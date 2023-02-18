@extends('layouts.backend')
@section('content')
@if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif
    <form action="{{ route('admin.categories.update',$category) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input class="form-control title @error('name') is-invalid @enderror" type="text" value="{{ old('name') ?? $category->name }}" placeholder="Input name ..." name="name">
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
                    <input class="form-control slug @error('slug') is-invalid @enderror" type="text" value="{{ old('slug') ?? $category->slug }}" placeholder="Input slug ..." name="slug">
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
                        <option value="0" selected>Select group</option>
                        {{ getCategories($categories, old('parent_id') ?? $category->parent_id) }}
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
