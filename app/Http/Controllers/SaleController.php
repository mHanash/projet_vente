<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Distribution;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distribution = Distribution::where('name','=','RKIN')->get();
        $customers = Customer::all();
        // dd($distribution[0]->products);
        $products = $distribution[0]->products;
        return view('sale.sale',['products'=>$products, 'customers'=>$customers]);
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
        $products_sales = [];
        $qte_products = [];
        $i = 0;
        foreach ($request->products as $key => $id) {
            $mid = 'product'. $key;
            $mid_qte = 'qte'.$key;
            if($request->$mid!= null){
                if ($request->$mid == $id) {
                    $products_sales[$i] = $id;
                    $qte_products[$i] = $request->$mid_qte;
                    $i++;
                }
            }
        }

        $amount = 0;
        $products = Product::all()->whereIn('id',$products_sales );
        foreach ($products as $key => $product) {
            foreach($product->distributions as $distribution){
                if ($distribution->name == 'RKIN') {
                    foreach ($products_sales as $i => $value) {
                        if ($product->id == $value) {
                            $amount += ($distribution->pivot->priceUnitPublic) * ($qte_products[$i]);
                        }
                    }
                }
            }
        }

        if($sale=Sale::create([
            'customer_id' => $request->customer,
            'user_id' => Auth::user()->id,
            'amount' =>$amount
        ])){
            $datas = [];
            foreach ($products_sales as $key => $value) {
                $datas[$key] = [
                    'product_id' => $products_sales[$key],
                    'qte' => $qte_products[$key]
                ];
            }
            $sale->products()->sync($datas);
            return redirect()->back()->with('success', 'Enregistrement éffectué');
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
        $sales = Sale::all();
        return view('sale.sale_view',['sales' => $sales]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
