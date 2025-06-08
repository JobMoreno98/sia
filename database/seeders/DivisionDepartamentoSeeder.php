<?php

namespace Database\Seeders;

use App\Models\Departamentos;
use App\Models\Divisiones;
use App\Models\ProgramaEducativo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionDepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    {
  $divisiones = [
            'División de Estudios Jurídicos' => [
                'Departamento de Derecho Privado' => [
                    'Licenciatura en Derecho',
                    'Maestría en Derecho Privado',
                    'Doctorado en Derecho Privado',
                ],
                'Departamento de Derecho Público' => [
                    'Maestría en Derecho Constitucional',
                    'Doctorado en Derecho Público',
                ],
                'Departamento de Derecho Social' => [
                    'Maestría en Derecho Social',
                    'Doctorado en Derecho Social',
                ],
                'Departamento de Disciplinas sobre el Derecho' => []
            ],
            'División de Estudios Históricos y Humanos' => [
                'Departamento de Lenguas Modernas' => [
                    'Licenciatura en Lenguas Modernas',
                    'Maestría en Lingüística Aplicada',
                    'Doctorado en Estudios Lingüísticos'
                ],
                'Departamento de Filosofía' => [
                    'Licenciatura en Filosofía',
                    'Maestría en Filosofía',
                    'Doctorado en Filosofía',
                ],
                'Departamento de Geografía y Ordenación Territorial' => [
                    'Licenciatura en Geografía',
                    'Maestría en Ordenación Territorial',
                ],
                'Departamento de Historia' => [
                    'Licenciatura en Historia',
                    'Maestría en Historia de México',
                    'Doctorado en Historia',
                ],
                'Departamento de Letras' => [
                    'Licenciatura en Letras Hispánicas',
                    'Maestría en Literatura',
                    'Doctorado en Estudios Literarios',
                ]
            ],
            'División de Estudios de la Cultura' => [
                'Departamentos de Estudios en Lenguas Indígenas' => [
                    'Licenciatura en Lenguas Indígenas',
                    'Maestría en Estudios Indígenas',
                ],
                'Departamentos de Estudios de la Comunicación Social' => [
                    'Licenciatura en Comunicación Pública',
                    'Maestría en Comunicación Social',
                    'Doctorado en Comunicación',
                ],
                'Departamentos de Estudios Literarios' => [
                    'Licenciatura en Literatura',
                    'Maestría en Literatura Comparada',
                ],
                'Departamentos de Estudios Mesoamericanos y Mexicanos' => [
                    'Maestría en Estudios Mesoamericanos',
                    'Doctorado en Estudios Mexicanos',
                ]
            ],
            'División de Estudios Políticos y Sociales' => [
                'Departamento de Estudios Internacionales' => [
                    'Licenciatura en Relaciones Internacionales',
                    'Maestría en Relaciones Internacionales',
                    'Doctorado en Estudios Internacionales',
                ],
                'Departamento de Sociología' => [
                    'Licenciatura en Sociología',
                    'Maestría en Sociología',
                    'Doctorado en Sociología',
                ],
                'Departamento de Estudios Políticos' => [
                    'Licenciatura en Ciencia Política',
                    'Maestría en Ciencia Política',
                    'Doctorado en Ciencia Política',
                ],
                'Departamento de Trabajo Social' => [
                    'Licenciatura en Trabajo Social',
                    'Maestría en Trabajo Social',
                ],
                'Departamento de Desarrollo Social' => [
                    'Maestría en Desarrollo Social',
                ]
            ],
            'División de Estudios de Estado y Sociedad' => [
                'Departamento de Estudios de Educación' => [
                    'Licenciatura en Educación',
                    'Maestría en Educación',
                    'Doctorado en Educación',
                ],
                'Departamento de Estudios Iberos y Latinoamericanos' => [
                    'Maestría en Estudios Latinoamericanos',
                    'Doctorado en Estudios Iberoamericanos',
                ],
                'Departamento de Estudios sobre Movimientos Sociales' => [
                    'Maestría en Movimientos Sociales',
                    'Doctorado en Ciencias Sociales',
                ],
                'Departamento de Estudios Socio Urbanos' => [
                    'Maestría en Desarrollo Urbano',
                ],
                'Departamento de Estudios del Pacífico' => []
            ]
        ];
        foreach ($divisiones as $divisionNombre => $departamentos) {
            $divisionId = Divisiones::insertGetId([
                'nombre' => $divisionNombre
            ]);

            foreach ($departamentos as $departamentoNombre => $programas) {
                $departamentoId = Departamentos::insertGetId([
                    'nombre' => $departamentoNombre,
                    'division_id' => $divisionId
                ]);

                foreach ($programas as $programaNombre) {
                    ProgramaEducativo::insert([
                        'nombre' => $programaNombre,
                        'departamento_id' => $departamentoId
                    ]);
                }
            }
        }
    }
    }
}
