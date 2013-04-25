<html>
<head>
<title>Search data</title>

<link rel="stylesheet" href="jquery-ui.css">
<script src="jquery-1.9.1.min.js"></script>
<script src="jquery-ui.min.js"></script>

</head>
<body>
<div id="datepicker"></div><input type="submit" value="load" id="refresh"/>
<input type="submit" value="Download" id="getcsv"/>
<div id="data"></div>

<script>
$(function() {
        $("#datepicker").datepicker({dateFormat: 'mm/dd/yyyy'
        });
	
	
});

$("#getcsv").click(function() {
        var dateObject = $("#datepicker").datepicker("getDate");
        var month = dateObject.getMonth();
        month = month +1;

	window.location.href="csv.php?date="+dateObject.getFullYear() + "-" + month + "-" + dateObject.getDate();
	});


$.ajaxSetup ({
	cache: false
	});
	var ajax_load = "please wait...";

	$("#refresh").click(function(){
		var dateObject = $("#datepicker").datepicker("getDate");
		var month = dateObject.getMonth();
		month = month +1;
		$("#data")
			.html(ajax_load)
			.load("date.php", {date: dateObject.getFullYear() +"-" + month + "-" + dateObject.getDate()});
	});


</script>
</body>
</html>

