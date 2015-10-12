<html>
<head>
<script src="js/jquery.min.js"></script>
<script>
var a = 0;
var b = 0;
var elem = 1;

$(document).ready(function(){
	console.log("ad");
	$(document).on("change", ".sdate", function(){
        document.getElementById("temp").innerHTML = "";
		var newDiv = document.createElement('div');
		if (this.value == 'between') {
			document.getElementById("temp").innerHTML = "<input type=text name=date1> AND <input type=text name=date2>";
		} else {
			document.getElementById("temp").innerHTML = "<input type=text name=date1>";
		}
        
		// document.getElementById("testing").appendChild(newDiv);
		});
});

/*function moreDates() {
	elem = this;
	var newDiv = document.createElement('div');
	alert(elem.value);
}*/
function addUsers(name) {
	var newDiv = document.createElement('div');
	newDiv.innerHTML = "<div class='sname'>Input user " + a + ": <input type=text name=suser[]><br></div>";
	document.getElementById("testing2").appendChild(newDiv);
	a++;
}
function addDates(name) {
	var newDiv = document.createElement('div');
	newDiv.innerHTML = "<select class='sdate' id=sdate" + b +"><option value=between>Between</option><option value=earlier>Earlier</option><option value=later>Later</option><option value=during>During</option></select> <div id=temp><input type=text> AND <input type=text></div>";
	document.getElementById("testing").appendChild(newDiv);
	b++;
}
</script>
</head>
<body>
<form method=post action=query.php>
Search query: <input type=text name=squery><br>
<div id=testing></div>
<div id=testing2></div>
<input type=button value='Specify dates' onClick=addDates('testing')>
<input type=button value='Specify users' onClick=addUsers('testing')>
<input type=submit>
</form>
</body>
</html>