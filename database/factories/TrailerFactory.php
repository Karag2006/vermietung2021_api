<?php

namespace Database\Factories;

use App\Models\trailer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class TrailerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = trailer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->randomElement($array = array(
                'Autotransporter',
                '3m Plane',
                '1er Motorrad',
                '2er Motorrad',
                '1er Absenker'
            )),
            'plateNumber' => "SU - ES " . $this->faker->unique()->numberBetween($min = 100, $max = 9999),
            'chassisNumber' => $this->faker->md5,
            'totalWeight' => $this->faker->numberBetween($min = 750, $max = 3500) . " kg",
            'usableWeight' => $this->faker->numberBetween($min = 500, $max = 2500) . " kg",
            'loadingSize' => $this->faker->numberBetween($min = 200, $max = 600) .
                " x " .
                $this->faker->numberBetween($min = 100, $max = 220) .
                $this->faker->optional($weight = 0.5)->passthrough(
                    " x " .
                        $this->faker->numberBetween($min = 30, $max = 200)
                ) . " cm",
            'tuev' => Carbon::parse($this->faker->dateTimeBetween($startDate = 'now', $endDate = '+2 years', NULL))->format('d.m.Y'),
        ];
    }
}
