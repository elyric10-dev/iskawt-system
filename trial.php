<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"/>
	<title>Trial</title>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
  </head>
  <body>
	<div id="img_container">
		<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=9c8c2f8820cb9e238b43bc94c6cc19cd&choe=UTF-8" alt="qr">
		
	</div>
	<button onclick="doCapture()">Capture</button>
  </body>
  <script>
		function doCapture(){
			window.scrollTo(0, 0)
			html2canvas(document.getElementById('img_container')).then(function (canvas){
				console.log(canvas.toDataURL("image/jpeg", 0.9))
			})
		}

  </script>
</html>