@extends('layouts.app')

@section('content')
@if(Auth::user()->usertype == '0')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Your application's dashboard.
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
