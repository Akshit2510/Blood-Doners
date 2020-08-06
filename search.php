<?php include('include/header.php'); ?>
  <style>
	.size{
		min-height: 0px;
		padding: 60px 0 40px 0;
	}
	.loader{
		display:none;
		width:69px;
		height:89px;
		position:absolute;
		top:25%;
		left:50%;
		padding:2px;
		z-index: 1;
	}
	.loader .fa{
		color: #e74c3c;
		font-size: 52px !important;
	}
	.form-group{
		text-align: left;
        margin-right: 350px;
	}
	h1{
		color: white;
	}
	h3{
		color: #e74c3c;
		text-align: center;
	}
	.red-bar{
		width: 25%;
	}
	span{
		display: block;
	}
	.name{
		color: #e74c3c;
		font-size: 22px;
		font-weight: 700;
	}
	.donors_data{
		background-color: white;
		border-radius: 5px;
		margin: 25px;
		-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		padding: 20px 10px 20px 30px;
	}
</style>
    <section id="search" class="contianer-fluid about-us">
       <div class="container">
        <center><h2>Search Donors</h2></center>
          <div class="col-md-10 offset-md-3 form-container">
           <form method="get">
              <div class="form-group">
              <label for="state">State</label>
                <select name="state" id="state" class="form-control demo-default" onchange="remove()" required>
	                <option value="">--Select State--</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chhatisgarh">Chhatisgarh</option>
                    <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                    <option value="Daman and Diu">Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Pondicheery">Pondicheery</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttrakhand">Uttrakhand</option>
                    <option value="West Bengal">West Bengal</option>
                </select>
              </div>
              <div class="form-group">
                <label for="blood">Blood Group</label><br>
                <select class="form-control demo-default" id="blood_group" name="blood_group" required>
                <option value="">---Select Your Blood Group---</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success" style="margin-left:230px;">Submit</button>
          </form>
          </div>
	    <div class="row" id="data">
		<!-- Display The Search Result -->
		<?php
			if(isset($_GET['state']) && !empty($_GET['state']) && (isset($_GET['blood_group']) && !empty($_GET['blood_group'])))
			{
                $state = $_GET['state'];
				$blood = $_GET['blood_group'];
				$sql = "SELECT * FROM donor WHERE state='$state' OR blood='$blood'";
				$result = mysqli_query($connection,$sql);
				if(mysqli_num_rows($result)>0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						if($row['save_life_date']=='0')
						{
							echo '<div class="col-md-3 col-sm-12 col-lg-3 donors_data">
							<span class="name">'.$row['name'].$row['lname'].'</span>
							<span>'.$row['state'].'</span>
							<span>'.$row['blood'].'</span>
							<span>'.$row['gender'].'</span>
							<span>'.$row['email'].'</span>
							<span>'.$row['contact'].'</span>
							</div>';
						}
						else
						{
							echo '<div class="col-md-3 col-sm-12 col-lg-3 donors_data">
							<span class="name">'.$row['name'].'</span>
							<span>'.$row['state'].'</span>
							<span>'.$row['blood'].'</span>
							<span>'.$row['gender'].'</span>
							<h4 class="name text-center">Donated</h4>
							</div>';
						}
					}
				}
				else
				{
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		          	<strong>There is no blood donor you are searching for!Sorry.</strong>
		          	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span></button>
		    		</div>';
				}
			}
		?>
	        </div>
        <div class="loader" id="wait">
            <i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>
        </div>
    </div>
</section>
<?php include('include/footer.php'); ?>