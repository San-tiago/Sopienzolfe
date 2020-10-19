<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    //
    public function index(){
        return view('Category.categories');
    }
    public function create(){
        return view('Category.createcategory');
    }
    public function store(Request $request){
        $data = request()->validate([
            'category' => 'required',
        ]);
        Category::create($request->all());
        return redirect('/admin/categories');
    }

}
