<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = date('Y-m-d H:i:s');
        });

        static::updating(function($model) {
			$model->updated_at = date('Y-m-d H:i:s');
        });
    } 
}
