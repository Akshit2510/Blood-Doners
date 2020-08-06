<?php 
include('include/header.php');

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];
    if(strlen($name)<3)
    {
        echo "<script>alert('First name must contain 3 characters.')</script>";
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        echo "<script>alert('Enter valid email.')</script>";
    }
    else if($contact==10)
    {
        echo "<script>alert('Contact no must contain 10 digits.')</script>";
    }
    else
    {
        if(isset($name) && isset($email) && isset($contact) && isset($message))
        {
            $sql = "INSERT INTO contact(name,email,contact,message) VALUES('$name','$email','$contact','$message')";
            if(mysqli_query($connection,$sql))
            {
                echo "<script>alert('Congratulations $name your message has been send successfully.')</script>";
            }
            else
            {
                echo "<script>alert('Could not send message try again later.')</script>";
            }
        }   
    }
}
?>
    <section id="signup" class="contianer-fluid about-us">
       <div class="container">
       <center><h2>Contact Us</h2></center>
           <div class="row">
               <div class="col-md-3"></div>
                   <div class="col-md-6">
                       <div class="row">
                           <div class="col-md-8">
                               <small><p style="margin-left:175px;">Fill the form below to contact us.</small>
                           </div>
                       </div> 
                       <hr>
                       <form method="post">
                           <label class="label control-label">Name</label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
                           <label class="label control-label">Email</label>
                           <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                           <label class="label control-label">Contact No</label>
                           <input type="number" class="form-control" name="contact" id="contact" placeholder="Enter your number" required>
                           <label class="label control-label">Message</label>
                           <textarea class="form-control" placeholder="Type your message here." id="message" name="message" required></textarea>
                           <center><button type="submit" class="btn btn-success" name="submit">Submit</button></center>
                       </form>          
                   </div>
            </div>      
       </div>
   </section>
<?php include('include/footer.php'); ?>