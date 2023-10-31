<?php
include("../config.php");
require_once './vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);

$sections = "SELECT * FROM `section` ORDER BY `name` ASC";
$sectionResult = $conn->query($sections);
$sectionRow = mysqli_fetch_assoc($sectionResult);
while ($sectionRow = mysqli_fetch_assoc($sectionResult)) {
  $trackContent = ($sectionRow["track"] === "Academic") ? $sectionRow["track"] . " - " .  $sectionRow["strand"] : $sectionRow["track"];
  $tvl = ($sectionRow["track"] === "Academic") ? "" : $sectionRow["strand"];
  $html =
    '
  <style>
      * {
        font-family: Arial, Helvetica, sans-serif;
       }
  </style>
       <img src="sf_logo.gif" style="height: 88px; Width:85px; margin-top:-27px; margin-left:-23px;">
       <h1 style="font-size: 15.2pt; text-align: center; margin-top:-84px; margin-left: 10px;">
       School Form 1 School Register for Senior High School (SF1-SHS)
       </h1>
       <img src="sf_logo2.png" alt="" style="Height: 43px; Width:57; margin-top: -93px;margin-bottom: 5px; margin-left: 973px">
       
       <div class="School Name">
        <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top:-43px; margin-left: 78px; " > School Name </p> 
       </div>
       <div >
        <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 188px; text-align:center; font-size: 6pt; margin-top: -47px; margin-left: 127px; border: 1px solid black;" >Tagaytay National High School - Integrated</p> 
       </div>
       <div class="Semester">
       <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top: -21px; margin-left: 86px; " > Semester </p> 
      </div>
      <div >
       <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 188px; text-align:center; font-size: 6pt; margin-top: -25px; margin-left: 127px; border: 1px solid black;" >' . $sectionRow['semester_name'] . '</p> 
      </div>

      <div class="School ID">
        <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top:-45px; margin-left: 345px; " > School ID </p> 
      </div>
      <div >
        <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 83px; text-align:center; font-size: 6pt; margin-top: -49px; margin-left: 389px; border: 1px solid black;" >301216</p> 
      </div>
      <div class="School Year">
      <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top: -23px; margin-left: 345px; " > School Year </p> 
     </div>
     <div >
      <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 83px; text-align:center; font-size: 6pt; margin-top: -27px; margin-left: 389px; border: 1px solid black;" >' . $sectionRow['start_year'] . ' - ' . $sectionRow['end_year'] . '</p> 
     </div>
      <div class="District">
        <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top:-45px; margin-left: 492px; " > District </p> 
      </div>
      <div >
        <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 138px; text-align:center; font-size: 6pt; margin-top: -49px; margin-left: 517px; border: 1px solid black;" >Tagaytay City</p> 
      </div>
      <div  class="Grade Level">
      <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top: -23px; margin-left: 496px; " >Grade Level</p> 
     </div>
     <div >
      <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 115px; text-align:center; font-size: 6pt; margin-top: -27px; margin-left: 540px; border: 1px solid black;" >' . $sectionRow['grade'] . '</p> 
     </div>
      <div class="Division">
        <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top:-45px; margin-left: 690px; " > Division </p> 
      </div>
      <div >
        <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 128px; text-align:center; font-size: 6pt; margin-top: -49px; margin-left: 720px; border: 1px solid black;" >Cavite</p> 
      </div>
      <div  class="Track and Strand">
      <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top: -18px; margin-left: 692px; " >Track and Strand</p> 
      </div>    
     <div>
     <p style="padding-top:3px; padding-bottom:2px; height:12px; width:250px; text-align:center; font-size:6pt; margin-top: -23px; margin-left:755px; border:1px solid black;">' . $trackContent . '</p> 
     </div>
      <div class="Region">
        <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top:-48px; margin-left: 866px; " > Region </p> 
      </div>
      <div >
        <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 113px; text-align:center; font-size: 6pt; margin-top: -53px; margin-left:892px; border: 1px solid black;" >Region IV-A</p> 
      </div>
      <table style="border: 0px;">
      <div class="Section">
      <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top: -3px; margin-left: 100px; " > Section </p> 
     </div>
     <div >
      <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 188px; text-align:center; font-size: 6pt; margin-top: -24px; margin-left: 127px; border: 1px solid black;" >' . $sectionRow['name'] . '</p> 
     </div>
      </style>
     <div class="Course (for TVL only)">
     <p style=" Height: 12px; width: 150px; font-size: 6pt; margin-top: -23px; margin-left: 334px; " > Course (for TVL only) </p> 
    </div>
    <div >
     <p style=" padding-top:3px; padding-bottom:2px; Height: 12px; width: 235px; text-align:center; font-size: 6pt; margin-top: -27px; margin-left: 420px; border: 1px solid black;" >' . $tvl . '</p> 
    </div>

    </table>

      ';
}
$html .= '

        <table  style=" margin-left: -25px; font-size: 5pt; margin-top: -9px;">
  
        <style>
        *{
          font-family: Arial, Helvetica, sans-serif;
        }
    table, td, th {
      border-collapse: collapse;
      border: 1px solid black;
      }
    
    td{  height: 20px;
    }
  
      </style>
        <tr >

          <th  rowspan =  "2">LRN</th>
          <th  rowspan =  "2">NAME <br> (Last Name, First Name, Name Extension, Middle Name)</th>
          <th rowspan =  "2"
        <div style="   margin-top: -1px; margin-left: 0px;  border: 0px solid black; font-weight: bold; font-size: 4pt; transform: rotate(450deg); transform-origin: 50%; width: 100%; "> 
             S
        </div>
        <div style=" margin-top: -1.5px;margin-left: 0px;  border: 0px solid black; font-weight: bold; font-size: 4pt; transform: rotate(450deg); transform-origin: 50%; width: 100%; "> 
          ex
        </div>
        <div style="margin-top: 1px;  margin-left: 0px;  border: 0px solid black; font-weight: bold; font-size: 4pt; transform: rotate(450deg); transform-origin: 50%; width: 100%; "> 
          (M
       </div>

       <div style=" margin-left: 0px;  border: 0px solid black; font-weight: bold; font-size: 4pt; transform: rotate(450deg); transform-origin: 50%; width: 100%; "> 
       /F)
      </div>
        </th>        
          <th  rowspan =  "2">BIRTH DATE <br> (mm/dd/yyyy) </th>
          <th style=" font-size: 5pt;"rowspan =  "2">AGE as of octob er 31st</th>
          <th rowspan =  "2">Religious Affiliation</th>
          <th style="height: 1%;" colspan= "4">COMPLETE ADDRESS </th>
          <th style="height: 1%;" colspan= "2">PARENTS</th>
          <th style="height: 1%;" colspan= "2">GUARDIAN <br>  (if learner is not Living with parent)</th>
          <th rowspan =  "2">Contact Number of Parent or Guardian</th>
          <th rowspan =  "2">Learning Modality</th>
          <th colspan= "1">REMARKS</th>
        </tr>
        <tr style="font-size: 5pt;  font-weight: bold;  text-align : center;">
          <td style=" height: 9px;">House #/ Street/ Sitio/ Purok</td>
          <td style=" height: 9px;">Barangay</td>
          <td style=" height: 9px;">Municipality/ City</td>
          <td style=" height: 9px;">Province</td>
          <td style=" height: 9px;">Father&rsquo;s Name (Last Name, First Name, Middle name)</td>
          <td style=" height: 9px;">Mother&rsquo;s Maiden Name (Last Name, First Name, Middle name)</td>
          <td style=" height: 9px;">Name <br> (Last Name, First <br> Name, Name <br> Extension, Middle</td>
          <td style=" height: 9px;">Relationship</td>
          <td style=" height: 9px; font-size: 3.5pt; text-align : center;">(Please refer to the legend on the last page)</td>
        </tr>
       ';
//MALE TABLE
$maleStudents = "SELECT *  FROM student WHERE sex = 'M' ORDER BY name ASC";
$maleStudentResult = mysqli_query($conn, $maleStudents);
$maleStudentCount = mysqli_num_rows($maleStudentResult);
if ($maleStudentCount === 0) {
  $html .=
    '
                <tr style="font-size: 5.5pt; "> 
                  <td style= " width:59px; vertical-align: middle; text-align: center;" ></td>
                  <td style= " width:215px; vertical-align: middle; text-align: center; "></td>
                  <td style="width: 10px;  text-align: center; vertical-align: middle; text-align: center; "></td>
                  <td style="width:57px;  text-align: right; vertical-align: middle; text-align: center; "></td>
                  <td style="width:19px; text-align: center; vertical-align: middle; text-align: center;  "></td>
                  <td style="width:78px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:79px; vertical-align: middle; text-align: center;  "></td>
                  <td style="width:41px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:53px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:46px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:69px ; vertical-align: middle; text-align: center; "></td>
                  <td style="width:58px;   vertical-align: middle; text-align: center; "></td>
                  <td style="width:63px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:46px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:34px;  vertical-align: middle; text-align: center; font-size: 5pt;"></td>
                  <td style="width:44px;  vertical-align: middle; text-align: center;"></td>
                  <td style= " width:66px; vertical-align: middle; text-align: center;"></td>
                </tr>
                <tr> 
                  <td  style="height: 17px; width: 54px; text-align: right;">' . $maleStudentCount . '</td>
                  <td  colspan="16"style=" height: 17px; width: 942px; text-align: left;">&lt;=== TOTAL MALE </td>
                </tr>
                ';
} else {
  foreach ($maleStudentResult as $male) {
    $html .=
      '
                  <tr style="font-size: 5.5pt; "> 
                    <td style= " width:59px; vertical-align: middle; text-align: center;" >' . $male['lrn'] . '</td>
                    <td style= " width:215px; vertical-align: middle; text-align: center; ">' . $male['name'] . '</td>
                    <td style="width: 10px;  text-align: center; vertical-align: middle; text-align: center; ">' . $male['sex'] . '</td>
                    <td style="width:57px;  text-align: right; vertical-align: middle; text-align: center; ">' . $male['birth_date'] . '</td>
                    <td style="width:19px; text-align: center; vertical-align: middle; text-align: center;  ">' . $male['age'] . '</td>
                    <td style="width:78px;  vertical-align: middle; text-align: center; ">' . $male['ra'] . '</td>
                    <td style="width:79px; vertical-align: middle; text-align: center;  ">' . $male['house_no'] . '</td>
                    <td style="width:41px;  vertical-align: middle; text-align: center; ">' . $male['barangay'] . '</td>
                    <td style="width:53px;  vertical-align: middle; text-align: center; ">' . $male['municipality'] . '</td>
                    <td style="width:46px;  vertical-align: middle; text-align: center; ">' . $male['province'] . '</td>
                    <td style="width:69px ; vertical-align: middle; text-align: center; ">' . $male['father'] . '</td>
                    <td style="width:58px;   vertical-align: middle; text-align: center; ">' . $male['mother'] . '</td>
                    <td style="width:63px;  vertical-align: middle; text-align: center; ">' . $male['guardian'] . '</td>
                    <td style="width:46px;  vertical-align: middle; text-align: center; ">' . $male['relationship'] . '</td>
                    <td style="width:34px;  vertical-align: middle; text-align: center; font-size: 5pt; padding: 0px 2px 0px 2px;">' . $male['contact'] . '</td>
                    <td style="width:44px;  vertical-align: middle; text-align: center;">' . $male['lm'] . '</td>
                    <td style= " width:66px; vertical-align: middle; text-align: center;">' . $male['indicator'] . " " . $male['ri'] . '</td>
                  </tr>
                  ';
  }
  $html .= '
          <tr> 
           <td  style="height: 17px; width: 54px; text-align: right;">' . $maleStudentCount . '</td>
           <td  colspan="16"style=" height: 17px; width: 942px; text-align: left;">&lt;=== TOTAL MALE </td>
          </tr>
              ';
}

//FEMALE TABLE
$femaleStudents = "SELECT *  FROM student WHERE sex = 'F' ORDER BY name ASC";
$femaleStudentResult = mysqli_query($conn, $femaleStudents);
$femaleStudentCount = mysqli_num_rows($femaleStudentResult);
if ($femaleStudentCount === 0) {
  $html .=
    '
                <tr style="font-size: 5.5pt; "> 
                  <td style= " width:59px; vertical-align: middle; text-align: center;" ></td>
                  <td style= " width:215px; vertical-align: middle; text-align: center; "></td>
                  <td style="width: 10px;  text-align: center; vertical-align: middle; text-align: center; "></td>
                  <td style="width:57px;  text-align: right; vertical-align: middle; text-align: center; "></td>
                  <td style="width:19px; text-align: center; vertical-align: middle; text-align: center;  "></td>
                  <td style="width:78px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:79px; vertical-align: middle; text-align: center;  "></td>
                  <td style="width:41px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:53px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:46px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:69px ; vertical-align: middle; text-align: center; "></td>
                  <td style="width:58px;   vertical-align: middle; text-align: center; "></td>
                  <td style="width:63px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:46px;  vertical-align: middle; text-align: center; "></td>
                  <td style="width:34px;  vertical-align: middle; text-align: center; font-size: 5pt;"></td>
                  <td style="width:44px;  vertical-align: middle; text-align: center;"></td>
                  <td style= " width:66px; vertical-align: middle; text-align: center;"></td>
                </tr>
                <tr> 
                  <td  style="height: 17px; width: 54px; text-align: right;">' . $femaleStudentCount . '</td>
                  <td  colspan="16"style=" height: 17px; width: 942px; text-align: left;">&lt;=== TOTAL FEMALE </td>
                </tr>
                ';
} else {
  foreach ($femaleStudentResult as $female) {
    $html .=
      '
                  <tr style="font-size: 5.5pt; "> 
                    <td style= " width:59px; vertical-align: middle; text-align: center;" >' . $female['lrn'] . '</td>
                    <td style= " width:215px; vertical-align: middle; text-align: center; ">' . $female['name'] . '</td>
                    <td style="width: 10px;  text-align: center; vertical-align: middle; text-align: center; ">' . $female['sex'] . '</td>
                    <td style="width:57px;  text-align: right; vertical-align: middle; text-align: center; ">' . $female['birth_date'] . '</td>
                    <td style="width:19px; text-align: center; vertical-align: middle; text-align: center;  ">' . $female['age'] . '</td>
                    <td style="width:78px;  vertical-align: middle; text-align: center; ">' . $female['ra'] . '</td>
                    <td style="width:79px; vertical-align: middle; text-align: center;  ">' . $female['house_no'] . '</td>
                    <td style="width:41px;  vertical-align: middle; text-align: center; ">' . $female['barangay'] . '</td>
                    <td style="width:53px;  vertical-align: middle; text-align: center; ">' . $female['municipality'] . '</td>
                    <td style="width:46px;  vertical-align: middle; text-align: center; ">' . $female['province'] . '</td>
                    <td style="width:69px ; vertical-align: middle; text-align: center; ">' . $female['father'] . '</td>
                    <td style="width:58px;   vertical-align: middle; text-align: center; ">' . $female['mother'] . '</td>
                    <td style="width:63px;  vertical-align: middle; text-align: center; ">' . $female['guardian'] . '</td>
                    <td style="width:46px;  vertical-align: middle; text-align: center; ">' . $female['relationship'] . '</td>
                    <td style="width:34px;  vertical-align: middle; text-align: center; font-size: 5pt;">' . $female['contact'] . '</td>
                    <td style="width:44px;  vertical-align: middle; text-align: center;">' . $female['lm'] . '</td>
                    <td style= " width:66px; vertical-align: middle; text-align: center;">' . $female['indicator'] . " " . $female['ri'] . '</td>
                  </tr>
                  ';
  }
  $html .= '
          <tr> 
           <td  style="height: 17px; width: 54px; text-align: right;">' . $femaleStudentCount . '</td>
           <td  colspan="16"style=" height: 17px; width: 942px; text-align: left;">&lt;=== TOTAL FEMALE </td>
          </tr>
              ';
}
//TOTAL COUNT OF STUDENTS COMBINED
$totalCountOfStudents = $maleStudentCount + $femaleStudentCount;

$html .= '
          <tr> 
          <td style="margin-left: -25px;  font-size: 5pt;  margin-top: -1px; height: 17px;  width: 54px; text-align: right;">' . $totalCountOfStudents . '</td>
          <td colspan="16" style="font-size: 5pt;  margin-top: -1px; height: 17px; width: 942px; text-align: left;">&lt;=== COMBINED </td>
          </tr>
        </table>
';

$html .= '
   <p style=" font-weight: bold; width: 300px; font-size: 6pt; margin-top: 0px; margin-left: -23px; text-align: left; " >Legend: List and Code of Indicators under REMARKS column</p> 

<table style="margin-top: -6px; font-size: 4.5pt; margin-left: -25px; ">
 <tr style=" font-weight: bold;"> 
   <td style=" height: 22px; width:60px; text-align: left;">Indicator</td>
   <td style=" width: 24px; text-align: center;">Code </td>
   <td style=" width:  155px; text-align: left;">Required Information </td>
   <td style=" height: 22px; width: 60px; text-align: left;">Indicator</td>
   <td style=" width: 25px; text-align: center;">Code </td>
   <td style=" width:  155px; text-align: left;">Required Information </td>
 </tr>
 <tr style=" font-weight: bold;"> 
   <td style=" height: 22px; width: 54px; text-align: left; vertical-align: top;">Transfered out  <br> <br> <br> <br> Transfered Out</td>
   <td style=" width: 22px; text-align: center; vertical-align: top;" >T/O  <br> <br> <br> <br> T/I </td>
   <td style=" width:  137px; text-align: left; vertical-align: top;"> <br> <br> Name of School, Date of 1st Attendance and <br> Date of last attendance if Transferred out</td>
   <td style=" height: 60px; width: 60px; text-align: left; vertical-align: top;">CCT Receipient <br> <br> Balik Aral <br> <br> Learner With <br> Exceptionality <br> Accelerated</td>
   <td style=" width: 22px; text-align: center; vertical-align: top; ">CCT <br> <br> B/A <br> <br> LWE <br> <br> ACL</td>
   <td style=" width:  137px; text-align: left; vertical-align: top;">CCT Control number & <br> Effectivity Date<br>Name of school last attnded & Year <br> <br> Specify Extentionality of the Learner <br> <br> Specify Level & Effectivity Date</td>
 </tr>



   </table>
   <table style="margin-top: -100px; font-size: 5pt; margin-left: 480px; ">
 <tr style=" font-weight: bold;"> 
   <td style=" height: 22px; width: 41px; text-align: center;">REGISTERED</td>
   <td style=" height: 22px; width: 65px; text-align: center;">Beginning of the <br> Semester </td>
   <td style=" height: 22px; width:  47px; text-align: center;">End of the <br> Semester </td>
 </tr>
 <tr style=" font-weight: bold;"> 
   <td style=" height: 18px; width: 39px; text-align: center;">MALE</td>
   <td style=" height: 18px; width: 59px; text-align: center;">' . $maleStudentCount . '</td>
   <td style=" height: 18px; width:  42px; text-align: center;">' . $maleStudentCount . '</td>
 </tr>
 <tr style=" font-weight: bold;"> 
   <td style=" height: 18px; width: 39px; text-align: center;">FEMALE</td>
   <td style=" height: 18px; width: 59px; text-align: center;">' . $femaleStudentCount . '</td>
   <td style=" height: 18px; width:  42px; text-align: center;">' . $femaleStudentCount . '</td>
 </tr>
 <tr style=" font-weight: bold;"> 
   <td style=" height: 18px; width: 39px; text-align: center;">TOTAL</td>
   <td style=" height: 18px; width: 59px; text-align: center;">' . $totalCountOfStudents . '</td>
   <td style=" height: 18px; width:  42px; text-align: center;">' . $totalCountOfStudents . '</td>
 </tr>

 </table>
 ';
$sections = "SELECT * FROM `section` ORDER BY `name` ASC";
$sectionResult = $conn->query($sections);
$sectionRow = mysqli_fetch_assoc($sectionResult);

$html .= '
 <table style="margin-top: -100px; font-size: 5pt; margin-left: 715px; border : 0px;">
 <tr style=" font-weight: bold;"> 
   <td style=" height: 10px; width: 325px; text-align: top; vertical-align: top; border : 0;">Prepared by:</td>
  </tr>
 <tr style=" font-weight: bold;"> 
   <td style=" height: 10px; width: 325px; text-align: top; vertical-align: top; border : 0; border-bottom: 1px solid black; text-align: center;">' . $sectionRow['faculty'] . ' </td>
  </tr>
 <tr style=" font-weight: bold;"> 
 <td style=" height: 20px; width: 40px; text-align: center; vertical-align: top; border: 0px;"><br> (Signature of Adviser over Printed Name)  </td>
 </tr>
 </table>

 <table style="margin-top: 6px; font-size: 5pt; margin-left: 715px; border : 0px;">
 <tr style=" font-weight: bold;"> 
 <td style="  height: 20px; width: 205px; text-align: left; vertical-align: top; border: 0px;">Beginning of the Semester Date:</td>
 <td style="  height: 20px; width: 150px; text-align: left; vertical-align: top; border: 0px; "> End of the Semester Date:</td>
 </table>

 <table style="margin-top: -6px; font-size: 5pt; margin-left: 715px; border : 0px;">
 <tr style=" border : 1px solid black;"> 
 <td style=" height: 18px; width: 105px; text-align: left;  border: 0px;">' . $sectionRow['start_year'] . ' AM</td>
 </table>
 <table style="margin-top: -25px; font-size: 5pt; margin-left: 922px; border : 0px;">
 </tr>
 <tr style=" border : 1px solid black;"> 
 <td style=" height: 18px; width: 105px; text-align: left;  border: 0px;">' . $sectionRow['end_year'] . ' AM</td>
 </tr>
</table>
 ';



$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream('my. pdf', array('Attachment' => 0));
