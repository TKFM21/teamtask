@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Task-Edit</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @guest
                        <p>Please Login!</p>
                    @else
                    
                    <div class="panel-body">
                    {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'class' => 'form-horizontal', 'method' => 'put']) !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('title', old('title'), ['class' => 'form-control', 'required', 'autofocus']) !!}
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('status', old('status'), ['class' => 'form-control', 'required']) !!}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('in_charge_id') ? ' has-error' : '' }}">
                            {!! Form::label('in_charge_id', 'In_charge_id', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('in_charge_id', old('in_charge_id'), ['class' => 'form-control', 'required']) !!}
                                @if ($errors->has('in_charge_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('in_charge_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                            {!! Form::label('detail', 'Detail', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('detail', old('detail'), ['class' => 'form-control', 'required']) !!}
                                @if ($errors->has('detail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('detail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('time_limit') ? ' has-error' : '' }}">
                            {!! Form::label('time_limit', 'Time-limit', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::date('time_limit', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                                @if ($errors->has('time_limit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
