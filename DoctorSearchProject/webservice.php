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

$sql = "SELECT * from 'Doctors' where DoctorArea like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorimage = $row["Doctorimage"];

        $doctor_data["DocName"] = $doctorname;
        $doctor_data["DocInfo"] = $doctorinfo;
        $doctor_data["DocImage"] = $doctorimage;

        $data[$doctorid] = $doctor_data;
    }

    $data["Result"] = "True";
    $data["Message"] = "Doctors Fetched Successfully";
}
else{

    $data["Result"] = "False";
    $data["Message"] = "No doctors Found";
}

}else{

    $data["Result"] = "False";
    $data["Message"] = "Bad Query";
}

// Sending Response back to the Request
echo json_encode($data, JSON_UNESCAPED_SLASHES);

?>