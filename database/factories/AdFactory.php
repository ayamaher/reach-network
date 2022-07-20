<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Advertiser;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' =>  $this->faker->randomElement(['paid', 'free']),
            'title' => $this->faker->text(10),
            'description' => $this->faker->text(30),
            'category_id' => function () {
                return Category::factory();
            },
            'advertiser_id' => function () {
                return Advertiser::factory();
            },
            'start_date' => $this->faker->date('Y-m-d'),
        ];
    }

}
