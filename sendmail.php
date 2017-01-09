
<?php
//  Include PHPExcel_IOFactory
include 'PHPExcel/Classes/PHPExcel/IOFactory.php';
require_once('phpmailer/PHPMailerAutoload.php');
$inputFileName = 'data.xls';

//sender
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
//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
    echo $rowData[0][0];
    $mail->AddAddress(trim($rowData[0][0]));
    $mail->IsHTML(FALSE);                                  // Set email format to HTML
    $mail->addAttachment('resume.pdf');
    $mail->Subject = $rowData[0][1];
    //$mail->Body    = 'html';
    $mail->Body = "Dear ".$rowData[0][4].",

I'm Vivek Lata, a final year undergraduate, currently pursuing my B.tech degree at IIT Jodhpur in Computer Science. Currently, my CGPA is 7.71 on the scale of 10. I have good knowledge of programming languages like C, C++, Java and Python.I also have good knowledge of data structure and algorithms.I have done summer internship from National Stock Exchange(IT) in mobile application development, where I designed design Ajax Requests to retrieve data from web services.  Parallelly with this project, I also worked on parsing and retrieving XML data, provided by SOAP APIs. 

I have also done algorithm design and analysis course, in which we have learned optimization problem solving under given constraints using linear programming.I have also learned various types of process scheduling in the course operating systems. So I have fundamental knowledge in the given field, and I would be a great fit for the job and the company.

As a motivated computer Science Student, the opportunity to work as an ".$rowData[0][2]." Position at Optym interests me greatly. I’ve attached a copy of my resume that details my projects and experience. Should you need any more details, please do let me know.
Thank you for your time and consideration. I look forward to speaking with you about this opportunity.

Sincerely,
Vivek Lata
Final year undergraduate
Computer Science, IIT Jodhpur

Email: ug201310041@iitj.ac.in
Contact No : +91-9413316701';";

   if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
   echo "message sent";
}
$mail->clearAddresses();
    //echo $rowData[0][0];
}
    //  Insert row data array into database here using your own structure