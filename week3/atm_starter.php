<?php
    
    include "checkings.php" ;
    include "savings.php" ;
// basic information provided about the accounts being stated
    $checking = new CheckingAccount ('C123', 1000, '12-20-2019');
    $savings = new SavingsAccount ('S123', 5000, '03-20-2020');
    //code to make make all of the buttons function as well as to get the values and change the right accouts
   if (isset ($_POST['withdrawChecking'])) 
     {
        if(!$checking->withdrawal($_POST['checkingWithdrawAmount'])){
            echo '<div>Amount that you are trying to withdraw is greater than the amount allowed</div>';
        }
    } 
    else if (isset ($_POST['depositChecking'])) 

    {
        $checking->deposit($_POST['checkingDepositAmount']);
    } 
    else if (isset ($_POST['withdrawSavings'])) 
    {
        
        if(!$savings->withdrawal($_POST['savingsWithdrawAmount'])){
            echo '<div >Amount that you are trying to withdraw is greater than the amount allowed</div>';
        }
    } 
    else if (isset ($_POST['depositSavings'])) 
    {
        $savings->deposit($_POST['savingsDepositAmount']);
    }
    
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <style type="text/css">
        body {
            margin-left: 120px;
            margin-top: 50px;
        }
       .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
        }
        .account {
            border: 1px solid black;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 80px;}
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }
    </style>
</head>
<body>

    <form method="post">

    <h1>ATM</h1>
        <div class="wrapper">

        <div class="account">
                <?php echo $checking->getAccountDetails();?>
            </div>
            <div class="account">
                <?php echo $savings->getAccountDetails();?>
            </div>

            <div class="account">


                    <div class="accountInner">
                        <input type="number" name="checkingWithdrawAmount" value="" />
                        <input type="submit" name="withdrawChecking" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="number" name="checkingDepositAmount" value="" />
                        <input type="submit" name="depositChecking" value="Deposit" /><br />
                    </div>

            </div>
<div class="account">


                    <div class="accountInner">
                        <input type="number" name="savingsWithdrawAmount" value="" />
                        <input type="submit" name="withdrawSavings" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="number" name="savingsDepositAmount" value="" />
                        <input type="submit" name="depositSavings" value="Deposit" /><br />
                    </div>

            </div>

        </div>
    </form>
</body>
</html>