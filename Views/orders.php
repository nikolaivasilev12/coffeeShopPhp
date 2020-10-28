<?php
include("header.php");
$admin = new Admin();
$ordersList = $admin->getOrders();
if ($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
?>
<div class="container">
    <div class="row justify-content-center">
        <h2>Orders</h2>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Order Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($ordersList as $key => $value){
                ?>
                <tr>
                    <th scope="row"><?php echo $value['orderID'] ?></th>
                    <td><?php echo $value['customerID'] ?></td>
                    <td>121321</td>
                    <td>Pending</td>
                    <td><?php echo $value['date'] ?></td>
                </tr>
                    <?php
                        }
                    ?>
            </tbody>
        </table>
    </div>

</div>