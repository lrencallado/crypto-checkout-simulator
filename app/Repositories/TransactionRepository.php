<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{
    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function model(): string
    {
        return Transaction::class;
    }

    /**
     * Checks if a transaction with the given reference ID and status already exists.
     *
     * @param string $referenceId
     * @param string $status
     * @return bool Returns true if a duplicate transaction exists, false otherwise.
     */
    public function isDuplicate(string $referenceId, string $status): bool
    {
        return $this->model->where('reference_id', $referenceId)
            ->where('status', $status)
            ->exists();
    }
}
