<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Visitor::factory(30)->create();
        $visitors = [
            [
                'name' => 'Juan Pérez',
                'entity' => 'Persona natural',
                'email' => 'juanperez@example.com',
            ],
            [
                'name' => 'María González',
                'entity' => 'Persona natural',
                'email' => 'mariagonzalez@example.com',
            ],
            [
                'name' => 'Empresa ABC',
                'entity' => 'Persona jurídica',
                'email' => 'empresaabc@example.com',
            ],
            [
                'name' => 'Pedro López',
                'entity' => 'Persona natural',
                'email' => 'pedrolopez@example.com',
            ],
            [
                'name' => 'Compañía XYZ',
                'entity' => 'Persona jurídica',
                'email' => 'companiaxyz@example.com',
            ],
            [
                'name' => 'Ana Torres',
                'entity' => 'Persona natural',
                'email' => 'anatorres@example.com',
            ],
            [
                'name' => 'Empresa DEF',
                'entity' => 'Persona jurídica',
                'email' => 'empresadef@example.com',
            ],
            [
                'name' => 'Luis García',
                'entity' => 'Persona natural',
                'email' => 'luisgarcia@example.com',
            ],
            [
                'name' => 'Empresa GHI',
                'entity' => 'Persona jurídica',
                'email' => 'empresaghi@example.com',
            ],
            [
                'name' => 'Laura Mendoza',
                'entity' => 'Persona natural',
                'email' => 'lauramendoza@example.com',
            ],
            [
                'name' => 'Carlos Rodríguez',
                'entity' => 'Persona natural',
                'email' => 'carlosrodriguez@example.com',
            ],
            [
                'name' => 'Empresa JKL',
                'entity' => 'Persona jurídica',
                'email' => 'empresajkl@example.com',
            ],
            [
                'name' => 'Fernanda Vargas',
                'entity' => 'Persona natural',
                'email' => 'fernandavargas@example.com',
            ],
            [
                'name' => 'Empresa MNO',
                'entity' => 'Persona jurídica',
                'email' => 'empresamno@example.com',
            ],
            [
                'name' => 'Gonzalo Silva',
                'entity' => 'Persona natural',
                'email' => 'gonzalosilva@example.com',
            ],
            [
                'name' => 'Empresa PQR',
                'entity' => 'Persona jurídica',
                'email' => 'empresapqr@example.com',
            ],
            [
                'name' => 'Paola Chávez',
                'entity' => 'Persona natural',
                'email' => 'paolachavez@example.com',
            ],
            [
                'name' => 'Empresa STU',
                'entity' => 'Persona jurídica',
                'email' => 'empresastu@example.com',
            ],
            [
                'name' => 'Martín López',
                'entity' => 'Persona natural',
                'email' => 'martinlopez@example.com',
            ],
            [
                'name' => 'Empresa VWX',
                'entity' => 'Persona jurídica',
                'email' => 'empresavwx@example.com',
            ],
            [
                'name' => 'Rosa Fernández',
                'entity' => 'Persona natural',
                'email' => 'rosafernandez@example.com',
            ],
            [
                'name' => 'Empresa YZA',
                'entity' => 'Persona jurídica',
                'email' => 'empresayza@example.com',
            ],
            [
                'name' => 'Andrés Sánchez',
                'entity' => 'Persona natural',
                'email' => 'andressanchez@example.com',
            ],
            [
                'name' => 'Empresa BCD',
                'entity' => 'Persona jurídica',
                'email' => 'empresabcd@example.com',
            ],
            [
                'name' => 'Gabriela Ramírez',
                'entity' => 'Persona natural',
                'email' => 'gabrielaramirez@example.com',
            ],
            [
                'name' => 'Empresa EFG',
                'entity' => 'Persona jurídica',
                'email' => 'empresaefg@example.com',
            ],
            [
                'name' => 'Julio Montes',
                'entity' => 'Persona natural',
                'email' => 'juliomontes@example.com',
            ],
            [
                'name' => 'Empresa UVW',
                'entity' => 'Persona jurídica',
                'email' => 'empresauvw@example.com',
            ],
            [
                'name' => 'Carolina López',
                'entity' => 'Persona natural',
                'email' => 'carolinalopez@example.com',
            ],
            [
                'name' => 'Empresa XYZ',
                'entity' => 'Persona jurídica',
                'email' => 'empresaxyz@example.com',
            ],
        ];


        foreach ($visitors as $visitor) {
            Visitor::factory()->create($visitor);
        }
    }
}
