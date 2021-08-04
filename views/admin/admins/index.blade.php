@extends('layouts.admin.dashboard.layout')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        div#datatable_wrapper .pagination, .dataTables_info {
            display: none;
        }

        .links {
        display: flex;
        justify-content: center;
        }
    </style>
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#datatable').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        })
    </script>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>All Admins</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">All Admins</li>
        </ol>
    </section>

    <section class="content">
        @if(session('message'))
            <div class="alert alert-info">{{ flash('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    <a href="{{ url('admin/admins/create') }}" class="btn btn-primary">Add new admin</a>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>User name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins['data'] as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->first_name }}</td>
                            <td>{{ $admin->last_name }}</td>
                            <td>{{ $admin->user_name }}</td>
                            <td>
                                <a href="{{ url('admin/admins/'. $admin->id . '/edit') }}" class="btn btn-success">Edit</a>
                                <a href="#" data-action="{{ url('admin/admins/'. $admin->id . '/delete') }}" class="btn btn-danger delete_confirmation" data-toggle="modal" data-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="links">
                {!! links($admins['current_page'], $admins['pages']) !!}
            </div>

            </div>
            <!-- /.box-body -->
        </div>
    </section>

    @include('layouts.admin.dashboard.partials.delete_modal')  
@endsection
