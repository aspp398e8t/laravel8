<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use CreateProductImagesTable;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();


        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('image_url')) {
            $path = Storage::put('/product', $request->image_url);
        }
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image_url' => $path,
            'description' => $request->description,
        ]);
        foreach ($request->image_urls ?? [] as  $image_url) {
            $path = Storage::put('/product', $image_url);

            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $path
            ]);
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $product_images = ProductImage::where('product_id', $product->id)->get();

        return view('admin.product.edit', compact('product', 'product_images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($request->hasFile('image_url')) {
            Storage::delete($product->image_url);
            $path = Storage::put('/product', $request->image_url);
        } else {
            $path = $product->image_url;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image_url' => $path,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image_urls')) {
            foreach ($request->image_urls ?? [] as  $image_url) {
                $path = Storage::put('/product', $image_url);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path
                ]);
            }
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function imageDelete(Request $request)
    {
        $productImage = ProductImage::find($request->id);
        Storage::delete($productImage->image_url);
        $productImage->delete();

        return 'success';
    }
}
