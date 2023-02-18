@extends('layouts.backend')
@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input class="form-control title @error('name') is-invalid @enderror" type="text"
                        value="{{ old('name') }}" placeholder="Input name ..." name="name">
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
                    <input class="form-control slug @error('slug') is-invalid @enderror" value="{{ old('slug') }}"
                        type="text" placeholder="Input slug ..." name="slug">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="parent_id">Parent</label>
                    <select name="parent_id" id="" class="form-select @error('parent_id') is-invalid @enderror">
                        <option value="0" selected>Select Parent</option>
                        {{ getCategories($categories ,old('parent_id'))}}
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
        <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Back</a>
    </form>
@endsection
