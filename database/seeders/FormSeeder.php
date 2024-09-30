<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\FormField;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $form = Form::create(['name' => 'Contacto']);

        $form->fields()->createMany([
            ['name' => 'Nombre', 'type' => 'text', 'required' => true],
            ['name' => 'Correo', 'type' => 'email', 'required' => true],
            ['name' => 'Mensaje', 'type' => 'textarea', 'required' => false],
        ]);
    }
}
