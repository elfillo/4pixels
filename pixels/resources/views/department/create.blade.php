@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Edit department</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('department.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Name') }}</label>

                                <div class="col-md-12">
                                    <input
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        required autocomplete="name" autofocus
                                    >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-12 col-form-label text-md-left">Description</label>

                                <div class="col-md-12">
                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description"
                                        id="description" cols="30" rows="10"
                                    >{{ old('description') }}
                                    </textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="logo" class="col-md-12 col-form-label text-md-left">Logo</label>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input
                                            type="file"
                                            name="logo"
                                            {{--value="{{ old('logo') }}"--}}
                                            value=""
                                            class="border rounded form-control-file @error('logo') is-invalid @enderror"
                                            id="logo"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-12 col-form-label text-md-left">Users</label>

                                <div class="col-md-12">
                                    @foreach($users as $user)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $user->id }}" name="users[]" value="{{ $user->id }}">
                                            <label class="form-check-label" for="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        Send
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
