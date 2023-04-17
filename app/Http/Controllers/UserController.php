<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['users'=>User::get()]);
    }

    public function indexUser(User $User)
    {
        return response()->json(['user'=>$User]);
    }

    public function indexRole(User $User)
    {
        $role = $User->getRoleNames();
        return response()->json(['userRole'=>$role]);
    }

    public function indexDatatable(User $User)
    {
        $users = User::all();
        return DataTables::of($users)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $User = new User($request->all());
            $User->assignRole($request->role);
            $User->save();
            DB::commit();
            if ($request->ajax()) {
                return response()->json(['User'=>$User]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json(['error'=>$th]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        return view('profile', compact('User'));
    }

    public function showUser(User $User, $redirect)
    {
        if ($redirect==='true') {
            return response()->json([], 301, ['location'=>"/Profile/Owner/user/{$User->id}"]);
        }else{
            return response()->json([
                'User'=>$User,
            ], 200, ['form'=>'none', 'profiledatatable'=>false]);
        }
    }
    public function showUsers($redirect)
    {
        $columnsUser=[
            ['data'=>'id', 'title'=>'ID'],
            ['data'=>'name', 'title'=>'Nombre'],
            ['data'=>'email', 'title'=>'Correo'],
            ['data'=>'credentials', 'title'=>'Documento'],
            ['data'=>'actions', 'title'=>'Acciones'],
        ];
        if ($redirect==='true') {
            return response()->json([], 301, ['location'=>'/Profile/Owner/Root/root']);
        }else{
            return response()->json([
                'url'=>'/Profile/Owner/Root/rootDatatable',
                'columns'=>$columnsUser,
                'title'=>'Usuarios'
            ], 200, ['form'=>'users', 'profiledatatable'=>true]);
        }
    }

    public function showUsersShops(User $User, $redirect)
    {
        if ($redirect==='true') {
            return response()->json([], 301, ['location'=>'/Profile/Owner/user/'.$User->id]);
        }else{
            return response()->json(['Usersshops'=>$User->load('Shops.Factures.Car', 'Shops.Factures.Product')], 200, ['form'=>'shops','profiledatatable'=>false]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $User, UpdateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $User->assignRole($request->role);
            $User->update($request->all());
            DB::commit();
            if ($request->ajax()) {
                return response()->json(['User'=>$User]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['error'=>$th]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        try {
            $User->delete();
            return response()->json([]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error'=>$th]);
        }
    }
}
