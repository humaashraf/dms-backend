<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationCategory extends Model
{
    protected $fillable = ['name', 'status'];

    public function donations()
{
    return $this->hasMany(Donation::class);
}

}
