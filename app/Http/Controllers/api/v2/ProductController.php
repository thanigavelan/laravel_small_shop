<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $products = Product::orderby('name','asc')->get();
        if($request->has('brand_id')){
            $products=Product::where('brand_id',$request->input('brand_id'))
                              ->orderBy('name','asc')
                              ->get();
        }
        else if($request->has('category_id')){
            $products = Product::where('category_id',$request->input('category_id'))
                      ->orderBy('name','asc')
                      ->get();
        }
        else 
        {
            $products= Product::orderBy('name','asc')->get();

        }

        $transformedProducts= $products->map(function($row){
           
            return[
                'id'=>$row->id,
                'name'=>$row->name,
                'category' => $row->category->name,
                'brand' => $row->brand->name,
                'price' => $row->price,
                'image_path'=>$row->GetImagePath(),
            ];
        });
            
        return response()->json(['data' => $transformedProducts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}