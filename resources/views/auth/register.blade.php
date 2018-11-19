@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'register', 'class' => 'form-horizontal']) !!}
                    <!-- <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                    -->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
                            <!-- <label for="name" class="col-md-4 control-label">Name</label> -->

                            <div class="col-md-6">
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required', 'autofocus']) !!}
                                <!-- <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus> -->

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', 'E-Mail Address', ['class' => 'col-md-4 control-label']) !!}
                            <!-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> -->

                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'required']) !!}
                                <!-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> -->

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            {!! Form::label('role', 'User-Role', ['class' => 'col-md-4 control-label']) !!}
                            <!-- <label for="role" class="col-md-4 control-label">Role</label> -->

                            <div class="col-md-6">
                                @can('admin-higher')
                                    @if(Auth::user()->role <= 3)
                                        {!! Form::select('role', [
                                            '10' => 'Read Only',
                                            '8' => 'R&U',
                                            '7' => 'CRU',
                                            '5' => 'CRUD',
                                            '3' => 'Administrator',
                                        ], null, ['class' => 'form-control', 'type' => 'role', 'value' => old('role'), 'required']) !!}
                                    @endif
                                @endcan
                                <!--
                                <select id="role" type="role" class="form-control" name="role" value="{{ old('role') }}" required>
                                    <option value="10">Read Only</option>
                                    <option value="8">R&U</option>
                                    <option value="7">CRU</option>
                                    <option value="5">CRUD</option>
                                    <option value="3">Administrator</option>
                                    <option value="1">SA</option>
                                </select>
                                -->


                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
                            <!-- <label for="password" class="col-md-4 control-label">Password</label> -->

                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                                <!-- <input id="password" type="password" class="form-control" name="password" required> -->

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-4 control-label']) !!}
                            <!-- <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label> -->

                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
                                <!-- <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}
                                <!--
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                -->
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
