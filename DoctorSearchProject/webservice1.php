<?php

$search_param = $_POST["search"];
$search_area = $_POST["area"];

if(isset($_POST["search"]) && isset($_POST["area"])){

// Connect to Database
$host = "localhost";
$dbname = "id20939961_doctor";
$dbuser = "id20939961_khalid_doctor";
$dbpass = "Doctor123+";

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

//check connection
if(!$conn){
  die("Connection Failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM 'Doctors' where DoctorArea like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

$result = $conn->query($sql);


if($result->num_rows > 0){
    
    $data = '<div class="lbltitlesection3">Doctors Found in your Area</div>';
    $doctor_data = "";

    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorimage = $row["DoctorImage"];

        $doctor_data = $doctor_data.' <div class="searchsection" id="searchSection">
        <div class="searchbox">
          <div class="searchbg"></div>
          <img class="searchicon1" alt="" src="'.$doctorimage.'" />
        </div>
        <b class="titlesearch">'.$doctorname.'</b>
        <div class="descsearch">
          '.$doctorinfo.'
        </div>
      </div>';

    }
   
}
else{
    $data = '<div class="lbltitlesection3">No Doctor Found in your Area</div>'; 
}

}else{
    $data = '<div class="lbltitlesection3">Bad Query</div>';
}

$data = $data.$doctor_data;
echo $data;

?>