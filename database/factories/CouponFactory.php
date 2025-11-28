<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition()
    {
        $regularPrice = $this->faker->randomFloat(2, 10, 100);
        $offerPrice = $this->faker->randomFloat(2, 1, $regularPrice - 1);
        $startDate = $this->faker->dateTimeBetween('now', '+1 week');
        $endDate = (clone $startDate)->modify('+7 days');
        $redemptionDeadline = (clone $endDate)->modify('+3 days');

        $user = User::whereHas('roles', function ($q) {
            $q->where('name', 'empresa');
        })->first();
        if (!$user) {
            $user = User::factory()->create();
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('empresa');
            }
        }
        return [
            'user_id' => $user->id,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'regular_price' => $regularPrice,
            'offer_price' => $offerPrice,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'redemption_deadline' => $redemptionDeadline,
            'quantity' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }
}
