<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // function addProduct(Request $req)
    // {
    //     $product = new Product;
    //     $product->name = $req->input('name');
    //     $product->price = $req->input('price');
    //     $product->description = $req->input('description');
    //     $product->file_path = $req->file('file')->store('products');
    //     $product->save();
    //     return $req->input();
    // }

    function addProduct(Request $req)
    {
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');

        if ($req->hasFile('file')) {
            $product->file_path = $req->file('file')->store('products');
        } else {
            $product->file_path = null; // atau default
        }

        $product->save();
        return response()->json(['success' => true, 'data' => $product]);
    }

    function list()
    {
        return Product::all();
    }

    function delete($id)
    {
        $result = Product::where('id', $id)->delete();
        if ($result) {
            return ["result" => "Product has been deleted"];
        } else {
            return ["result" => "Operation Failed"];
        }
    }

    function getProduct($id)
    {
        return Product::find($id);
    }

    function updateProduct($id, Request $req)
    {
        // return $req->input();
        $product = Product::find($id);
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        if ($req->file('file')) {
            $product->file_path = $req->file('file')->store('products');
        }
        $product->save();
        return $req->input();
    }
}
