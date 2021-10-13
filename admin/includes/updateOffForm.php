 <?php include_once("config.php"); ?>
 <?php include_once("updateOff.php"); ?>

 <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

     <div class="row justify-content-between">
         <div class="col-11">
             <h3>You are updating details of <br> <?php echo "ID :" . $officer_id ?></h3>
         </div>
         <div class="col-1  mt-3"><a type="button" href="manageOfficer.php" class="btn-close bg-danger" aria-label="Close"></a>
         </div>
     </div>
     <div>
         <div class="">
             <input name="officer_id" type="text" placeholder="<?php echo $officer_id_err;  ?>" value="<?php echo $officer_id ?>" required minlength="6" maxlength="6" hidden>
         </div>
         <div class="mt-3">
             <span>station</span>
             <input name="station" type="text" placeholder="<?php echo $station_err;  ?> " value="<?php echo $station ?>" required>
         </div>
         <div class="mt-3">
             <span>Email address</span>
             <input name="email" type="email" placeholder="<?php echo $email_err;  ?> " value="<?php echo $email ?>" required>
         </div>
         <div class="mt-3">
             <span>Contact Number</span>
             <input name="mobile" type="tel" placeholder="<?php echo $mobile_err;  ?> " value="<?php echo $mobile ?>" pattern="[0]{1}[0-9]{9}" maxlength="10" required>
         </div>
         <div class="mt-2">
             <span>Duty status</span>
             <select name="work_status" placeholder="<?php echo $work_status_err;  ?> " value="<?php echo $work_status ?>">
                 <option value="active">Active</option>
                 <option value="retired">Retired</option>
                 <option value="suspended">Suspended</option>
             </select>
         </div> <br>
         <div class="button text-center">
             <input type="submit" class="me-3" value="Submit">
         </div>
 </form>