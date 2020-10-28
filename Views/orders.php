<?php
include("header.php");
$admin = new Admin();
if ($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
if (!isset($_GET['orderID'])) {
    $ordersList = $admin->getOrders();
?>
    <div class="container">
        <div class="row justify-content-center">
            <h2>Orders</h2>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($ordersList as $key => $value) {
                        $orderTotal = $admin->getOrderTotal($value['orderID'])
                    ?>
                        <tr>
                            <th scope="row"><?php echo $value['orderID'] ?></th>
                            <td><?php echo $value['customerID'] ?></td>
                            <td>
                                <?php
                                $sum = 0;
                                $arrayLength = count($orderTotal);
                                foreach ($orderTotal as $keyInner => $valueInner) {
                                    $amount = $valueInner['price'] * $valueInner['amount'];
                                    if ($arrayLength <= 1) {
                                        echo ($amount);
                                    } else {
                                        $sum += $amount;
                                    }
                                };
                                if ($arrayLength > 1) {
                                    echo ($sum);
                                }
                                ?>
                                DKK
                            </td>
                            <td>Pending</td>
                            <td><?php echo $value['date'] ?></td>
                            <td>
                                <a href="orders?orderID=<?php echo $value['orderID'] ?>" class="btn btn-primary">
                                    Details
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
<?php
} else {
    $selectedOrder = $admin->getOrderById($_GET['orderID']);
    print_r($selectedOrder);
?>
<?php
}
?>