<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'card';

    protected $fillable = [
    	'person_name', 'designation', 'business_name','short_description','photo','whatsapp_number','email','address','slug'
    ];
}