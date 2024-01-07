<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['brand','category'])->latest()->get();
        return Inertia::render('Admin/Product/ProductIndex',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        return Inertia::render('Admin/Product/ProductCreate',[
            'categories'=>$category,
            'brands'=>$brand
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $product = new Product;
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->description = $request->input('description');
        $product->save();

        if($request->hasFile('product_images'))
        {
            $productImages = $request->file('product_images');
            foreach($productImages as $image){
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'=>$image ? $image->store('products', 'public') : null
                ]);
            }

        }

        return to_route('admin.products.index')->with('message','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['product_images'])->where('id',$id)->first();
        $category = Category::all();
        $brand = Brand::all();
        return Inertia::render('Admin/Product/ProductEdit',[
            'product'=>$product,
            'categories'=>$category,
            'brands'=>$brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
