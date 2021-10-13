<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">


    <div class="">

        <input class="" name="officer_id" type="text" placeholder="<?php echo $officer_id_err;  ?>" value="<?php echo $officer_id ?>" required minlength="6" pattern="[0-9]{6}" maxlength="6">
        <label class="">Officer ID</label>
    </div>
    <div class="">
        <input class="" name="fname" type="text" placeholder="<?php echo $fname_err;  ?>" value="<?php echo $fname ?>" pattern="[A-Za-z]+" required>
        <label class="">First Name</label>
    </div>

    <div class="">
        <input class="" name="lname" type="text" placeholder="<?php echo $lname_err;  ?>" value="<?php echo $lname ?>" pattern="[A-Za-z]+" required>
        <label class="">Last Name</label>
    </div>
    <div class="">
        <input class="" name="station" type="text" placeholder="<?php echo $station_err;  ?> " value="<?php echo $station ?>" required>
        <label class="">station</label>
    </div>
    <div class="">
        <input class="" name="email" type="email" placeholder="<?php echo $email_err;  ?> " value="<?php echo $email ?>" required>
        <label class="">Email</label>
    </div>
    <div class="">
        <input class="" name="mobile" type="tel" placeholder="<?php echo $mobile_err;  ?> " value="<?php echo $mobile ?>" pattern="[0]{1}[0-9]{9}" maxlength="10" required>
        <label class="">Contact Number</label>
    </div>
    <div class=" ">
        <input id="button" class="" type="submit" value="Submit">
        <input id="button" class=" " type="reset" value="Reset">

    </div>
    </div>


</form>