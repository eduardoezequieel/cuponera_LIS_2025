<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'coupon_id' => Coupon::factory(),
            'purchase_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'unique_code' => strtoupper(Str::random(8)),
            'payment_details' => [
                'card_type' => $this->faker->randomElement(['visa', 'mastercard']),
                'card_number' => '**** **** **** ' . $this->faker->numberBetween(1000, 9999),
                'cardholder_name' => $this->faker->name,
            ],
        ];
    }
}
