<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 72px;
				margin-bottom: 40px;
			}
			p {
				color:#2b2b2b;
				font-size:18px;
			}

			a {
				text-decoration:none;
				color:#0000FF;
			}
			a:hover {
				text-decoration:underline;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">404 Page Not Found.</div>
				<p>Sorry, page was not found. Click <a class="goback" href="/">here</a> to go back</p>
			</div>
		</div>

<!-- onclick back -->
<script>
var backbutton = document.getElementById("goback");
backbutton.onclick = function(e){
  e = e || window.event; // support  for IE8 and lower
  e.preventDefault(); // stop browser from doing native logic
  window.history.back();
}
</script>
	</body>
</html>
