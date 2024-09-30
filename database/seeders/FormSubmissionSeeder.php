<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\FormSubmission;
use App\Models\FormField;
use App\Models\Form;


class FormSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Obtener el ID del formulario de contacto que se creó en el FormSeeder
        $form = Form::where('name', 'Contacto')->first();

        if ($form) {
            foreach (range(1, 50) as $index) {
                $formFields = FormField::where('form_id', $form->id)->get();

                $formData = [];
                foreach ($formFields as $field) {
                    // Asignar un valor basado en el tipo de campo
                    if ($field->type === 'email') {
                        $formData[$field->name] = $faker->email;
                    } elseif ($field->type === 'textarea' || $field->name === 'Mensaje') {
                        $formData[$field->name] = $faker->text(200); // Ajusta según sea necesario
                    } else {
                        $formData[$field->name] = $faker->text(50);
                    }
                }

                FormSubmission::create([
                    'form_id' => $form->id,
                    'data' => json_encode($formData), // Almacena los datos del formulario en formato JSON
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
