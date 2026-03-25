<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'city', 'address', 'amount', 'date', 'donation_category_id', 'bank_account_id', 'payment_method_id'];

    protected $casts = [
    'date' => 'datetime',
];


    public function category()
{
    return $this->belongsTo(DonationCategory::class, 'donation_category_id');
}

public function bankAccount()
{
    return $this->belongsTo(BankAccount::class, 'bank_account_id');
}
public function paymentMethod()
{
    return $this->belongsTo(PaymentMethod::class);
}


}


