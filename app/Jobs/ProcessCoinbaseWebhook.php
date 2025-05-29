<?php

namespace App\Jobs;

use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob as SpatieProcessWebhookJob;

class ProcessCoinbaseWebhook extends SpatieProcessWebhookJob
{
    protected $transactionRepository;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payload = $this->webhookCall->payload;
        $this->transactionRepository = new TransactionRepository();

        // Check if event type is 'charge:confirmed'
        if ($payload['event']['type'] === 'charge:confirmed') {
            $transactionId = $payload['event']['data']['transaction_id'];
            $status = $payload['event']['data']['status'];

            $isDuplicate = $this->transactionRepository->isDuplicate($transactionId, $status);

            if ($isDuplicate) {
                Log::info('Transaction already exists, skipping processing.', ['transaction_id' => $transactionId]);
                return;
            }

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
        $transaction = $this->transactionRepository->create([
            'reference_id' => $data['transaction_id'],
            'email' => $data['email'],
            'amount' => $data['amount'],
            'status' => $data['status'],
        ]);
        Log::info('Transaction has been created.', ['transaction' => $transaction]);
    }
}
