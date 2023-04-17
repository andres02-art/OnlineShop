<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Util\Exception;
use Yajra\DataTables\Facades\DataTables;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['factures'=>Facture::all()], 200);
    }

    public function indexDatatable()
    {
        $factures = Facture::all();
        return DataTables::of($factures)
            ->make();
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
     * @param  \App\Http\Requests\StoreFactureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFactureRequest $request)
    {
        try {
            DB::beginTransaction();
            $Facture = new Facture($request->all());
            $Facture->save();
            $Product = Product::find($Facture->product_id);
            $Product->stock -= $Facture->amount;
            $Product->update();
            $ShopRegister = new Shop();
            $ShopRegister->date_shop = date_create('now');
            $ShopRegister->shop_confirm = true;
            $ShopRegister->factures_id = $Facture->id;
            $ShopRegister->owner_user_id = $request->owner_user_id;
            $ShopRegister->customer_user_id = 1;
            $ShopRegister->save();
            DB::commit();
            return response()->json(['succes'=>$Facture], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error'=>$th->getMessage()], $th->getCode());
        }

    }

    public function storeCar(StoreFactureRequest $request)
    {
        try {
            DB::beginTransaction();
            $Facture = new Facture($request->all());
            $Facture->save();
            $Product = Product::find($Facture->product_id);
            $Product->stock -= $Facture->amount;
            $Product->update();
            $ShopRegister = new Shop();
            $ShopRegister->date_shop = date_create('now');
            $ShopRegister->shop_confirm = true;
            $ShopRegister->factures_id = $Facture->id;
            $ShopRegister->owner_user_id = $request->owner_user_id;
            $ShopRegister->customer_user_id = 1;
            $ShopRegister->save();
            DB::commit();
            return $Facture;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
    }

    public function showFactures($redirect)
    {
        $comuns=[
            ['data'=>'id', 'title'=>'ID'],
            ['data'=>'type_id', 'title'=>'Tipo'],
            ['data'=>'car_id', 'title'=>'Carrito'],
            ['data'=>'product_id', 'title'=>'Producto'],
            ['data'=>'owner_user_id', 'title'=>'Usuario'],
            ['data'=>'sub_total', 'title'=>'subTotal'],
            ['data'=>'total_purchase', 'title'=>'Total'],
            ['data'=>'amount', 'title'=>'Cantidad'],
        ];
        if ($redirect==='true') {
            return response()->json([], 301, ['location'=>'/Profile/Owner/Root/root']);
        }else{
            return response()->json([
                'url'=>'/Shops/Confirm/Root/shopsAdminDatatable',
                'columns'=>$comuns,
                'title'=>'Facturas'
            ], 200, ['form'=>'shops', 'profiledatatable'=>true]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFactureRequest  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFactureRequest $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
