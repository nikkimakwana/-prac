<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeCard extends Model
{
    use HasFactory;

    protected $table = 'stripe_card';

    protected $guarded = ['id'];
}
