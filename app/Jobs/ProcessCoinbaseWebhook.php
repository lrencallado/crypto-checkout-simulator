<?php

namespace App\Jobs;

use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob as SpatieProcessWebhookJob;

class ProcessCoinbaseWebhook extends SpatieProcessWebhookJob
{
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payload = $this->webhookCall->payload;

        // Check if event type is 'charge:confirmed'
        if ($payload['event']['type'] === 'charge:confirmed') {
            // Process the confirmed charge
            Log::info('Processing event charge:confirmed.', ['payload' => $payload]);
            $this->processConfirmedCharge($payload['event']['data']);
        }
    }

    /**
     * Process the confirmed charge data.
     *
     * @param array $data
     */
    private function processConfirmedCharge(array $data): void
    {
        $transactionRepository = new TransactionRepository();
        $transaction = $transactionRepository->create([
            'reference_id' => $data['transaction_id'],
            'email' => $data['email'],
            'amount' => $data['amount'],
            'status' => $data['status'],
        ]);
        Log::info('Transaction has been created.', ['transaction' => $transaction]);
    }
}
