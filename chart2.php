<html>
<head>
		<script src="https://code.jquery.com/jquery-1.12.4.js"	integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="	crossorigin="anonymous"></script>
		<script>
			$(document).ready(function() {
				var refresh = function () {
				$('#chart2').load('fetch_2.php');
				 }
				 setInterval(refresh, 15000);
				 refresh();
			});
		</script>


</head>
<body>

<div id="chart2"></div>

</body>
</html>
