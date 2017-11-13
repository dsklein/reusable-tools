<html>

<head>
<title>Contents of <?php $find = array("home/users/","public_html/","index.php"); $replace = array("~","",""); echo str_replace($find,$replace,$_SERVER['SCRIPT_FILENAME']); ?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<style type='text/css'>
	body {
		margin: 0;
		padding: 0;
	}

	#count {
		background-color: LightSkyBlue;
		border-radius: 10px;
		color: white;
		margin-left: 2em;
		padding: 5px;
	}

	#filetable {
		margin: 50px 0px 10px 3px;
	}

	h3, form {
		display: inline;
	}

	td {
		padding: 2px 1px 1px 5px;
	}

	#topbar {
		background-color: LightGray;
		height: 22px;
		padding: 10px;
		position: fixed;
		top: 0px;
/* For a full-width search bar, use the following: */
		width: 100%;
/* Or, for a box that hovers on the right: */
		/*margin-right: calc(100% - 100vw);
		right: 0px;
		width: 400px; */
	}
</style>
</head>

<body>
<div id="topbar">
	<form><h3>Filter files: <input type="text" name="filterbox" placeholder="Search..." value="<?php if (isset($_GET["q"])) print $_GET["q"]; ?>" /></h3></form>
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
function runsearch() {

	var searchkey = $("input[name='filterbox']").val().toLowerCase();
	$("#filetable tr").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(searchkey) > -1)
	});

	var foundfiles = $("#filetable tr:visible").length;
	document.getElementById("count").innerHTML = foundfiles;
}

$(document).ready(function() {
	 runsearch();

	$( "input[name='filterbox']" ).on('keyup', function() {
		runsearch();
	});
});

</script>

</body>

</html>
