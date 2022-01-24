<?php

namespace Database\Factories;

use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array
     */
    protected $model = Test::class;

    public function definition()
    {
        return [
            'category_trainings_id' => $this->faker->numberBetween(1, 4),
            'subcategory_trainings_id' => $this->faker->numberBetween(1, 4),
            'lesson_id' => $this->faker->numberBetween(1, 4),
            'nameTest' => $this->faker->word(),
            'typeTest' => $this->faker->word(),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'duration' => $this->faker->time('D_H_i_s'),
            'description' => $this->faker->sentence()
        ];
    }
}
