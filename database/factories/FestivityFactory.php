<?php

namespace Database\Factories;

use App\Models\Festivity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Lorem;
use Faker\Provider\DateTime;
use Faker\Provider\pt_BR\Address;


class FestivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Festivity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Lorem::sentence(4),
            'tag' => Lorem::word(),
            'month' => DateTime::date(),
            'local' => Address::state(),
            'desc' => Lorem::text(500),
        ];
    }
}
