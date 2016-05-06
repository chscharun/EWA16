// Constructing an object
function Person1 (name)
{
	this.name = name;	
}

var alice = new Person1("Alice");
var bob = new Person1("Bob");

console.log(alice.name); // Alice
console.log(bob.name); // Bob

// Constructing person with private properties
function Person2(firstname, lastname)
{
	this.firstname = firstname;
	var lastname = lastname;
	
	this.getLastname = function(){
		return lastname;
	}
}

var jdoe = new Person2("John", "Doe");

console.log(jdoe.lastname); // undefined
console.log(jdoe.getLastname()); // Doe