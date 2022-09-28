<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getAllSubCategoryData($id){
		return $getData = SubCategory::where('category_id',$id)->get(["subcategory_name", "id"]);
	}
}
