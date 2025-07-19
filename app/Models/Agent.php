<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getFinalBalance()
    {
        $lastTransaction = Transaction::where('agent_id', $this->id)
            ->orderBy('id', 'desc')
            ->first();

        return $lastTransaction->final_balance ?? 0;
    }
}
