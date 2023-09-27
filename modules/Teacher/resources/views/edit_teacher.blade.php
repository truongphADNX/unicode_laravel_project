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
    <form action="{{ route('admin.teachers.update', $teacher) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input class="form-control title @error('name') is-invalid @enderror" type="text"
                        value="{{ old('name') ?? $teacher->name }}" placeholder="Input full name ..." name="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="slug">Slug</label>
                    <input class="form-control slug @error('slug') is-invalid @enderror"
                        value="{{ old('slug') ?? $teacher->slug }}" type="text" placeholder="Input user slug ..."
                        name="slug">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="exp">Exp</label>
                    <input class="form-control @error('exp') is-invalid @enderror" value="{{ old('exp') ?? $teacher->exp }}"
                        type="number" step="0.1" placeholder="Input full exp ..." name="exp">
                    @error('exp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="description">Desciption</label>
                    <textarea class="form-control ckeditor @error('description') is-invalid @enderror" name="description" id=""
                        cols="30" rows="5">{{ old('description') ?? $teacher->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="row  {{ $errors->has('image') ? 'align-items-center' : 'align-items-end' }}">
                        <div class="col-8">
                            <label for="image">Image</label>
                            <input type="text" id="image" class="form-control @error('image') is-invalid @enderror"
                                value="{{ old('image') ?? $teacher->image }}" placeholder="Input image ..." name="image">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-1 d-grid">
                            <button type="button" id="lfm" data-input="image" data-preview="holder"
                                class="btn btn-primary">Chosse</button>
                        </div>

                        <div class="col-3">
                            <div id="holder">
                                @if (old('image') || $teacher->image)
                                    <img src="{{ old('image') ?? $teacher->image }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-danger">Back</a>
    </form>
@endsection
