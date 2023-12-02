<?php
include "../config.php";
session_start();

require_once "vendor/autoload.php";
require_once "calendar.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);

$sectionName = $_SESSION['section'];
$section = "SELECT * FROM `section` WHERE `name` = '$sectionName'";
$sectionResult = $conn->query($section);
$sectionRow = $sectionResult->fetch_assoc();

$today = new CurrentDate();
$calendar = new Calendar($today, new CalendarDate());

// Automatically set the calendar to the current month and year
$calendar->setMonthYear($today->getYear(), $today->getMonthNumber());

$calendar->create();


$currentMonth = date('m');

if ($sectionRow['track'] == 'Technical-Vocational-Livelihood') {
  $track = $sectionRow['track'];
  $strand = $sectionRow['strand'];
} else {
  $track = $sectionRow['track'] . ' - ' . $sectionRow['strand'];
  $strand = '';
}


$select = "SELECT *  FROM student WHERE sex = 'M' AND section = '$sectionName'ORDER BY name ASC";
$result = mysqli_query($conn, $select);
while ($row = mysqli_fetch_assoc($result)) {
  $html =
    '
      <style>
        @page { margin-bottom: 10px; }
        
        *{
          font-family: Arial, Helvetica, sans-serif;
        }
      </style>
       <img src="sf_logo.gif" alt="" style="  Height: 88px; Width:85px; margin-top:-27px; margin-left: -8px;" >
       <h1 style="font-size: 10.5pt; text-align: center; margin-top:-40px; margin-left: -150px;"> 
        School Form 2 Daily Attendance Report of Learners For Senior High School (SF2-SHS)
       </h1>
       <img src="depedlogosf5.jpg" alt="" style="Height: 52px; Width:75; margin-top: -80px;margin-bottom: 5px; margin-left: 773px">
       <div class="School Name">
       <p style=" Height: 12px; width: 150px; font-size: 7.7pt; margin-top:-3px; margin-left: 6px; " > School Name </p> 
      </div>
      <div >
      <table style= " margin-top: -31px; margin-left: 68px;"   >
       <tr>
        <td style="  Height: 20px; width: 173px; text-align:center; font-size: 6.5pt;  border: 1.5px solid black;" >Tagaytay City National High School - ISHS</td> 
        <td style="  padding-left: 3px; Height: 20px; width: 47px; text-align:center; font-size: 7.7pt;  " >School ID</td> 
        <td style="  Height: 20px; width: 98px; text-align:center; font-size: 7pt;  border: 1.5px solid black;" >301216</td> 
        <td style="  padding-right: -1px; Height: 20px; width: 68px; text-align:right; font-size: 7.7pt; " >District</td> 
        <td style="  Height: 20px; width: 72px; text-align:center; font-size: 7pt;  border: 1.5px solid black;" >Tagaytay</td> 
        <td style="  padding-right: 5px; Height: 20px; width: 56px; text-align:right; font-size: 7.7pt; " >Division                </td> 
        <td style="  Height: 20px; width: 90px; text-align:center; font-size: 7pt;  border: 1.5px solid black;" >Cavite</td> 
        <td style="  padding-right: 3px; Height: 20px; width: 57px; text-align:right; font-size: 7.7pt; " >Region</td> 
        <td style="  Height: 20px; width: 71px; text-align:center; font-size: 7.7pt;  border: 1.5px solid black;" >Region IV-A</td> 
        </tr>
      </table>
      </div>

      <div class="Semester">
      <p style=" Height: 12px; width: 150px; font-size: 7.7pt; margin-top:7px; margin-left: 23px; " >Semester</p> 
     </div>
      <div >
      <table style= " margin-top: -27px; margin-left: 68px;"   >
       <tr>
        <td style="  Height: 15px; width: 133px; text-align:center; font-size: 6.5pt;  border: 1.5px solid black;" >' . $sectionRow['semester_name'] . '</td>
        <td style="  PADDING-left: 7px; Height: 15px; width: 64px; text-align:center; font-size: 7.7pt;  " >School Year</td> 
        <td style="  padding-right: px; Height: 15px; width: 89px; text-align:center; font-size: 7pt;  border: 1.5px solid black;" >' . $sectionRow['start_year'] . ' - ' . $sectionRow['end_year'] . '</td> 
        <td style="  overflow: hidden; padding-bottom: 2px; Height: 15px; width: 53px; text-align:right; font-size: 7.7pt; " ></td> 
        <td style="  Height: 15px; width: 61px; text-align:center; font-size: 7pt;  border: 1.5px solid black;" >Grade ' . $sectionRow['grade'] . '</td> 
        <td style="  padding-right: 5px; Height: 15px; width: 88px; text-align:right; font-size: 7.7pt; " >Track and Strand   </td> 
        <td style="  Height: 15px; width: 254px; text-align:center; font-size: 7pt;  border: 1.5px solid black;" >' . $track . '</td> 
        <p style=" Height: 0px; width: 10px; text-align:right ; font-size: 7.7pt; margin-top:-5px; margin-left: -436px; " >Grade Level</p> 
        </tr>
      </table>
      </div>
      <div class="Semester">
      <p style=" Height: 12px; width: 150px; font-size: 7.7pt; margin-top:7px; margin-left: 33px; " >Section</p> 
     </div>
     
      <div >
      <table style= " margin-top: -27px; margin-left: 68px;  "   >
       <tr>
        <td style="  Height: 15px; width: 173px; text-align:center; font-size: 6.5pt;  border: 1.5px solid black;" >' . $sectionRow['name'] . '</td> 
        <td style="  padding-right: 1px; Height: 15px; width: 119px; text-align:right; font-size: 7.7pt; " >Course (for TVL only)</td> 
        <td style="  Height: 15px; width: 190px; text-align:center; font-size: 7pt;  border: 1.5px solid black;" >' . $strand . '</td> 

        <td style="  padding-right: 6px; Height: 15px; width: 116px; text-align:right; font-size: 7.7pt;  " >Month of</td> 
        <td style="   Height: 15px; width: 160px; text-align:center; font-size: 7pt;  border: 1.5px solid black;" >' . date('F', strtotime('2023-' . $currentMonth . '-01')) . '</td> 
        </tr>
      </table>
      </div>
      ';
}

$html .= '
<div><table style=" margin-top: 49px;">
<tr>
<td  style=" margin-left: 60px; font-size:7pt; height:18px; width:287.8px; text-align: center; vertical-align: middle;   border-right: 2px solid black;" > </td> 
<td  style=" margin-left: 60px; font-size:7pt; height:15px; width:99.2px; text-align: center; vertical-align: middle;   border-right: 2px solid black;" > </td> 
<td  style=" margin-left: 60px; font-size:7pt; height:15px; width:99.3px; text-align: center; vertical-align: middle;   border-right: 2px solid black;" > </td> 
<td  style=" margin-left: 60px; font-size:7pt; height:15px; width:99.2px; text-align: center; vertical-align: middle;   border-right: 2px solid black;" > </td> 

</tr>
</table>
</div>
<style>
*{
  font-family: Arial, Helvetica, sans-serif;

}

</style>

<table style = "  border-collapse: collapse; border: 2px solid black; margin-left: -22px; margin-top: -40px;">
    <tr style = "    font-size: 5pt;" >
        <td rowspan="3" style = "  width: 28px; font-weight: bold; border: 2px solid black; text-align: center; ">No.</td>
        <td rowspan="3" style = " font-weight: bold; border:2px solid black; text-align: center; width:172px;  " > Name <br/> (Last Name, First Name, Middle Name)</td>
        <td  colspan="25" style = "font-size: 5pt; height:5px; " > DATE </td>
        <td rowspan="2" colspan = " 2"  style = "height:20px; font-weight: bold; font-size: 8pt; border: 2px solid black; text-align: center;  " > Total for the Month</td>
        <td rowspan="3" colspan = " 1" style = "font-weight: bold;  border: 2px solid black; text-align: center; font-size: 5pt; " >REMARKS (If, NLPA, state reason, please refer to legend number 2. If </br> TRANSFFERED IN/OUT write the name of the School</td>

        </tr>
        
<tr>';

foreach ($calendar->getWeeks() as $week) {
  foreach ($week as $day) {
    $html .= '<td style = "height: 15px; width:18.05px; font-size: 8pt;  border: 1px solid black; text-align: center;  " ';

    if (isset($day['currentMonth']) && !$day['currentMonth']) {
      $html .= ' class="different-month"';
    }

    $html .= '><span';

    if (isset($day['currentDate']) && $calendar->isCurrentDate($day['dayNumber'])) {
      $html .= ' class="current-date"';
    }

    $html .= '>' . $day["dayNumber"] . '</span></td>';
  }
}

$html .= '</tr> <tr>';

foreach ($calendar->getDayLabels() as $dayLabel) {
  $style = " height: 15px; font-size: 6pt; text-align: center;";

  // Check if the day label contains "Fri"
  if (strpos($dayLabel, 'F') !== false) {
    $style .= " border-right: 2px solid black; border-bottom: 2px solid black;";
  } else {
    $style .= " border-right: 1px solid black; border-bottom: 2px solid black;";
  }

  $html .= '<td style="' . $style . '">' . $dayLabel . '</td>';
}

$html .= '
<td style = " width: 44px; font-weight:bold; font-size: 6pt; border: 2px solid black; text-align: center;  ">ABSENT</td>
<td style = " width: 44px; font-weight:bold;  font-size: 6pt; border: 2px solid black; text-align: center;  " >PRESENT</td>
</tr>

';

$select = "SELECT *  FROM student WHERE sex = 'M' AND section = '$sectionName'ORDER BY name ASC";
$result = mysqli_query($conn, $select);
$maleCount = 1;
$totalAbsentMale = 0;
$totalPresentMale = 0;
foreach ($result as $emp) {
  // Get current month and year
  $currentMonth = date('m');
  $currentYear = date('Y');

  $studentName = $emp['name'];
  $sf2 = "SELECT * FROM `sf2` WHERE `student_name` = '$studentName' AND `attendance_month` = '$currentMonth'";
  $sf2Result = $conn->query($sf2);
  $sf2Count = $sf2Result->num_rows;

  $totalPresentMale += $sf2Count;

  $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

  // Calculate weekdays and weekend days
  $weekdays = 0;
  $weekendDays = 0;

  for ($i = 1; $i <= $daysInMonth; $i++) {
    $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));

    if ($day == 'Sat' || $day == 'Sun') {
      $weekendDays++;
    } else {
      $weekdays++;
    }
  }

  $absent = $weekdays - $sf2Count;
  $totalAbsentMale += $absent;

  $html .=
    '
      <tr style="font-size: 5pt; ">
      <td style=" height: 22px; border-right: 2px solid black; border-bottom: 1px solid black;  font-size:7pt;  width:20px;  text-align: center;  vertical-align: middle; " >' . $maleCount . '</td>
      <td style=" border-right: 2px solid black; border-bottom: 1px solid black; font-size:7pt;   vertical-align: middle; ">' . $emp['name'] . '</td>';

  $present = "SELECT `day` FROM `sf2` WHERE `student_name` = '$studentName' AND `attendance_month` = '$currentMonth'";
  $presentResult = $conn->query($present);
  $presentDays = [];

  foreach ($presentResult as $present) {
    $presentDays[] = $present['day'];
  }

  foreach ($calendar->getWeeks() as $week) {
    foreach ($week as $day) {
      $dayNumber = $day['dayNumber'];
      if (date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $dayNumber)) === 'Fri') {
        // Check if the day number exists in the presentDays array
        if (in_array($day['dayNumber'], $presentDays)) {
          $html .= '<td style="font-size:7pt;  width:10px; text-align: center; vertical-align: middle;  border: 1px solid black; border-right: 2px solid black;"></td>';
        } else {
          $html .= '<td style="font-size:7pt;  width:10px; text-align: center; vertical-align: middle;  border: 1px solid black; border-right: 2px solid black;">X</td>';
        }
      } else {
        // Check if the day number exists in the presentDays array
        if (in_array($day['dayNumber'], $presentDays)) {
          $html .= '<td style="font-size:7pt;  width:10px; text-align: center; vertical-align: middle;  border: 1px solid black;"></td>';
        } else {
          $html .= '<td style="font-size:7pt;  width:10px; text-align: center; vertical-align: middle;  border: 1px solid black;">X</td>';
        }
      }
    }
  }

  $html .= '
      <td style="  vertical-align: middle; text-align : center;  border-right: 2px solid black; border-bottom: 1px solid black;">' . $absent . '</td>
      <td style= "  vertical-align: middle; text-align : center;  border-right: 2px solid black; border-bottom: 1px solid black;">' . $sf2Count . '</td>';

  $id = $emp['id'];
  $remarks = "SELECT * FROM `sf2remarks` WHERE `student_id` = '$id'";
  $remarksResult = $conn->query($remarks);
  $remarksRow = $remarksResult->fetch_assoc();

  $remarksValue = isset($remarksRow['remarks']) ? $remarksRow['remarks'] : '';

  $html .= '
        <td style="font-size: 5pt; width:228px; vertical-align: middle; text-align: center; border: 1px solid black;">' . $remarksValue . '</td>
      </tr>';

  $maleCount++;
}

$html .= '
    <tr> 
    <td  style=" font-size: 7pt;  height: 22px;  text-align: right;  border-right: 2px solid black; border-bottom: 2px solid black;"></td>
    <td  style="  font-size: 7pt;  text-align: center;  border-right: 2px solid black; border-bottom: 2px solid black; ">&lt;===MALE |  TOTAL Per Day ===> </td>
  ';

$presentCounts = [];

foreach ($calendar->getWeeks() as $week) {
  foreach ($week as $day) {
    // Get the day number
    $dayNumber = $day['dayNumber'];

    // Query to get the count of students present on the current day
    $presentQuery = "SELECT COUNT(DISTINCT student_name) AS count FROM sf2 WHERE attendance_month = '$currentMonth' AND day = '$dayNumber' AND sex = 'M'";
    $presentResult = $conn->query($presentQuery);
    $presentCount = $presentResult->fetch_assoc()['count'];

    // Store the count of present students for the current day in the array
    $presentCounts[$dayNumber] = $presentCount;

    // Check if the day is Friday to add border-right
    $borderStyle = 'border: 1px solid black; border-bottom: 2px solid black';
    if (date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $dayNumber)) === 'Fri') {
      $borderStyle = 'border: 1px solid black; border-right: 2px solid black; border-bottom: 2px solid black';
    }

    // Append the cell with the appropriate border style
    $html .= '<td style="font-size: 8pt; width:10px; text-align: center; vertical-align: middle; ' . $borderStyle . '">' . $presentCounts[$dayNumber] . '</td>';
  }
}


$html .= '
      <td style=" font-size: 5pt;  vertical-align: middle; text-align : center; border-right: 2px solid black; border-bottom: 2px solid black;">' . $totalAbsentMale . '</td>
      <td style= " font-size: 5pt; vertical-align: middle; text-align : center; border-right: 2px solid black; border-bottom: 2px solid black;">' . $totalPresentMale . '</td>
      <td style= " font-size: 5pt; vertical-align: middle; text-align : center; border-right: 2px solid black; border-bottom: 2px solid black;"></td>
</tr>
  ';

$select = "SELECT *  FROM student WHERE sex = 'F' AND section = '$sectionName'ORDER BY name ASC";
$result = mysqli_query($conn, $select);
$femaleCount = 1;
$totalAbsentFemale = 0;
$totalPresentFemale = 0;
foreach ($result as $emp) {
  // Get current month and year
  $currentMonth = date('m');
  $currentYear = date('Y');

  $studentName = $emp['name'];
  $sf2 = "SELECT * FROM `sf2` WHERE `student_name` = '$studentName' AND `attendance_month` = '$currentMonth'";
  $sf2Result = $conn->query($sf2);
  $sf2Count = $sf2Result->num_rows;
  $totalPresentFemale += $sf2Count;

  $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

  // Calculate weekdays and weekend days
  $weekdays = 0;
  $weekendDays = 0;

  for ($i = 1; $i <= $daysInMonth; $i++) {
    $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));

    if ($day == 'Sat' || $day == 'Sun') {
      $weekendDays++;
    } else {
      $weekdays++;
    }
  }

  $absent = $weekdays - $sf2Count;
  $totalAbsentFemale += $absent;
  $html .=
    '
      <tr style="font-size: 5pt; ">
      <td style=" height: 22px; border-right: 2px solid black; border-bottom: 1px solid black;  font-size:7pt;  width:20px;  text-align: center;  vertical-align: middle; " >' . $femaleCount . '</td>
      <td style=" border-right: 2px solid black; border-bottom: 1px solid black; font-size:7pt;   vertical-align: middle; ">' . $emp['name'] . '</td>';

  $present = "SELECT `day` FROM `sf2` WHERE `student_name` = '$studentName' AND `attendance_month` = '$currentMonth'";
  $presentResult = $conn->query($present);
  $presentDays = [];

  foreach ($presentResult as $present) {
    $presentDays[] = $present['day'];
  }

  foreach ($calendar->getWeeks() as $week) {
    foreach ($week as $day) {
      $dayNumber = $day['dayNumber'];
      if (date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $dayNumber)) === 'Fri') {
        // Check if the day number exists in the presentDays array
        if (in_array($day['dayNumber'], $presentDays)) {
          $html .= '<td style="font-size:7pt;  width:10px; text-align: center; vertical-align: middle;  border: 1px solid black; border-right: 2px solid black;"></td>';
        } else {
          $html .= '<td style="font-size:7pt;  width:10px; text-align: center; vertical-align: middle;  border: 1px solid black; border-right: 2px solid black;">X</td>';
        }
      } else {
        // Check if the day number exists in the presentDays array
        if (in_array($day['dayNumber'], $presentDays)) {
          $html .= '<td style="font-size:7pt;  width:10px; text-align: center; vertical-align: middle;  border: 1px solid black;"></td>';
        } else {
          $html .= '<td style="font-size:7pt;  width:10px; text-align: center; vertical-align: middle;  border: 1px solid black;">X</td>';
        }
      }
    }
  }

  $html .= '      
      <td style="  vertical-align: middle; text-align : center;  border-right: 2px solid black; border-bottom: 1px solid black;">' . $absent . '</td>
      <td style= "  vertical-align: middle; text-align : center;  border-right: 2px solid black; border-bottom: 1px solid black;">' . $sf2Count . '</td>

      <td style= " font-size: 5pt; width:228px; vertical-align: middle; text-align : center; border: 1px solid black;"></td>
    </tr>
        ';
  $femaleCount++;
}

$html .= '
  <tr> 
  <td  style=" font-size: 7pt;  height: 22px;  text-align: right;  border-right: 2px solid black; border-bottom: 1px solid black;"></td>
  <td  style="  font-size: 7pt;  text-align: center;  border-right: 2px solid black; border-bottom: 1px solid black; ">&lt;===FEMALE |  TOTAL Per Day ===> </td>';

$presentCounts = [];

foreach ($calendar->getWeeks() as $week) {
  foreach ($week as $day) {
    // Get the day number
    $dayNumber = $day['dayNumber'];

    // Query to get the count of students present on the current day
    $presentQuery = "SELECT COUNT(DISTINCT student_name) AS count FROM sf2 WHERE attendance_month = '$currentMonth' AND day = '$dayNumber' AND sex = 'F'";
    $presentResult = $conn->query($presentQuery);
    $presentCount = $presentResult->fetch_assoc()['count'];

    // Store the count of present students for the current day in the array
    $presentCounts[$dayNumber] = $presentCount;

    // Check if the day is Friday to add border-right
    $borderStyle = 'border: 1px solid black; border-bottom: 2px solid black';
    if (date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $dayNumber)) === 'Fri') {
      $borderStyle = 'border: 1px solid black; border-right: 2px solid black; border-bottom: 2px solid black';
    }

    // Append the cell with the appropriate border style
    $html .= '<td style="font-size: 8pt; width:10px; text-align: center; vertical-align: middle; ' . $borderStyle . '">' . $presentCounts[$dayNumber] . '</td>';
  }
}


$html .= '
      <td style=" font-size: 5pt;  vertical-align: middle; text-align : center; border-right: 2px solid black; border-bottom: 1px solid black;">' . $totalAbsentFemale . '</td>
      <td style= " font-size: 5pt; vertical-align: middle; text-align : center; border-right: 2px solid black; border-bottom: 1px solid black;">' . $totalPresentFemale . '</td>
      <td style= " font-size: 5pt; vertical-align: middle; text-align : center; border: 1px solid black;"></td>
</tr>
  ';

$html .= '
  <tr> 
  <td  style=" font-size: 7pt;  height: 22px;  text-align: right;  border-right: 2px solid black; border-bottom: 2px solid black;"> </td>
  <td  style="  font-size: 7pt;  text-align: center;  border-right: 2px solid black; border-bottom: 2px solid black; ">Combined TOTAL Per Day</td>';

// Initialize an array to store the combined counts
$combinedCounts = [];

foreach ($calendar->getWeeks() as $week) {
  foreach ($week as $day) {
    // Get the day number
    $dayNumber = $day['dayNumber'];

    // Query to get the count of male students present on the current day
    $malePresentQuery = "SELECT COUNT(DISTINCT student_name) AS count FROM sf2 WHERE attendance_month = '$currentMonth' AND day = '$dayNumber' AND sex = 'M'";
    $malePresentResult = $conn->query($malePresentQuery);
    $malePresentCount = $malePresentResult->fetch_assoc()['count'];

    // Query to get the count of female students present on the current day
    $femalePresentQuery = "SELECT COUNT(DISTINCT student_name) AS count FROM sf2 WHERE attendance_month = '$currentMonth' AND day = '$dayNumber' AND sex = 'F'";
    $femalePresentResult = $conn->query($femalePresentQuery);
    $femalePresentCount = $femalePresentResult->fetch_assoc()['count'];

    // Calculate the combined count
    $combinedCount = $malePresentCount + $femalePresentCount;

    // Store the combined count for the current day in the array
    $combinedCounts[$dayNumber] = $combinedCount;

    // Append the cell with the combined count
    $html .= '<td style="font-size: 8pt; width:10px; text-align: center; vertical-align: middle; border: 1px solid black; border-right: 2px solid black; border-bottom: 2px solid black;">' . $combinedCounts[$dayNumber] . '</td>';
  }
}


$html .= '
      <td style=" font-size: 5pt;  vertical-align: middle; text-align : center; border-right: 2px solid black; border-bottom: 2px solid black;">' . $totalAbsentMale + $totalAbsentFemale . '</td>
      <td style= " font-size: 5pt; vertical-align: middle; text-align : center; border-right: 2px solid black; border-bottom: 2px solid black;">' . $totalPresentMale + $totalPresentFemale . '</td>
      <td style= " font-size: 5pt; vertical-align: middle; text-align : center; border-right: 2px solid black; border-bottom: 2px solid black;"></td>
  </tr>
</table>
  ';

$html .= ' <table style = " font-size: 6pt; border-collapse: collapse; border: 0px solid black; margin-top:150px; margin-left: -22px; ">

<tr>
<td></br></br>
1. The attendance shall be accomplished daily. Refer to the codes for checking learners&rsquo; attendance. </br>
2. Dates shall be written in the columns after Learner&rsquo;s Name.</br>
3. To compute the following:</td>
</tr>


';



$html .= ' 
<tr>
<td></td>
</tr>


';

$html .= '

<tr >
<td style="padding-left: 23px;" ></br> </br> </br>a. Percentage of Enrolment =   </br> </br>  </br>
b. Average Daily Attendance =  </br> </br>
c. Percentage of Attendance for the month =</td>

</tr>
</table>

';

$html .= '<table style = " font-size: 6pt; border-collapse: collapse; border: 0px solid black; margin-left: 190px; margin-top: -65px;">

<tr>
<td style=" width: 220px;text-align:center;  padding-top: 3px; border-bottom: 1.5px solid black;"> Registered Learners as of end of the month</br> 
</tr>

<tr>
<td style=" width: 220px;text-align:center;  "> Enrolment as of 1st Friday of the school year </br>  
</tr>



<tr>
<td style=" width: 220px;text-align:center;  border-bottom: 1.5px solid black;">Total Daily Attendance</br> 
</tr>

<tr>
<td style=" width: 200px;text-align:center;  ">Number of School Days in reporting month</br>  
</tr>


<tr>
<td style=" width: 200px;text-align:center;  border-bottom: 1.5px solid black;">Average daily attendance</br> 
</tr>

<tr>
<td style=" width: 200px;text-align:center;  ">Registered Learners as of end of the month</br>  
</tr>
</table>

';


$html .= '<table style = " font-size: 6pt; border-collapse: collapse; border: 0px solid black; margin-left: 325px; margin-top: -75px;">
<tr>
<td style=" width: 200px;text-align:center;  ">x100</br> 
</tr>
</table>

';
$html .= '<table style = " font-size: 6pt; border-collapse: collapse; border: 0px solid black; margin-left: 325px; margin-top: 50px;">
<tr>
<td style=" width: 200px;text-align:center;  ">x100</br> 
</tr>
</table>

';

$html .= '<table style = " font-size: 6pt; border-collapse: collapse; border: 0px solid black; margin-left: -22px; margin-top: 0px;">

<tr>
<td > 
</br>
</br>
4. Every end of the month, the class adviser will submit this form to the office of the principal for recording of summary table into School <br> 
Form 4. Once signed by the principal, this form should be returned to the adviser. </br>
5. The adviser will provide neccessary interventions including but not limited to home visitation to learner/s who were absent for 5 </br>
consecutive days and/or those at risk of dropping out. </br>
6.  Attendance performance of learners will be reflected in Form 137 and Form 138 every grading period.


</td>

</tr>
</table>

';






$html .= '<table style = "width:159px; font-size: 5pt; border-collapse: collapse; border: 0px solid black; margin-top: 0px; margin-left: 470px; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">

<tr>
<td style=" width:160px; font-weight:bold; padding-top: 5px;" > 1. CODES FOR CHECKING ATTENDANCE</br> </br> </td>
</tr>
<tr>
<td style="text-align: center;">(blank) - Present; (x)- Absent; Tardy (half shaded= </br> Upper for Late Commer, Lower for Cutting Classes)</td>
</tr>
<tr>
<td style=" font-weight:bold;" > </br>  </br>  </br>2. REASONS/CAUSES FOR NLPA  </br> </br> </br></td>
</tr>

<tr>
<td style=" font-weight:bold;" > a. Domestic-Related Factors </br> </br></td>
</tr>

<tr>
<td> 
a.1. Had to take care of siblings </br>
a.2. Early marriage/pregnancy</br>
a.3. Parents&rsquo; attitude toward schooling</br>
a.4. Family problems 
</td>
</tr>

<tr>
<td style=" font-weight:bold;" > b. Individual-Related Factors </br> </br></td>
</tr>

<tr>
<td> 
b.1. Illness </br>
b.2. Overage </br>
b.3. Death </br>
b.4. Drug Abuse </br>
b.5. Poor academic performance </br>
b.6. Lack of interest/Distractions </br>
b.7. Hunger/Malnutrition </br>
</td>
</tr>

<tr>
<td style=" font-weight:bold;" > </br> c. School-Related Factors </br> </br></td>
</tr>

<tr>
<td> </br> 
c.1. Teacher Factor </br>
c.2. Physical condition of classroom </br>
c.3. Peer influence </br>  </br>  </br>  </br>  </br>
</td>
</tr>

<tr>
<td style=" font-weight:bold;" > </br> d. Geographic/Environmental </br> </br></td>
</tr>

<tr>
<td> 
d.1. Distance between home and school </br>
d.2. Armed conflict (incl. Tribal wars & clanfeuds) </br>
d.3. Calamities/Disasters </br> </br>
</td> 
</tr>

<tr>
<td style=" font-weight:bold;" > </br> </br> </br> e. Financial-Related  </br></td>
</tr>

<tr>
<td> 
e.1. Child labor, work </br> </br> </br> </br>
</td>
</tr>
<tr>
<td style=" font-weight:bold;" ></br> </br> f. Others (Specify) </br> </br> </br> </br> </td>
</tr>
</table>
';

$html .= '
<table style="font-size: 4.9pt; border-collapse: collapse;  margin-left: -22px;">

  <tr>
  <td style= " font-size: 6pt; width:207px;"></td>
  <td style= " font-size: 6pt; width:207px;"></td>
  <td style= " font-size: 6pt; width:63px;"></td>
    <td rowspan ="2" style= "width:153px; font-size: 4.9pt;  font-weight:bold; border-left: 1.3px solid black;  border-right: 1.3px solid black;" >1.CODES FOR CHECKING ATTENDANCE</td>
    <td rowspan ="5" style= "width: 93px;  font-weight:bold; font-size: 4.9pt; " ></td>
    <td rowspan ="1" style= "width:67px;  font-weight:bold;   border-right: 2px solid black; font-size: 5.5pt;" >Month</td>
    <td rowspan ="3" style= "width:80px; font-size: 5.5pt; font-weight:bold; text-align:center; border-right: 2px solid black; border-bottom: 2px solid black;">22 </td>
    <td  rowspan ="2" colspan ="3"  style= "text-align:center; height:10px; font-weight:bold; border-right: 2px solid black; border-bottom: 2px solid black;" >Summary </td>

  </tr>


  
  <tr>
  <td colspan="3" style= "text-align:center;  font-size: 5.5pt; width:287.7px;">  </td> 
    <td rowspan ="2" style= "vertical-align:top;  font-weight:bold;  border-right: 2px solid black; border-bottom: 2px solid black; font-size: 5.5pt">   May</td> 

  </tr>

  <tr>
  <td  colspan="3"style= "  font-size: 5.8pt; ">   1. The attendance shall be accomplished daily. Refer to the codes for checking learners&rsquo; attendance. </br> 2. Dates shall be written in the columns after Learner&rsquo;s Name. </br> 3. To compute the following:    </td> 
  <td  rowspan="1" style= "  font-size: 4.7pt; border-left: 1.3px solid black; text-align:center; border-right: 1.3px solid black;">(blank) - Present; (x)- Absent; Tardy (half shaded= </br>  Upper for Late Commer, Lower for Cutting Classes)</td> 
  <td rowspan ="1"style= "width:56.6px;   font-weight:bold; text-align:center;border-right: 2px solid black; border-bottom: 2px solid black;">M</td> 
  <td rowspan ="1"style= "width:56.6px;   font-weight:bold; text-align:center;border-right: 2px solid black; border-bottom: 2px solid black;">F</td> 
  <td rowspan ="1" style= "width:40px;   font-weight:bold; text-align:center;border-right: 2px solid black; border-bottom: 2px solid black;">TOTAL</td> 
</tr>



  <tr style= " font-size: 6pt;">
    <td colspan="3" style="text-align:center;"></td>
    <td style=" border-right: 1.3px solid black; border-left: 1.3px solid black;"></td>
    <td colspan="2" style= "  border-bottom: 1.3px solid black;  border-right: 1.3px solid black; height: 13px;"  >* Enrolment as of (1st Friday of August)</td>
    <td style= "Text-align:center; border: 1.3px solid black;"> 12</td>
    <td style= "Text-align:center; border: 1.3px solid black;"> 24</td>
    <td style= "Text-align:center; border: 1.3px solid black;"> 36</td>
  </tr>

  <tr style= " ">
    <td colspan="3"> </td>
    <td style= " font-size:  5pt;  width:153px;  font-weight:bold; border-left: 1.3px solid black;  border-right: 1.3px solid black;" >2.REASON/CAUSES FOR NLPA</td>
    <td></td>
    <td colspan="1" ></td>
    <td rowspan="4" style= "Text-align:center; font-size: 6pt; border: 1.3px solid black;"> 12</td>
    <td rowspan="4" style= "Text-align:center; font-size: 6pt; border: 1.3px solid black;"> 24</td>
    <td rowspan="4" style= "Text-align:center; font-size: 6pt; border: 1.3px solid black;"> 36</td>
  </tr>

<tr style= " ">
<td rowspan="2" style="padding-left: 25px; font-size: 5.5pt;">a. Percentage of enrolment = </td>
<td style="text-align:center;  border-bottom:1.3px solid black; font-size: 5.5pt;">Registered Learners as of end of the month</td>
<td style= " font-size: 5.5pt;">x100</td>

  <td style= "border-left: 1.3px solid black;  border-right: 1.3px solid black;" ></td>
  <td> </td>
  <td colspan="1" style="font-style: italic; width: 50px;">Late</td>
  <td rowspan="2" style="font-style: italic; padding-right: 10px; font-weight:bold; border-right: 1.3px solid black;">during the month</td>
</tr>

<tr style= " ">
<td style="text-align:center; font-size: 5.5pt;">Enrolment as of 1st Friday of the school year</td>
<td style= " font-size: 5.5pt;"></td>
<td style= " font-size:  5pt;font-weight:bold; border-left: 1.3px solid black;  border-right: 1.3px solid black;" >a.Domestic-related Factors</td>
<td></td>
<td colspan="2" style="font-style: italic;">enrolment</td>
</tr>

<tr style= " ">
<td rowspan="2" style="padding-left: 25px; font-size: 5.5pt;">b. Average Daily Attendance = </td>
<td style="text-align:center;  border-bottom:1.3px solid black; font-size: 5.5pt; ">Total Daily Attendance</td>
<td> </td>
<td rowspan="4"style= " font-size:  4.7pt;  border-left: 1.3px solid black;  border-right: 1.3px solid black;" >a.1. Had to take care of siblings </br> a.2. Early marriage/pregnancy </br> a.3. Parents attitude toward schooling </br> a.4. Family problems</br>  <span style="font-weight:bold;">b. Individual-Related Factors</span> </td>
<td></td>
<td colspan="2" rowspan="1"style="font-style: italic; border-bottom: 1.3px solid black;"> (beyond cut-off) </td>
</tr>

<tr style= " ">
<td style="text-align:center; font-size: 5.5pt;">Number of School Days in reporting month</td>
<td style= " font-size: 5.5pt;"></td>
<td style= " font-size: 5.5pt;"></td>
<td colspan="2" style="font-weight:bold; border-bottom: 1.3px solid black; font-size:3.9pt; font-style: italic; border-right: 1.3px solid black;">end of the month</td>
<td style="border-bottom: 1.3px solid black;border-right: 1.3px solid black; Text-align:center; font-size: 6pt;" >100</td>
<td style="border-bottom: 1.3px solid black;border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
</tr>

<tr style= " ">
<td rowspan="2" style="padding-left: 25px; font-size: 5.5pt;">C.Percentage of Attendance for the month =  </td>
<td style="text-align:center;  border-bottom:1px solid black; font-size: 5.5pt; ">Average daily attendance</td>
<td style= " font-size: 5.5pt;"> </td>
<td></td>
<td colspan="2" style=" border-right: 1.3px solid black; font-style: italic; ">Percentage of enrolment as of</td>
<td rowspan = "3" style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td rowspan = "3" style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td rowspan = "3" style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;" >100</td>
</tr>

<tr style= " ">
<td style="text-align:center; font-size: 5.5pt; ">Registered Learners as of end of the month</td>
<td style= " font-size: 5.5pt;"> x100</td>
<td ></td>
<td colspan ="2" style=" font-size:3.9pt;font-style: italic;   font-weight:bold;  border-right: 1.3px solid black; height:10px;">end of the month</td>
</tr>

<tr>
<td  ></td>
<td  ></td>
<td  > </td>
<td rowspan="5" style= " font-size:  4.7pt;  border-left: 1.3px solid black;  border-right: 1.3px solid black;" >
b.1. Illness </br> 
b.2. Overage</br> 
b.3. Death</br> 
b.4. Drug Abuse</br> 
b.5. Poor academic performance</br> 
b.6. Lack of Interest/Distractions</td>
<td   > </td>
<td    colspan ="2" style=" font-size:3.9pt;font-style: italic;   font-weight:bold; border-bottom: 1.3px solid black; border-right: 1.3px solid black;" > </td>
</tr>

<tr>
<td  rowspan =" 4" colspan ="3"   style=" font-size:5.9pt;">4. Every end of the month, the class adviser will submit this form to the office of the principal for recording of summary table into  School  </br>
Form 4. Once signed by the principal, this form should be returned to the adviser. </br>
5. The adviser will provide neccessary interventions including but not limited to home visitation to learner/s who were absent for 5 </br>
consecutive days and/or those at risk of dropping out.
</td>
<td>  </td>
<td rowspan="2" colspan="2" style=" font-size:5pt;font-style: italic; border-bottom: 1.3px solid black;  border-right: 1.3px solid black;"> Average Daily Attendance</td>
<td rowspan="2" style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td rowspan="2" style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td rowspan="2" style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;" >100</td>
</tr>
 
<tr>
</tr>

<tr>
<td> </td>
<td colspan ="2" style=" font-size:5pt; font-style: italic;   border-bottom: 1.3px solid black; border-right: 1.3px solid black;" > Percentage of Attendance for the month </td>
<td  style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td  style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td  style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;" >100</td>
</tr>

<tr>
<td> </td>
<td colspan ="2" style=" font-size:5pt; font-style: italic;   border-bottom: 1.3px solid black; border-right: 1.3px solid black;" >Number of student absent for 5 consecutive days</td>
<td  style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td  style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;">100</td>
<td  style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;" >100</td>
</tr>

<tr>
<td colspan ="3" > </td>
<td rowspan="3" style=" font-weight:bold; border-right: 1.3px solid black; border-left: 1.3px solid black;">
c.School Related Factors
</br>
</td>
<td rowspan="2" > </td>
<td rowspan ="2"  colspan ="2" style=" font-size:5pt; font-style: italic;   border-bottom: 1.3px solid black; border-right: 1.3px solid black; height:20px; background-color: #808080;" ></td>
<td rowspan ="2"  style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;  background-color: #808080;"></td>
<td  rowspan ="2" style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;  background-color: #808080;"></td>
<td  rowspan ="2"  style="border-bottom: 1.3px solid black; border-right: 1.3px solid black; Text-align:center; font-size: 6pt;  background-color: #808080;" ></td>
</tr>

<tr>
<td colspan ="3" > </td>
</tr>

<tr>
<td colspan ="3" ></td>
<td rowspan="3"style="border-left: 1.3px solid black;  " ></td>
<td   rowspan="3" colspan ="2" style="padding-left: 10px; border-bottom: 1.3px solid black;  border-right: 1.3px solid black; height:5px;">NLPA</td>
<td rowspan="3" style="text-align:center;    border-bottom: 1.3px solid black;  border-right: 1.3px solid black;"> P3</td>
<td rowspan="3" style="text-align:center;    border-bottom: 1.3px solid black;  border-right: 1.3px solid black;"> P3</td>
<td rowspan="3" style="text-align:center;    border-bottom: 1.3px solid black;  border-right: 1.3px solid black;"> P5</td>
</tr>

<tr>
<td colspan ="3" > </td>
<td style="border-left: 1.3px solid black;  border-right: 1.3px solid black;"> </br>
c.1. Teacher Factor</br>
c.2. Physical condition of classroom </br>
c.3. Peer Influence 
</td>
</tr>

<tr>
<td colspan ="3" > </td>
<td style="border-left: 1.3px solid black;  border-right: 1.3px solid black;"></td>
</tr>

<tr>
<td colspan ="3" > </td>
<td rowspan="2" style="VERTICAL-ALIGN:BOTTOM; border-left: 1.3px solid black;  border-right: 1.3px solid black;" > d. Geograpical/Environmental</br></td>
<td rowspan="2" > </td>
<td rowspan="2" colspan="2" style="padding-left: 10px; border-bottom: 1.3px solid black;  border-right: 1.3px solid black; height:35px;" >Transferred Out </td>
<td rowspan="2" style=" text-align:center; border-bottom: 1.3px solid black;  border-right: 1.3px solid black;">3b </td>
<td rowspan="2" style="text-align:center; border-bottom: 1.3px solid black;  border-right: 1.3px solid black;" >3c </td>
<td rowspan="2" style="text-align:center; border-bottom: 1.3px solid black;  border-right: 1.3px solid black;" >3c </td>
</tr>

<tr>
<td colspan ="3" ></td>
</tr>

<tr>
<td colspan ="3" > </td>
<td rowspan="1" style="border-left: 1.3px solid black;  border-right: 1.3px solid black;">
</br>
d.1. Distance between home and school </br>
d.2. Armed conflict (incl. Tribal wars and clanfeuds) </br>
d.3. Clamities/Disaster
<td></td>
<td rowspan="1" colspan="2" style=" padding-left: 10px; border-bottom: 1.3px solid black;  border-right: 1.3px solid black; height:35px; " >Transferred In </td>
<td rowspan="1" style=" text-align:center;border-bottom: 1.3px solid black;  border-right: 1.3px solid black;">3b </td>
<td rowspan="1" style=" text-align:center;border-bottom: 1.3px solid black;  border-right: 1.3px solid black;" >3c </td>
<td rowspan="1" style=" text-align:center; border-bottom: 1.3px solid black;  border-right: 1.3px solid black;" >3c </td>
</td>

</tr>

<tr>
<td rowspan="1"colspan ="3" > </td>
<td style=" text-align:center; border-left: 1.3px solid black;  border-right: 1.3px solid black;" ></td>
<td ></td>
<td colspan="2" style="padding-left: 10px; border-bottom: 1.3px solid black;  border-right: 1.3px solid black; height: 10px;" >Shifted Out</td>
<td style=" text-align:center; border-bottom: 1.3px solid black;  border-right: 1.3px solid black;" >33</td>
<td style=" text-align:center; border-bottom: 1.3px solid black;  border-right: 1.3px solid black;" >33</td>
<td style=" text-align:center; border-bottom: 1.3px solid black;  border-right: 1.3px solid black;" >33</td>
</tr>



<tr>
  <td colspan ="3" ></td>
  <td rowspan="4" style=" border-left: 1.3px solid black;  border-right: 1.3px solid black; " > </br> e.Financial-Related </br> </br> e.1. Child labor, work</td>
  <td  rowspan="4" ></td>
  <td   rowspan="4" colspan ="2" style="padding-left: 10px; border-bottom: 1.3px solid black;  border-right: 1.3px solid black; height:35px;">Shifted In </td>
  <td rowspan="4" style="text-align:center;    border-bottom: 1.3px solid black;  border-right: 1.3px solid black;"> P3</td>
  <td rowspan="4" style="text-align:center;    border-bottom: 1.3px solid black;  border-right: 1.3px solid black;"> P3</td>
  <td rowspan="4" style="text-align:center;    border-bottom: 1.3px solid black;  border-right: 1.3px solid black;"> P5</td>
</tr>

<tr>
  </tr>
  <tr>
  </tr>
  <tr>
</tr>

<tr>
<td colspan ="3" ></td>
<td   style="text-align:center;    border-left: 1.3px solid black;  border-right: 1.3px solid black;"   > </td>
<td    > </td>
<td style="text-align:center;   "  colspan="2"> </td>
<td style="text-align:center;   "  > </td>
<td style="text-align:center;   " > </td>
<td style=" text-align:center;    height:10px"> </td>
</tr>

<tr>
  <td colspan ="3" ></td>
  <td style="text-align:center;    border-left: 1.3px solid black;  border-right: 1.3px solid black; height:10px"   > </td>
  <td > </td>
  <td style="text-align:left; font-size:8pt; font-style:italic;"  colspan="3">I certify that this is a true and correct report.</td>
  <td > </td>
  <td > </td>
</tr>

<tr>
  <td colspan ="3" ></td>
  <td style="text-align:left; font-weight:bold;   border-left: 1.3px solid black;  border-bottom: 1.3px solid black;  border-right: 1.3px solid black; height:40px"   >f. Others (Specify) </br> </br></td>
  <td > </td>
  <td style="text-align:center; font-weight:bold; font-size:7.5pt;   "  colspan="5">
MARIA JiNCKY L. SUARNABA
</br> <span style=" font-size:5.5pt; font-weight:light;" > (Signature of Head over Printed Name)
</td>
</tr>
<tr>
  <td colspan="3" style="height:20px;"> </td>
  <td > </td>
  <td > </td>
</tr>

<tr>
  <td colspan="3" > </td>
  <td > </td>
  <td > </td>
  <td style=" font-style:italic; vertical-align: top; font-size:8pt;   " ">Attested by:</td>
  <td   style=" padding-right:65px; text-align:center; font-weight:bold; font-size:8pt;   "  colspan="4">
LORENA V. MIRANDA
  </br> <span style=" font-size:6pt; font-weight:light;" > (Signature of School Head over Printed Name)
  </td>
</tr>

</table>
';



$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream('my.pdf', array('Attachment' => 0));
