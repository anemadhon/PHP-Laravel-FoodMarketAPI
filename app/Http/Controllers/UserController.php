<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '<>', auth()->user()->id);

        $users->when(request('search') ?? false, fn($query, $key) =>
            $query->where(fn() => 
                $query->where('name', 'like', '%'.$key.'%')
                      ->orWhere('username', 'like', '%'.$key.'%')
                      ->orWhere('email', 'like', '%'.$key.'%')
            )
        );

        return view('users.index', [
            'users' => $users->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        if ($request->file('profile_photo_path'))
        {
            $fileName = 'avatar.'.$request->file('profile_photo_path')->extension();
            
            $data['profile_photo_path'] = $request->file('profile_photo_path')->storePubliclyAs('assets/users/'.$request->username, $fileName, 'public');
        }

        $data['name'] = "$request->first_name $request->last_name";

        User::create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $name = collect(explode(' ', $user->name));

        return view('users.form', [
            'user' => $user,
            'name' => $name
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->file('profile_photo_path'))
        {
            $fileName = 'avatar.'.$request->file('profile_photo_path')->extension();
            
            $data['profile_photo_path'] = $request->file('profile_photo_path')->storePubliclyAs('assets/users/'.$request->username, $fileName, 'public');
        }

        $data['name'] = "$request->first_name $request->last_name";

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
