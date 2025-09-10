<link rel="stylesheet" href="currency_style.css">
<h2>Currency Converter</h2>
<form action="currency_converter.php" method="post">
    Choose Input type:
    <select name="from_conversion">
        <option value="usd">USD</option>
        <option value="eur">EUR </option>
        <option value="inr">INR</option>
    </select><br><br>
    Amount: <input type="number" name="amount" step="0.01"><br><br>
     <select name="to_conversion">
        <option value="usd">USD</option>
        <option value="eur">EUR </option>
        <option value="inr">INR</option>
    </select><br><br> 
    <input type="submit" value="Convert">   
</form>