@extends('app')
@section('content')
    <div id="app">
        <edit-contact :contacts="'{{$contact}}'" ></edit-contact>

    </div>
@endsection
