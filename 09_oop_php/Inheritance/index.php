<?php
class Animal {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function speak() {
        echo "{$this->name} makes a sound.<br>";
    }
}

class Dog extends Animal {
    public function speak() {
        echo "{$this->name} barks! 🐶<br>";
    }
}

$dog = new Dog("Tommy");
$dog->speak(); // Output: Tommy barks!
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inheritance Example</title>
</head>
<body>  
    <h1>🐾 Inheritance in PHP OOP</h1>
    <p>Check the output above to see how the Dog class inherits from the Animal class and overrides the speak method.</p>
</body>
</html>