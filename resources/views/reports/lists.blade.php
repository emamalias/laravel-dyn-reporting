@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Select Website to report</div>

                <div class="panel-body">
                    <table class="table">
                        @foreach($lists as $list)
                            <tr>
                                @foreach($list->meta as $meta)
                                    <td>{{ $meta->value }}</td>
                                @endforeach
                                <td><a href="/reports/websites/{{ $list->id }}" class="btn btn-warning btn-xs">View</a></td>
                                <td><a href="/reports/websites/{{ $list->id }}/new" class="btn btn-warning btn-xs">Report</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
