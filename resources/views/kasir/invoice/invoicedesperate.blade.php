@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript">
	function totalAmount(){
		var t = 0;
		$('.amount').each(function(i,e){
			var amt = $(this).val()-0;
			t += amt;
		});
		$('.total').html(t);
	}
	$(function () {
		$('.add').click(function () {
			var product = $('.product_id').html();
			var n = ($('.neworderbody tr').length - 0) + 1;
			var tr = '<tr><td class="no">' + n + '</td>' + '<td><select class="form-control product_id" name="product_id[]">' + product + '</select></td>' +
			'<td><input type="text" class="qty form-control" name="qty[]" value="{{ old('
			email ') }}"></td>' +
			'<td><input type="text" class="price form-control" name="price[]" value="{{ old('
			email ') }}"></td>' +
			'<td style="display: none;"><input type="text" class="dis form-control" name="dis[]" value="0"></td>' +
			'<td><input type="text" class="amount form-control" name="amount[]"></td>' +
			'<td><input type="button" class="btn btn-danger delete" value="x"></td></tr>';
			$('.neworderbody').append(tr);
		});
		$('.neworderbody').delegate('.delete', 'click', function () {
			$(this).parent().parent().remove();
			totalAmount();
		});
		$('.neworderbody').delegate('.product_id', 'change', function () {
			var tr = $(this).parent().parent();
			var price = tr.find('.product_id option:selected').attr('data-price');
			tr.find('.price').val(price);
			
			var qty = tr.find('.qty').val() - 0;
			var dis = tr.find('.dis').val() - 0;
			var price = tr.find('.price').val() - 0;

			var total = (qty * price) - ((qty * price * dis)/100);
			tr.find('.amount').val(total);
			totalAmount();
		});
		$('.neworderbody').delegate('.qty , .dis', 'keyup', function () {
			var tr = $(this).parent().parent();
			var qty = tr.find('.qty').val() - 0;
			var dis = tr.find('.dis').val() - 0;
			var price = tr.find('.price').val() - 0;

			var total = (qty * price) - ((qty * price * dis)/100);
			tr.find('.amount').val(total);
			totalAmount();
		});
		
		$('#hideshow').on('click', function(event) {  
			$('#content').removeClass('hidden');
			$('#content').addClass('show'); 
			$('#content').toggle('show');
		});


		
	});
</script>

<style>
	.hidden{
		display : none;  
	}

	.show{
		display : block !important;
	}
	select.form-control.product_id {
		width: 150px;
	}
</style>
<div class="container">

	<div class="row">
		@include('kasir.sidebar')
		<div class="col-md-9">

			<div class="panel panel-default">
				<div class="panel-heading">New Order</div>

				<div class="panel-body">
					<a href="{{ url('/kasir/invoice') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
					<br />
					<br />

					<form class="form-horizontal" id="yoyo" role="form" method="POST" action="{{ url('/kasir/invoice') }}">
						{!! csrf_field() !!}
						<table class="table table-striped">
							<tr>
								<td>
									Nama Customer: <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
								</td>
								<td>
									Tanggal: <input type="text" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
								</td>
							</tr>
						</table>
						
						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Produk</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th class="hidden">Discount</th>
									<th>Subtotal</th>
									<th>Delete</th>
									
								</tr>
							</thead>
							<tbody class="neworderbody">
								<tr>
									<td class="no">1</td>
									<td>
										<select class="form-control product_id" name="product_id[]">
											@foreach($products as $product)
											<option data-price="{!! $product->harga !!}" value="{!! $product->id !!}">{!! $product->nama!!}</option>
											@endforeach
										</select>
									</td>
									<td>
										<input type="text" class="qty form-control" name="qty[]" value="">
									</td>
									<td>
										<input type="text" class="price form-control" name="price[]" value="">
									</td>
									<td class="hidden">
										<input type="text" class="dis form-control" name="dis[]" value="0">
									</td>
									<td>
										<input type="text" class="amount form-control" name="amount[]">
									</td>
									<td>
										<input type="button" class="btn btn-danger delete" value="x">
									</td>
								</tr>

							</tbody>
							
							<tfoot>
								<th colspan="6">Total:<b class="total">0</b></th>
							</tfoot>


						</table>	
						<input type="button" class="btn btn-lg btn-primary add" value="Add New Item">
						<hr>	
						<hr>


						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Actions</div>

								<div class="panel-body">
									<center><input type="submit" class="btn btn-default btn-lg" name="save" value="Place Order">  
									</center>
								</div>
							</div>
						</div>
					</form>

					</div>

				</div>
			</div>
			<!--  Right -->

	</div>

</div>

@endsection