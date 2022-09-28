<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderproduct extends Model
{
    use HasFactory;

    protected $table = 'orderproducts';

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
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
