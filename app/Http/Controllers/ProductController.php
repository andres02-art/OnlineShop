<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($offset=0, $limit=15)
    {
        return response()->json(Product::get()->skip($offset)->take($limit));
    }

    public function indexDatatable()
    {
        $products = Product::get()->where('stock', '>=', 0);
        return DataTables::of($products)
            ->addColumn('actions', function($row){
                $fedit = Storage::get('/buttons/editButton.html');
                $fdelete = Storage::get('/buttons/deleteButton.html');
                return "<div rowitem='{$row->id}'>".$fedit.$fdelete.'</div>';
            })
            ->rawColumns(['actions'])
            ->make();
    }

    public function indexProduct(Product $Product)
    {
        return response()->json($Product, 200);
    }

    public function indexProductsByCategory()
    {
        $productByCategory = Product::with('Category')->get()->groupBy('category.id');
        return response()->json($productByCategory, 200);
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $Product = new Product($request->all());
        $this->storeImg($request, $Product);
        $Product->save();
        return response()->json(['succes'=>$request]);
    }

    private function storeImg($request, &$Product){
        $randomName = Str::random(30);
        $randomName = "{$randomName}.{$request->img->clientExtension()}";
        $request->img->move(storage_path('app/public/products/imgs'), $randomName);
        $Product->img = $randomName;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        return view('product', compact('Product'));
    }

    public function ShowProduct(Product $Product)
    {
        return response()->json([], 301, ['location'=>"/Product/product/{$Product->id}"]);
    }

    public function showProducts($redirect)
    {
        $columnsProduct=[
            ['data'=>'id', 'title'=>'ID'],
            ['data'=>'category_id', 'title'=>'Categoria'],
            ['data'=>'promotion_id', 'title'=>'Promocion'],
            ['data'=>'name', 'title'=>'Nombre'],
            ['data'=>'stock', 'title'=>'Cantidad'],
            ['data'=>'precio', 'title'=>'Costo'],
            ['data'=>'mark', 'title'=>'Marca'],
            ['data'=>'actions', 'title'=>'Acciones'],
        ];
        if ($redirect==='true') {
            return response()->json([], 301, ['location'=>'/Profile/Owner/Root/root']);
        }else{
            return response()->json([
                'url'=>'/Search/Root/productsAdminDatatable',
                'columns'=>$columnsProduct,
                'title'=>'Productos'
            ], 200, ['form'=>'products', 'profiledatatable'=>true]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $Product)
    {
        try {
            DB::beginTransaction();
            $requestImg = $request->all();
            $this->updateImg($request, $Product);
            $requestImg['img']=$Product->img;
            $Product->update($requestImg);
            DB::commit();
            return response()->json([]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error'=>$th]);
        }
    }

    private function updateImg(&$request, Product &$Product){
        $randomName = Str::random(30);
        $randomName = "{$randomName}.{$request->img->clientExtension()}";
        $request->img->move(storage_path('app/public/products/imgs'), $randomName);
        $Product->img = $randomName;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $Product){
        try {
            DB::beginTransaction();
            $Product->delete();
            DB::commit();
            return response()->json([]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error'=>$th]);
        }
    }
}
