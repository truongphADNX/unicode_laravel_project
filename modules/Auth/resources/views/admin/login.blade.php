@extends('layouts.auth')

@section('content')
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4">{{ $pageTitle }}</h3>
        </div>
        <div class="card-body">
            <form action={{ route('login') }} method="post">
                @csrf
                @method('POST')
                <div class="form-floating mb-3">
                    <input class="form-control" name="email" id="email" type="email" value="{{ old('email') }}"
                        placeholder="Email..." />
                    <label for="emai">Email address</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="password" id="password" type="password" placeholder="Password..." />
                    <label for="password">Password</label>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    <a class="small" href="#!">Forgot Password?</a>
                    <button type="submmit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
