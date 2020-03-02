<?php

namespace App\Http\Controllers\Admin;

use App\ConstManager\ConstManager;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('list-role')){
            $data = Role::where('name','!=','owner')->paginate(ConstManager::PAGINATE);
            return view('backend.role.index', compact('data'));
        }else{
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('add-role')){

        }else{
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('add-role')){

        }else{
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('update-role')){

        }else{
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('update-role')){

        }else{
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('destroy-role')){

        }else{
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }
}
