<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $types = Type::all();
        $categories = Category::all();
        return view('admin.product',['products'=>$products, 'types'=>$types, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($product = Product::create([
            'name' => $request->name,
            'qteEmballage' => $request->qteEmballage,
            'typeEmballage' => $request->typeEmballage,
            'origine' => $request->origine,
            'weight' => $request->weight,
            'type_id' => $request->type,
            'category_id' => $request->category
        ])) {
            return redirect()->back()->with('success', 'Ingénieur enregistré avec succès');
        } else {
            return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enrégistrement');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // $stores = $product->stores;
        // $customers = $product->customers;
        // $salers = $product->salers;
        // $type = $product->type;
        // $category = $product->category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Request $request)
    {
        $product = Product::find($request->id);
        $types = Type::all();
        $categories = Category::all();
        return view('admin.product_editor', ['product' => $product, 'types' => $types, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        dd('test');
        $product = Product::find($request->id);
        if ($product->update($request->all())) {
            return redirect()->route('product')->with('success', 'Produit modifié avec succès');
        }
        return redirect()->route('product')->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        $product = Product::find($request->id);
        if ($product->delete()) {
            return redirect()->route('product')->with('success', 'Service modifié avec succès');
        }
        return redirect()->route('product')->with('fail', 'Une erreur est survenue lors de la modification');
    }
}
