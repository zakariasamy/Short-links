@include('layouts.admin.auth.partials.head')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ asset('/') }}">Short links</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        @yield('content')
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@include('layouts.admin.auth.partials.foot')
