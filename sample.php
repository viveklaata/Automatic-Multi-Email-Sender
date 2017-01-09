
<html>
<body>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<form>
  <div class="form-group">
    <label for="formGroupExampleInput">Receiver E-Mail Id</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Subject</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
  </div>
</form>
<button type="button" class="btn btn-success">Success</button>

<?php
require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'ssl://smtp.gmail.com';                 // Specify main and backup server             
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'ug201310041@iitj.ac.in';                // SMTP username
$mail->Password = '185230100';                  // SMTP password
$mail->SMTPSecure = 'ssl'; 
$mail->Port = 465;                             // Enable encryption, 'ssl' also accepted
$mail->From = 'ug201310041@iitj.ac.in';
$mail->FromName = 'Vivek';
$mail->AddAddress('ug201312015@iitj.ac.in');  // Add a recipient
//$mail->AddAddress('ellen@example.com');               // Name is optional

$mail->IsHTML(true);                                  // Set email format to HTML
$mail->addAttachment('iitj.png');
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <strong>in bold!</strong>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//echo "string";
/*if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}*/

echo 'Message has been sent';
?>
</body>
</html>