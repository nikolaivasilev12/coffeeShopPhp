<?php
/*$conn = new mysqli('localhost', '', '', 'ratingSystem');

if (isset($_POST['save'])) {
    $userID = $conn->real_escape_string($_POST['uID']);
    $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
    $ratedIndex++;

    if (!$userID) {
        $conn->query("INSERT INTO stars (rateIndex) VALUES ('$ratedIndex')");
        $sql = $conn->query("SELECT id FROM stars ORDER BY id DESC LIMIT 1");
        $uData = $sql->fetch_assoc();
        $userID = $uData['id'];
    } else
        $conn->query("UPDATE stars SET rateIndex='$ratedIndex' WHERE id='$userID'");

    exit(json_encode(array('id' => $userID)));
}

$sql = $conn->query("SELECT id FROM stars");
$numR = $sql->num_rows;

$sql = $conn->query("SELECT SUM(rateIndex) AS total FROM stars");
$rData = $sql->fetch_array();
$total = $rData['total'];

$avg = $total / $numR;
*/
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
    var ratedIndex = -1, userID = 0;

    $(document).ready(function () {
        resetStarColors();

        if (localStorage.getItem('ratedIndex') != null) {
            setStars(parseInt(localStorage.getItem('ratedIndex')));
            userID = localStorage.getItem('userID');
        }

        $('.fa-star').on('click', function () {
            ratedIndex = parseInt($(this).data('index'));
            localStorage.setItem('ratedIndex', ratedIndex);
            saveToTheDB();
        });

        $('.fa-star').mouseover(function () {
            resetStarColors();
            var currentIndex = parseInt($(this).data('index'));
            setStars(currentIndex);
        });

        $('.fa-star').mouseleave(function () {
            resetStarColors();

            if (ratedIndex != -1)
                setStars(ratedIndex);
        });
    });

    function saveToTheDB() {
        $.ajax({
            url: "index.php",
            method: "POST",
            dataType: 'json',
            data: {
                save: 1,
                userID: userID,
                ratedIndex: ratedIndex
            }, success: function (r) {
                userID = r.id;
                localStorage.setItem('userID', userID);
            }
        });
    }

    function setStars(max) {
        for (var i=0; i <= max; i++)
            $('.fa-star:eq('+i+')').css('color', 'green');
    }

    function resetStarColors() {
        $('.fa-star').css('color', 'white');
    }
</script>
</body>
</html>