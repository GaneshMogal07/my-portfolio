<?php
echo "=== PHP Variable Types Demo ===<br><br>";

// 1. Integer
$age = 25;
echo "Integer: $age <br>";

// 2. Float / Double
$price = 99.99;
echo "Float: $price <br>";

// 3. String
$name = "Ganesh";
echo "String: $name <br>";

// 4. Boolean
$is_active = true;
echo "Boolean: " . ($is_active ? "true" : "false") . "<br>";

// 5. Indexed Array
$fruits = ["Apple", "Banana", "Mango"];
echo "Indexed Array: " . implode(", ", $fruits) . "<br>";

// 6. Associative Array
$user = ["name" => "Ganesh", "age" => 25];
echo "Associative Array: Name = " . $user["name"] . ", Age = " . $user["age"] . "<br>";

// 7. Object
class Car {
    public $brand = "BMW";
}
$myCar = new Car();
echo "Object: Car Brand = " . $myCar->brand . "<br>";

// 8. NULL
$emptyVar = null;
echo "NULL: ";
var_dump($emptyVar);
echo "<br>";

// 9. Resource (Example: DB connection or file)
$file = fopen("php_demo.txt", "w"); 
echo "Resource: ";
var_dump($file);
fclose($file);

?>
