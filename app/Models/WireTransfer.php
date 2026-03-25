<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WireTransfer extends Model
{
    protected $fillable = ['name', 'amount', 'status', 'date', 'bank_account_id', 'remaining_amount'];

    protected $casts = [
    'date' => 'datetime',
    ];

    public function bankAccount()
{
    return $this->belongsTo(BankAccount::class, 'bank_account_id');
}

}
