<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Penjualan</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1>Penjualan</h1>
					<form action="@if(isset($barangs)) {{ route('jual') }} @else {{ route('cek') }} @endif" method="post">
						{{ csrf_field() }}
						Kode Invoice:
						<input type="text" class="form-control" name="kodeinvoice">
						<br>
						Nama Customer:
						<input type="text" class="form-control" name="namacust">
						<br>
						Tanggal Penjualan:
						<input type="date" class="form-control" name="tanggal">
						<br>
						Kode barang:
						<input type="text" class="form-control" name="kodebarang" @if(isset($barangs)) value="{{ $barangs->kodebarang }}" @endif>
						<br>
						<button type ="submit" class="btn btn-success">Cek</button>
						<br>
						Nama Barang:
						<input type="text" class="form-control" name="namabarang" @if(isset($barangs)) value="{{ $barangs->nama }}" @endif disabled>
						<br>
						Jumlah:
						<input id="box1" type="text" class="form-control" name="jumlah" oninput="calculate()" />
						<br>
						Harga Satuan:
						<input id="box2" type="text" class="form-control" name="harga" @if(isset($barangs)) value="{{ $barangs->harga }}" @endif disabled oninput="calculate()" />
						<br>
						Total:
						<input id="result" class="form-control" name="total" disabled/>
						<br>
						<br>
						<button type ="submit" class="btn btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
		<script>
			function calculate() {
			var myBox1 = document.getElementById('box1').value;
			var myBox2 = document.getElementById('box2').value;
			var result = document.getElementById('result');
			var myResult = myBox1 * myBox2;
			result.value = myResult;
		}
		</script>
	</body>
</html>