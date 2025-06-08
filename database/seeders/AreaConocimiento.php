<?php

namespace Database\Seeders;

use App\Models\Disciplinas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaConocimiento extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disciplinas = [
            'Educación',
            'Antropología Física',
            'Arqueología',
            'Estética',
            'Etnohistoria',
            'Filología',
            'Filosofía',
            'Historia',
            'Arquitectura',
            'Urbanismo',
            'Psicología',
            'Literatura',
            'Lingüística y disciplinas afines',
            'Sociología',
            'Antropología Social',
            'Demografía',
            'Comunicación',
            'Derecho',
            'Etnología',
            'Geografía',
            'Administración y políticas públicas y administración privada',
            'Ciencias políticas',
            'Relaciones internacionales y de disciplinas afines',
        ];

        foreach ($disciplinas as $nombre) {
            Disciplinas::create([
                'nombre' => $nombre,
                'tipo' => 'Área de Conocimiento',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $areas = [
            'Análisis del discurso',
            'Antropología',
            'Antropología ecológica',
            'Antropología social',
            'Antropología y sociología',
            'Arte y estética',
            'Ciencia política',
            'Ciencias de la educación',
            'Ciencias sociales',
            'Ciencias sociales (otros)',
            'Comunicación',
            'Comunicación social',
            'Derecho',
            'Derecho constitucional',
            'Derecho penal',
            'Desarrollo económico regional',
            'Desarrollo humano',
            'Docencia de calidad',
            'Economía regional',
            'Educación',
            'Educación superior',
            'Educación, humanidades y artes',
            'Estudios regionales',
            'Filosofía',
            'Filosofía de las religiones',
            'Filosofía, literatura y arte',
            'Geografia fisica',
            'Geografia humana',
            'Historia',
            'Historia de la educación',
            'Historia y antropología',
            'Lengua y literatura',
            'Lenguaje y comunicación',
            'Lingüística',
            'Lingüística aplicada al frances',
            'Literatura',
            'Literatura mexicana',
            'Planeación y desarrollo',
            'Política educativa',
            'Relaciones internacionales',
            'Sociología',
            'Sociología (otros)',
            'Sociología de la educación',
            'Trabajo social',
        ];

        foreach ($areas as $nombre) {
            Disciplinas::create([
                'nombre' => $nombre,
                'tipo' => 'Disciplina',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
