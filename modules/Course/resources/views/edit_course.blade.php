@extends('layouts.backend')
@section('stylesheets')
    <style>
        img {
            max-width: 100%;
            height: auto !important;
        }

        #holder img {
            width: 100% !important;
            height: auto;
        }

        .list__categories {
            max-height: 200px;
            overflow-y: scroll;
        }
    </style>
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <form action="{{ route('admin.courses.update', $course) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input class="form-control title @error('name') is-invalid @enderror" type="text"
                        value="{{ old('name') ?? $course->name }}" placeholder="Input full name ..." name="name">
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
                    <input class="form-control slug @error('slug') is-invalid @enderror" type="text"
                        value="{{ old('slug') ?? $course->slug }}" placeholder="" name="slug">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="teacher_id">Select teacher</label>
                    <select name="teacher_id" id="" class="form-select @error('teacher_id') is-invalid @enderror">
                        <option value="0" selected>Select teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" @if (old('teacher_id') == $teacher->id || $course->teacher_id == $teacher->id) selected @endif>
                                {{ $teacher->name }}</option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="code">Course Code</label>
                    <input class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code') ?? $course->code }}" type="text" placeholder="Input course code ..."
                        name="code">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="price">Price</label>
                    <input class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') ?? $course->price }}" type="number" placeholder="Input course price ..."
                        name="price">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="sale_price">Sale Price</label>
                    <input class="form-control @error('sale_price') is-invalid @enderror"
                        value="{{ old('sale_price') ?? $course->sale_price }}" type="number"
                        placeholder="Input course sale price ..." name="sale_price">
                    @error('sale_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="is_document">Documents</label>
                    <select name="is_document" id=""
                        class="form-select @error('is_document') is-invalid @enderror">
                        <option value="0"
                            {{ old('is_document') == 0 || $course->is_document == 0 ? 'selected' : false }}>No</option>
                        <option value="1"
                            {{ old('is_document') == 1 || $course->is_document == 1 ? 'selected' : false }}>Yes</option>
                    </select>
                    @error('is_document')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="" class="form-select @error('status') is-invalid @enderror">
                        <option value="0" {{ old('status') == 0 || $course->status == 0 ? 'selected' : false }}>Active
                        </option>
                        <option value="1" {{ old('status') == 1 || $course->status == 1 ? 'selected' : false }}>
                            InActive
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="supports">Supports</label>
                    <textarea class="form-control ckeditor @error('detail') is-invalid @enderror" name="supports" id=""
                        cols="30" rows="5">{{ old('supports') ?? $course->supports }}</textarea>
                    @error('supports')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="detail">Detail</label>
                    <textarea class="form-control ckeditor @error('detail') is-invalid @enderror" name="detail" id=""
                        cols="30" rows="5">{{ old('detail') ?? $course->detail }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3 form-group">
                    <label for="" class="mb-2">Chose category</label>
                    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 list__categories">
                        {{ getCategoriesCheckbox($categories, old('categories') ?? $categoryIds) }}
                    </div>
                    @error('categories')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="row {{ $errors->has('thumbnail') ? 'align-items-center' : 'align-items-end' }}">
                        <div class="col-8">
                            <label for="thumbnail">Avatar</label>
                            <input type="text" id="thumbnail"
                                class="form-control @error('thumbnail') is-invalid @enderror"
                                value="{{ old('thumbnail') ?? $course->thumbnail }}" placeholder="Input thumbnail ..."
                                name="thumbnail">
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-1 d-grid">
                            <button type="button" id="lfm" data-input="thumbnail" data-preview="holder"
                                class="btn btn-primary">Chosse</button>
                        </div>
                        <div class="col-3">
                            <div id="holder">
                                @if (old('thumbnail') || $course->thumbnail)
                                    <img src="{{ old('thumbnail') ?? $course->thumbnail }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">Back</a>
    </form>
@endsection
