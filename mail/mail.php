<?php 
if(isset($_POST['submit'])){
$header = "New account";
  if(mail('ituaosemeilu234@gmail.com','this is the subject','this is the body',$header)){
    echo "mail sent";
  }else{
    echo "mail not sent";
  }
}

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<form method="post">
  <input type="text" name="">
  <input type="submit" name="submit">
</form>
</body>
</html>