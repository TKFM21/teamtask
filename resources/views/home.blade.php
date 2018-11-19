@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Task-Index</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @guest
                        <p>Please Login!</p>
                    @else
                        @foreach ($tasks as $task)
                            <div>
                                <p>ID : [ {!! $task->id !!} ]</p>
                                <p>Title : [ {!! $task->title !!} ]</p>
                                <p>Status : [ {!! $task->status !!} ]</p>
                                <p>In-Charge : [ {!! $task->in_charge_id !!} ]</p>
                                <p>Detail : [ {!! $task->detail !!} ]</p>
                                <p>Time-Limit : [ {!! $task->time_limit !!} ]</p>
                                <p>Create-Date : [ {!! $task->created_at !!} ]</p>
                                <p>Update-Date : [ {!! $task->updated_at !!} ]</p>
                                {!! link_to_route('tasks.show', 'Detail', ['id' => $task->id], ['class' => 'btn btn-link']) !!}
                            </div>
                        @endforeach
                        
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
