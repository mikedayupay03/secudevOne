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
		var newDiv = document.createElement('div');
		if (this.value == 'between') {
			newDiv.innerHTML = "a<br>";
		} else {
			newDiv.innerHTML = "b<br>";
		}
		document.getElementById("testing").appendChild(newDiv);
		document.getElementById("testing").removeChild(getElementById("testing").childNodes[0]);
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
	newDiv.innerHTML = "<select class='sdate' id=sdate" + b +"><option value=between>Between</option><option value=earlier>Earlier</option><option value=later>Later</option><option value=during>During</option></select>";
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