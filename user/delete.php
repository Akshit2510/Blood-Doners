<?php 
include ('include/header.php'); 
include('include/sidebar.php'); 
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
    $sql = "SELECT password,id FROM donor WHERE id=".$_SESSION['user_id']."";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $userID = $row['id'];
            $dbPassword = $row['password'];
        }
    }
    //code for deleting account
    if(isset($_POST['delete_account']))
    {
        if(isset($_POST['account_password']) && !empty($_POST['account_password']))
        {
            $account_password = md5($_POST['account_password']);
            if($account_password==$dbPassword)
            {
                $showForm = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Are you sure you want to delete your account?</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <form target="" method="post">
                <br>
                <input type="hidden" name="userID" value="'.$_SESSION['user_id'].'">
                <button type="submit" class="btn btn-success">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="alert">
                <span aria-hidden="true">Oops! No</span>
                </button>      
                </form>
                </div>';    
            }
            else
            {
                echo "<script>alert('Please enter valid password.')</script>";    
            }
        }
        else
        {
            echo "<script>alert('Please enter password.')</script>";
        }
    }
    
    if(isset($_POST['userID']))
    {
        $userID = $_POST['userID'];
        $sql = "DELETE FROM donor WHERE id=".$userID;
        if(mysqli_query($connection,$sql))
        {
            echo "<script>window.location.href='logout.php';</script>";
            exit();
        }
        else
        {
            echo "<script>alert('Oops! Your account not deleted please try again later.')</script>";
        }   
    }
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-push-1">
            <div class="panel panel-default">
                <div class="panel-body">
                   <div class="container">
                   <center><h2>Delete your account</h2></center>
                       <div class="col-md-7 offset-md-3 form-container">
                           <?php if(isset($showForm)) echo $showForm; ?>
                        <div class="panel panel-default" style="padding: 20px;">
                            <form action="" method="post" class="form-group form-container" >
                                <div class="form-group">
                                    <label for="oldpassword">Password</label>
                                    <input type="password" name="account_password" placeholder="Current Password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-danger center-aligned" type="submit" name="delete_account">Delete Account</button>
                                </div>
                            </form>
                        </div>
                       </div>      
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
else
{
    header("Location: ../index.php");
}
?>