<?php
function load($page = "useraccess.php") {
  $url = "http://".$_SERVER["HTTP_HOST"];
  // $url = rtrim($url, "/\\");
  $url .= "/".$page;

  header("Location: $url");

  exit();
}

function validate($connection, $EMAIL="", $PASS="") {
  $email = mysqli_real_escape_string($connection, trim($EMAIL));
  $password = mysqli_real_escape_string($connection, trim($PASS));

  //check email
  $loginCheckEmailQuery = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query($connection, $loginCheckEmailQuery);
  if (mysqli_num_rows($result) == 1) {

    //check password
    $loginCheckPassQuery = "SELECT * FROM user WHERE email='$email' AND password=md5('$password')";
    $result2 = mysqli_query($connection, $loginCheckPassQuery);
    if (mysqli_num_rows($result2) == 1) {

      $userdata = mysqli_fetch_array($result2);
      return array(true, $userdata);

    } else {

      $operationDescLogin[] = "Password incorrect.";

    }

  } else {

    $operationDescLogin[] = "Email address not found";

  }

  return array(false, $operationDescLogin);

}
?>
