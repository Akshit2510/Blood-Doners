<?php 

include 'include/header.php';
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
    //code for update user details
    if(isset($_POST['submit']))
    {
        //Name input check
        if(isset($_POST['name']) && !empty($_POST['name']))
        {
            if(preg_match('/^[A-Za-z\s]+$/',$_POST['name']))
            {
                $name = $_POST['name'];
            }
            else
            {
                echo "<script>alert('Only upper & lower case character are allowed.')</script>";
            }
        }
        else
        {
            echo "<script>alert('Please fill the field.')</script>";
        }

        //Last Name input check
        if(isset($_POST['lname']) && !empty($_POST['lname']))
        {
            if(preg_match('/^[A-Za-z\s]+$/',$_POST['lname']))
            {
                $lname = $_POST['lname'];
            }
            else
            {
                echo "<script>alert('Only upper & lower case character are allowed.')</script>";
            }
        }
        else
        {
            echo "<script>alert('Please fill the field.')</script>";
        }

        //DOB input check
        if(isset($_POST['dob']) && !empty($_POST['dob']))
        {
            $dob = $_POST['dob'];
        }
        else
        {
            echo "<script>alert('Please select DOB.')</script>";
        }

        //Blood input check
        if(isset($_POST['blood_group']) && !empty($_POST['blood_group']))
        {
            $blood = $_POST['blood_group'];    
        }
        else
        {
            echo "<script>alert('Please select your blood group.')</script>";
        }

        //City input check
        if(isset($_POST['state']) && !empty($_POST['state']))
        {
            $state = $_POST['state'];
        }
        else
        {
            echo "<script>alert('Please select your state.')</script>";
        }

        //City input check
        if(isset($_POST['city']) && !empty($_POST['city']))
        {
            $city = $_POST['city'];
        }
        else
        {
            echo "<script>alert('Please select your city.')</script>";
        }

        //Contact input check
        if(isset($_POST['contact']) && !empty($_POST['contact']))
        {
            if(preg_match('/\d{10}/',$_POST['contact']))
            {
                $contact = $_POST['contact'];
            }
            else
            {
                echo "<script>alert('Contact should contain 10 digits only.')</script>";
            }
        }
        else
        {
            echo "<script>alert('Please fill the contact field.')</script>";
        }

        //Email input check
        if(isset($_POST['email']) && !empty($_POST['email']))
        {
            $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if(preg_match($pattern,$_POST['email']))
            {
                $check_email = $_POST['email'];
                $sql = "select email from donor where email='$check_email'";
                $result = mysqli_query($connection,$sql);
                if(mysqli_num_rows($result)>0)
                {
                    echo "<script>alert('Sorry this email already exists.')</script>";
                }
                else
                {
                    $email = $_POST['email'];    
                }
            }
            else
            {
                echo "<script>alert('Please enter valid email.')</script>";
            }
        }
        else
        {
            echo "<script>alert('Please fill the email field.')</script>";
        }
        //Update into db 
        if(isset($name) && isset($lname) && isset($email) && isset($state) && isset($city) && isset($dob) && isset($contact) && isset($blood))
        {
            $sql = "UPDATE donor SET name='$name',lname='$lname',email='$email',state='$state',city='$city',dob='$dob',contact='$contact',blood='$blood' WHERE id=".$_SESSION['user_id']."";
            if(mysqli_query($connection,$sql))
            {
                echo "<script>alert('Data updated successfully.')</script>";
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
                echo "<script>alert('Failed to update your data try again later.')</script>";
            }
        }
    }

    $sql = "SELECT * FROM donor WHERE id=".$_SESSION['user_id']."";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $userID = $row['id'];
            $name = $row['name'];
            $lname = $row['lname'];
            $email = $row['email'];
            $state = $row['state'];
            $city = $row['city'];
            $dob = $row['dob'];
            $contact = $row['contact'];
            $blood = $row['blood'];
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
<script>
    function remove()
    {
        var a = document.getElementById("state").value;
        if(a==="Andhra Pradesh")
        {
            var array = ["Anantapur","Chittoor","East Godavari","Guntur","Krishna","Kurnool","Prakasam","Srikakulam","SriPotti Sri Ramulu Nellore","Vishakhapatnam","Vizianagaram","West Godavari","Cudappah"]
        }
        else if(a==="Arunachal Pradesh")
        {
            var array = ["Anjaw","Changlang","Dibang Valley","East Siang","East Kameng","Kurung Kumey","Lohit","Longding","Lower Dibang Valley","Lower Subansiri","Papum Pare","Tawang","Tirap","Upper Siang","Upper Subansiri","West Kameng","West Siang"]
        }
        else if(a==="Assam")
        {
            var array = ["Baksa","Barpeta","Bongaigaon","Cachar","Chirang","Darrang","Dhemaji","Dima Hasao","Dhubri","Dibrugarh","Goalpara","Golaghat","Hailakandi","Jorhat","Kamrup","Kamrup Metropolitan","Karbi Anglong","Karimganj","Kokrajhar","Lakhimpur","Morigaon","Nagaon","Nalbari","Sivasagar","Sonitpur","Tinsukia","Udalguri"]
        }
        else if(a==="Bihar")
        {
            var array = ["Araria","Arwal","Aurangabad","Banka","Begusarai","Bhagalpur","Bhojpur","Buxar","Darbhanga","East Champaran","Gaya","Gopalganj","Jamui","Jehanabad","Kaimur","Katihar","Khagaria","Kishanganj","Lakhisarai","Madhepura","Madhubani","Munger","Muzaffarpur","Nalanda","Nawada","Patna","Purnia","Rohtas","Saharsa","Samastipur","Saran","Sheikhpura","Sheohar","Sitamarhi","Siwan","Supaul","Vaishali","West Champaran"]
        }
        else if(a==="Chhattisgarh")
        {
            var array = ["Bastar","Bijapur","Bilaspur","Dantewada","Dhamtari","Durg","Jashpur","Janjgir-Champa","Korba","Koriya","Kanker","Kabirdham (formerly Kawardha)","Mahasamund","Narayanpur","Raigarh","Rajnandgaon","Raipur","Surajpur","Surguja"]
        }
        else if(a==="Dadra and Nagar Haveli")
        {
            var array = ["Amal","Silvassa"]
        }
        else if(a==="Daman and Diu")
        {
            var array = ["Daman and Diu"]
        }
        else if(a==="Delhi")
        {
            var array = ["Delhi","New Delhi","North Delhi","Noida","Patparganj","Sonabarsa","Tughlakabad"]
        }
        else if(a==="Goa")
        {
            var array = ["Chapora","Dabolim","Madgaon","Marmugao (Marmagao)","Panaji Port","Panjim","Pellet Plant Jetty/Shiroda","Talpona","Vasco da Gama"]
        }
        else if(a==="Gujarat")
        {
            var array = ["Ahmedabad","Amreli district","Anand","Aravalli","Banaskantha","Bharuch","Bhavnagar","Dahod","Dang","Gandhinagar","Jamnagar","Junagadh","Kutch","Kheda","Mehsana","Narmada","Navsari","Patan","Panchmahal","Porbandar","Rajkot","Sabarkantha","Surendranagar","Surat","Tapi","Vadodara","Valsad"]
        }
        else if(a==="Haryana")
        {
            var array = ["Ambala","Bhiwani","Faridabad","Fatehabad","Gurgaon","Hissar","Jhajjar","Jind","Karnal","Kaithal","Kurukshetra","Mahendragarh","Mewat","Palwal","Panchkula","Panipat","Rewari","Rohtak","Sirsa","Sonipat","Yamuna Nagar"]
        }
        else if(a==="Himachal Pradesh")
        {
            var array = ["Baddi","Baitalpur","Chamba","Dharamsala","Hamirpur","Kangra","Kinnaur","Kullu","Lahaul & Spiti","Mandi","Simla","Sirmaur","Solan","Una"]
        }
        else if(a==="Jammu and Kashmir")
        {
            var array = ["Jammu","Leh","Rajouri","Srinagar"]
        }
        else if(a==="Jharkhand")
        {
            var array = ["Bokaro","Chatra","Deoghar","Dhanbad","Dumka","East Singhbhum","Garhwa","Giridih","Godda","Gumla","Hazaribag","Jamtara","Khunti","Koderma","Latehar","Lohardaga","Pakur","Palamu","Ramgarh","Ranchi","Sahibganj","Seraikela Kharsawan","Simdega","West Singhbhum"]
        }
        else if(a==="Karnataka")
        {
            var array = ["Bagalkot","Bangalore","Bangalore Urban","Belgaum","Bellary","Bidar","Bijapur","Chamarajnagar","Chikkamagaluru","Chikkaballapur","Chitradurga","Davanagere","Dharwad","Dakshina Kannada","Gadag","Gulbarga","Hassan","Haveri district","Kodagu","Kolar","Koppal","Mandya","Mysore","Raichur","Shimoga","Tumkur","Udupi","Uttara Kannada","Ramanagara","Yadgir"]
        }
        else if(a==="Kerala")
        {
            var array = ["Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thrissur","Thiruvananthapuram","Wayanad"]
        }
        else if(a==="Madhya Pradesh")
        {
            var array = ["Alirajpur","Anuppur","Ashoknagar","Balaghat","Barwani","Betul","Bhilai","Bhind","Bhopal","Burhanpur","Chhatarpur","Chhindwara","Damoh","Dewas","Dhar","Guna","Gwalior","Hoshangabad","Indore","Itarsi","Jabalpur","Khajuraho","Khandwa","Khargone","Malanpur","Malanpuri (Gwalior)","Mandla","Mandsaur","Morena","Narsinghpur","Neemuch","Panna","Pithampur","Raipur","Raisen","Ratlam","Rewa","Sagar","Satna","Sehore","Seoni","Shahdol","Singrauli","Ujjain"]
        }
        else if(a==="Maharastra")
        {
            var array = ["Ahmednagar","Akola","Alibag","Amaravati","Arnala","Aurangabad","Aurangabad","Bandra","Bassain","Belapur","Bhiwandi","Bhusaval","Borliai-Mandla","Chandrapur","Dahanu","Daulatabad","Dighi(Pune)","Dombivali","Goa","Jaitapur","Jalgaon","Jawaharlal Nehru (Nhava Sheva)","Kalyan","Karanja","Kelwa","Khopoli","Kolhapur","Lonavale","Malegaon","Malwan","Manori","Mira Bhayandar","Miraj","Mumbai (ex Bombay)","Murad","Nagapur","Nagpur","Nalasopara","Nanded","Nandgaon","Nasik","Navi Mumbai","Nhave","Osmanabad","Palghar","Panvel","Pimpri","Pune","Ratnagiri","Sholapur","Shrirampur","Shriwardhan","Tarapur","Thana","Thane","Trombay","Varsova","Vengurla","Virar","Wada"]
        }
        else if(a==="Manipur")
        {
            var array = ["Bishnupur","Churachandpur","Chandel","Imphal East","Senapati","Tamenglong","Thoubal","Ukhrul","Imphal West"]
        }
        else if(a==="Meghalaya")
        {
            var array = ["Baghamara","Balet","Barsora","Bolanganj","Dalu","Dawki","Ghasuapara","Mahendraganj","Moreh","Ryngku","Shella Bazar","Shillong"]
        }
        else if(a==="Mizoram")
        {
            var array = ["Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip"]
        }
        else if(a==="Nagaland")
        {
            var array = ["Dimapur","Kiphire","Kohima","Longleng","Mokokchung","Mon","Peren","Phek","Tuensang","Wokha","Zunheboto"]
        }
        else if(a==="Odisha")
        {
            var array = ["Bahabal Pur","Bhubaneswar","Chandbali","Gopalpur","Jeypore","Paradip Garh","Puri","Rourkela"]
        }
        else if(a==="Pondicheery")
        {
            var array = ["Karaikal","Mahe","Pondicherry","Yanam"]
        }
        else if(a==="Punjab")
        {
            var array = ["Amritsar","Barnala","Bathinda","Firozpur","Faridkot","Fatehgarh Sahib","Fazilka","Gurdaspur","Hoshiarpur","Jalandhar","Kapurthala","Ludhiana","Mansa","Moga","Sri Muktsar Sahib","Pathankot","Patiala","Rupnagar","Ajitgarh (Mohali)","Sangrur","Shahid Bhagat Singh Nagar","Tarn Taran"]
        }
        else if(a==="Rajasthan")
        {
            var array = ["Ajmer","Banswara","Barmer","Barmer Rail Station","Basni","Beawar","Bharatpur","Bhilwara","Bhiwadi","Bikaner","Bongaigaon","Boranada Jodhpur","Chittaurgarh","Fazilka","Ganganagar","Jaipur","Jaipur-Kanakpura","Jaipur-Sitapura","Jaisalmer","Jodhpur","Jodhpur-Bhagat Ki Kothi","Jodhpur-Thar","Kardhan","Kota","Munabao Rail Station","Nagaur","Rajsamand","Sawaimadhopur","Shahdol","Shimoga","Tonk","Udaipur"]
        }
        else if(a==="Sikkim")
        {
            var array = ["Chamurci","Gangtok"]
        }
        else if(a==="Tamil Nadu")
        {
            var array = ["Ariyalur","Chennai","Coimbatore","Cuddalore","Dharmapuri","Dindigul","Erode","Kanchipuram","Kanyakumari","Karur","Krishnagiri","Madurai","Mandapam","Nagapattinam","Nilgiris","Namakkal","Perambalur","Pudukkottai","Ramanathapuram","Salem","Sivaganga","Thanjavur","Thiruvallur","Tirupur","Tiruchirapalli","Theni","Tirunelveli","Thanjavur","Thoothukudi","Tiruvallur","Tiruvannamalai","Vellore","Villupuram","Viruthunagar"]
        }
        else if(a==="Telangana")
        {
            var array = ["Adilabad","Hyderabad","Karimnagar","Mahbubnagar","Medak","Nalgonda","Nizamabad","Ranga Reddy","Warangal"]
        }
        else if(a==="Tripura")
        {
            var array = ["Agartala","Dhalaighat","Kailashahar","Kamalpur","Kanchanpur","Kel Sahar Subdivision","Khowai","Khowaighat","Mahurighat","Old Raghna Bazar","Sabroom","Srimantapur"]
        }
        else if(a==="Uttar Pradesh")
        {
            var array = ["Agra","Allahabad","Auraiya","Banbasa","Bareilly","Berhni","Bhadohi","Dadri","Dharchula","Gandhar","Gauriphanta","Ghaziabad","Gorakhpur","Gunji","Jarwa","Jhulaghat (Pithoragarh)","Kanpur","Katarniyaghat","Khunwa","Loni","Lucknow","Meerut","Moradabad","Muzaffarnagar","Nepalgunj Road","Pakwara (Moradabad)","Pantnagar","Saharanpur","Sonauli","Surajpur","Tikonia","Varanasi"]
        }
        else if(a==="Uttarakhand")
        {
            var array = ["Almora","Badrinath","Bangla","Barkot","Bazpur","Chamoli","Chopra","Dehra Dun","Dwarahat","Garhwal","Haldwani","Hardwar","Haridwar","Jamal","Jwalapur","Kalsi","Kashipur","Mall","Mussoorie","Nahar","Naini","Pantnagar","Pauri","Pithoragarh","Rameshwar","Rishikesh","Rohni","Roorkee","Sama","Saur"]
        }
        else if(a==="West Bengal")
        {
            var array = ["Alipurduar","Bankura","Bardhaman","Birbhum","Cooch Behar","Dakshin Dinajpur","Darjeeling","Hooghly","Howrah","Jalpaiguri","Kolkata","Maldah","Murshidabad","Nadia","North 24 Parganas","Paschim Medinipur","Purba Medinipur","Purulia","South 24 Parganas","Uttar Dinajpur"]
        }
        var String = "" ;
        for(i=0;i<array.length;i++)
        {
            String=String+"<option value=" + array[i] + ">" + array[i] + "</option>";
        }
        document.getElementById("city").innerHTML=String;
    }
    </script>
<div class="container" style="padding: 60px 160px;">
    <div class="row">
        <div class="col-md-12 col-md-push-1">
            <div class="panel panel-default" style="padding: 20px;">
                <div class="panel-body">
                    <center><h2>Update your info</h2></center>
                       <form method="post">
                          <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter First name" value="<?php if(isset($name)) echo $name; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last name" value="<?php if(isset($name)) echo $lname; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php if(isset($email)) echo $email; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter Contact" value="<?php if(isset($email)) echo $contact; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="blood">Blood Group</label><br>
                            <select class="form-control demo-default" id="blood_group" name="blood_group" required>
                            <option value="<?php if(isset($blood)) echo $blood; ?>">---Select Your Blood Group---</option>
                                <?php if(isset($blood)) echo '<option selected="" value="'.$blood.'">'.$blood.'</option>'; ?>
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
                          <div class="form-group">
                            <label for="dob">DOB</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php if(isset($dob)) echo $dob; ?>" required>
                          </div>
                          <div class="form-group">
                          <label for="state">State</label>
                            <select name="state" id="state" class="form-control demo-default" onchange="remove()" required>
                                <?php if(isset($state)) echo '<option selected="" value="'.$state.'">'.$state.'</option>'; ?>
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
                             <label for="city">City</label>
                             <select id="city" onchange="remove" class="form-control demo-default" name="city" required> 
                             <option value=""></option>
                             <?php if(isset($city)) echo '<option selected="" value="'.$city.'">'.$city.'</option>'; ?>
                             </select>
                          </div>
                          <center><button type="submit" class="btn btn-success" name="submit">Update</button></center><br>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>