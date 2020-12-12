<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::orderBy('category')->get();
        return view('Category.categories',[
            'categories'=>$categories
            ]);
    }
    public function create(){
        return view('Category.createcategory');
    }
    public function store(Request $request){
        $data = request()->validate([
            'category' => 'required',
        ]);
        Category::create($request->all());
        $request->session()->flash('category_added','Category Added Successfully!');
        return redirect('/admin/categories');
    }
    public function edit($id){
        $category = Category::find($id);
        return view('Category.editcategory', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->update($request->all());
        return redirect('/admin/categories');
    }

    public function delete($id){
        $category = Category::find($id);
        $category -> delete();
        return back()->with('delete','Deleted Successfuly!');;
    }

}
