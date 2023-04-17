<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['categories'=>Category::with(['Products'=>function($products){
            $products->where('stock', '>', 0);
        }])->get()], 200);
    }

    public function indexProductsByCategories()
    {
        $categories = Category::get();
        foreach ($categories as $key => $category) {
            $productsByCategory[$key] = Category::find($category->id)->load(['Products'=>function($products){
                $products->skip(0)->take(24)->where('stock', '>', 0);
            }]);
        }
        return response()->json(['productsByCategories' => $productsByCategory], 200);
    }

    public function indexDatatable()
    {
        $categories = Category::all();
        return DataTables::of($categories)
            ->addColumn('actions', function($row){
                $fedit = Storage::get('/buttons/editButton.html');
                $fdelete = Storage::get('/buttons/deleteButton.html');
                return "<div rowitem='{$row->id}'>".$fedit.$fdelete.'</div>';
            })
            ->rawColumns(['actions'])
            ->make();
        ;
    }

    public function indexCategoryPorducts(Category $Category, $offset, $limit)
    {
        $categoryProducts = $Category->load(['Products'=>function($products){
            $products->where('stock', '>', 0);
        }]);
        return response()->json([$categoryProducts], 200);
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category($request->all());
        $category->save();
        return response()->json(['succes'=>$request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $Category)
    {
        return view('category', compact('Category'));
    }

    public function showCategory(Category $Category, $redirect)
    {
        if ($redirect==='true') {
            return response()->json([], 301, ['location'=>'/Categories/viewCategory']);
        }else{
            return response()->json(['fetch'=>Category::get()], 200);
        }
    }

    public function showCategories($redirect)
    {
        $comuns=[
            ['data'=>'id', 'title'=>'ID'],
            ['data'=>'name', 'title'=>'Nombre'],
            ['data'=>'actions', 'title'=>'Acciones']
        ];
        if ($redirect==='true') {
            return response()->json([], 301, ['location'=>'/Profile/Owner/Root/root']);
        }else{
            return response()->json([
                'url'=>'/Categories/Root/categoriesAdminDatatable',
                'columns'=>$comuns,
                'title'=>'Categorias'
            ], 200, ['form'=>'categories', 'profiledatatable'=>true]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $Category)
    {
        //
        $Category->update($request->all());
        return response()->json(['succes'=>$request]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $Category)
    {
        try {
            DB::beginTransaction();
            $products = Product::where('category_id', $Category->id)->get();
            foreach ($products as $product) {
                $product->delete();
            }
            $Category->delete();
            DB::commit();
            return response()->json([]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error'=>$th]);
        }
    }
}
