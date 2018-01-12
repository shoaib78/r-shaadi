@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
    <section class="banner-inner">
        <h3>Reset Password</h3>
    </section>
    <section class="cotnent-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Reset Password</div>

                        <div class="panel-body">
                            @if (session('password_error'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('password_error') }}
                                </div>
                            @endif

                            @if (session('password_success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('password_success') }}
                                </div>
                            @endif
                            <form class="form-horizontal" id="reset-password-form" role="form" method="POST" action="{{ url('/password/reset') }}">
                                {{ csrf_field() }}

                                {{--<input type="hidden" name="token" value="{{ $token }}">--}}

                                <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }} required">
                                    <label for="old_password" class="col-md-4 control-label">Old Password </label>

                                    <div class="col-md-6">
                                        <input id="old_password" type="password" class="form-control" name="old_password" required>

                                        @if ($errors->has('old_password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }} required">
                                    <label for="new_password" class="col-md-4 control-label">New Password </label>

                                    <div class="col-md-6">
                                        <input id="new_password" type="password" class="form-control" name="new_password" required>

                                        @if ($errors->has('new_password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('confirm_new_password') ? ' has-error' : '' }} required">
                                    <label for="new_password_confirmation" class="col-md-4 control-label">Confirm New Password </label>
                                    <div class="col-md-6">
                                        <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>

                                        @if ($errors->has('new_password_confirmation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-pink">Reset Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
