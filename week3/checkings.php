<?php
 
require_once "./account.php";

class CheckingAccount extends Account 
{
    const OVERDRAW_LIMIT = -200;

    public function withdrawal($amount) 
    {
        // write code here. Return true if withdrawal goes through; false otherwise
        $newBal = $this->balance - $amount;
        if ($newBal < self::OVERDRAW_LIMIT) {
            return false; // Overdraw limit exceeded
        }
        $this->balance = $newBal;
        return true; 
    } // end withdrawal

    //freebie. I am giving you this code.
    public function getAccountDetails() 
    {
        $accountDetails = "<h2>Checking Account</h2>";
        $accountDetails .= parent::getAccountDetails();

        return $accountDetails;
    }
}


// The code below runs everytime this class loads and 
// should be commented out after testing.