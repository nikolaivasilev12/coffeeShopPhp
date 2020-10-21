<?php
include("header.php");
class Rating extends Controller {
    public static function save($ratingValue) {
        self::query("INSERT INTO rating (productID, customerID, ratingValue) VALUES ( ? , ? , ? )", array($ratingValue['productID'], $ratingValue['customerID'], $ratingValue['ratingValue']));
        $ratingValue = self::query("SELECT ratingValue FROM rating");

        }

/* if (isset($_POST['save'])) {
    $customerID = $conn->real_escape_string($_POST['customerID']);
    $ratingValue = $conn->real_escape_string($_POST['ratingValue']);
    $ratingValue++;

    if (!$customerID) {
        $conn->query("INSERT INTO rating (ratingValue) VALUES ('$ratingValue')");
        $sql = $conn->query("SELECT customerID FROM rating ORDER BY customerID DESC LIMIT 1");
        $uData = $sql->fetch_assoc();
        $customerID = $uData['customerID'];
    } else
        $conn->query("UPDATE rating SET ratingValue='$ratingValue' WHERE customerID='$customerID'");

    exit(json_encode(array('customerID' => $customerID)));
}

$sql = $conn->query("SELECT customerID FROM rating");
$numR = $sql->num_rows;

$sql = $conn->query("SELECT SUM(ratingValue) AS total FROM rating");
$rData = $sql->fetch_array();
$total = $rData['total'];

$avg = $total / $numR;
*/
?>