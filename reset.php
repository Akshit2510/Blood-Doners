<?php 
include ('include/header.php');
include ('include/congif.php');
if(isset($_SESSION['email']) && !empty($_SESSION['email']))
{
    //code for update password
    if(isset($_POST['update_pass']))
    {
        //Password input check
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM donor WHERE email='$email'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0)
        {
            $row = mysqli_fetch_assoc($result);
            $doner_id = $row['id'];
        }
        if(isset($_POST['new_password']) && !empty($_POST['new_password']) && ($_POST['c_password']) && !empty($_POST['c_password']))
        {
            if(strlen($_POST['new_password'])>=6)
            {
                if($_POST['new_password'] == $_POST['c_password'])
                {
                    $password = md5($_POST['new_password']);
                    if(isset($password))
                    {
                        //Update password into db
                        $sql = "UPDATE donor SET password='$password' WHERE email='$email'";
                        if(mysqli_query($connection,$sql))
                        {
                            echo "<script>alert('Password updated successfully.')</script>";
                            ?>
                            <script>
                                function myFunction()
                                {
                                    location.reload();
                                }
                            </script>
                            <?php
                        }
                        else
                        {
                            echo "<script>alert('Failed to update password please try again later.')</script>";
                        }
                    }  
                }
                else
                {
                    echo "<script>alert('Password are not same.')</script>";
                }
            }
            else
            {
                echo "<script>alert('Password consists of 6 characters.')</script>";
            }    
        }
        else
        {
            echo "<script>alert('Please fill the password field.')</script>";
        }
    }
}
?>
<section id="signup" class="contianer-fluid about-us">
   <div class="container">
    <center><h2>Reset Password</h2></center>
      <div class="col-md-6 offset-md-3 form-container">
        <form action="" method="post" class="form-group form-container" >
            <div class="form-group">
                <label for="newpassword">New Password</label>
                <input type="password" name="new_password" placeholder="New Password" class="form-control">
            </div>
            <div class="form-group">
                <label for="c_password">Confirm Password</label>
                <input type="password" name="c_password" placeholder="Confirm Password" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-danger center-aligned" type="submit" name="update_pass">Reset Password</button>
            </div>
        </form>
       </div>
    </div>
</section>
<?php include('include/footer.php'); ?>