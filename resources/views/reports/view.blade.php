@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">View</div>

                <div class="panel-body">
                    @foreach($object->meta as $meta)
                        {{ $meta->label }} : {{ $meta->value }} <br />
                    @endforeach
                    <br /><br /><br />
                    <a href="/reports/websites/{{ $object->id }}/new" class="btn btn-warning btn-xs">Report</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
