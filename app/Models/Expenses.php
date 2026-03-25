<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    protected $fillable = ['amount', 'date', 'details', 'receipt', 'expense_category_id', 'wire_transfer_id'];

    protected $casts = [
    'date' => 'datetime',
    ];

    public function category()
{
    return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
}

public function wireTransfer()
{
    return $this->belongsTo(WireTransfer::class);
}


}
