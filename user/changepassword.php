<?php 
include ('include/header.php'); 
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
//code for update password
if(isset($_POST['update_pass']))
{
    //Password input check
    $sql = "SELECT * FROM donor WHERE id=".$_SESSION['user_id']."";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $userID = $row['id'];
            $dbPassword = $row['password'];
        }
    }
    if(isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password']) && ($_POST['c_password']) && !empty($_POST['c_password']))
    {
        $oldpassword = md5($_POST['old_password']);
        if($oldpassword == $dbPassword)
        {
            if(strlen($_POST['new_password'])>=6)
            {
                if($_POST['new_password'] == $_POST['c_password'])
                {
                    $password = md5($_POST['new_password']);
                }
                else
                {
                    echo "<script>alert('Password does not match.')</script>";
                }
            }
            else
            {
                echo "<script>alert('Password must contains 8 characters.')</script>";
            }    
        }
        else
        {
            echo "<script>alert('Enter valid password.')</script>";
        }
    }
    else
    {
        echo "<script>alert('Enter the filled.')</script>";
    }
    if(isset($password))
    {
        //Update password into db
        $sql = "UPDATE donor SET password='$password' WHERE id='$userID'";
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
            echo "<script>alert('Password not updated try again later.')</script>";
        }
    }
}

include 'include/sidebar.php';
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-push-1">
            <div class="panel panel-default">
                <div class="panel-body">
                   <center><h2>Change Password</h2></center>
                       <div class="col-md-7 offset-md-3 form-container">
                        <form action="" method="post" class="form-group form-container">
                            <div class="form-group">
                                <label for="oldpassword">Current Password</label>
                                <input type="password" required name="old_password" placeholder="Current Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="newpassword">New Password</label>
                                <input type="password" required name="new_password" placeholder="New Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="c_password">Confirm Password</label>
                                <input type="password" required name="c_password" placeholder="Confirm Password" class="form-control">
                            </div>
                            <center><button class="btn btn-lg btn-danger center-aligned" type="submit" name="update_pass">Reset Password</button></center>
                        </form>
                       </div>     
                   </div>
            </div>
        </div>
    </div>
</div>
   <?php } ?>