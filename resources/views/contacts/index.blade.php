@extends('app')
@section('content')
    <div id="app">
        <index-contact :contacts="'{{$contacts}}'" ></index-contact>

    </div>
@endsection
