<?php

namespace App\Http\Controllers\Admin;

use App\ConstManager\ConstManager;
use App\Http\Requests\Backend\PasswordRequest;
use App\Role;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Display a listing of the users
     *
     * @param \App\User $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        if (auth()->user()->can('list-user')) {
            return view('backend.users.index', ['users' => $model->orderBy('id', ConstManager::DESCENDING)->paginate(ConstManager::PAGINATE)]);
        } else {
            return redirect()->route('admin.dashboard')->with('info', 'Permission denied!');
        }
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (auth()->user()->can('add-user')) {
            $roles = Role::where('name', '!=', 'owner')->get();
            return view('backend.users.create', compact('roles'));
        } else {
            return redirect()->route('admin.dashboard')->with('info', 'Permission denied!');
        }
    }

    /**
     * Store a newly created user in storage
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\User $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        if (auth()->user()->can('add-user')) {
            $user = $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

            if (!empty($request->role)) {
                $user->syncRoles($request->role);
            } else {
                $user->attachRole(ConstManager::USERROLE);
            }

            return redirect()->route('admin.user.index')->withStatus(__('User successfully created.'));
        } else {
            return redirect()->route('admin.dashboard')->with('info', 'Permission denied!');
        }
    }

    /**
     * Show the form for editing the specified user
     *
     * @param \App\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        if (auth()->user()->can('update-user')) {
            $roles = Role::where('name', '!=', 'owner')->get();
            return view('backend.users.edit', compact('user', 'roles'));
        } else {
            return redirect()->route('admin.dashboard')->with('info', 'Permission denied!');
        }
    }

    /**
     * Update the specified user in storage
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        if (auth()->user()->can('update-user')) {
            $user->update(
                $request->merge(['password' => Hash::make($request->get('password'))])
                    ->except([$request->get('password') ? '' : 'password']
                    ));
            if (!in_array(ConstManager::USERROLE, (array)$user->getRoles())) {
                $user->attachRole(ConstManager::USERROLE);
            }
           if (!empty($request->get('role'))) {
               $user->syncRoles($request->get('role'));
           }else{
               $user->detachRoles($request->get('role'));
           }
            return redirect()->route('admin.user.index')->withStatus(__('User successfully updated.'));
        } else {
            return redirect()->route('admin.dashboard')->with('info', 'Permission denied!');
        }
    }

    /**
     * Remove the specified user from storage
     *
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if (auth()->user()->can('destroy-user')) {
            $user->delete();

            return redirect()->route('admin.user.index')->withStatus(__('User successfully deleted.'));
        } else {
            return redirect()->route('admin.dashboard')->with('info', 'Permission denied!');
        }
    }

    public function changePassword($id, PasswordRequest $request)
    {
        if (auth()->user()->can('update-user')) {
            $user = User::find($id);
            $user->update(['password' => Hash::make($request->get('password'))]);

            return back()->withPasswordStatus(__('Password successfully updated.'));
        } else {
            return redirect()->route('admin.dashboard')->with('info', 'Permission denied!');
        }
    }
}
