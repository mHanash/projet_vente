<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\Product;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributions = Distribution::all();
        return view('admin.distribution', ['distributions' => $distributions]);
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
        if (count(Distribution::all()->where('name', $request->name)) > 0) {
            return redirect()->back()->with('fail', 'Cet enregistrement existe déjà');
        }
        if ($distribution = Distribution::create([
            'name' => $request->name
        ])) {
            return redirect()->back()->with('success', 'Enregistrement éffectué');
        } else {
            return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enrégistrement');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $distribution = Distribution::find($request->id);
        $products = Product::whereDoesntHave('distributions', function($query) use(&$distribution){
            $query->where('distribution_id','=',$distribution->id);
        })->get();
        return view('admin.distribution_show', ['distribution' => $distribution, 'products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $distribution = Distribution::find($request->id);
        $product = new Product();
        foreach($distribution->products as $productItem){
            if ($request->product_id == $productItem->id) {
                $product = $productItem;
            }else {
                $product = null;
            }
        }
        $products = Product::all();
        return view('admin.distribution_show_editor', ['distribution' => $distribution, 'product' => $product, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'priceUnit' => 'required|numeric',
            'priceUnitPublic' => 'required|numeric',
            'priceHTVA' => 'required|numeric'
        ]);
        $distribution = Distribution::find($request->dist);
        foreach($distribution->products as $product){
            if ($request->id == $product->id) {
                if($product->pivot->update([
                    'priceUnit' => $request->priceUnit,
                    'priceUnitPublic' => $request->priceUnitPublic,
                    'priceHTVA' => $request->priceHTVA
                ])){
                    return redirect()->route('distribution.show',['id'=>$distribution->id])->with('success', 'Enregistrement modifié');
                }
            }
        }
        return redirect()->route('distribution.show',['id'=>$distribution->id])->with('fail', 'Une erreur s\'est produite lors de la suppression');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $distribution = Distribution::find($request->id);
        if ($distribution->delete()) {
            return redirect()->back()->with('success', 'Enregistrement supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur s\'est produite lors de la suppression');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'unique:distribution_product',
            'priceUnit' => 'required|numeric',
            'priceUnitPublic' => 'required|numeric',
            'priceHTVA' => 'required|numeric'
        ]);
        $distribution = Distribution::find($request->id);

        $distribution->products()->attach([
            1 => [
                'priceUnit' => $request->priceUnit,
                'product_id' => $request->product,
                'priceUnitPublic' => $request->priceUnitPublic,
                'priceHTVA' => $request->priceHTVA
            ]
            ]);
        return redirect()->back()->with('success', 'Affecté...');
    }

    public function deleteProduct(Request $request)
    {
        $distribution = Distribution::find($request->id);
        foreach($distribution->products as $product){
            if ($request->product_id == $product->id) {
                if($product->distributions()->detach()){
                    return redirect()->back()->with('success', 'Suppression effectuée...');
                }
            }
        }
        return redirect()->back()->with('fail', 'Une erreur s\'est produite lors de la suppression');

    }
}
