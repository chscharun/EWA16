// Defining objects
var a = new Object();
//console.log(a);

// Literal form
var b = {};

// Adding properties
var c = {};
c.letter = "c";
//console.log(c);
//console.log(c.letter);

// Associative bindings (is possible because Arrays are also Objects)
var d = {};
d["letter"] = "d";
//console.log(d);
//console.log(d.letter);

// Adding methods
var e = {};
e.add = function(a, b){
	return a + b;
};

//console.log(e.add(2,3));
var x = e.add;
var y = x(2,3);
console.log(y);

// As mentioned in primitives.js - Strings aren't real primitives
console.log("EWA".length);
console.log("EWA".charAt(1));

 