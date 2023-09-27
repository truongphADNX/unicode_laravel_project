@extends('layouts.backend')
@section('content')
    <p><a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Create</a></p>
    <table id="datatable" class="table table-bordered">
        @if (session('msg'))
            <div class="alert alert-success">{{ session('msg') }}</div>
        @endif
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Updated_at</th>
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
                ajax: '{{ route('admin.courses.data') }}',
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'updated_at'
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
