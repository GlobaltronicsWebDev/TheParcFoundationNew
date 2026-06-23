<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'country',
        'street',
        'city',
        'postal',
        'emailUpdates',
        'textUpdates',
        'card_number',
        'expiration_month',
        'expiration_year',
        'cvv',
        'cover_processing_fee',
    ];
}

