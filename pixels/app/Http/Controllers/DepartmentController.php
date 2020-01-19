<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::latest()->paginate(4);
        return view('department.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('department.create', compact('users'));
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

        $users_ids = [];
        if(!empty($data['users'])){
            foreach ($data['users'] as $user){
                $users_ids[] = (int)$user;
            }
        }

        $rules = array(
            'name'          => 'required|string|min:2|max:15|unique:departments,name',
            'description'   => 'required|string|min:10',
            'logo'          => 'required',
            'users'         => 'required|array'
        );

        $request->validate($rules);

        $data['logo'] = $request->file('logo')->store('', 'logo');
        $post = Department::create($data);
        $post->users()->sync($users_ids);

        return redirect()->route('department');
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
        $department = Department::find($id);
        $users = $department->users;

        $all_users = User::all();

        $selected = [];

        foreach ($users as $k => $user){
            $selected[$k] = $user->id;
        }

        $all = [];
        foreach ($all_users as $key=>$item){
            $all[$key]['id'] = $item->id;
            $all[$key]['name'] = $item->name;
            $all[$key]['email'] = $item->email;
            $all[$key]['checked'] = false;
        }

        foreach ($all as $a_key => $a){
            foreach ($selected as $s){
                if($a['id'] === $s){
                    $all[$a_key]['checked'] = true;
                }
            }
        }

        $users = $all;

        return view('department.edit', compact('department', 'users'));
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
        $department = Department::find($id);
        $data = $request->all();

        $users_ids = [];
        if(!empty($data['users'])){
            foreach ($data['users'] as $user){
                $users_ids[] = (int)$user;
            }
        }

        $rules = array(
            'name'          => 'required|string|min:2|max:15',
            'description'   => 'required|string|min:10',
            'users'         => 'required'
        );

        $request->validate($rules);

        if(isset($data['logo'])){
            $data['logo'] = $request->file('logo')->store('', 'logo');
        }

        $department->update($data);
        $department->users()->sync($users_ids);

        return redirect()->route('department');
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
        return redirect()->route('department');
    }
}
