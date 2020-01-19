@extends('layouts.app')
@section('content')
    <div class="container border rounded-lg">
        <div class="row border-bottom">
            <div class="col-12 d-flex justify-content-between align-items-center bg-light">
                Users
                <a href="{{ route('user.create') }}"><button type="button" class="btn btn-primary m-2">Add</button></a>
            </div>
        </div>
        <div class="container">
            @foreach($users as $user)
                <div class="row border-top mt-4 d-flex justify-content-between align-items-center pt-2 pb-2">
                    <div class="col-3">{{ $user->name }}</div>
                    <div class="col-3">{{ $user->email }}</div>
                    <div class="col-3">{{ $user->created_at }}</div>
                    <div class="col-3">
                        <a href="{{ route('user.edit', $user->id) }}"><button type="button" class="btn btn-secondary m-2">Edit</button></a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete"/>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="row mt-4">
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection
