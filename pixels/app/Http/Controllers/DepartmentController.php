<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;
use App\Models\Department;
use App\Models\User;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::latest()->with('users')->paginate(4);
        return response()->json($departments);
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
    public function store(StoreDepartment $request)
    {
        $data = $request->all();

        $users_ids = [];
        if(!empty($data['users'])){
            $data['users'] = explode(",", $data['users']);
            foreach ($data['users'] as $user){
                $users_ids[] = (int)$user;
            }
        }

        $request->validated();

        $data['logo'] = $request->file('logo')->store('', 'logo');
        $post = Department::create($data);
        $post->users()->sync($users_ids);

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
        $department = Department::find($id);
        $users = User::all();
        $selectedUsers = $department->users()->get()->pluck('id')->toArray();

        return response()->json(['department' => $department, 'users' => $users, 'selectedUsers' => $selectedUsers]);
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
    public function update(UpdateDepartment $request, $id)
    {

        $department = Department::find($id);
        $data = $request->all();

        $users_ids = [];
        if(!empty($data['users'])){
            $data['users'] = explode(",", $data['users']);
            foreach ($data['users'] as $user){
                $users_ids[] = (int)$user;
            }
        }

        $request->validated();

        if(isset($data['logo'])){
            $data['logo'] = $request->file('logo')->store('', 'logo');
        }

        $department->update($data);
        $department->users()->sync($users_ids);

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
        $department = Department::find($id);
        $department->delete();

        $departments = Department::latest()->with('users')->paginate(4);

        return response()->json($departments);
    }
}
