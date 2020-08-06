<?php 
include ('include/header.php');
include ('include/config.php');
if(isset($_POST['verify']))
{
    $otp = $_POST['otp'];
    if($_SESSION['otp'] == $otp)
    {
        header("Location:reset.php");
    }
    else
    {
        $submitError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please enter current OTP.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        </div>';
    }
}
?>

<section id="signup" class="contianer-fluid about-us">
   <div class="container">
    <center><h2>Verify OTP</h2></center>
      <div class="col-md-6 offset-md-3 form-container">
          <form action="" method="post" class="form-group form-container">
              <div class="form-group">
                 <label for="otp">OTP</label>
                 <input type="number" name="otp" placeholder="Enter OTP" id="otp" class="form-control">
              </div>
              <div class="form-group">
                 <button name="verify" class="btn btn-primary btn-block">Verify</button>
              </div>
          </form>  
      </div>
    </div>
</section>
<?php include('include/footer.php'); ?>