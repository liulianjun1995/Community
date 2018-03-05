<?php

namespace App\Http\Controllers;

use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * 获取所有的版块
     */
    public function category(){
        return Category::all();
    }
}
