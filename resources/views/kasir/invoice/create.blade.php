@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Invoice</div>
                    <div class="panel-body">
                        <a href="{{ url('/kasir/invoice') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if (session('salah1'))
                            <ul class="alert alert-danger">
                                @if(session('salah1'))
                                    <li>{{ session('salah1') }}</li>
                                @endif
                            </ul>
                        @endif

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/kasir/invoice', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('kasir.invoice.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
