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
    </style>
@endsection
@section('content')
    <form action="{{ route('admin.courses.store') }}" method="post">
        @method('POST')
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input class="form-control title @error('name') is-invalid @enderror" type="text"
                        value="{{ old('name') }}" placeholder="Input full name ..." name="name">
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
                        value="{{ old('slug') }}" placeholder="" name="slug">
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
                        <option value="1" @if (old('teacher_id') == '1') {{ 'selected' }} @endif>Tiến Bịp
                        </option>
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
                    <input class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}"
                        type="text" placeholder="Input course code ..." name="code">
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
                    <input class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                        type="number" placeholder="Input course price ..." name="price">
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
                    <input class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price') }}"
                        type="number" placeholder="Input course sale price ..." name="sale_price">
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
                        <option value="0" @if (old('is_document') == '0') {{ 'selected' }} @endif>No</option>
                        <option value="1" @if (old('is_document') == '1') {{ 'selected' }} @endif>Yes</option>
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
                        <option value="0" @if (old('status') == '0') {{ 'selected' }} @endif>Active
                        </option>
                        <option value="1" @if (old('status') == '1') {{ 'selected' }} @endif>InActive
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
                        cols="30" rows="5">{{ old('supports') }}</textarea>
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
                        cols="30" rows="5">{{ old('detail') }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <label for="thumbnail">Avatar</label>
                            <input type="text" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror"
                                value="{{ old('thumbnail') }}" placeholder="Input thumbnail ..."
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
                                @if (old('thumbnail'))
                                    <img src="{{ old('thumbnail') }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Back</a>
    </form>
@endsection
