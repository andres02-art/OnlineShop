<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Facture;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        try {
            DB::beginTransaction();
            $Car = new Car($request->all());
            $Car->save();
            foreach ($request->all() as $key => $value) {
                if (Product::find($key)) {
                    $products[$value] = Product::find($key);
                    $newRequest=[
                        'sub_total'=>$request->all()["sub_total{$key}"],
                        'owner_user_id'=>$request->all()["owner_user_id"],
                        'amount'=>$request->all()["amount{$key}"],
                        'product_id'=>$key,
                        'total_purchase'=>$request->all()["total_purchase{$key}"],
                        'method'=>$request->all()["method"],
                        'token'=>$request->all()["token"],
                        'type_id'=>"2",
                        'car_id'=>$Car->id,
                    ];
                    $facture[$value] = new FactureController();
                    $requestFacture[$value] = new StoreFactureRequest($newRequest, $newRequest, $newRequest);
                    $validation = Validator::make($newRequest, $requestFacture[$value]->rules());
                    if($validation->fails()){
                        $resolve[$value]= $validation->errors();
                    }else{
                        $resolve[$value]=$facture[$value]->storeCar($requestFacture[$value]);
                    }
                }
            };
            DB::commit();
            return response()->json(['resolve'=>$resolve]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['reject'=>$th], $th);
        }
        //dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
