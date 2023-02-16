@extends('layouts.backend')
@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" placeholder="Input name ..." name="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="slug">Slug</label>
                    <input class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" type="text" placeholder="Input slug ..." name="slug">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="parent_id">Group</label>
                    <select name="parent_id" id="" class="form-select @error('parent_id') is-invalid @enderror">
                        <option value="0" selected>Parent</option>
                        <option value="1" @if (old('parent_id') == "1") {{ 'selected' }} @endif >Parent</option>
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-danger" >Back</a>
    </form>
@endsection
