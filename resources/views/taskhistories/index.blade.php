@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Task-History</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @guest
                        <p>Please Login!</p>
                    @else
                        @foreach ($taskhistories as $taskhistory)
                            <div>
                                <p>ID : [ {!! $taskhistory->id !!} ]</p>
                                <p>Task-ID : [ {!! $taskhistory->task_id !!} ]</p>
                                <p>CRUD : [ {!! $taskhistory->crud !!} ]</p>
                                <p>Title : [ {!! $taskhistory->title !!} ]</p>
                                <p>Status : [ {!! $taskhistory->status !!} ]</p>
                                <p>In-Charge : [ {!! $taskhistory->in_charge_id !!} ]</p>
                                <p>Detail : [ {!! $taskhistory->detail !!} ]</p>
                                <p>Time-Limit : [ {!! $taskhistory->time_limit !!} ]</p>
                                <p>Create-Date : [ {!! $taskhistory->created_at !!} ]</p>
                                <p>Update-Date : [ {!! $taskhistory->updated_at !!} ]</p>
                                {!! link_to_route('taskhistories.show', 'Detail', ['id' => $taskhistory->id], ['class' => 'btn btn-link']) !!}
                            </div>
                        @endforeach
                        
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
