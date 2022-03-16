<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        return view('admin.store', ['stores' => $stores]);
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
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
        ]);
        if (count(Store::all()->where('name', $request->name)) > 0) {
            return redirect()->back()->with('fail', 'Cet enregistrement existe déjà');
        }
        if ($store = Store::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact
        ])) {
            return redirect()->back()->with('success', 'Enregistrement éffectué');
        } else {
            return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enrégistrement');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $store = Store::find($request->id);
        $products = Product::whereDoesntHave('stores', function($query) use(&$store){
            $query->where('store_id','=',$store->id);
        })->get();
        return view('admin.store_show', ['store' => $store, 'products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $store = Store::find($request->id);
        return view('admin.store_editor',['store'=>$store]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $store = Store::find($request->id);
        if ($store->update($request->all())) {
            return redirect()->route('store')->with('success', 'Modification reussie');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $store = Store::find($request->id);
        if ($store->delete()) {
            return redirect()->back()->with('success', 'Enregistrement supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur s\'est produite lors de la suppression');
    }

    public function deleteProduct(Request $request){
        $store = Store::find($request->id);
        foreach($store->products as $product){
            if ($request->product_id == $product->id) {
                if($product->stores()->detach()){
                    return redirect()->back()->with('success', 'Suppression effectuée...');
                }
            }
        }
        return redirect()->back()->with('fail', 'Une erreur s\'est produite lors de la suppression');

    }

    public function updateProduct(Request $request){
        $request->validate([
            'code' => 'required|numeric',
        ]);
        $store = Store::find($request->store);
        foreach($store->products as $product){
            if ($request->id == $product->id) {
                if($product->pivot->update([
                    'code' => $request->code,
                ])){
                    return redirect()->route('distribution.show',['id'=>$store->id])->with('success', 'Enregistrement modifié');
                }
            }
        }
        return redirect()->route('distribution.show',['id'=>$store->id])->with('fail', 'Une erreur s\'est produite lors de la suppression');
    }

    public function editProduct(Request $request){
        $store = Store::find($request->id);
        $product = new Product();
        foreach($store->products as $productItem){
            if ($request->product == $productItem->id) {
                $product = $productItem;
            }else {
                $product = null;
            }
        }
        return view('admin.store_show_editor', ['store' => $store, 'product' => $product]);
    }

    public function storeProduct(Request $request){
        $request->validate([
            'code' => 'required|numeric'
        ]);
        $store = Store::find($request->id);
        $store->products()->attach([1=>[
            'code'=>$request->code,
            'product_id'=>$request->product_id
        ]]);
        return redirect()->back()->with('success', 'Affecté...');
    }
}
