<?php
$PageTitle = "Coffee Shop";
if (!isset($_SESSION)) {
    $session = new SessionHandle();
}
?>
<html>
<body>
    <div class="container">
        <div class="row" id="background" style="color: #F4FAFF; justify-content: center;
  align-items: center;">
            <div class="col text-center" style="font-weight: 300; ">
            <p>"<?php echo($index->getCompanyData()['companyDescription']); ?>"</p>
            </div>
            <div class="col text-center" style="color: #9C7738;">
            <p>Address: <br> <?php echo($index->getCompanyData()['adress']); ?></p>
            <p>Phone: <br> <?php echo($index->getCompanyData()['phone']); ?></p>
            <p>Email: <br> <?php echo($index->getCompanyData()['email']); ?></p>
            </div>
            <div class="col text-left">
            <h5 style="font-weight: 300; ">Working time of the Company:</h5> <br>
            <div class="hours" style="color: #9C7738;">
                    <?php
                    foreach ($index->getWorkdays() as $key => $value) {
                    ?>
                    <div class="col-sm">
                    <p><?php print_r($value['startingHour']) ?></p> 
                    </div>
                    <div class="col-sm">
                    <p><?php print_r($value['closingHour']) ?></p> 
                    </div> 
                    <div class="col-sm text-left">
                    <p><?php print_r($value['openDay']) ?></p>  
                    </div> 
                    <?php
                    }
                    ?>
            </div>
            </div>
           
         
        </div>
        <div class="row justify-content-center" style="background-color: #0B0501; color: #5D5A57;">
        <p>© Copyright 2020 Coffee Shop. All rights Reserved. Designed by Niko, Simas & Ugne</p>
        </div>
    </div>
</body>
</html>
<style>
#background {
    background: url("https://scontent.faar2-1.fna.fbcdn.net/v/t1.15752-9/s2048x2048/122551051_4786173088090077_747681848141860092_n.jpg?_nc_cat=102&ccb=2&_nc_sid=ae9488&_nc_ohc=d4ggOw64ldsAX-6-Pmj&_nc_ht=scontent.faar2-1.fna&tp=7&oh=1c9e11befdf3c746f49624401921269e&oe=5FB8ED80");
    height: 380px; /* You must set a specified height */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; /
}
.hours {
    display: grid; 
    grid-template-columns: 15% 30% 55%; 
}

</style>