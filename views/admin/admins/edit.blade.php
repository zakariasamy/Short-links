@extends('layouts.admin.dashboard.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ $title }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="{{ url('admin/admins') }}"><i class="fa fa-cogs"></i>Admins</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <!-- /.col (left) -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <form action="{{ url('admin/admins/' . $admin->id . '/update') }}" method="post">
                        <div class="box-body">
                            @include('layouts.admin.dashboard.partials.form')
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
                <!-- /.box -->
            </div>
            <!-- /.col (right) -->
        </div>
    </section>
@endsection
