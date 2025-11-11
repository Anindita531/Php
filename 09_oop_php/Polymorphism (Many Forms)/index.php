<?php
interface Shape {
    public function area();
}

class Circle implements Shape {
    public $radius;
    public function __construct($radius) {
        $this->radius = $radius;
    }
    public function area() {
        return 3.14 * $this->radius * $this->radius;
    }
}

class Rectangle implements Shape {
    public $width;
    public $height;
    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }
    public function area() {
        return $this->width * $this->height;
    }
}

$shapes = [new Circle(5), new Rectangle(4, 6)];

foreach ($shapes as $shape) {
    echo "Area: " . $shape->area() . "<br>";
}
?>
<!DOCTYPE html>
<html>  
<head>
    <meta charset="UTF-8">
    <title>Polymorphism Example</title>
</head>
<body>
    <h1>🔷 Polymorphism in PHP OOP</h1>
    <p>Check the output above to see how different shapes calculate their area using the same method name.</p>
</body>
</html>