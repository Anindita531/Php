<?php
class Car {
    public $brand;
    public $color;

    // Constructor
    public function __construct($brand, $color) {
        $this->brand = $brand;
        $this->color = $color;
    }

    // Method
    public function showDetails() {
        echo "This car is a {$this->color} {$this->brand}.<br>";
    }
}

// Create objects
$car1 = new Car("Tesla", "Red");
$car2 = new Car("BMW", "Black");

// Access method
$car1->showDetails();
$car2->showDetails();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simple Class Example</title>
</head>
<body>  
    <h1>🚗 Simple Class Example in PHP</h1>
    <p>Check the output above to see the car details displayed using the class method.</p>
</body>
</html>    