<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    protected $fillable = ['smtp_host', 'username', 'password', 'smtp_secure', 'port', 'from_email'];
}
