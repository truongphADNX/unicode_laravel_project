@extends('layouts.backend')
@section('stylesheets')
    <style>
        .teacher__img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')
    <p><a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">Create</a></p>
    <table id="datatable" class="table table-bordered">
        @if (session('msg'))
            <div class="alert alert-success">{{ session('msg') }}</div>
        @endif
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Exp</th>
                <th>Created at</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
    </table>
    @include('parts.backend.delete')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                // scrollY: 400,
                // searching: false,
                // ordering:  false,
                lengthMenu: [10, 25, 50, 75, 100],
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.teachers.data') }}',
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'exp'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'update'
                    },
                    {
                        data: 'delete'
                    },
                ],
                language: {
                    // "processing": "Loading. Please wait...",
                    "processing": "<img width='30' src='{{ asset('backend/assets/img/loading.png') }}' /><img width='40' src='{{ asset('backend/assets/img/loading.png') }}' /><img width='50' src='{{ asset('backend/assets/img/loading.png') }}' />",
                },
            });
        });
    </script>
@endsection
