@extends('layouts.backend')
@section('content')
@if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif
    <form action="{{ route('admin.users.update',$user) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') ?? $user->name }}" placeholder="Input full name ..." name="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="username">User name</label>
                    <input class="form-control @error('username') is-invalid @enderror" type="text" value="{{ old('username') ?? $user->username }}" placeholder="Input full name ..." name="username">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $user->email }}" type="text" placeholder="Input full email ..." name="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" autocomplete="off" placeholder="Input user name ..." name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="group_id">Group</label>
                    <select name="group_id" id="" class="form-select @error('group_id') is-invalid @enderror">
                        <option value="0" selected>Select group</option>
                        <option value="1" @if (old('group_id') == "1") {{ 'selected' }} @endif >Admin</option>
                    </select>
                    @error('group_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-danger" >Back</a>
    </form>
@endsection
