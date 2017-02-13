@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your feedbacks</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Model</th>
                                <th>Value</th>
                                <th>Feedback</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td><a href="/reports/websites">{{ str_replace('App\\', '', $report->model) }}</a></td>
                                    <td><a href="/reports/websites/{{ $report->model_id }}">{{ $report->model::find($report->model_id)->meta()->where('name', 'domain')->first()->value }}</a></td>
                                    <td>{{ $report->feedback }}</td>
                                    <td><a href="/reports/websites/{{ $report->id }}/edit">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
