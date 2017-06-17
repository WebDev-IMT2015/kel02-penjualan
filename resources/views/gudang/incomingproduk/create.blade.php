@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Incomingproduk</div>
                    <div class="panel-body">
                        <a href="{{ url('/gudang/incomingproduk') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if (isset($salah1) || isset($salah2))
                            <ul class="alert alert-danger">
                                @if(isset($salah1))
                                    <li>{{ $salah1 }}</li>
                                @endif
                                @if(isset($salah2))
                                    <li>{{ $salah2 }}</li>
                                @endif
                            </ul>
                        @endif


                        {!! Form::open(['url' => '/gudang/incomingproduk', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('gudang.incomingproduk.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
