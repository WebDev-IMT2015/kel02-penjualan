@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('gudang.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Incomingproduk {{ $incomingproduk->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/gudang/incomingproduk') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/gudang/incomingproduk/' . $incomingproduk->id . '/edit') }}" title="Edit Incomingproduk"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['gudang/incomingproduk', $incomingproduk->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Incomingproduk',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $incomingproduk->id }}</td>
                                    </tr>
                                    <tr><th> Kode </th><td> {{ $incomingproduk->kode }} </td></tr><tr><th> Jumlah </th><td> {{ $incomingproduk->jumlah }} </td></tr><tr><th> Keterangan </th><td> {{ $incomingproduk->keterangan }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
