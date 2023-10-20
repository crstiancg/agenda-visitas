<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    public function definition()
    {
        $visitor = [
            'name' => $this->faker->name,
            'phone_number' => $this->faker->optional()->phoneNumber,
            'email' => $this->faker->unique()->email(),
            'entity' => $this->faker->randomElement(['Persona natural', 'Persona jurídica']),
        ];

        // RUC must only be available if the entity is persona juridica
        if ($visitor['entity'] == 'Persona jurídica') {
            // A random number of 11 digits
            $visitor['ruc'] = $this->faker->randomNumber(5, true) . $this->faker->randomNumber(6, true);
        } else {
            $visitor['dni'] = $this->faker->unique()->randomNumber(8, true);
        }

        return $visitor;
    }
}
