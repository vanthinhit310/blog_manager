<?php

namespace App\Http\Controllers\Admin;

use App\ConstManager\ConstManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\RoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('list-role')) {
            $data = Role::where('name', '!=', 'owner')->paginate(ConstManager::PAGINATE);
            return view('backend.role.index', compact('data'));
        } else {
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
        if (auth()->user()->can('add-role')) {
            $permissions = Permission::all()->groupBy('group');
            return view('backend.role.create', compact('permissions'));
        } else {
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->can('add-role')) {
                $param = $request->all();
                $role = Role::create([
                    'name' => Str::slug($param['display_name'], '-'),
                    'display_name' => $param['display_name'],
                    'description' => $param['description']
                ]);
                if (!empty($param['permissions'])) {
                    $role->syncPermissions($param['permissions']);
                }
                DB::commit();
                return redirect()->route('admin.role.index')->withSuccess('Role has been create successfully!');
            } else {
                DB::rollBack();
                return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
            }
        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('update-role')) {
            $role_permission = [];
            $role = Role::find($id);
            if (!empty($role->permissions()->allRelatedIds())) {
                $role_permission = $role->permissions()->allRelatedIds()->toArray();
            }
            $permissions = Permission::all()->groupBy('group');
            return view('backend.role.edit', compact('role', 'role_permission', 'permissions'));
        } else {
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->can('update-role')) {
                $param = $request->all();
                $role = Role::find($id);
                $role->update([
                    'display_name' => $param['display_name'],
                    'description' => $param['description']
                ]);
                $current_permissions = $role->permissions()->allRelatedIds()->toArray();
                if (!empty($param['permissions'])) {
                    $role->syncPermissions($param['permissions']);
                } else {
                    $role->detachPermissions($current_permissions);
                }
                DB::commit();
                return redirect()->route('admin.role.index')->withSuccess('Role has been updated successfully!');
            } else {
                DB::rollBack();
                return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
            }
        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('destroy-role')) {

        } else {
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }
}
