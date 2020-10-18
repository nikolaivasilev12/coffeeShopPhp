<?php 

class Profile extends Controller {
   
    public function getProfileData($customerID) {
        return $this->array_flatten(self::query("SELECT * FROM customer WHERE customerID = ('{$customerID}')"));
    }
    public function updateProfile($customerID, $profileData) {
        return self::query("UPDATE customer SET fname = '{$profileData['fname']}', lname = '{$profileData['lname']}', email = '{$profileData['email']}'
        WHERE customerID = ('{$customerID}')");
    }



    /* Getting Customer's DATA FIRST */
    // public function getCustomerEmail($customerID) {
    //     return (self::query("SELECT email FROM customer
    //     WHERE customerID = ('{$customerID}')"));
    // }
    // public function getCustomerPassword($customerID) {
    //     return (self::query("SELECT `password` FROM customer
    //     WHERE customerID = ('{$customerID}')"));
    // }
    // public function getCustomerfName($customerID) {
    //     return (self::query("SELECT fname FROM customer
    //     WHERE customerID = ('{$customerID}')"));
    // }
    // public function getCustomerlName($customerID) {
    //     return (self::query("SELECT lname FROM customer
    //     WHERE customerID = ('{$customerID}')"));
    // }
    // public function getCustomerphoneNr($customerID) {
    //     return (self::query("SELECT phoneNr FROM customer
    //     WHERE customerID = ('{$customerID}')"));
    //  }
    
        /* Edit customer's email, password, names., email */
    // public function updateCustomerEmail($customerEmail){
    //     self::query("UPDATE customer SET email = '{$customerEmail}'");
    // }
    // public function updateCustomerPass($customerPassword){
    //     self::query("UPDATE customer SET `password` = '{$customerPassword}'");
    // }
    // public function updateCustomerfName($customerfName){
    //     self::query("UPDATE customer SET fname = '{$customerfName}'");
    // }
    // public function updateCustomerlName($customerlName){
    //     self::query("UPDATE customer SET lname = '{$customerlName}'");
    // }
    // public function updateCustomerphoneNr($customerphoneNr){
    //     self::query("UPDATE customer SET phoneNr = '{$customerphoneNr}'");
    // }

}
