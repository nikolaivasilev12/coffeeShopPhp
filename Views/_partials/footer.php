<?php
if (!isset($_SESSION)) {
    $session = new SessionHandle();
}
?>
<footer>
    <div class="container-fluid px-0">
        <div class="row mx-0" id="background">
            <img id="imageFooter" height="350" class=""
                src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("assets/footer.jpg")); ?>"
            >
            <div class="col" style="font-weight: 300; margin-left: 5%;">
                <div class="content">
                    <h5>About Us:</h5>
                    <hr>
                    <p>"<?php echo($index->getCompanyData()['companyDescription']); ?>"</p>
                </div>
            </div>
            <div class="col">
                <div class="content">
                    <h5>Contact Us:</h5>
                    <hr>
                        <div class="contact">   
                            <p>Address: </p>  <?php echo($index->getCompanyData()['adress']); ?> <br>
                            <p>Phone:</p>  <?php echo($index->getCompanyData()['phone']); ?> <br>
                            <p>Email: </p> <?php echo($index->getCompanyData()['email']); ?>
                        </div>
                </div>
            </div>
            <div class="col">
                <div class="content">
                    <h5>Opening Hours:</h5>
                    <hr>
                        <div class="hours">
                            <?php
                            foreach ($index->getWorkdays() as $key => $value) {
                            ?>
                            <div class="col-sm">
                                <p><?php print_r($value['startingHour']) ?></p> 
                            </div>
                            <div class="col-sm">
                                <p><?php print_r($value['closingHour']) ?></p> 
                            </div> 
                            <div class="col-sm">
                                <p><?php print_r($value['openDay']) ?></p>  
                            </div> 
                            <?php
                            }
                            ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</footer>
        <div class="row mx-0 justify-content-center" style="background-color: #0B0501; color: #5D5A57;">
            <p>© Copyright 2020 Coffee Shop. All rights Reserved. Designed by Niko, Simas & Ugne</p>
        </div>
<style lang="css">
p {
    color: #F9F8F0; display: inline; line-height: 2; 
}
hr {
    margin-left:0;
    height:2px;
    width:15%;
    border-width:2px;
    background-color:#F9F8F0;  
}
h5 {
    font-weight: 700; font-family: Marcellus; text-transform: uppercase;
}
.row {
    color: #F9F8F0; justify-content: center; align-items: center;
}
col {
    text-align: center; margin-left: 5%; font-weight: 300;
}
.content {
    display: inline-block; text-align: left;
}
#imageFooter {
    position: absolute;
    height: 100% !important;
    width: 100% !important; /* IT WORKS!!!!!!!! */
}
.contact {
    color: #9C7738;
}
.hours {
    color: #F9F8F0; line-height: 1;
}
#background {
    position: absolute;
    height: 380px; /* You must set a specified height */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; 
    color: #F4FAFF; 
}
.hours {
    display: grid; 
    grid-template-columns: 20% 30% 50%; 
    margin-left: -5%; 
}
</style>