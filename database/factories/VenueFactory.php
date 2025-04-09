<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $venue_name = [
            'Rafhley Futsal',
            'Green Futsal',
            'Dallas Futsal',
            'Glory Futsal',
            'Perdana Futsal',
            'Arena Futsal',
            'Kenzie Futsal',
            'Family Futsal',
            'Kanda Futsal',
            'Pandawa Futsal',
            'Piai Futsal',
            'G Sport Futsal',
            'Lapai Futsal',
            'Golden Futsal',
            'Premier Futsal',
            'Prima Futsal',
            'Sawahan Futsal',
            'Pondok Futsal',
            'Siteba Futsal',
            'Salingka Futsal',
            'Radja Futsal',
            'Graha Futsal',
            'Point Futsal',
            'Putra Futsal',
            'Minang Futsal',
            'Silungkang Futsal',
            'Tarandam Futsal',
            'Unand Futsal',
            'Nipah Futsal',
            'Veteran Futsal'
        ];

        $information = [
            'Venue ini berlokasi di tempat yang strategis dengan biaya yang cukup terjangkau',
            'Venue ini menyediakan lapangan futsal sesuai dengan jenis lapangan dan berbagai fasilitas lainnya.',
            'Venue lapangan yang populer dan menyediakan berbagai fasilitas yang menarik dan sesuai',
            'Booking lapangan futsal yang aman dengan harga terjangkau dan nyaman bermain disini',
            'Lapangan futsal terdiri dar berbagai jenis dan fasilitas untuk menunjang permainan futsal anda'
        ];

        return [
            'name' => $this->faker->randomElement($venue_name, $count = 1, $allowDuplicates = false),
            'status' => $this->faker->biasedNumberBetween($min = 0, $max = 2, $function = 'sqrt'),
            'dp_percentage' => $this->faker->randomElement([20,30,40]),
            'address' => $this->faker->streetAddress(),
            'information' => $this->faker->randomElement($information),
            'phone_number' => $this->faker->phoneNumber(),
            'latitude' => $this->faker->latitude($min = -0.8066666666666668, $max = -0.9072222222222223),
            'longitude' => $this->faker->longitude($min = 100.2911111111111, $max = 100.46138888888889)
        ];
    }
}