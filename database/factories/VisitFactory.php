<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    public function definition(): array
    {
        $visitors = Visitor::pluck('id')->all();
        $users = User::pluck('id')->all();

        return [
            'subject' => $this->faker->word(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addHour(),
            'status' => $this->faker->randomElement(['Pendiente', 'Confirmado', 'Cancelado']),
            'visitor_id' => $this->faker->randomElement($visitors),
            'user_id' => $this->faker->randomElement($users)
        ];
    }
}
