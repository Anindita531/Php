<?php
// Define recipes array
$recipes = [
    "Pasta Primavera" => ["pasta", "tomato", "bell pepper", "olive oil", "garlic"],
    "Omelette" => ["egg", "milk", "salt", "pepper", "butter"],
    "Fruit Salad" => ["apple", "banana", "orange", "honey", "lemon"],
    "Grilled Cheese Sandwich" => ["bread", "cheese", "butter"],
    "Tomato Soup" => ["tomato", "onion", "garlic", "olive oil", "salt"]
];

// Optional: store additional info
$recipe_info = [
    "Pasta Primavera" => ["time"=>"20 mins", "difficulty"=>"Medium","image"=>"https://food.com/pasta.jpg"],
    "Omelette" => ["time"=>"10 mins", "difficulty"=>"Easy","image"=>"https://www.recipetineats.com/tachyon/2017/09/Omelette-with-Mushrooms_0-2.jpg?resize=900%2C1260&zoom=0.72"],
    "Fruit Salad" => ["time"=>"5 mins", "difficulty"=>"Easy","image"=>"https://example.com/fruitsalad.jpg"],
    "Grilled Cheese Sandwich" => ["time"=>"10 mins", "difficulty"=>"Easy","image"=>"https://example.com/grilledcheese.jpg"],
    "Tomato Soup" => ["time"=>"25 mins", "difficulty"=>"Medium","image"=>"https://th.bing.com/th/id/OSK.b19ae7ed2b8fe28bac8ef7fa28986a7f?w=200&h=126&c=7&rs=1&qlt=80&o=6&cdv=1&pid=16.1"],
];

$matched_recipes = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ingredients
    $input = strtolower($_POST['ingredients']);
    $user_ingredients = array_map('trim', explode(",", $input));

    // Check recipes
    foreach ($recipes as $recipe => $ingredients) {
        // If all recipe ingredients are in user input
        $found = array_intersect($ingredients, $user_ingredients);
        // Threshold: at least 50% ingredients match
        if (count($found) >= ceil(count($ingredients)/2)) {
            $matched_recipes[$recipe] = $recipe_info[$recipe];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quick Recipe Finder</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f9f9f9; }
        h1 { text-align: center; }
        form { text-align: center; margin-bottom: 30px; }
        input[type=text] { width: 300px; padding: 5px; }
        input[type=submit] { padding: 5px 15px; }
        .recipe { background: #ffe4b5; margin: 10px auto; padding: 15px; border-radius: 8px; width: 50%; }
    </style>
</head>
<body>
    <h1>🍳 Quick Recipe Finder</h1>
    <form method="post" action="">
        <label for="ingredients">Enter your ingredients (comma separated):</label><br><br>
        <input type="text" id="ingredients" name="ingredients" placeholder="e.g. egg, milk, bread" required>
        <input type="submit" value="Find Recipes">
    </form>

    <?php if(!empty($matched_recipes)) { ?>
        <h2>Recipes you can make:</h2>
        <?php foreach($matched_recipes as $recipe => $info) { ?>
            <div class="recipe">
                <h3><?php echo $recipe; ?></h3>
                <p>Estimated Time: <?php echo $info['time']; ?></p>
                <p>Difficulty: <?php echo $info['difficulty']; ?></p>
                <img src="<?php echo $info['image']; ?>" alt="<?php echo $recipe; ?>" style="max-width:98%; height: 200px;; border-radius:8px;">
            </div>
        <?php } ?>
    <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <p style="text-align:center;">No matching recipes found 😢. Try adding more ingredients.</p>
    <?php } ?>
</body>
</html>
