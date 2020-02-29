<?php

namespace App\Http\Controllers\Admin;

use App\ConstManager\ConstManager;
use App\User;
use App\Http\Requests\UserRequest;
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
            return view('users.index', ['users' => $model->orderBy('id', ConstManager::DESCENDING)->paginate(ConstManager::PAGINATE)]);
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
            return view('users.create');
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
            $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

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
            return view('users.edit', compact('user'));
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

            return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
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
        if (auth()->user()->can('destroy-user-s')) {
            $user->delete();

            return redirect()->route('admin.user.index')->withStatus(__('User successfully deleted.'));
        } else {
            return redirect()->route('admin.dashboard')->with('info', 'Permission denied!');
        }
    }
}
