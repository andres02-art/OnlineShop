<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['promotions'=>Promotion::get()], 200);
    }

    public function indexProductsByPromotion(Promotion $Promotion)
    {
        return response()->json(['productsByPromotion' => Promotion::with(['Products'=>function($products){
            $products->skip(0)->take(5);
        }])->find($Promotion)], 200);
    }

    public function indexDatatable()
    {
        $promotions = Promotion::all();
        return DataTables::of($promotions)
            ->addColumn('actions', function($row){
                $fedit = Storage::get('/buttons/editButton.html');
                $fdelete = Storage::get('/buttons/deleteButton.html');
                return "<div rowitem='{$row->id}'>".$fedit.$fdelete.'</div>';
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
     * @param  \App\Http\Requests\StorePromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        $promotion = new Promotion($request->all());
        $promotion->save();
        return response()->json(['succes'=>$request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    public function showPromotions($redirect)
    {
        $comuns=[
            ['data'=>'id', 'title'=>'ID'],
            ['data'=>'name', 'title'=>'Nombre'],
            ['data'=>'season', 'title'=>'Temporada'],
            ['data'=>'active', 'title'=>'Activa'],
            ['data'=>'actions', 'title'=>'Acciones'],
        ];
        if ($redirect==='true') {
            return response()->json([], 301, ['location'=>'/Profile/Owner/Root/root']);
        }else{
            return response()->json([
                'url'=>'/Promotions/Root/promotionsAdminDatatable',
                'columns'=>$comuns,
                'title'=>'Promociones'
            ], 200, ['form'=>'promotions', 'profiledatatable'=>true]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromotionRequest  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Promotion $Promotion, UpdatePromotionRequest $request, )
    {
        $Promotion->update($request->all());
        return response()->json(['succes'=>$Promotion]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return response()->json([]);
    }
}
