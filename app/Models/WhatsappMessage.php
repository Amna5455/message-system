<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'from',
        'whole_message',
        'message_id'
    ];
}
