<?php 
include('include/header.php');
include('include/config.php');
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        echo "<script>alert('Enter valid email.')</script>";
    }
    if(isset($email) && isset($password))
    {
        $sql = "SELECT * FROM donor WHERE password='$password' AND email='$email'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['save_life_date'] = $row['save_life_date'];
                header('Location: user/index.php');
            }
        }
        else
        {
            echo "<script>alert('No record found please enter valid email and password.')</script>";
        }
    }
}

?>
    <section id="signup" class="contianer-fluid about-us">
       <div class="container">
        <center><h2>Login</h2></center>
          <div class="col-md-6 offset-md-3 form-container">
           <form method="post">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
              </div>
              <center><button type="submit" class="btn btn-success" name="submit">Submit</button></center><br>
              <p><center>Don't have an acoount <a href="signup.php" style="color:#6495ED;">Signup</a> here.</center></p><br>
              <p><center><a href="forgot.php" style="color:#6495ED;">Forgot Password?</a></center></p>
          </form>
           </div>
       </div>
   </section>
<?php include('include/footer.php'); ?>