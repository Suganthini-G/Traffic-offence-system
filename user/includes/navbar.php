  <div class="d-lg-none d-block pt-2 d-flex justify-content-between sticky-top">
      <!--menu dropdown-->
      <div class="dropdown ms-4">
          <a class=" dropdown-toggle" href="" type="button" role="button" id="dropdownMenuLink" data-mdb-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bars fa-2x text-success"></i>
          </a>
          <ul class="dropdown-menu mx-2 bg-tranparent" aria-labelledby="dropdownMenuLink">
              <li class=""><a class="text-start fw-bold btn  btn-sm but-warning " href="offenceHistory.php">View Offense history</a></li>
              <li class=""><a class="text-start fw-bold btn  btn-sm but-warning " href="vehicleLost.php">Complaint on lost vehicles</a></li>
              <li class=""><a class="text-start fw-bold btn  btn-sm but-warning " href="RequestHelp.php">Request to get help</a> </li>
              <li class=""><a class="text-start fw-bold btn  btn-sm but-warning " href="paymentPortal.php">Online payment portal</a></li>
              <li class=""> <a class="text-start fw-bold btn  btn-sm but-warning " href="ambulanceSearch.php">Call for ambulance</a> </li>
          </ul>
      </div>
      <!--avatar and notification -->
      <div class=" m-auto me-0">
          <ul class="nav nav-pills m-auto">
              <?php include("userDrop.php");
                include("notification.php"); ?>
          </ul>
      </div>
  </div>