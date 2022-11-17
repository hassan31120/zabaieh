<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        Carbon::setLocale('ar');
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $cats = Category::all();
        return view('admin.products.add', compact('cats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'weight' => 'required',
            'image' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
            'cat_id' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/images/products/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect(route('admin.products'))->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cats = Category::all();
        return view('admin.products.edit', compact('product', 'cats'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $request->validate([
            'name' => 'required',
            'weight' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
            'cat_id' => 'required',
        ]);

        $data = $request->all();

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filepath = 'storage/images/products/'.date('Y').'/'.date('m').'/';
            $filename =$filepath.time().'-'.$file->getClientOriginalName();
            $file->move($filepath, $filename);
            if(request('old-image')){
                $oldpath=request('old-image');
                if(File::exists($oldpath)){
                    unlink($oldpath);
                }
            }
          $data['image'] = $filename;
        }
        $product->update($data);

        return redirect(route('admin.products'))->with('success', 'تم تعديل المنتج بنجاح');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('admin.products'))->with('success', 'تم حذف المنتج بنجاح');
    }
}
