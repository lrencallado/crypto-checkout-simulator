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
}
