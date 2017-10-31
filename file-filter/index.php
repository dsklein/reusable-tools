<html>

<head>
<title><?php echo $_SERVER['SCRIPT_FILENAME']; ?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<style type='text/css'>
	#count {
		background-color: LightSkyBlue;
		border-radius: 10px;
		color: white;
		margin-left: 2em;
		padding: 5px;
	}

	#filetable {
		margin-top: 50px;
	}

	h3, form {
		display: inline;
	}

	td {
		padding: 2px 1px 1px 5px;
	}

	#topbar {
		background-color: LightGray;
		padding: 10px;
		position: fixed;
		top: 0px;
		width: 100%;
		//left: 70%;
	}
</style>
</head>

<body>
<div id="topbar">
	<form><h3>Filter files: <input type="text" name="filterbox" placeholder="Search..." /></h3></form>
	<span id="count">..</span> files found
</div>
<div id="filetable">


<?php
	$files = scandir(".");

	print "<table id=\"filetable\">\n";

	foreach ($files as $thisfile) {
		if ($thisfile == ".") continue;
		if ($thisfile == "..") continue;
		if ($thisfile == "index.php") continue;

		print "<tr>\n";
		print "<td>";
		print date("Y-m-d H:i:s",filemtime("$thisfile"));
		print "</td>\n<td>";
		print "<a href=\"$thisfile\">$thisfile</a>";
		print "</td>\n</tr>\n";
	}

	print "</table>\n";
?>

</div>


<script>
$(document).ready(function(){
		document.getElementById("count").innerHTML = $("#filetable tr").length;

	$( "input[name='filterbox']" ).on('keyup', function() {
		var searchkey = $(this).val().toLowerCase();
		$("#filetable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(searchkey) > -1)
				});

		var foundfiles = $("#filetable tr:visible").length;
		document.getElementById("count").innerHTML = foundfiles;
	});
});

</script>

</body>

</html>
