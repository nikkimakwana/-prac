<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product';

    protected $guarded = ['id'];

	protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = date('Y-m-d H:i:s');
            if (Auth::check()) {
                $model->created_by = Auth::id();
            }
        });

        static::updating(function($model) {
			$model->updated_at = date('Y-m-d H:i:s');
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function($model) {
			if (Auth::check()) {
                $model->deleted_by = Auth::id();
            }
        });
    } 
}
