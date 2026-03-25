<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = ['account_title', 'account_number', 'bank_name', 'balance','status'];

    public function donations()
{
    return $this->hasMany(Donation::class, 'bank_account_id');
}
    public function transfers()
{
    return $this->hasMany(Donation::class, 'bank_account_id');
}
}
