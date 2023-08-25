<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<title>Creating QR Code</title>
</head>
<body>
<div class="container">
<h1 class="page-header text-center">QRCode using Google QRCode API</h1>
	<div class="row">
		<div class="col-sm-3 col-sm-offset-3">
			<form method="POST">
				<div class="form-group">
					<label for="">Text to Convert to QRCode</label>
					<input type="text" class="form-control" name="text_code">
				</div>
				<button type="submit" class="btn btn-primary" name="generate">Generate QRCode</button>
			</form>
		</div>
		<div class="col-sm-3">
			<!-- PUT INTO DATABASE  -->
			<?php
				session_start();
				if(isset($_POST['generate'])){
					$code = md5($_POST['text_code']);
					$qr2Link = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$code.'&choe=UTF-8';
					$thisLink = $qr2Link;
					echo "
						<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$code&choe=UTF-8'>
					";
					
				}
			?>
		</div>
	</div>
</div>
</body>
</html>