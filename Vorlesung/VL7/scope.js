// Scope 1
var candy1 = "chocolate";

function outputCandy1()
{
	var sweet1 = "cookie";
	console.log(candy1);
	console.log(sweet1);
}

outputCandy1();
console.log(sweet1);

// Scope 2
var candy2 = "chocolate";

function outputCandy2()
{
	var candy2 = "cookie";
	console.log(candy2);
}

outputCandy2();
console.log(candy2);

// Scope 3
function outputCandy3()
{
	candy3 = 4;
	console.log(candy3);
}

var candy3 = "chocolate";

console.log(candy3);
outputCandy3();
console.log(candy3);