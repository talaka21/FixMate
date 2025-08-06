<?php

namespace Database\Factories;

use App\Enum\statusServiceProviderRequestEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProviderRequest>
 */
class ServiceProviderRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'provider_name'   => $this->faker->company,
            'shop_name'       => $this->faker->word . ' Shop',
            'description'     => $this->faker->sentence,
            'phone'           => $this->faker->phoneNumber,
            'whatsapp'        => $this->faker->optional()->phoneNumber,
            'facebook'        => $this->faker->optional()->url,
            'instagram'       => $this->faker->optional()->url,
            'image' => $this->faker->optional()->imageUrl(),
     'is_read' => $this->faker->boolean(30),
            'status' => $this->faker->randomElement(array_column(statusServiceProviderRequestEnum::cases(), 'value')),
            'category_id'     => $this->faker->numberBetween(1, 6),
            'subcategory_id'  => $this->faker->numberBetween(1, 2),
            'state_id'        => $this->faker->numberBetween(1, 3),
            'city_id'         => $this->faker->numberBetween(1, 5),
        ];
    }
}
