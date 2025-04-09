<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $field_name = [
            'Lapangan A',
            'Lapangan B',
            'Lapangan C',
            'Lapangan D',
            'Lapangan E'
        ];

        $image = 'field_'.(string) rand(1,15).'.jpg';
        return [
            'name' => $this->faker->randomElement($field_name),
            'field_type_id' => $this->faker->numberBetween(1, 6),
            'image' => $image,
        ];
    }
}
