<html>
<head>
<script src="js/jquery.min.js"></script>
<script>

var a = 0;
var b = 0;

function addUsers(name) {
	var newDiv = document.createElement('div');
	newDiv.innerHTML = "Input user " + a + ": <input type=text name=suser[]><br>";
	document.getElementById("testing2").appendChild(newDiv);
	a++;
}

function addDates(name) {
	var newDiv = document.createElement('div');
	newDiv.innerHTML = "<select id=doption" + b + " name=doption[] onchange=myFunction('doption" + b + "','hider" + b + "')><option value=1>Between</option><option value=2>Earlier</option><option value=3>Later</option><option value=4>Exactly</option></select><input type=date name=d0[]><input type=date id=hider" + b + " name=d1[]><br>";
	document.getElementById("testing").appendChild(newDiv);
	b++;
}

function condActivate() {
	if (a > 0 && b > 0) {
		document.getElementById("condit").style.display  = "block";
	} else {
		document.getElementById("condit").style.display = "none";
	}
}

function myFunction(name1,name2) {
	var x = document.getElementById(name1).value;
	if (x == 1) {
		document.getElementById(name2).style.visibility = "visible";
	} else {
		document.getElementById(name2).style.visibility = "hidden";
	}
}

setInterval("condActivate()",0);

</script>
</head>
<body>
<form method=post action=query.php>
Search query: <input type=text name=squery><br>
<div id=testing></div>
<select id=condit name=cond><option value=AND>AND</option><option value=OR>OR</option></select>
<div id=testing2></div>
<input type=button value='Specify dates' onClick=addDates('testing')>
<input type=button value='Specify users' onClick=addUsers('testing')>
<input type=submit>
</form>
</body>
</html>