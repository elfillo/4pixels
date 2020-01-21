<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request) && $request->has('all')){
            $users = User::all();
        }else{
            $users = User::latest()->paginate(4);
        }

        return response()->json($users);
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
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = array(
            'name'          => 'required|string|min:2|',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
        );

        $request->validate($rules);

        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        User::create($data);

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
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
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->all();

        $password_rule = isset($data['password']) ? 'min:6' : '';

        $rules = array(
            'name'          => 'required|string|min:2|',
            'email'         => 'sometimes|required|email|unique:users,id,'.$id,
            'password'      => $password_rule
        );

        $request->validate($rules);

        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        $user->update($data);

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $users = User::latest()->paginate(4);

        return response()->json($users);
    }
}
