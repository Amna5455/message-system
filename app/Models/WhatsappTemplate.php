<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'template_name',
        'language',
        'category',
        'broadcast_type',
        'broadcast_description',
        'broadcast_media',
        'broadcast_media_url',
        'footer_text',
        'body_text',
        'template_button',
        'cta_type',
        'phone_number',
        'phone_number_description',
        'website_description',
        'website_url',
        'website_type',
        'quick_reply_text'
    ];
}
