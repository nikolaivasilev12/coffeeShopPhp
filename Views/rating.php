<?php
$ratingObj = new Rating();
$ratingObj->save($rating);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rating System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous"></head>
<body>
<div align="center" style="background: #000; padding: 50px;color:white;">
    <i class="fa fa-star fa-2x" data-index="0"></i>
    <i class="fa fa-star fa-2x" data-index="1"></i>
    <i class="fa fa-star fa-2x" data-index="2"></i>
    <i class="fa fa-star fa-2x" data-index="3"></i>
    <i class="fa fa-star fa-2x" data-index="4"></i>
    <br><br>
    <?php //echo round($avg,2) ?>
</div>

<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
<script>
    var ratingValue = -1, customerID = 0;

    $(document).ready(function () {
        resetRatingColors();

        if (localStorage.getItem('ratingValue') != null) {
            setRating(parseInt(localStorage.getItem('ratingValue')));
            customerID = localStorage.getItem('customerID');
        }

        $('.fa-star').on('click', function () {
            ratingValue = parseInt($(this).data('index'));
            localStorage.setItem('ratingValue', ratingValue);
            saveToTheDB();
            
        });

        $('.fa-star').mouseover(function () {
            resetRatingColors();
            var currentIndex = parseInt($(this).data('index'));
            setRating(currentIndex);
        });

        $('.fa-star').mouseleave(function () {
            resetRatingColors();

            if (ratingValue != -1)
                setRating(ratingValue);
        });
    });

    function saveToTheDB() {
        $.ajax({
            url: "rating",
            method: "POST",
            dataType: 'json',
            data: {
                save: 1,
                customerID: customerID,
                ratingValue: ratingValue
            }, success: function (r) {
                customerID = r.customerID;
                localStorage.setItem('customerID', customerID);
            }
        });
    }

    function setRating(max) {
        for (var i=0; i <= max; i++)
            $('.fa-star:eq('+i+')').css('color', 'green');
    }

    function resetRatingColors() {
        $('.fa-star').css('color', 'white');
    }
</script>
</body>
</html>