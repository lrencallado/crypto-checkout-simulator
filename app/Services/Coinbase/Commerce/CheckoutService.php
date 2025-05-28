<?php

namespace App\Services\Coinbase\Commerce;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CheckoutService
{

    /**
     * Creates a simulated checkout session using the Coinbase Commerce API.
     *
     * @param float $amount The amount to be charged. Must be greater than zero.
     * @param string $email The email address of the customer.
     * @return array The checkout session data, including transaction ID and payment URL.
     * @throws \InvalidArgumentException If the amount is less than or equal to zero.
     * @throws \RuntimeException If the simulated API call fails to create a checkout session.
     */
    public function create(float $amount, string $email): array
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero.');
        }

        // Simulates calling the Coinbase Commerce API

        // 1. Mock the endpoint
        Http::fake([
            'https://fake-api.commerce.coinbase.com/checkouts' => Http::response([
                'data' => [
                    'payment_url' => 'https://fake.coinbase.com/pay/' . Str::ulid(),
                ],
            ], 201),
        ]);

        // 2. Make the request from the fake endpoint
        $response = Http::post('https://fake-api.commerce.coinbase.com/checkouts', [
            'email' => $email,
            'amount' => $amount,
        ]);

        if ($response->failed()) {
            throw new \RuntimeException('Failed to create checkout session.');
        }

        return $response->json('data');
    }
}
