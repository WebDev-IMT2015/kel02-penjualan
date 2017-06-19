@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">Dashboard</div> --}}
                <div class="panel-body text-center" style="height: 80vh;">
                    <img src="{{asset('images/RRH.png')}}" alt="" style="max-width: 40vw; margin-top: 5em; margin-bottom: 2em;">
                    <h1 style="margin-bottom: 1em;">Hello, <b>{{ Auth::user()->name }}</b> !</h1>
                    @if(Auth::user()->usertype == '0')
                    <a href="{{ url('/admin') }}" class="btn btn-success btn-lg">Continue</a>
                    @elseif(Auth::user()->usertype == '1')
                    <a href="{{ url('/gudang') }}" class="btn btn-success btn-lg">Continue</a>
                    @elseif(Auth::user()->usertype == '2')
                    <a href="{{ url('/kasir') }}" class="btn btn-success btn-lg">Continue</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
