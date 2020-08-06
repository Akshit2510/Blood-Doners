<?php 
include ('include/header.php');
if(isset($_POST['sendotp']))
{
    if(isset($_POST['email']) && !empty($_POST['email']))
    {
        $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if(preg_match($pattern,$_POST['email']))
        {
             $email = $_POST['email'];    
        }
        else
        {
            echo "<script>alert('Please enter valid email.')</script>";
        }
    }
    else
    {
        echo "<script>alert('Please enter your email.')</script>";
    }
    if(isset($_POST['dob']) && !empty($_POST['dob']))
    {
        $dob = $_POST['dob'];    
    }
    else
    {
        echo "<script>alert('Please enter your DOB.')</script>";
    }
    if(isset($_POST['contact']) && !empty($_POST['contact']))
    {
        $mobile = $_POST['contact'];    
    }
    else
    {
        echo "<script>alert('Please enter mobile no.')</script>";
    }
    if(isset($email) && isset($dob) && isset($mobile))
    {
        $query = "SELECT * FROM donor WHERE email='$email' AND dob='$dob'";
        $run = mysqli_query($connection,$query);
        if(mysqli_num_rows($run)>0)
        {
            $row = mysqli_fetch_array($run);
            $email = $row['email'];
            $_SESSION['email'] = $email;
            require('textlocal.class.php');
            $phone = $_POST['contact'];
            define("API_KEY",'vsmeirgSz/8-K29kXctTyaCmSJ85sdgFV61NrER1av');
            define("MOBILE",$phone);
            $textlocal = new Textlocal(false,false, API_KEY);
            $numbers = array(MOBILE);
            $sender = 'TXTLCL';
            $otp = mt_rand(10000,99999);
            $message = "This is your OTP:" . $otp . " for changing your account password do not share it with others.";
            try 
            {
                $result = $textlocal->sendSms($numbers, $message, $sender);
                $_SESSION['otp'] = $otp;
                header("location:verify.php");
            }
            catch (Exception $e) 
            {
                die('Error: ' . $e->getMessage());
            }    
        }
        else
        {
            echo "<script>alert('Your email or dob does not match to any account.')</script>";
        }    
    }
}       
?>
<section id="signup" class="contianer-fluid about-us">
   <div class="container">
    <center><h2>Signup</h2></center>
      <div class="col-md-6 offset-md-3 form-container">
        <form method="post">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
              </div>
              <div class="form-group">
                <label for="contact">Contact</label>
                <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter Contact" required>
              </div>
              <div class="form-group">
                <label for="dob">DOB</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
              </div>
              <div class="form-group">
                <button name="sendotp" class="btn btn-primary btn-block">Send OTP</button>
              </div>
        </form>
       </div>
    </div>
</section>
<?php include('include/footer.php'); ?>