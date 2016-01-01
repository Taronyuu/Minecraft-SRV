@extends('app')

@section('content')
    {!! Form::open(['method' => 'post', 'action' => 'RecordController@store']) !!}
        <div class="row">
            <div class="six columns">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['style' => 'width: 100%; padding: 8px; font-size: 10pt', 'id' => 'name', 'placeholder' => 'Your record without .mcplay.pw']) !!}
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                {!! Form::label('ip', 'Ip:') !!}
                {!! Form::text('ip', null, ['style' => 'width: 100%; padding: 8px; font-size: 10pt', 'id' => 'ip', 'placeholder' => 'Your ip']) !!}
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                {!! Form::label('port', 'Port:') !!}
                {!! Form::text('port', null, ['style' => 'width: 100%; padding: 8px; font-size: 10pt', 'id' => 'port', 'placeholder' => 'Your port']) !!}
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null, ['style' => 'width: 100%; padding: 8px; font-size: 10pt', 'id' => 'email', 'placeholder' => 'Your email']) !!}
            </div>
        </div>

        <input style="display:none;" type="text" name="robots" value="" />

        <input type="submit" name="create" value="Create"  />
    {!! Form::close() !!}
@endsection