<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Http\Requests\StoreFactureRequest;
    use App\Http\Requests\UpdateFactureRequest;
use Illuminate\Support\Facades\Storage;
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
            ->addColumn('actions', function($row){
                $fedit = Storage::get('/buttons/editButton.html');
                $fdelete = Storage::get('/buttons/deleteButton.html');
                $fsee = Storage::get('/buttons/seeButton.html');
                return "<div rowitem='{$row->id}'>".$fedit.$fdelete.$fsee.'</div>';
            })
            ->rawColumns(['actions'])
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
        //
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
            ['data'=>'actions', 'title'=>'Actions']
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
