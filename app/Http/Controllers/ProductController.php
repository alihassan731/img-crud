<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function index(){
        
        $products = Product::latest();
        // $products = $products->paginate(3);
        $products = $products->get();
        $data['products'] = $products;
        return view('products.index', $data);
    }
    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif'
        ]);

        //upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        $product =new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return redirect(route('product.index'))->withSuccess('Product created !!!!!');
    }
    public function edit($id){
        $product = Product::where('id',$id)->first();
        return view('products.edit',['product'=>$product]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif'
        ]);

        $product = Product::where('id',$id)->first();

        if(isset($request->image))
        {
         
        //upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);
        $product->image = $imageName;
    }
    
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
        return redirect(route('product.index'))->withSuccess('Product Updated !!!!!');
    }
    public function destroy($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
        return redirect(route('product.index'))->withSuccess('Product DELETED !!!!!');
    }
}