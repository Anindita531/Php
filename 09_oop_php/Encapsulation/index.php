<?php
class BankAccount {
    private $balance = 0;

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function getBalance() {
        return $this->balance;
    }
}

$account = new BankAccount();
$account->deposit(500);
echo "Your balance: ₹" . $account->getBalance();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Encapsulation Example</title>
</head>
<body>
    <h1>🏦 Encapsulation in PHP OOP</h1>
    <p>Check the output above to see the balance after depositing money into the bank account.</p>
</body>
</html>