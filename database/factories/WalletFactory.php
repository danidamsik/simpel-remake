<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $banks = [
            'BCA'      => 10,
            'BRI'      => 15,
            'BNI'      => 10,
            'Mandiri' => 13,
            'BSI'      => 10,
            'BTN'      => 10,
        ];

        $bankName = $this->faker->randomElement(array_keys($banks));
        $accountLength = $banks[$bankName];

        return [
            'bank_name' => $bankName,
            'account_name' => $this->faker->name(),
            'account_number' => $this->faker->numerify(str_repeat('#', $accountLength)),
            'balance' => $this->faker->numberBetween(500_000, 50_000_000),
        ];
    }
}
