<?php 
include 'include/header.php';
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
    if(isset($_POST['date']))
    {
        $showForm = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Are you sure you want to update your record by donating the blood?</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <form target="" method="post">
        <br>
        <input type="hidden" name="userID" value="'.$_SESSION['user_id'].'">
        <button type="submit" name="updateSave" class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-primary" data-dismiss="alert">
        <span aria-hidden="true">Oops! No</span>
        </button>      
        </form>
        </div>';
    }

    if(isset($_POST['userID']))
    {
        $userID = $_POST['userID'];
        $crntDate = date_create();
        $crntDate = date_format($crntDate, 'Y-m-d');
        $sql = "INSERT INTO history(u_id,save_life_date) VALUES('$userID','$crntDate')";
        $sql2 = "UPDATE donor SET save_life_date='$crntDate' WHERE id='$userID'";
        if(mysqli_query($connection,$sql) && mysqli_query($connection,$sql2))
        {
            $_SESSION['save_life_date'] = $crntDate;
            header("Location: index.php");
        }
        else
        {
            $submitError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data are not updated please try again later.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            </div>';
        }
    }
?>
<style>
h1,h3
{
    display: inline-block;
    padding: 10px;
}
.name
{
    color: #e74c3c;
    font-size: 22px;
    font-weight: 700;
}
.donors_data
{
    background-color: white;
    border-radius: 5px;
    margin:35px 0px 10px 75px;
    -webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
    -moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
    box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
    padding: 20px;
}
</style>
<?php include 'include/sidebar.php'; ?>

<div class="container" style="padding: 60px 160px;">
    <div class="row">
        <div class="col-md-12 col-md-push-1">
            <div class="panel panel-default" style="padding: 20px;">
                <div class="panel-body">
                    <div class="heading text-center">
                        <h3>Welcome</h3><h1><?php if(isset($_SESSION['name'])) echo ucfirst($_SESSION['name']); ?></h1>
                    </div>
                    <p class="text-center">Here you can manage your account profile.</p>
                    <div class="test-success text-center" id="data" style="margin-top: 20px;">
                    <?php if(isset($showForm)) echo $showForm; ?></div>
                    <?php

                        $saveDate = $_SESSION['save_life_date'];
                        if($saveDate=='0')
                        {
                            echo '<form target="" method="post">
                            <center><button style="margin-top: 20px;" name="date" id="save_the_life" type="submit" class="btn btn-lg btn-success center-aligned ">Save The Life</button></center>
                            </form>';
                        }
                        else
                        {
                            $start = date_create("$saveDate");
                            $end = date_create();
                            $diff = date_diff($start,$end);
                            $diffMonth = $diff->m;
                            if($diffMonth>=3)
                            {
                                echo '<form target="" method="post">
                                <button style="margin-top: 20px;" name="date" id="save_the_life" type="submit" class="btn btn-lg btn-success center-aligned ">Save The Life</button>
                                </form>';
                            }
                            else
                            {
                                echo '<div class="donors_data">
                                <span class="name">Congratulations!</span>
                                <span>You Already Save the life. You will donate the blood after 3 months.
                                We are thanking to you.</span>
                                </div>';    
                            }    
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>