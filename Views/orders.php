<?php
include("Views/_partials/header.php");
$admin = new Admin();
if ($_SESSION['permission'] != 'admin') {
    new Redirector('index');
}
if (!isset($_GET['orderID'])) {
    $ordersList = $admin->getOrders();
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
                                <a href="orders?orderID=<?php echo $value['orderID'] ?>" class="btn btn-orange ">
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
    $getCustomer = $admin->getCustomerById($selectedOrder[0]['customerID']);
    $adress = $admin->getOrderAdress($selectedOrder[0]['adressID']);
    $products = $admin->getProductsByOrderId($_GET['orderID']);
    $orderTotal = $admin->getOrderTotal($_GET['orderID']);
?>
    <div class="container">
        <div class="row pt-5 mt-5 justify-content-around">
            <div class="col-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div  iv class="d-flex flex-column align-items-center text-center">
                            <p class="h3">
                                Client Data
                            </p>
                            <div class="mt-3">
                                <h4><?php
                                    if (strlen($getCustomer[0]['fname']) > 0) {
                                        echo ($getCustomer[0]['fname'] . ' ' . $getCustomer[0]['lname']);
                                    } else {
                                        echo 'User doesnt have a profile name';
                                    }
                                    ?></h4>
                                <p class="text-secondary mb-1">Email: <?php echo ($getCustomer[0]['email']); ?></p>
                                <p class="text-muted font-size-sm">
                                    <?php
                                    if (strlen($getCustomer[0]['phoneNr']) > 0) {
                                    ?>
                                        Phone Number: <?php echo ($getCustomer[0]['phoneNr']) ?>
                                    <?php
                                    } else {
                                    ?>
                                        User hasnt provided a phone nr
                                    <?php } ?>
                                </p>
                            </div>
                            <p class="h2">
                                Address
                            </p>
                            <p class="h5">
                                <?php
                                if(isset($adress[0]['street'])){
                                    print_r($adress[0]['street']);
                                } else {
                                    echo('No street provided');
                                }
                                ?>
                            </p>
                            <p class="h5">
                                <?php
                                if(isset($adress[1]['city'])){
                                    print_r($adress[1]['city']);
                                } else {
                                    echo('No city provided');
                                }
                                ?>
                            </p>
                            <p class="h5">
                                <?php
                                if(isset($adress[0]['postalCode'])) {
                                    print_r($adress[0]['postalCode']);
                                } else {
                                    echo('No postal code provided');
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex align-items-start">
                <div class="row text-center">
                    <div class="col">
                        <h2 class="text-center">
                            Ordered Products
                        </h2>
                    </div>
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
                            foreach ($products as $key => $value) {
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
        </div>
        <div class="row justify-content-center">
            <div class="col-4 text-center">
                <p>
                    Status: <strong id="order_status">Accepted</strong>
                </p>
                <button onclick="updateOrderStatus()" class="btn btn-orange">
                    Update Status
                </button>
            </div>
        </div>
    </div>
    <script type="text/javascript"> 
    function updateOrderStatus() {
        var currentValue = document.getElementById('order_status').innerHTML;
        switch(currentValue) {
        case 'Accepted':
            document.getElementById('order_status').innerHTML = 'Awaiting Shippment'
            break;
        case 'Awaiting Shippment':
            document.getElementById('order_status').innerHTML = 'Shipped'
            break;
        case 'Shipped':
            document.getElementById('order_status').innerHTML = 'Completed'
            break;
        case 'Completed':
            document.getElementById('order_status').innerHTML = 'Accepted'
            break;
        default:
            document.getElementById('order_status').innerHTML = 'Accepted'
        }
    }
    </script>
<?php
}
?>