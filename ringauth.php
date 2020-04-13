<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ( isset( $_POST['email'] ) ) {

// retrieve the form data by using the element's name attributes value as key


$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

if ( empty( $_REQUEST['twofa'] ) ) {
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://oauth.ring.com/oauth/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n    \"client_id\": \"ring_official_android\",\n    \"grant_type\": \"password\",\n    \"password\": \"" . $password . "\",\n    \"scope\": \"client\",\n    \"username\": \"" . $email . "\"\n\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Postman-Token: 3efec26d-cdaa-4ce6-96f6-cf84d618ec68",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
 // echo $response;
}


$obj = json_decode($response);
//echo $response;
$nexttime = $obj->{'next_time_in_secs'};

}

if ( isset( $_REQUEST['twofa'] ) ) {
$twofa = $_REQUEST['twofa'];

$curl1 = curl_init();
$twofajson = "2fa-code: " . $twofa;
//echo $twofajson;
curl_setopt_array($curl1, array(
  CURLOPT_URL => "https://oauth.ring.com/oauth/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n    \"client_id\": \"ring_official_android\",\n    \"grant_type\": \"password\",\n    \"password\": \"" . $password . "\",\n    \"scope\": \"client\",\n    \"username\": \"" . $email . "\"\n\n}",
  CURLOPT_HTTPHEADER => array(
    $twofajson ,
    "2fa-support: true",
    "Content-Type: application/json",
    "Postman-Token: 3efec26d-cdaa-4ce6-96f6-cf84d618ec68",
    "cache-control: no-cache"
  ),
));

$response1 = curl_exec($curl1);
$err1 = curl_error($curl1);

curl_close($curl1);

if ($err1) {
  echo "cURL Error #:" . $err1;
} else {
//  echo $response1;
}
$obj = json_decode($response1);
//$nexttime = $obj->{'next_time_in_secs'};
}



if (isset($obj->{'refresh_token'})) {
$curl5 = curl_init();

curl_setopt_array($curl5, array(
  CURLOPT_URL => "https://api.ring.com/clients_api/ring_devices?api_version=9",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer " . $obj->{'access_token'},
    "cache-control: no-cache"
  ),
));

$response5 = curl_exec($curl5);
$err5 = curl_error($curl5);

curl_close($curl5);

if ($err5) {
  echo "cURL Error #:" . $err5;
} else {
$obj5 = json_decode($response5);
$stickupcams = $obj5->stickup_cams;




//  echo $response5;
}

}




}

?>

<html>
<body>
<form action="ringauth.php" method="post">
  <fieldset>
    <legend>Enter Ring credentials</legend>
    Ring Username (Email): <input type="email" name="email"<?php if (isset($email)){ echo '  value = "' . $email . '"';} ?>>
    <br>
    Ring Password: <input type="password" name="password"<?php if (isset($password)){ echo '  value = "' . $password . '"';} ?>>
    <br>

    <?php 
    if (isset($nexttime)) {
    echo 'Ring 2FA Code <input type="text" id="twofa" name="twofa"> <br>';} ?>
    <button>submit</button>
  </fieldset>
</form>
<h3> <?php 
    if (isset($obj->{'refresh_token'})) {
    echo "Refresh Token: " . $obj->{'refresh_token'} . " \n <br> \nAccess Token: " . $obj->{'access_token'} . "\n <br> <br>"; 
    echo '<table style="width:100%">'; 
 echo "<tr> \n <td>Description</td> \n<td>Device ID</td> \n</tr>\n";
 foreach($stickupcams as $stickupcam){
echo  "<tr> \n <td>" . $stickupcam->description . "</td> \n<td>" . $stickupcam->id . "</td> \n</tr>\n";
}
  echo "</table>";
  }?>


  </h2>
</body>
</html>