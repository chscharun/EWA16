// Named function
function exponentiate1 (a) {
	return a * a;
}

console.log(exponentiate1(5));

// Anonymous function
var exponentiate2 = function(a){
	return a * a;
}

console.log(exponentiate2(5));

// Closure exponentiate variant 1
function exponentiate3 (a) {
	var multiply = function(y){
		return a * y;
	}
	
	return multiply(a);
}

console.log(exponentiate3(5));

// Closure exponentiate variant 2
function exponentiate4 (a) {
	return function(b){
		return a * b;
	}(a);
}

console.log(exponentiate4(5));