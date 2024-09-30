<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Profile;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    // Almacenar un nuevo lead
    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'rut' => 'required|string',
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'source' => 'nullable|string',
        ]);

        // Buscar o crear el perfil por RUT
        $profile = Profile::firstOrCreate(
            ['rut' => $validated['rut']],
            ['name' => $validated['name'], 'email' => $validated['email']]
        );

        // Crear el lead asociado al perfil
        $lead = Lead::create([
            'profile_id' => $profile->id,
            'source' => $validated['source'] ?? 'Unknown',
        ]);

        // Guardar los atributos del lead (excluyendo los campos estándar como rut, name, email y source)
        foreach ($request->except(['rut', 'name', 'email', 'source']) as $key => $value) {
            $lead->attributes()->create([
                'key' => $key,
                'value' => $value,
            ]);
        }

        return response()->json(['message' => 'Lead almacenado con éxito'], 201);
    }

    // Mostrar todos los leads de un perfil por RUT
    public function showLeadsByRut($rut)
    {
        $profile = Profile::where('rut', $rut)->first();

        if (!$profile) {
            return response()->json(['message' => 'Perfil no encontrado'], 404);
        }

        return response()->json($profile->leads->load('attributes'), 200);
    }
}
