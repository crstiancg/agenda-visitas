<?php

namespace Database\Seeders;

use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    private static $defaultRanges = [
        ['start' => ['hour' => 9, 'minute' => 0], 'end' => ['hour' => 9, 'minute' => 30]],
        ['start' => ['hour' => 9, 'minute' => 30], 'end' => ['hour' => 10, 'minute' => 0]],
        ['start' => ['hour' => 10, 'minute' => 0], 'end' => ['hour' => 10, 'minute' => 30]],
        ['start' => ['hour' => 10, 'minute' => 30], 'end' => ['hour' => 11, 'minute' => 0]],
        ['start' => ['hour' => 11, 'minute' => 0], 'end' => ['hour' => 11, 'minute' => 30]],
        ['start' => ['hour' => 11, 'minute' => 30], 'end' => ['hour' => 12, 'minute' => 0]],
        ['start' => ['hour' => 12, 'minute' => 0], 'end' => ['hour' => 12, 'minute' => 30]],
        ['start' => ['hour' => 12, 'minute' => 30], 'end' => ['hour' => 13, 'minute' => 0]],
        ['start' => ['hour' => 13, 'minute' => 0], 'end' => ['hour' => 13, 'minute' => 30]],
        ['start' => ['hour' => 13, 'minute' => 30], 'end' => ['hour' => 14, 'minute' => 0]],
        ['start' => ['hour' => 14, 'minute' => 0], 'end' => ['hour' => 14, 'minute' => 30]],
        ['start' => ['hour' => 14, 'minute' => 30], 'end' => ['hour' => 15, 'minute' => 0]],
        ['start' => ['hour' => 15, 'minute' => 0], 'end' => ['hour' => 15, 'minute' => 30]],
        ['start' => ['hour' => 15, 'minute' => 30], 'end' => ['hour' => 16, 'minute' => 0]],
        ['start' => ['hour' => 16, 'minute' => 0], 'end' => ['hour' => 16, 'minute' => 30]],
        ['start' => ['hour' => 16, 'minute' => 30], 'end' => ['hour' => 17, 'minute' => 00]],
    ];

    private static $subjects = [
        "Reunión de la junta de concejales para discutir el presupuesto municipal",
        "Entrevista con el director del departamento de obras públicas sobre los proyectos de infraestructura",
        "Presentación del informe de seguridad ciudadana ante el comité de seguridad",
        "Visita a la escuela primaria para inaugurar una nueva sala de computación",
        "Reunión con representantes de la comunidad para discutir programas de desarrollo económico",
        "Entrevista con el periodista local para hablar sobre las políticas de medio ambiente",
        "Charla sobre prevención de violencia de género en el centro comunitario",
        "Asistencia a la ceremonia de graduación de la academia de policía",
        "Reunión con el sindicato de trabajadores municipales para discutir contratos laborales",
        "Visita a la planta de tratamiento de aguas residuales para evaluar su funcionamiento",
        "Entrevista con el jefe de bomberos sobre el plan de emergencias municipal",
        "Reunión con el equipo de asesores legales para revisar ordenanzas municipales",
        "Asistencia a la feria de empleo para promover oportunidades laborales en el municipio",
        "Visita a la comunidad rural para conocer sus necesidades de servicios públicos",
        "Entrevista con el representante del sindicato de maestros sobre las condiciones de trabajo",
        "Reunión con el comité de turismo para planificar eventos culturales en el municipio",
        "Visita al hospital local para inaugurar una nueva sala de emergencias",
        "Entrevista con el concejal de planificación urbana sobre el crecimiento de la ciudad",
        "Charla sobre educación vial en la escuela secundaria para promover la seguridad vial",
        "Reunión con representantes de organizaciones sin fines de lucro para discutir proyectos comunitarios",
        "Visita al centro de atención a personas mayores para conocer sus necesidades de atención",
        "Entrevista con el director del departamento de finanzas para revisar el presupuesto municipal",
        "Reunión con el comité de desarrollo económico para atraer inversiones al municipio",
        "Asistencia a la ceremonia de apertura de un nuevo parque recreativo",
        "Visita a la comisaría de policía para conocer las necesidades de seguridad en el municipio",
        "Entrevista con el director del departamento de educación para mejorar la calidad de las escuelas",
        "Charla sobre prevención de incendios en la comunidad para promover la seguridad",
        "Reunión con representantes de empresas locales para fomentar el desarrollo empresarial",
        "Visita al centro deportivo para promover la actividad física entre los jóvenes",
        "Entrevista con el concejal de medio ambiente sobre políticas de sostenibilidad",
        "Asistencia a la ceremonia de premiación a los mejores estudiantes del año",
        "Reunión con el comité de vivienda para discutir programas de vivienda asequible",
        "Visita a la biblioteca municipal para promover la lectura entre los ciudadanos",
        "Entrevista con el representante de la asociación de vecinos sobre mejoras en el barrio",
        "Charla sobre prevención de drogas en la escuela para concienciar a los estudiantes",
        "Reunión con el comité de igualdad de género para promover la equidad en el municipio",
        "Visita a la empresa de reciclaje para impulsar prácticas sostenibles en el municipio",
        "Entrevista con el director del departamento de cultura para planificar eventos artísticos",
        "Asistencia a la inauguración de una exposición de arte local",
        "Visita al centro de atención a personas con discapacidad para conocer sus necesidades",
        "Entrevista con el concejal de transporte para mejorar el sistema de transporte público",
        "Charla sobre prevención de enfermedades en la comunidad para promover la salud",
        "Reunión con el comité de turismo para promover el turismo local",
        "Visita al centro comunitario para discutir programas de ayuda social",
        "Entrevista con el director del departamento de tecnología para mejorar los servicios digitales",
        "Asistencia a la feria agrícola para apoyar a los agricultores locales",
        "Reunión con representantes de la comunidad indígena para conocer sus necesidades",
        "Visita al centro de rehabilitación para personas con adicciones para brindar apoyo",
        "Entrevista con el concejal de deportes para promover actividades deportivas en el municipio",
        "Charla sobre cuidado del medio ambiente en la escuela para concienciar a los estudiantes",
        "Reunión con el comité de desarrollo urbano para planificar el crecimiento sostenible",
        "Visita a la asociación de pequeños empresarios para brindar apoyo y capacitación",
        "Entrevista con el director del departamento de salud para mejorar los servicios sanitarios",
        "Asistencia a la inauguración de un centro cultural en el municipio",
        "Reunión con representantes de la comunidad inmigrante para promover la integración",
        "Visita al centro de atención a víctimas de violencia doméstica para ofrecer apoyo",
        "Entrevista con el concejal de educación sobre políticas de inclusión en las escuelas",
        "Charla sobre prevención de accidentes de tránsito para promover la seguridad vial",
        "Reunión con el comité de desarrollo económico para impulsar el emprendimiento local",
        "Visita al centro de atención a personas sin hogar para brindar apoyo y recursos",
        "Entrevista con el director del departamento de planificación para mejorar el urbanismo",
        "Asistencia a la celebración del aniversario de la fundación del municipio",
        "Reunión con representantes de asociaciones culturales para promover la diversidad",
        "Visita al centro de atención a personas mayores para brindar apoyo y recreación",
        "Entrevista con el concejal de seguridad ciudadana sobre estrategias de prevención del delito",
        "Charla sobre educación financiera en la escuela para promover el manejo responsable del dinero"
    ];


    public function run(): void
    {
        // Generate a random amount of visits for each day of the week
        $this->generateVisitsPerDay(80);
    }

    /**
     * Generate a random amount of visits for each day of the week.
     * @param int $numVisits The number of visits to generate per day.
     * @return array An array of generated visits.
     */
    public function generateVisitsPerDay(int $numVisits): array
    {
        $visits = [];
        // Start from a month ago
        $date = Carbon::now()->subMonth();
        for ($i = 0; $i < $numVisits; $i++) {
            // Skip weekends and move to Monday
            if ($date->isWeekend()) {
                $date->next(Carbon::MONDAY);
            }

            $visits = array_merge($visits, $this->generateVisits($date));
            $date->addDay();
        }

        return $visits;
    }

    /**
     * Generate a random amount of visits for a given date.
     * @param Carbon $date The date to generate visits for.
     * @return array An array of generated visits.
     */
    public function generateVisits(Carbon $date): array
    {
        $defaultRanges = self::$defaultRanges;
        $timeRanges = [];

        // Generate a random amount of time ranges for the given day
        $amount = mt_rand(1, count($defaultRanges));
        while (count($timeRanges) < $amount) {
            $randomIndex = array_rand($defaultRanges);
            $selectedTimeRange = $defaultRanges[$randomIndex];
            $isDuplicate = false;

            // Check if the time range is already in the array
            foreach ($timeRanges as $time) {
                if ($time['start'] === $selectedTimeRange['start']) {
                    $isDuplicate = true;
                    break;
                }
            }

            // If the time range is not a duplicate, add it to the array
            if (!$isDuplicate) {
                $timeRanges[] = [
                    'start' => $selectedTimeRange['start'],
                    'end' => $selectedTimeRange['end'],
                ];
            }
        }

        $visits = [];

        foreach ($timeRanges as $timeRange) {
            $visits[] = Visit::factory()->create([
                'subject' => self::$subjects[array_rand(self::$subjects)],
                'start_date' => $date->copy()->setTime($timeRange['start']['hour'], $timeRange['start']['minute'], 0),
                'end_date' => $date->copy()->setTime($timeRange['end']['hour'], $timeRange['end']['minute'], 0),
            ]);
        }

        return $visits;
    }
}
