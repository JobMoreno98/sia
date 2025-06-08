<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Titulacion extends Model
{
      protected $guarded = [];
      public function programa()
      {
            return $this->belongsTo(ProgramaEducativo::class, 'programa_id');
      }

      // En el modelo o una clase Enum simulada
      public static function niveles(): array
      {
            return [
                  'Licenciatura' => 'Licenciatura',
                  'Maestría' => 'Maestría',
                  'Doctorado' => 'Doctorado',
            ];
      }

      public static function participaciones(): array
      {
            return [
                  'Director' => 'Director',
                  'Co Director' => 'Co Director',
                  'Sinodal' => 'Sinodal',
                  'Lector' => 'Lector',
            ];
      }
      public static function tiposTutoria(): array
      {
            return [
                  'Tutoría académica individual' => 'Tutoría académica individual',
                  'Tutoría académica grupal' => 'Tutoría académica grupal',
                  'Tutorías en el nivel medio superior' => 'Tutorías en el nivel medio superior',
                  'Tutor de alumnos para Prácticas profesionales' => 'Tutor de alumnos para Prácticas profesionales',
                  'Tutor de alumnos para Servicio social' => 'Tutor de alumnos para Servicio social',
                  'Tutor de estudiantes indígenas' => 'Tutor de estudiantes indígenas',
                  'Asesoría disciplinar para alumnos rezagados' => 'Asesoría disciplinar para alumnos rezagados',
                  'Preparación de alumnos para olimpiadas' => 'Preparación de alumnos para olimpiadas',
                  'Preparación de alumnos para competencias académicas' => 'Preparación de alumnos para competencias académicas',
                  'Preparación de alumnos para exámenes generales' => 'Preparación de alumnos para exámenes generales',
                  'Dirección de Titulación' => 'Dirección de Titulación',
                  'Asesoría de tesis' => 'Asesoría de tesis',
                  'Lector de tesis' => 'Lector de tesis',
                  'Sinodal en exámenes de titulación' => 'Sinodal en exámenes de titulación',
                  'Participación en los programas de orientación educativa' => 'Participación en los programas de orientación educativa',
            ];
      }
}
