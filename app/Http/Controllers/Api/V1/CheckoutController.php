<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Services\Coinbase\Commerce\CheckoutService;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct(protected CheckoutService $checkoutService) {}

    /**
     * Handle the incoming request to create a checkout session.
     *
     * @param CheckoutRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(CheckoutRequest $request)
    {
        $validated = $request->validated();

        try {
            $checkout = $this->checkoutService->create($validated['amount'], $validated['email']);
            return response()->json([
                'message' => 'Checkout created successfully',
                'data' => [
                    'payment_url' => $checkout['payment_url'],
                ],
            ], 201);
        } catch (\Exception $e) {
            Log::error('Checkout failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create checkout: ' . $e->getMessage()], 500);
        }
    }
}
