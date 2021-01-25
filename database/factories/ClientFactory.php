<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_document_type'=> $this->faker->randomDigitNotNull
            , 'id_municipality'=> $this->faker->randomDigitNotNull
            , 'document_number'=> $this->faker->numberBetween(100000,2000000)
            , 'full_name'=> $this->faker->name
            , 'address'=> $this->faker->address
            , 'phone'=> $this->faker->phoneNumber
        ];
    }
}
