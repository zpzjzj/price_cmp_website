<!DOCTYPE html>
<html>
<head>
	<title> Price Compare Search </title>
	<link href="/static/css/bootstrap.min.css" rel="stylesheet">

	<style type="text/css"> 
		#middle_div {
		    position:absolute;
		    top: 50%;
		    left: 50%;
		    width:30em;
		    height:18em;
		    margin-top: -9em; /*set to a negative number 1/2 of your height*/
		    margin-left: -15em; /*set to a negative number 1/2 of your width*/
		}
	</style>
</head>
<body>
	<center>
		<h1> Price Compare </h1>
		<form id="search" method="get" action="/index.php/search/scrape">
			<div id="middle_div" class="input centered_div">
				<input name="keyword" class="input-lg"/><br/>
				<button type="submit" class="btn btn-lg btn-primary" 
					style="margin-top: 20px"> search </button>
			</div>
		</form>
	</center>
    <script src="/static/jquery-1.11.1.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</body>
</html>