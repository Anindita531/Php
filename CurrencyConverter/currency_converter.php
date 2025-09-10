<link rel="stylesheet" href="currency_style.css">
<?php
 $amount = $_POST['amount'];
 $fromCurrency = $_POST['from_conversion'];
    $toCurrency = $_POST['to_conversion'];
    $conversionRates = [// arrays for conversion rates
        'usd' => 1,
        'eur' => 0.85,
        'inr' => 74.57
    ];
    if (array_key_exists($fromCurrency, $conversionRates)) {
        $convertedAmount = $amount * ($conversionRates[$toCurrency] / $conversionRates[$fromCurrency]);
        echo "<h2>Currency Converter</h2>";
        echo "Amount in $fromCurrency: $amount<br>";
        echo "Converted Amount in $toCurrency: " . number_format($convertedAmount, 2);
    } else {
        echo "Invalid currency selected.";
    }

?>