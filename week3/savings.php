<?php

require_once "./account.php";
 
class SavingsAccount extends Account 
{

    public function withdrawal($amount) 
    {
        $amount = intval($amount);
        // write code here. Return true if withdrawal goes through; false otherwise
        //checks the amount being left after withdrawl is greater than or equal than 0
        if($this->balance - $amount >= 0){
            $this->balance -= $amount;
            return true;
        }
        else{
            return false;
        }

    } //end withdrawal

    public function getAccountDetails() 
    {

        $accountDetails = "<h2>Savings Account</h2>";
        $accountDetails .= parent::getAccountDetails();

        return $accountDetails;
    } //end getAccountDetails

} // end Savings
