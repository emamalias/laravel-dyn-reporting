@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Feedback</div>

                <div class="panel-body">
                    @foreach($object->meta as $meta)
                        {{ $meta->label }} : {{ $meta->value }} <br />
                    @endforeach
                    <br /><br /><br />
                    <form action="/reports/{{ $model }}/{{ $report->id }}/edit" method="POST">
                        {{ csrf_field() }}
                        <strong>Your feedback:</strong>
                        <textarea class="form-control" name="feedback">{{ old('feedback') ?: $report->feedback }}</textarea>

                        @if ($errors->has('feedback'))
                            <span class="help-block">
                                <strong>{{ $errors->first('feedback') }}</strong>
                            </span>
                        @endif

                        @if (Session::has('success'))
                            <span class="help-block">
                                <strong>{{ Session::get('success') }}</strong>
                            </span>
                        @endif

                        @if (Session::has('error'))
                            <span class="help-block">
                                <strong>{{ Session::get('error') }}</strong>
                            </span>
                        @endif

                        <br />
                        <button type="submit" class="btn btn-info">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
