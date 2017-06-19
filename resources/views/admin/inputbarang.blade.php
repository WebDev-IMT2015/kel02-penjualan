<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Input Barang</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1>Input Barang</h1>
					<form action="inputbarang" method="post">
						{{ csrf_field() }}
						Kode barang:
						<input type="text" class="form-control" name="kodebarang">
						<br>
						Nama:
						<input type="text" class="form-control" name="nama">
						<br>
						Jumlah:
						<input type="text" class="form-control" name="jumlah">
						<br>
						Harga Satuan:
						<input type="text" class="form-control" name="harga">
						<br>
						<br>
						<button type ="submit" class="btn btn-success">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>