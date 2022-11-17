<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Categorycontroller extends Controller
{
    public function index()
    {
        Carbon::setLocale('ar');
        $cats = Category::all();
        return view('admin.categories.index', compact('cats'));
    }

    public function create()
    {
        return view('admin.categories.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = $request->all();
        Category::create($data);
        return redirect(route('admin.categories'))->with('success', 'تم إضافة القسم بنجاح');
    }

    public function show($id)
    {
        Carbon::setLocale('ar');
        $cat = Category::find($id);
        $products = Product::where('cat_id', $id)->get();
        return view('admin.categories.showCat', compact('products', 'cat'));
    }

    public function edit($id)
    {
        $cat = Category::find($id);
        return view('admin.categories.edit', compact('cat'));
    }

    public function update(Request $request, $id)
    {
        $cat = Category::find($id);
        $request->validate([
            'name' => 'required'
        ]);
        $data = $request->all();
        $cat->update($data);
        return redirect(route('admin.categories'))->with('success', 'تم تعديل القسم بنجاح');
    }

    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();
        return redirect(route('admin.categories'))->with('success', 'تم تعديل القسم بنجاح');
    }
}
