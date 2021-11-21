<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);

    }

    public function store(Request $request)
    {
        $products = new Product();
        $products->name = $request->name;
        $products->user_id = $request->user_id;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->imagePath = $request->imagePath;
        $products->descript = $request->descript;
        $products->save();

        return response()->json([
            "message" => "Product Save"
          ], 200);
    }

    public function show($id)
    {
        if (Product::where('id', $id)->exists()) {
            $product = Product::where('id', $id)->first()->toJson(JSON_PRETTY_PRINT);
            return response($product, 200);
          } else {
            return response()->json([
              "message" => "Product not found"
            ], 404);
          }
    }
    public function showProductUser($id)
    {
        if (Product::where('user_id', $id)->exists()) {
            $product = Product::where('user_id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($product, 200);
          } else {
            return response()->json([], 404);
          }
    }

    public function update(Request $request, $id)
    {
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->name = is_null($request->name) ? $product->name : $request->name;
            $product->price = is_null($request->price) ? $product->price : $request->price;
            $product->quantity = is_null($request->quantity) ? $product->quantity : ($request->quantity - $product->quantity);
            $product->imagePath = is_null($request->imagePath) ? $product->imagePath : $request->imagePath;
            $product->descript = is_null($request->descript) ? $product->descript : $request->descript;
            $product->save();

            return response()->json( $request, 200);

            } else {

            return response()->json([
                "message" => "Student not found"
            ], 404);

        }
        //
    }
    public function destroy($id)
    {
      if(Product::where('id', $id)->exists()) {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "Student not found"
        ], 404);
      }

    }
}
