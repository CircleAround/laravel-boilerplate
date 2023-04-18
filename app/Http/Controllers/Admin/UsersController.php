<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // @see https://laravel.com/docs/9.x/validation#quick-writing-the-validation-logic
        $validated = $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|unique:users|',
            'password' => 'required',
        ]);

        return to_route('admin.users.show', ['user' => $user->id]);
    }

    /**
     * /admin/users/{id}
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // User型の指定によりDIでidから検索した結果が取れる。
        // show($id) のように型指定がなければidの数値。
        // 暗に以下のようなコードが呼ばれている。
        // $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
        // return view('admin.users.show', ['user' => $user]); // これと同じ意味になる
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // @see https://laravel.com/docs/9.x/validation#quick-writing-the-validation-logic
        $validated = $request->validate([
            'name' => 'required|max:10',
            'email' => "required|email|unique:users,email,{$user->id}",
            // 'password' => 'required'
        ]);
        
        // Hash::make('password'),
        $user->fill($validated);
        $user->save();

        Log::debug($user->toJson());
        return to_route('admin.users.show', ['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
