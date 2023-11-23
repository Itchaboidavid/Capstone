<?php
//SF 9 BACK
include("../config.php");
require_once './vendor/autoload.php';
session_start();

use Dompdf\Dompdf;
use Dompdf\Options;

$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);

$id = $_GET['id'];
$select = "SELECT *  FROM `student` WHERE `id` = '$id'";
$result = mysqli_query($conn, $select);
$row = $result->fetch_assoc();
$student = $row['name'];


//SF9 FRONT
$html = '

<style>
table{
    border-collapse: collapse;
}

*{
    font-family: Arial, Helvetica, sans-serif;
  }
</style>

<p style=" font-size: 13.5px;margin-left: 97px; margin-top: -7px; font-weight:bold;"> REPORT ON ATTENDANCE</p>
<div><p style=" font-size: 12px;margin-left: 452px; margin-top: -30px; font-weight:bold;">SF9-SHS</p></div>

<table style="margin-left: -24px; margin-top: 19px; ">
     <tr style="font-size: 8.5pt; text-align:center; ">
        <td style="border-collapse: collapse; border: 1px solid black;Height:15px; "> </td>
        <td style="  border: 1px solid black;" > Aug</td>
        <td style="  border: 1px solid black;" > Sept</td>
        <td style="  border: 1px solid black;" > Oct</td>
        <td style="  border: 1px solid black;" > Nov</td>
        <td style="  border: 1px solid black;" > Dec</td>
        <td style="  border: 1px solid black;" > Jan</td>
        <td style="  border: 1px solid black;" > Feb</td>
        <td style="  border: 1px solid black;" > Mar</td>
        <td style="  border: 1px solid black;" > Apr</td>
        <td style="  border: 1px solid black;" > May</td>
        <td style="  border: 1px solid black;" > Jun</td>
        <td style="  border: 1px solid black;" > Jul</td>
        <td style="  border: 1px solid black;"> Total</td>
    </tr>   

<tr style="font-size: 10pt; text-align:center;">
    <td style="width: 79px; height:29px; border-collapse: collapse; border: 1px solid black;" "></td>
    <td style="width: 27px;  border: 1px solid black; "> 1</td>
    <td style="width: 28px;  border: 1px solid black; " > 2 </td>
    <td style="width: 27px;  border: 1px solid black; " > 3 </td>
    <td style="width: 23px;  border: 1px solid black; " > 4 </td>
    <td style="width: 25px; border: 1px solid black; " > 5 </td>
    <td style="width: 20px;  border: 1px solid black; " > 6 </td>
    <td style="width: 26px;  border: 1px solid black; "> 7 </td>
    <td style="width: 25px;  border: 1px solid black; "> 8 </td>
    <td style="width: 25px;  border: 1px solid black; "> 9 </td>
    <td style="width: 24px;  border: 1px solid black; " > 10 </td>
    <td style="width: 23px;  border: 1px solid black; " > 11 </td>
    <td style="width: 28px;  border: 1px solid black; " > 12 </td>
    <td style="width: 29px;  border: 1px solid black; "> 13 </td>
    </tr>

    <tr style="font-size: 10pt; text-align:center;">
    <td style=" border: 1px solid black; width: 60px; height:29px;"></td>
    <td style=" border: 1px solid black; width: 20px;"> 22</td>
    <td style="border: 1px solid black;"> 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;"> 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;"> 22 </td>
    </tr>

    <tr style="font-size: 10pt; text-align:center;">
    <td style=" border: 1px solid black; width: 60px; height:29px;"></td>
    <td style=" border: 1px solid black; width: 20px;"> 22</td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    <td style="border: 1px solid black;" > 22 </td>
    </tr>

</table>

';


$html .= '
<img src="sf9logo2nd.jpg" alt="" style="  Height: 98px; Width:510px; margin-top: -113px; margin-left: 450px;" >
<img src="sf_logo.gif" alt="" style="  Height: 50px; Width:50px; margin-top: -185px; margin-left: 678px;" >
<div><p style=" font-size: 14px;margin-left: -24px; margin-top: -138.5px; text-align: center; width: 81px; ">No. of </br> school days</p></div>
<div><p style=" font-size: 14px;margin-left: -24px; margin-top: -107px; text-align: center; width: 81px; ">No. of </br> school days</p></div>
<div><p style=" font-size: 14px;margin-left: -24px; margin-top: -75px; text-align: center; width: 81px; ">No. of </br> school days</p></div>
';

$html .= '

<table style="margin-left: -26px; border: 0px solid black; margin-top:90px;">
    <tr>
      <td colspan="2" style="border: 0px solid black; font-size: 13.5px; font-weight:bold;  width: 358px; padding-left: 95px; height:20px"> PARENT/GUARDIAN&rsquo;S SIGNATURE </td>
    </tr>

    <tr style=" border: 0px solid black;">
      <td style=" vertical-align:bottom; height:34px;border: 0px solid black; font-size: 13.5px; width:80px;"> 1st Quarter</td>
      <td style=" border-bottom: 1px solid black; width:365px;">  </td>
    </tr>
    <tr style=" border: 0px solid black;">
    <td style="   vertical-align:bottom; height:34px; border: 0px solid black; font-size: 13.5px; width:80px;"> 2nd Quarter</td>
    <td style=" border-bottom: 1px solid black; width:365px;">  </td>
  </tr>
  <tr style=" border: 0px solid black;">
  <td style="   vertical-align:bottom; height:34px; border: 0px solid black; font-size: 13.5px; width:80px;"> 3rd Quarter</td>
  <td style=" border-bottom: 1px solid black; width:365px;">  </td>
</tr>
<tr style=" border: 0px solid black;">
<td style="   vertical-align:bottom; height:34px; border: 0px solid black; font-size: 13.5px; width:80px;"> 4th Quarter</td>
<td style=" border-bottom: 1px solid black; width:365px;">  </td>
</tr>


</table>
';





$html .= '<div>
<table style="margin-left:452px; margin-top: -235px; border: no-border; ">
      <tr>
        <td colspan ="4" style=" Width:510px; text-align: center; font-weight:bold; font-size:14.5px; height:20px;"> LEARNER&rsquo;S PROGRESS REPORT CARD</td>

      </tr>

      <tr style="font-size: 12px;">
      <td style="width:88px;">Name:</td>
      <td colspan="3" style=" text-align: center; font-weight:bold; border-bottom:1px solid black;">' . $row['name'] . '</td>
      </tr>

      <tr style="font-size: 12px;">
      <td >Age:</td>
      <td  style="width:132px;text-align: center; font-weight:bold; border-bottom:1px solid black;">' . $row['age'] . '</td>
      <td style="width:58px;">Sex:</td>
      <td  style="text-align: center; font-weight:bold; border-bottom:1px solid black; width:220px;">' . $row['sex'] . '</td>
      </tr>

      <tr style="font-size: 12px;"> 
      <td >Grade:</td>
      <td  style="text-align: center; font-weight:bold; border-bottom:1px solid black;">' . $row['grade'] . '</td>
      <td >Section:</td>
      <td  style="text-align: center; font-weight:bold; border-bottom:1px solid black;">' . $row['section'] . '</td>
      </tr>

      <tr style="font-size: 12px;">
      <td >School Year:</td>
      <td  style="text-align: center; font-weight:bold; border-bottom:1px solid black;">' . $row['school_year'] . '</td>
      <td >LRN:</td>
      <td  style="text-align: center; font-weight:bold; border-bottom:1px solid black;">' . $row['lrn'] . '</td>
      </tr>

      <tr style="font-size: 12px;">
      <td >Track/Strand:</td>
      <td colspan="3"  style="text-align: center; font-weight:bold; border-bottom:1px solid black;">' . $row['track'] . " - " . $row['strand'] . '</td>
      </tr>

<tr>
<td colspan="4" style="height: 17px;"> </td>
</tr>
      <tr >
      <td colspan="4" style="font-size: 12.5px;" > Dear Parent,</td>
      </tr>
      <tr>
      <td colspan="4" style="font-size: 12.5px; padding-left: 51px;" > This report  card  shows  the ability and  progress your child has made</td>
      </tr>
      <tr>
      <td colspan="4" style="font-size: 12.5px;" >in  the  different  learning  areas  as  well  as his/her  core  values.</td>
      </tr>
      <tr>
      <td colspan="4" style="font-size: 12.5px; padding-left: 51px;" >  The school welcomes you should you desire to know more about</td>
      </tr>
      <tr>
      <td colspan="4" style="font-size: 12.5px;" >your child&rsquo;s progress.</td>
      </tr>
</table>
</div>


<div>
<table style="margin-left:548px; margin-top: 0px; border: no-border; ">
<tr style="font-size: 12px;">
<td ></td>
<td  style="width:130px;text-align: center; font-weight:bold; "></td>
<td style="width:55px;"></td>
<td  style="text-align: center; font-weight:bold; border-bottom:1px solid black; width:220px;">' . $_SESSION['name'] . '</td>
</tr>
<tr style="font-size: 12px;">
<td ></td>
<td  style="width:130px;text-align: center; font-weight:bold; "></td>
<td style="width:55px;"></td>
<td  style="text-align: center; width:220px;">Class Adviser</td>
</tr>

</table>
</div>

<div>
<table style="margin-left:452px; margin-top: 2px; border: no-border; ">
<tr style="font-size: 12px;">

<td  style="text-align: center; font-weight:bold; border-bottom:1px solid black; width:222px; font-size: 12px; ">LORENA V. MIRANDA</td>
</tr>
<tr style="font-size: 12px;">

<td  style="text-align: center; width:220px; font-size: 12px;">School Principal IV</td>
</tr>



</table>
</div>


<div>
<table style="margin-left:452px; margin-top: 36px; border: no-border; ">>

<tr style="font-size: 12px;">
<td colspan="4" style="text-align:center; font-weight:bold;">Certificate of Transfer</td>
</tr>

<tr style="font-size: 12px;">
<td style="width:132px;">Admitted to Grade:</td>
<td style=" width: 88px; text-align:center;  border-bottom:1px solid black;"> </td>
<td style=" width: 58px; text-align:center;">Section:</td>
<td style="  width: 219px; text-align:center;  border-bottom:1px solid black;"></td>
</tr>


<tr style="font-size: 12px;"> 
<td colspan="2" ">Eligibility for Admission to Grade:</td>
<td colspan="2" style="text-align:center; border-bottom:1px solid black; "></td>
</tr>
</table>
</div>



<div>
<table style="margin-left:452px; margin-top: 33px; border: no-border; ">
<tr style="font-size: 12px;">
<td ></td>
<td  style="width:130px;text-align: center; font-weight:bold; "></td>
<td style="width:55px;"></td>
<td  style="text-align: center; font-weight:bold; border-bottom:1px solid black; width:220px;">' . $_SESSION['name'] . '</td>
</tr>
<tr style="font-size: 12px;">
<td >Approved:</td>
<td  style="width:130px;text-align: center; font-weight:bold; "></td>
<td style="width:95px;"></td>
<td  style="text-align: center; width:220px;">Class Adviser</td>
</tr>

</table>
</div>


<div>
<table style="margin-left:452px; margin-top: 17px; border: no-border; ">
<tr style="font-size: 12px;">

<td  style="text-align: center; font-weight:bold; border-bottom:1px solid black; width:220px; font-size: 12px; ">LORENA V. MIRANDA</td>
</tr>
<tr style="font-size: 12px;">

<td  style="text-align: center; width:222px; font-size: 12px;">School Principal IV</td>
</tr>



</table>
</div>
';
$html .= '<div style="page-break-before: always;"></div>';

//SF9 BACK
//CORE SUBJECTS 1ST SEM
$core = "SELECT * FROM `sf9` WHERE `student_name` = '$student' AND `subject_type` = 'Core' AND `semester` = '1st'";
$coreResult = $conn->query($core);
$coreResultCount = $coreResult->num_rows;
//APPLIED SUBJECTS 1ST SEM
$applied = "SELECT * FROM `sf9` WHERE `student_name` = '$student' AND `subject_type` = 'Applied' AND `semester` = '1st'";
$appliedResult = $conn->query($applied);
$appliedResultCount = $appliedResult->num_rows;
//SPECIALIZED SUBJECTS 1ST SEM
$specialized = "SELECT * FROM `sf9` WHERE `student_name` = '$student' AND `subject_type` = 'Specialized' AND `semester` = '1st'";
$specializedResult = $conn->query($specialized);
$specializedResultCount = $specializedResult->num_rows;

$semAverage = 0;

// Counters for each type of subject
$coreCount = 0;
$appliedCount = 0;
$specializedCount = 0;

//2ND SEM
//CORE SUBJECTS 2ND SEM
$core2 = "SELECT * FROM `sf9` WHERE `student_name` = '$student' AND `subject_type` = 'Core' AND `semester` = '2nd'";
$coreResult2 = $conn->query($core2);
$coreResultCount2 = $coreResult2->num_rows;
//APPLIED SUBJECTS 2ND SEM
$applied2 = "SELECT * FROM `sf9` WHERE `student_name` = '$student' AND `subject_type` = 'Applied' AND `semester` = '2nd'";
$appliedResult2 = $conn->query($applied2);
$appliedResultCount2 = $appliedResult2->num_rows;
//SPECIALIZED SUBJECTS 2ND SEM
$specialized2 = "SELECT * FROM `sf9` WHERE `student_name` = '$student' AND `subject_type` = 'Specialized' AND `semester` = '2nd'";
$specializedResult2 = $conn->query($specialized2);
$specializedResultCount2 = $specializedResult2->num_rows;

$semAverage2 = 0;

// Counters for each type of subject
$coreCount2 = 0;
$appliedCount2 = 0;
$specializedCount2 = 0;


$html .=
    '
    <style>
          *{
            font-family: Arial, Helvetica, sans-serif;
           }
    </style>
<div>
    <table style="margin-left: -6px; margin-top:-3px; font-size: 8.2pt; border-collapse: collapse;">
        <tr style="border: none;">
        <th colspan="4" style="width: 100%; border:none;">REPORT OF LEARNING PROGRESS AND ACHIEVEMENT </th>
        </tr>

        <tr>
        <th rowspan="2" style=" width: 304px; border: 1px solid black;"> SUBJECT (1st Semester) </th>
        <th colspan = "2" style="font-size:8.2pt;  height: 18px; width: 42px; border: 1px solid black;">  QUARTER </th>
        <th rowspan="2" style="width: 80px; border: 1px solid black;">SEMESTER FINAL GRADE</th>
        </tr>

        <tr >
        <th style="width: 44px; border: 1px solid black;">  1 </th>
        <th style="width: 44px; border: 1px solid black;">  2 </th>
        </tr>

        <tr  style=" font-weight: bold; vertical-align: bottom;" >
        <td style=" vertical-align: bottom; height: 18px; width: 100px; border: 1px solid black;">CORE SUBJECTS</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">  </td>
        <td style="border: 1px solid black;">   </td>
        </tr>
        ';

if ($coreResultCount == 0) {
    $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;"></td>
            <td style="height: 18px; border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black; font-weight: bold;"></td>
            </tr>';
} else {
    while ($coreRow = $coreResult->fetch_assoc()) {
        $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;">' . $coreRow['subject_title'] . '</td>
            <td style="height: 18px; border: 1px solid black;">' . $coreRow['sem_grade1'] . '</td>
            <td style="border: 1px solid black;">' . $coreRow['sem_grade2'] . '</td>
            <td style="border: 1px solid black; font-weight: bold;">' .  $coreRow['final_grade'] . '</td>
            </tr>';
        // Calculate the sum for Core subjects
        $semAverage += $coreRow['final_grade'];
        $coreCount++;
    }
}

$html .= '
        <tr  style="font-weight: bold; vertical-align: bottom; " >
        <td style="height: 18px; width: 100px; border: 1px solid black;">APPLIED TRACK SUBJECTS</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">  </td>
        <td style="border: 1px solid black;">   </td>
        </tr>
';

if ($appliedResultCount == 0) {
    $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;"></td>
            <td style="height: 18px; border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black; font-weight: bold;"></td>
            </tr>';
} else {
    while ($appliedRow = $appliedResult->fetch_assoc()) {
        $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;">' . $appliedRow['subject_title'] . '</td>
            <td style="height: 18px; border: 1px solid black;">' . $appliedRow['sem_grade1'] . '</td>
            <td style="border: 1px solid black;">' . $appliedRow['sem_grade2'] . '</td>
            <td style="border: 1px solid black; font-weight: bold;">' .  $appliedRow['final_grade'] . '</td>
            </tr>';
        // Calculate the sum for Applied subjects
        $semAverage += $appliedRow['final_grade'];
        $appliedCount++;
    }
}

$html .= '
        <tr  style="font-weight: bold; vertical-align: bottom; " >
        <td style="height: 18px; width: 100px; border: 1px solid black;">SPECIALIZED TRACK SUBJECTS</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">  </td>
        <td style="border: 1px solid black;">   </td>
        </tr>
';

if ($specializedResultCount == 0) {
    $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;"></td>
            <td style="height: 18px; border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black; font-weight: bold;"></td>
            </tr>';
} else {
    while ($specializedRow = $specializedResult->fetch_assoc()) {
        $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;">' . $specializedRow['subject_title'] . '</td>
            <td style="height: 18px; border: 1px solid black;">' . $specializedRow['sem_grade1'] . '</td>
            <td style="border: 1px solid black;">' . $specializedRow['sem_grade2'] . '</td>
            <td style="border: 1px solid black; font-weight: bold;">' .  $specializedRow['final_grade'] . '</td>
            </tr>';
        // Calculate the sum for Specialized subjects
        $semAverage += $specializedRow['final_grade'];
        $specializedCount++;
    }
}
$semAverage = ($semAverage) / ($coreCount + $appliedCount + $specializedCount);
$html .= '  
        <tr  style="font-weight: bold; vertical-align: bottom; text-align:center;" >
        <td style=" height: 18px; width: 100px; border: none;">General Average for the Semester:</td>
        <td style="border: 0px solid black;"></td>
        <td style="border: 0px solid black;"> </td>
        <td style="border: 1px solid black; font-weight: bold;">' . round($semAverage) . '  </td>
        </tr>
    </table>
    </div>
';

$html .= '
    <div style="margin-top: 10px;">
    <table style="margin-left: -6px; font-size:8.2pt;">
        <tr>   
            <th colspan="4" style=" height:18px; border: 0px solid black;"></th>
        </tr>

        <tr>
        <th rowspan="2" style=" width: 304px; border: 1px solid black;"> SUBJECT (2nd Semester) </th>
        <th colspan = "2"style="        font-size:8.2pt;  height: 18px; width: 42px; border: 1px solid black;">  QUARTER </th>
        <th rowspan="2" style="width: 80px; border: 1px solid black;">SEMESTER FINAL GRADE</th>
        </tr>

        <tr >
        <th style="width: 44px; border: 1px solid black;">  3 </th>
        <th style="width: 44px; border: 1px solid black;">  4 </th>
        </tr>

        <tr  style=" font-weight: bold; vertical-align: bottom;" >
        <td style=" vertical-align: bottom; height: 18px; width: 100px; border: 1px solid black;">CORE SUBJECTS</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">  </td>
        <td style="border: 1px solid black;">   </td>
        </tr>
';
//2ND SEM
if ($coreResultCount2 == 0) {
    $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;"></td>
            <td style="height: 18px; border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black; font-weight: bold;"></td>
            </tr>';
} else {
    while ($coreRow2 = $coreResult2->fetch_assoc()) {
        $html .= '
        <tr style="text-align: center; vertical-align: bottom;">
        <td style="text-align: left; width: 30px; border: 1px solid black;">' . $coreRow2['subject_title'] . '</td>
        <td style="height: 18px; border: 1px solid black;">' . $coreRow2['sem_grade1'] . '</td>
        <td style="border: 1px solid black;">' . $coreRow2['sem_grade2'] . '</td>
        <td style="border: 1px solid black; font-weight: bold;">' . $coreRow2['final_grade'] . '</td>
        </tr>
';
        // Calculate the sum for Core subjects
        $semAverage2 += $coreRow2['final_grade'];
        $coreCount2++;
    }
}

$html .= '
        <tr  style="font-weight: bold; vertical-align: bottom; " >
        <td style="height: 18px; width: 100px; border: 1px solid black;">APPLIED TRACK SUBJECTS</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">  </td>
        <td style="border: 1px solid black;">   </td>
        </tr>
';
if ($appliedResultCount2 == 0) {
    $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;"></td>
            <td style="height: 18px; border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black; font-weight: bold;"></td>
            </tr>';
} else {
    while ($appliedRow2 = $appliedResult2->fetch_assoc()) {
        $html .= '
        <tr style="text-align: center; vertical-align: bottom;">
        <td style="text-align: left; width: 30px; border: 1px solid black;">' . $appliedRow2['subject_title'] . '</td>
        <td style="height: 18px; border: 1px solid black;">' . $appliedRow2['sem_grade1'] . '</td>
        <td style="border: 1px solid black;">' . $appliedRow2['sem_grade2'] . '</td>
        <td style="border: 1px solid black; font-weight: bold;">' . $appliedRow2['final_grade'] . '</td>
        </tr>
';
        // Calculate the sum for Applied subjects
        $semAverage2 += $appliedRow2['final_grade'];
        $appliedCount2++;
    }
}

$html .= '
        <tr  style="font-weight: bold; vertical-align: bottom;" >
        <td style=" height: 18px; width: 100px; border: 1px solid black;">SPECIALIZED SUBJECTS</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">  </td>
        <td style="border: 1px solid black;">   </td>
        </tr>
';

if ($specializedResultCount2 == 0) {
    $html .= '<tr style="text-align: center; vertical-align: bottom;">
            <td style="text-align: left; width: 30px; border: 1px solid black;"></td>
            <td style="height: 18px; border: 1px solid black;"></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black; font-weight: bold;"></td>
            </tr>';
} else {
    while ($specializedRow2 = $specializedResult2->fetch_assoc()) {
        $html .= '
        <tr style="text-align: center; vertical-align: bottom;">
        <td style="text-align: left; width: 30px; border: 1px solid black;">' . $specializedRow2['subject_title'] . '</td>
        <td style="height: 18px; border: 1px solid black;">' . $specializedRow2['sem_grade1'] . '</td>
        <td style="border: 1px solid black;">' . $specializedRow2['sem_grade2'] . '</td>
        <td style="border: 1px solid black; font-weight: bold;">' . $specializedRow2['final_grade'] . '</td>
        </tr>
';
        // Calculate the sum for Specialized subjects
        $semAverage2 += $specializedRow2['final_grade'];
        $specializedCount2++;
    }
}

$semAverage2 = ($semAverage2) / ($coreCount2 + $appliedCount2 + $specializedCount2);
$totalAverage = ($semAverage + $semAverage2) / 2;
$html .= '
        <tr  style="font-weight: bold; vertical-align: bottom; text-align:center;" >
        <td style=" height: 18px; width: 100px; border: 0px solid black;">General Average for the Semester:</td>
        <td style="border: 0px solid black;"></td>
        <td style="border: 0px solid black;">  </td>
        <td style="border: 1px solid black;">' . round($semAverage2) . '</td>
        </tr>

        <tr  style="font-weight: bold; vertical-align: bottom; text-align: center;" >
        <td style=" height: 20px; width: 100px; border: 0px solid black;">General Average for the two Semesters:</td>
        <td style="border: 0px solid black;"></td>
        <td style="border: 0px solid black;">  </td>
        <td style="border: 1px solid black;">' . round($totalAverage) . '</td>
        </tr>

        <tr>
        <th colspan="4" style=" height:9px; border: 0px solid black;"></th>
        </tr>

    </table>
         </div>
    
<div>';

$modality = "SELECT * FROM `sf9_modality` WHERE `student_name` = '$student'";
$modalityResult = $conn->query($modality);
$modalityRow = $modalityResult->fetch_assoc();

$html .= '
<table style="margin-left: -6px; text-align: left; font-size:8.2pt; margin-top: 10px;">
        <tr  style=" font-weight: bold; text-align: center;" >
        <td style="  height: 18px; width: 210px; border: 1px solid black;">MODALITY</td>
        <td style="width: 44px; border: 1px solid black;">  Q1 </td>
        <td style="width: 44px; border: 1px solid black;">  Q2 </td>
        <td style="width: 44px; border: 1px solid black;">  Q3 </td>
        <td style="width: 44px; border: 1px solid black;">  Q4 </td>
        </tr>
        <tr style="font-weight: bold; text-align: center; ">
        <td style="height: 18px; text-align: left; width: 30px; border: 1px solid black;">* Blended</td>';
//BLENDED MODALITY
if ($modalityRow['blended_q1'] == 1) {
    $html .= '
    <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
        <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['blended_q2'] == 1) {
    $html .= '
    <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
        <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['blended_q3'] == 1) {
    $html .= '
    <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
        <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['blended_q4'] == 1) {
    $html .= '
    <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
        <td style="width: 44px; border: 1px solid black;">  </td>';
}

//MODULAR DISTANCE LEARNING MODALITY
$html .= '
        </tr>
        <tr  style="font-weight: bold; text-align:center;">
        <td style="height: 18px; text-align: left; width: 30px; border: 1px solid black;">* Modular Distance Learning</td>';
if ($modalityRow['mdl_q1'] == 1) {
    $html .= '
            <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
                <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['mdl_q2'] == 1) {
    $html .= '
            <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
                <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['mdl_q3'] == 1) {
    $html .= '
            <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
                <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['mdl_q4'] == 1) {
    $html .= '
            <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
                <td style="width: 44px; border: 1px solid black;">  </td>';
}

//IN-PERSON MODALITY
$html .= '
        </tr>
        <tr  style="font-weight: bold;  text-align:center;" >
        <td style="height: 18px; text-align: left; width: 30px; border: 1px solid black;">* In-person</td>';
if ($modalityRow['ip_q1'] == 1) {
    $html .= '
            <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
                <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['ip_q2'] == 1) {
    $html .= '
            <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
                <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['ip_q3'] == 1) {
    $html .= '
            <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
                <td style="width: 44px; border: 1px solid black;">  </td>';
}

if ($modalityRow['ip_q4'] == 1) {
    $html .= '
            <td style="width: 44px; border: 1px solid black;">/</td>';
} else {
    $html .= '
                <td style="width: 44px; border: 1px solid black;">  </td>';
}


$ov = "SELECT * FROM `sf9_ov` WHERE `student_name` = '$student'";
$ovResult = $conn->query($ov);
$ovRow = $ovResult->fetch_assoc();

$html .= '
        </tr>
</table>
</div>
    <div>
        <table style="margin-left: 555px; position:fixed; font-size:8.2pt; border-collapse: collapse;">
            <tr style="border: none;">
            <th colspan="6" style="font-size:11.3pt; border: 0px solid black;">REPORT ON LEARNER&rsquo;S OBSERVED VALUES</th>
            </tr>
            <tr >
            <th rowspan="2" style="height:28px; width: 120px; border: 1px solid black;">CORE VALUES</th>
            <th rowspan="2" style="width: 169px; border: 1px solid black;">BEHAVIOR STATEMENT</th>
            <th rowspan="1" colspan = "4" style="width: 100px; border: 1px solid black;">QUARTER</th>
            </tr>
            <tr >
            <th style="width: 27px; border: 1px solid black;">  1 </th>
            <th style="width: 25px; border: 1px solid black;">  2 </th>
            <th style="width: 25px; border: 1px solid black;">  3 </th>
            <th style="width: 25px; border: 1px solid black;">  4 </th>
            </tr>


            <tr >
            <td rowspan="2" style=" text-align: left; width: 100px; border: 1px solid black;">1. Maka-Diyos</td>

            <td style="height:59px; text-align: left; border: 1px solid black;"> Expresses ones spiritual belief&rsquo;s while respecting the spiritual beliefs of other </td>
            <td style="text-align: center; border: 1px solid black;">' . $ovRow['mdq1'] . ' </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mdq2'] . '  </td>
            <td style="text-align: center; border: 1px solid black;">' . $ovRow['mdq3'] . '</td>
            <td style="text-align: center;border: 1px solid black;">' . $ovRow['mdq4'] . '  </td>
            
            </tr>

            <tr style="text-align: center;">
            <td style="text-align: left; height: 39px; border: 1px solid black;">Shows adherence to ethical principles by uplholding truth. </td>
            <td style="border: 1px solid black;">' . $ovRow['mdq5'] . '</td>
            <td style="border: 1px solid black;">' . $ovRow['mdq6'] . '</td>
            <td style="border: 1px solid black;">' . $ovRow['mdq7'] . '</td>
            <td style="border: 1px solid black;"> ' . $ovRow['mdq8'] . '  </td>
            </tr>

            <tr >
            <td rowspan="2" style="text-align: left; width: 100px; border: 1px solid black;">2. Makatao</td>
            <td style="text-align: Left; height: 39px; border: 1px solid black;"> Is sensitive to individual, social and cultural differences</td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkq1'] . ' </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkq2'] . '  </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkq3'] . '  </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkq4'] . ' </td>
            
            </tr>

            <tr style="text-align: center;">
            <td style="text-align: left;height: 39px;  width: 30px; border: 1px solid black;">Demonstrate contribution toward solidarity </td>
            <td style="text-align: center; border: 1px solid black;">' . $ovRow['mkq5'] . '</td>
            <td style="text-align: center; border: 1px solid black;">' . $ovRow['mkq6'] . '</td>
            <td style="text-align: center; border: 1px solid black;">' . $ovRow['mkq7'] . '</td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkq8'] . '  </td>
            </tr>

            <tr >
            <td style="width: 100px; border: 1px solid black;">3.Makakalikasan</td>
            <td style="text-align: left; height: 78px; border: 1px solid black;"> Cares for the environment and utilizes resources wisely, judiciously, and economically.</td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkkq1'] . ' </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkkq2'] . '  </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkkq3'] . ' </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mkkq4'] . '  </td>
            
            </tr>
            <tr >
            <td rowspan="2" style="width: 100px; border: 1px solid black;">4.Makabansa</td>
            <td style="text-align: left; border: 1px solid black;"> Demonstrate pride in being a Filipino, exercises the rights and responsibilities of a <br>Filipio citizen.</td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mbq1'] . ' </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mbq2'] . '  </td>
            <td style="text-align: center; border: 1px solid black;"> ' . $ovRow['mbq3'] . '  </td>
            <td style="text-align: center;  border: 1px solid black;"> ' . $ovRow['mbq4'] . '  </td>
            </tr>
            <tr style="text-align: center;">
            <td style="text-align: left;height: 78px; width: 30px; border: 1px solid black;">Demonstrate appropriate behavior in carrying out activities in the school, community, and country.</td>
            <td style="border: 1px solid black;">' . $ovRow['mbq5'] . '</td>
            <td style="border: 1px solid black;">' . $ovRow['mbq6'] . '</td>
            <td style="border: 1px solid black;">' . $ovRow['mbq7'] . '</td>
            <td style="border: 1px solid black;"> ' . $ovRow['mbq8'] . ' </td>
            </tr>
        </table>
                                                                    
    </div>
        
<div>
<table style=" margin-top: 485px; margin-left: 553px; position:fixed; font-size:8pt;">

        <tr  style="font-size: 8pt; font-weight: bold; text-align: left;" >
        <td colspan="2" style=" width: 100%; height: 0px;  border: 0px solid black;">OBSERVED VALUES</td>



        </tr>

        <tr style=" font-weight: bold; text-align: left; ">
        <td style="width: 80px; height: 0px; text-align: left;  border: 0px solid black;">MARKING</td>
        <td style="width: 200px; border: 0px solid black;"> NON-NUMERICAL RATING  </td>
    

        </tr>
        <tr  style="" >
        <td style=" width: 80px; height: 0px;  border: 0px solid black;">AO</td>
        <td style="width: 200px; border: 0px solid black;">  Always Observed </td>


        </tr>
        <tr  style="" >
        <td style="width: 80px; height: 0px;  border: 0px solid black;">SO</td>
        <td style="width: 200px; border: 0px solid black;"> Sometimes Observed  </td>

        </tr>

        </tr>
        <tr  style="" >
        <td style="width: 80px; height: 0px;  border: 0px solid black;">RO</td>
        <td style="width: 200px; border: 0px solid black;"> Rarely Observed  </td>

        </tr>

        </tr>
        <tr  style="" >
        <td style="width: 80px; height: 0px;  border: 0px solid black;">NO</td>
        <td style="width: 200px; border: 0px solid black;">  Not Observed </td>

        </tr>

</table>
</div>

<div>
<table style="margin-top: 595px; margin-left: 553px; position:fixed; font-size:8pt;">

        <tr  style=" font-weight: bold; text-align: left;" >
        <td colspan="2" style=" width: 100%; height: 0px;  border: 0px solid black;">Learner Progress and Achievement</td>
        </tr>

        <tr style="  font-weight: bold; text-align: left; ">
        <td style="width: 155px; height: 0px; text-align: left;  border: 0px solid black;">Descriptor</td>
        <td style="width: 200px; border: 0px solid black;">Grading Scale </td>
    
        </tr>
        <tr  style="" >
        <td style="width: 155px; height: 0px;  border: 0px solid black;">Outstanding</td>
        <td style="width: 200px; border: 0px solid black;"> 90-100</td>


        </tr>
        <tr  style="" >
        <td style="width: 155px; height: 0px;  border: 0px solid black;">Very Satisfactory</td>
        <td style="width: 200px; border: 0px solid black;">85-89   </td>

        </tr>

        </tr>
        <tr  style="" >
        <td style="width: 155px; height: 0px;  border: 0px solid black;">Satisfactory</td>
        <td style="width: 200px; border: 0px solid black;">80-84</td>

        </tr>

        </tr>
        <tr  style="" >
        <td style="width: 155px; height: 0px;  border: 0px solid black;">Fairly Satisfactory</td>
        <td style="width: 200px; border: 0px solid black;">75-79</td>

        </tr>

        </tr>
        <tr  style="" >
        <td style="width: 155px; height: 0px;  border: 0px solid black;">Did Not Meet Expectation</td>
        <td style="width: 200px; border: 0px solid black;">Below 75-79</td>

        </tr>
</table>
</div>
    ';
$dompdf->loadHtml($html);

$dompdf->setPaper('LETTER', 'landscape');

$dompdf->render();

$dompdf->stream('my. pdf', array('Attachment' => 0));
