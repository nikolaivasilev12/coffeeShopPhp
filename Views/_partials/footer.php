<?php
if (!isset($_SESSION)) {
    $session = new SessionHandle();
}
?>
<footer>
    <div class="container-fluid px-0">
        <div class="row mx-0" id="background" style="color: #F9F8F0; justify-content: center; align-items: center;">
        <img id="imageFooter" height="350" class=""
                src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("assets/footer.jpg")); ?>"
            >
            <div class="col" style="text-align: center; font-weight: 300; margin-left: 5%;">
                <div style="display: inline-block; text-align: left;">
                    <h5 style="font-weight: 700; font-family: Marcellus; text-transform: uppercase;">About Us:</h5>
                    <hr style="margin-left:0;height:2px;width:15%;border-width:2px;background-color:#F9F8F0;">
                    <p style="color: #F9F8F0; display: inline; line-height: 2;">"<?php echo($index->getCompanyData()['companyDescription']); ?>"</p>
                </div>
            </div>
            <div class="col" style="text-align: center; margin-left: 5%;">
                <div style="display: inline-block; text-align: left;">
                    <h5 style="font-weight: 700; font-family: Marcellus; text-transform: uppercase;">Contact Us:</h5>
                    <hr style="margin-left:0;height:2px;width:15%;border-width:2px;background-color:#F9F8F0;">
                        <div class="contact" style="color: #9C7738;">   
                            <p style="color: #F9F8F0; display: inline; line-height: 2;">Address: </p>  <?php echo($index->getCompanyData()['adress']); ?> <br>
                            <p style="color: #F9F8F0; display: inline; line-height: 2;">Phone:</p>  <?php echo($index->getCompanyData()['phone']); ?> <br>
                            <p style="color: #F9F8F0; display: inline; line-height: 2;">Email: </p> <?php echo($index->getCompanyData()['email']); ?>
                        </div>
                </div>
            </div>
            <div class="col" style="text-align: center; margin-right: 5%;">
                <div style="display: inline-block; text-align: left;">
                    <h5 style="font-weight: 700; font-family: Marcellus; text-transform: uppercase;">Opening Hours:</h5>
                    <hr style="margin-left:0;height:2px;width:15%;border-width:2px;background-color:#F9F8F0;">
                        <div class="hours" style="color: #F9F8F0; line-height: 1;">
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
#imageFooter {
    position: absolute;
    height: 100% !important;
    width: 100% !important; /* IT WORKS!!!!!!!! */
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