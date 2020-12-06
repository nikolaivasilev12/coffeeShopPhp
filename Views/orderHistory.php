<?php 
include("Views/_partials/header.php");
$admin = new Admin();
$ordersList = $admin->getOrdersByCustomer($_SESSION['customerID']);
if (!isset($_GET['orderID'])) {
        if (isset($ordersList)) {
    ?>
    <div class="container">
    <div class="row justify-content-center mt-5 mb-3">
                <h2>Orders</h2>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Amount</th>
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
                                <td><?php echo $value['date'] ?></td>
                                <td>
                                    <a href="order-history?orderID=<?php echo $value['orderID'] ?>" class="btn btn-orange ">
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
    ?>
<div class="container">
    <div class="row justify-content-center text-center">
        <h2>
            You have no orders yet!
        </h2>
    </div>
</div>
<?php 
    } 
} elseif(isset($_GET['orderID'])) {
    $orderProducts = $admin->getProductsByOrderId($_GET['orderID']);
    $orderTotal = $admin->getOrderTotal($_GET['orderID']);
?>
<div class="container">
    <div class="row justify-content-center">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Name</th>
                <th scope="col">Individual Price</th>
                <th scope="col">Quantity</th>
                <th style="width:170px;" scope="col">Origin</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($orderProducts as $key => $value) {
            ?>
                <tr>
                    <th scope="row"><?php echo $value['productID'] ?></th>
                    <td><?php echo $value['name'] ?></td>
                    <td>
                        <?php
                        echo $value['price'];
                        ?>
                        DKK
                    </td>
                    <td>
                        <?php
                        echo ($orderTotal[$key]['amount']);
                        ?>
                    </td>
                    <td><?php echo $value['origin'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <th/>
        <th/>
        <th/>
        <th/>
        <th>
            Total:
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
            ?> DKK
        </th>
    </table>
    </div>
</div>
        <?php } ?>