// Construct new Array
var array1 = new Array();
//console.log(array1);

// Construct new Array with Elements
var array2 = new Array("EWA", "GDV", "ENA");
//console.log(array2);

// Construct new Array with specific length
var array3 = new Array(5);
//console.log(array3);

// Literal form
var array4 = ["EWA", "GDV", "ENA"];
//console.log(array4);

// Extension using object methods
var array5 = new Array();
array5.push("EWA");
array5.push(5);
array5.push(true);
//console.log(array5);

// Extension using index
var array6 = [];
array6[0] = "EWA";
//console.log(array6);

// Associative extension
var array7 = [];
array7["subject"] = "EWA";
//console.log(array7.length);

// Getting the length of an array
var array8 = ["EWA", "GDV"]
//console.log(array8.length);

// Iterating over arrays using for
var array9 = ["EWA", "GDV"];

for(var i = 0; i < array8.length; i++){
	//console.log(array9[i]);
}


// Iterating over array using for in short form
var array10 = ["EWA", "GDV"];
array10["subject"] = "ENA";

for (var i in array10){
	console.log(array10[i]);
}