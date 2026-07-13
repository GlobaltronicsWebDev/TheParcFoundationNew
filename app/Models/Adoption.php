<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
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
        'package',
        'amount',
        'emailUpdates',
        'textUpdates',
        'cover_processing_fee',
        'receipt_path',
    ];
}
