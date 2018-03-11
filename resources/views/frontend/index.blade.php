@extends('frontend.layout.layout')
@section('content')

    <div id="root_frontend">
        <div class="row">
            <router-view class="view"></router-view>
        </div>
    </div>

@endsection
