<?php

class Profile extends Controller {

    public function getProfileData($customerID) {
        return $this->array_flatten(self::query("SELECT * FROM customer WHERE customerID = ('{$customerID}')"));
    }
/** Comments work here use this syntax */
    public function updateProfile($customerID, $profileData) {
        return self::query("UPDATE customer SET fname = '{$profileData['fname']}', lname = '{$profileData['lname']}', phoneNr = '{$profileData['phoneNr']}', email = '{$profileData['email']}'
        WHERE customerID = ('{$customerID}')");
    }

    public function getCustomerIds() {
        return $this->array_flatten(self::query("SELECT customerID FROM customer"));
    }
}
