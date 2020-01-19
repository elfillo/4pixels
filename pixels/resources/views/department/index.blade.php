@extends('layouts.app')
@section('content')
    <div class="container border rounded-lg">
        <div class="row border-bottom">
            <div class="col-12 d-flex justify-content-between align-items-center bg-light">
                Departments
                <a href="{{ route('department.create') }}"><button type="button" class="btn btn-primary m-2">Add</button></a>
            </div>
        </div>
        <div class="container">
            @foreach($departments as $department)
                <div class="row border-top mt-4 d-flex justify-content-between pt-2 pb-2">
                    <div class="col-2 border" style="overflow: hidden; width: 150px; height: 150px; background: url({{asset('/logo/' . $department -> logo)}}); background-size: cover; background-position: center"></div>
                    <div class="col-4">
                        <p class="font-weight-bold" style="text-transform: capitalize">{{$department -> name}}</p>
                        <span>{{$department -> description}}</span>
                    </div>
                    <div class="col-4">
                        <p class="font-weight-bold">Users</p>
                        <ol>
                            @foreach($department->users()->pluck('name') as $user)
                                <li>{{ $user }}</li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="col-2">
                        <a href="{{ route('department.edit', $department->id) }}"><button type="button" class="btn btn-secondary m-2">Edit</button></a>
                        <form action="{{ route('department.destroy', $department->id) }}" method="POST" style="display: inline-block">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete"/>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="row mt-4">
                {{$departments->links()}}
            </div>
        </div>
    </div>
@endsection
