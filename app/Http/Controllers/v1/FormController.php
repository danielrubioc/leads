<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Obtiene todos los formularios con sus campos
    public function index()
    {
        return Form::with('fields')->get();
    }

    // Crea un nuevo formulario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $form = Form::create($request->only('name'));

        return response()->json($form, 201);
    }

    // Envía los datos del formulario
    public function submit(Request $request, $id)
    {
        $form = Form::with('fields')->findOrFail($id);

        // Validar los campos del formulario
        $validatedData = $request->validate($this->getValidationRules($form));

        // Guardar los datos del envío
        $submission = FormSubmission::create([
            'form_id' => $form->id,
            'data' => $validatedData,
        ]);

        return response()->json($submission, 201);
    }

    // Genera reglas de validación a partir de los campos del formulario
    private function getValidationRules($form)
    {
        $rules = [];

        foreach ($form->fields as $field) {
            $rules[$field->name] = $field->required ? 'required' : 'nullable';
            if ($field->type === 'email') {
                $rules[$field->name] .= '|email';
            }
        }

        return $rules;
    }
}
