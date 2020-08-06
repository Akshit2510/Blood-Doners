<?php include ('include/header.php'); include 'include/sidebar.php'; ?>
<div class="container" style="padding: 60px 160px;">
    <div class="row">
        <div class="col-md-12 col-md-push-1">
            <div class="panel panel-default" style="padding: 20px;">
                <div class="panel-body">
                <div class="heading text-center">
                    <h3>Welcome</h3><h1><?php if(isset($_SESSION['name'])) echo ucfirst($_SESSION['name']); ?></h1>
                </div>
                <p class="text-center">Here you can see your blood donation history.</p>
                <?php 
                if(isset($_SESSION['user_id']))
                {
                    $result=mysqli_query($connection,"SELECT save_life_date FROM history WHERE u_id=".$_SESSION['user_id']."") or die("Error:" . mysqli_error($connection));
                    $row=mysqli_num_rows($result);
                    if($row == 0)
                    { 
                        echo '<div class="donors_data"><span class="name">You have not donated blood yet.</span></div>';
                    }
                    else
                    {
                        echo "<div class=container><br>";
                        echo "<center><h4>Total no of Donation you have done : ".$row."</h4></center>";
                        echo "<br><br>";
                        echo "<table class='table table-striped table-bordered'>";
                        echo "<tr align='center'>";
                        echo "<th>Sr.no</th>";
                        echo "<th>Date</th>";
                        echo "<th>Day</th>";
                        echo "</tr>";
                        echo "</div>";
                        $i=0;
                        while($retrieve=mysqli_fetch_array($result))
                        {
                            $save=date('d-m-Y',strtotime($retrieve['save_life_date']));
                            $dayOfWeek = date("l",strtotime($save));
                            echo "<tr align='center'>";
                            echo "<th>".$i=$i+1;"</th>";
                            echo "<th>$save</th>";
                            echo "<th>$dayOfWeek</th>";
                            echo "</tr>";
                        }
                        echo "</table>";    
                    }
                }
                ?>      
               </div>
            </div>
        </div>
    </div>
</div>