// Constructing an object
function Person (name)
{
	this.name = name;	
}

// extending the prototype of the object by a getName function
Person.prototype.getName = function(){
	return this.name;
}

Person.prototype.gender = "female";

var alice = new Person("Alice");
var bob = new Person("Bob")


console.log(alice.gender);
console.log(alice.getName());

console.log(bob.gender);
console.log(bob.getName());

// Lecture example
Object.prototype.gender = "female";

var x = new Array();
console.log(x.gender);