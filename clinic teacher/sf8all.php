<?php
include("../config.php");
session_start();
require_once("../TCPDF/tcpdf.php");

// create new PDF document
$pdf = new TCPDF('P', 'mm', 'LETTER');
// set document information
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$sy = "SELECT * FROM school_year WHERE is_archived = 0";
$syResult = $conn->query($sy);
$syRow = $syResult->fetch_assoc();
$school_year_id = $syRow['id'];

$school = "SELECT * FROM school WHERE id = '1'";
$schoolResult = $conn->query($school);
$schoolRow = $schoolResult->fetch_assoc();

$sections = "SELECT * FROM `section` WHERE is_archived = 0 AND school_year_id = '$school_year_id'";
$result = mysqli_query($conn, $sections);
while ($row = mysqli_fetch_assoc($result)) {
    // add a page
    $pdf->AddPage();
    $pdf->Image('../images/sf_logo.gif', 7.5, 4.5, 19.9, 18.5);
    $pdf->Image('../images/sf_logo2.png', 176, 5.5, 31, 14.3);

    $pdf->SetFont('helvetica', 'B', 8.8);
    $pdf->Text(91.5, 5.5, 'Department of Education');

    $pdf->SetFont('helvetica', 'B', 6.2);
    $pdf->Text(75.3, 9.5, "School Form 8 Learner's Basic Health and Nutrition Report (student)");

    $pdf->SetFont('helvetica', 'I', 5.2);
    $pdf->Text(100, 13.5, "(For All Grade Levels)");

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(33.5, 21, 'School Name');
    /*-School Name'*/
    $pdf->SetFont('helvetica', '', 5);
    $pdf->SetXY(47.5, 20.2);
    $pdf->Cell(39, 4.5, $schoolRow['school_name'], 1, 0, 'C', 0);

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(19, 27, 'School ID');
    /*-School ID'*/
    $pdf->SetFont('helvetica', '', 6);
    $pdf->SetXY(29.5, 26.3);
    $pdf->Cell(18, 4.5, $schoolRow['school_id'], 1, 0, 'C', 0);

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(90, 21, 'District');
    /*-District*/
    $pdf->SetFont('helvetica', '', 6);
    $pdf->SetXY(98, 20.2);
    $pdf->Cell(23.5, 4.5, $schoolRow['school_district'], 1, 0, 'C', 0);

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(51.5, 27, 'Grade');
    /*-Grade*/
    $pdf->SetFont('helvetica', '', 6);
    $pdf->SetXY(59, 26.3);
    $pdf->Cell(12, 4.5, $row["grade"], 1, 0, 'C', 0);

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(78, 27, 'Section');
    /*-Section*/
    $pdf->SetFont('helvetica', '', 6);
    $pdf->SetXY(86.5, 26.3);
    $pdf->Cell(35, 4.5, $row["name"], 1, 0, 'C', 0);

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(129, 21, 'Division');
    /*-Division*/
    $pdf->SetFont('helvetica', '', 6);
    $pdf->SetXY(138, 20.2);
    $pdf->Cell(28, 4.5, $schoolRow['school_division'], 1, 0, 'C', 0);

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(124.2, 27, 'Track/Strand');
    /*-T&S*/
    $pdf->SetFont('helvetica', '', 5);
    $pdf->SetXY(138, 26.3);
    $pdf->Cell(28, 4.5, $row["track"], 1, 0, 'C', 0);

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(175, 21, 'Region');
    /*-Region*/
    $pdf->SetFont('helvetica', '', 6);
    $pdf->SetXY(183, 20.2);
    $pdf->Cell(26, 4.5, $schoolRow['school_region'], 1, 0, 'C', 0);

    $pdf->SetFont('helvetica', '', 6);
    $pdf->Text(170, 27, 'School Year');
    /*-School Year*/
    $pdf->SetFont('helvetica', '', 6);
    $pdf->SetXY(183, 26.3);
    $pdf->Cell(26, 4.5, $row['school_year'], 1, 1, 'C', 0);

    $pdf->ln(1);
    /*-TABLE HEADER-*/
    $pdf->SetFillColor(192);
    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->SetX(9);
    $pdf->Cell(5, 11.4, 'No.', 1, 0, 'C', 1);
    $pdf->Cell(15.5, 11.4, 'LRN', 1, 0, 'C', 1);
    $pdf->Cell(41.5, 11.4, '', 1, 0, 'C', 1);
    $pdf->Cell(15.5, 11.4, '', 1, 0, 'C', 1);
    $pdf->Cell(11.5, 11.4, 'Age', 1, 0, 'C', 1);
    $pdf->Cell(12, 11.4, '', 1, 0, 'C', 1);
    $pdf->Cell(11.5, 11.4, '', 1, 0, 'C', 1);
    $pdf->Cell(16.5, 11.4, '', 1, 0, 'C', 1);
    $pdf->Cell(28, 11.4, '', 1, 0, 'C', 1);
    $pdf->Cell(17, 11.4, '', 1, 0, 'C', 1);
    $pdf->Cell(26, 11.4, 'Remarks', 1, 0, 'C', 1);
    $pdf->SetXY(138, 35);
    $pdf->Cell(12, 8.2, '', 1, 0, 'C', 1);
    $pdf->Cell(16, 8.2, 'BMI Category', 1, 1, 'C', 1);

    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->SetFillColor(220);
    $pdf->Setx(9);
    $pdf->Cell(62, 3.2, '        MALE', 1, 0, 'L', 1);
    $pdf->Cell(15.5, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(11.5, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(12, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(11.5, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(16.5, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(28, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(17, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(26, 3.2, '', 1, 0, 'C', 1);



    $pdf->SetFont('helvetica', 'B', 5.8);


    $pdf->Text(41.3, 33.4, "Learner's Name");
    $pdf->SetFont('helvetica', '', 5.8);
    $pdf->Text(30, 35.9, "(Last Name, First Name, Name Extension,");
    $pdf->Text(43, 38.4, "Middle Name)");

    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->Text(73.5, 34.9, "Birthdate");
    $pdf->SetFont('helvetica', '', 5.8);
    $pdf->Text(70.5, 37.4, "(MM/DD/YYYY)");

    $pdf->SetFont('helvetica', 'B', 5.8);

    $pdf->Text(98, 36.35, 'Weight');
    $pdf->SetFont('helvetica', '', 5.8);
    $pdf->Text(105, 36.35, '(kg)');

    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->Text(111.5, 34.9, "Height");
    $pdf->SetFont('helvetica', '', 5.8);
    $pdf->Text(113, 37.4, "(m)");


    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->Text(125.5, 34.9, "Height²");
    $pdf->SetFont('helvetica', '', 5.8);
    $pdf->Text(127, 37.4, "(m²)");

    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->Text(142.5, 32, "Nutritional Status");


    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->Text(141.5, 36, "BMI");
    $pdf->SetFont('helvetica', '', 5.8);
    $pdf->Text(140, 39, "(kg/m²)");

    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->Text(166.5, 34.9, "Height for Age");
    $pdf->Text(171, 37.4, "(HFA)");

    $pdf->ln(9);
    $pdf->SetFont('helvetica', '', 5.8);

    //MALE TABLE
    $html = '<table>';
    $section = $row["name"];
    $select_male = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' ORDER BY `name` ASC";
    $result_select_male = mysqli_query($conn, $select_male);
    $select_male_count = $result_select_male->num_rows;
    $maleCount = 1;
    if ($select_male_count == 0) {
        $html .= '<tr >
    <td style="width:2.44%; nobr=true; text-align:center;"></td>
    <td style="width:7.5%; nobr=true; text-align:center;"></td>
    <td style="width:20.15%; nobr=true; text-align:center;"></td>
    <td style="width:7.52%; nobr=true; text-align:center;"></td>
    <td style="width:5.6%; nobr=true; text-align:center;"></td>
    <td style="width:5.8%; nobr=true; text-align:center;"></td>
    <td style="width:5.6%; nobr=true text-align:center;"></td>
    <td style="width:8%; nobr=true; text-align:center;"></td>
    <td style="width:5.84%; nobr=true; text-align:center;"></td>
    <td style="width:7.78%; nobr=true; text-align:center;"></td>
    <td style="width:8.25%; nobr=true; text-align:center;"></td>
    <td style="width:12.6%;  nobr=true; text-align:center;"></td>
    </tr>';
    } else {
        foreach ($result_select_male as $emp) {
            $html .= '<tr >
      <td style="width:2.44%; nobr=true; text-align:center;">' . $maleCount . '</td>
      <td style="width:7.5%; nobr=true; text-align:center;">' . $emp['lrn'] . '</td>
      <td style="width:20.15%; nobr=true; text-align:center;">' . $emp['name'] . '</td>
      <td style="width:7.52%; nobr=true; text-align:center;">' . $emp['birth_date'] . '</td>
      <td style="width:5.6%; nobr=true; text-align:center;">' . $emp['age'] . '</td>
      <td style="width:5.8%; nobr=true; text-align:center;">' . $emp['weight'] . '</td>
      <td style="width:5.6%; nobr=true text-align:center;">' . $emp['height'] . '</td>
      <td style="width:8%; nobr=true; text-align:center;">' . $emp['height2'] . '</td>
      <td style="width:5.84%; nobr=true; text-align:center;">' . $emp["bmi"] . '</td>
      <td style="width:7.78%; nobr=true; text-align:center;">' . $emp["bmi_category"] . '</td>
      <td style="width:8.25%; nobr=true; text-align:center;">' . $emp['hfa_category'] . '</td>
      <td style="width:12.6%;  nobr=true; text-align:center;">' . $emp['sf8_remarks'] . '</td>
      </tr>';
            $maleCount++;
        }
    }

    $html .= '
</table>
<style>
table {
	border-collapse: collapse;
	width: 100%;
    padding:2px;
  }

td {
	border: .6px solid black;
    height:7px;
    padding:2px;
  }
</style>
';
    $pdf->WriteHTMLCell(208, 0, 8, '', $html, 0, 1, 0, true, '', true);
    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->SetFillColor(220);
    $pdf->Setx(9);
    $pdf->Cell(62, 3.2, '        FEMALE', 1, 0, 'L', 1);
    $pdf->Cell(15.5, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(11.5, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(12, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(11.5, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(16.5, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(28, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(17, 3.2, '', 1, 0, 'C', 1);
    $pdf->Cell(26, 3.2, '', 1, 1, 'C', 1);
    $pdf->SetFont('helvetica', '', 5.8);

    //FEMALE TALBE
    $html = '<table>';
    $select_female = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' ORDER BY `name` ASC";
    $result_select_female = mysqli_query($conn, $select_female);
    $femaleCount = 1;
    if ($result_select_female->num_rows == 0) {
        $html .= '<tr>
        <td style="width:2.44%; nobr=true; text-align:center;"></td>
        <td style="width:7.5%; nobr=true; text-align:center;"></td>
        <td style="width:20.15%; nobr=true; text-align:center;"></td>
        <td style="width:7.52%; nobr=true; text-align:center;"></td>
        <td style="width:5.6%; nobr=true; text-align:center;"></td>
        <td style="width:5.8%; nobr=true; text-align:center;"></td>
        <td style="width:5.6%; nobr=true text-align:center;"></td>
        <td style="width:8%; nobr=true; text-align:center;"></td>
        <td style="width:5.84%; nobr=true; text-align:center;"></td>
        <td style="width:7.78%; nobr=true; text-align:center;"></td>
        <td style="width:8.25%; nobr=true; text-align:center;"></td>
        <td style="width:12.6%;  nobr=true; text-align:center;"></td>
  </tr>';
    } else {
        foreach ($result_select_female as $empf) {
            $html .= '<tr>
          <td style="width:2.44%; nobr=true; text-align:center;">' . $femaleCount . '</td>
          <td style="width:7.5%; nobr=true; text-align:center;">' . $empf['lrn'] . '</td>
          <td style="width:20.15%; nobr=true; text-align:center;">' . $empf['name'] . '</td>
          <td style="width:7.52%; nobr=true; text-align:center;">' . $empf['birth_date'] . '</td>
          <td style="width:5.6%; nobr=true; text-align:center;">' . $empf['age'] . '</td>
          <td style="width:5.8%; nobr=true; text-align:center;">' . $empf['weight'] . '</td>
          <td style="width:5.6%; nobr=true text-align:center;">' . $empf['height'] . '</td>
          <td style="width:8%; nobr=true; text-align:center;">' . $empf['height2'] . '</td>
          <td style="width:5.84%; nobr=true; text-align:center;">' . $empf["bmi"] . '</td>
          <td style="width:7.78%; nobr=true; text-align:center;">' . $empf["bmi_category"] . '</td>
          <td style="width:8.25%; nobr=true; text-align:center;">' . $empf["hfa_category"] . '</td>
          <td style="width:12.6%;  nobr=true; text-align:center;">' . $emp['sf8_remarks'] . '</td>
    </tr>';
            $femaleCount++;
        }
    }

    $html .= '
</table>
<style>
table {
	border-collapse: collapse;
	width: 100%;
    padding:2px;
  }

td {
	border: .6px solid black;
    height:7px;
    padding:2px;
  }
</style>
';
    $pdf->WriteHTMLCell(208, 0, 8, '', $html, 0, 1, 0, true, '', true);
    $pdf->ln(4);
    $pdf->SetFont('helvetica', 'B', 7.5);
    $pdf->Cell(200, 6.4, 'SUMMARY TABLE', 0, 0, 'C', 0);

    /*-TABLE HEADER-*/
    $pdf->ln(6.5);
    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->SetX(9);
    $pdf->Cell(20.5, 6.4, '', 1, 0, 'C', 0);
    $pdf->Cell(80.5, 6.4, '', 1, 0, 'C', 0);
    $pdf->Cell(99, 6.4, '', 1, 0, 'C', 0);

    $pdf->ln(0.0000001);
    $pdf->SetX(9);
    $pdf->Cell(20.5, 6.4, 'Sex', 'LR', 0, 'C', 0);
    $pdf->Cell(80.5, 3.2, 'Nutritional Status', 1, 0, 'C', 0);
    $pdf->Cell(99, 3.2, 'Height for Age(HFA)', 1, 1, 'C', 0);
    $pdf->ln(0.00000001);
    $pdf->SetX(29.5);
    $pdf->Cell(18, 3.2, 'Severely Wasted', 1, 0, 'C', 0);
    $pdf->Cell(11.5, 3.2, 'Wasted', 1, 0, 'C', 0);
    $pdf->Cell(11.5, 3.2, 'Normal', 1, 0, 'C', 0);
    $pdf->Cell(16.5, 3.2, 'Overweight', 1, 0, 'C', 0);
    $pdf->Cell(11.5, 3.2, 'Obese', 1, 0, 'C', 0);
    $pdf->Cell(11.5, 3.2, 'Total', 1, 0, 'C', 0);
    $pdf->Cell(28, 3.2, 'Severely Stunted', 1, 0, 'C', 0);
    $pdf->Cell(12, 3.2, 'Stunted', 1, 0, 'C', 0);
    $pdf->Cell(16, 3.2, 'Normal', 1, 0, 'C', 0);
    $pdf->Cell(17, 3.2, 'Tall', 1, 0, 'C', 0);
    $pdf->Cell(26, 3.2, 'Total', 1, 1, 'C', 0);

    $pdf->SetFont('helvetica', 'B', 5.8);
    $pdf->SetFillColor(176, 207, 165);
    $pdf->Setx(9);
    $pdf->Cell(20.5, 3.2, '        MALE', 1, 0, 'L', 1);

    //SEVERELY WASTED
    $severelyWasted = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `bmi_category` = 'Severely wasted'";
    $severelyWastedResult = mysqli_query($conn, $severelyWasted);
    $severelyWastedCount = mysqli_num_rows($severelyWastedResult);
    $pdf->Cell(18, 3.2, $severelyWastedCount, 1, 0, 'C', 0);

    //WASTED
    $wasted = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `bmi_category` = 'Wasted'";
    $wastedResult = mysqli_query($conn, $wasted);
    $wastedCount = mysqli_num_rows($wastedResult);
    $pdf->Cell(11.5, 3.2, $wastedCount, 1, 0, 'C', 0);

    //NORMAL
    $normal = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `bmi_category` = 'Normal'";
    $normalResult = mysqli_query($conn, $normal);
    $normalCount = mysqli_num_rows($normalResult);
    $pdf->Cell(11.5, 3.2, $normalCount, 1, 0, 'C', 0);

    //OVERWEIGHT
    $overweight = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `bmi_category` = 'Overweight'";
    $overweightResult = mysqli_query($conn, $overweight);
    $overweightCount = mysqli_num_rows($overweightResult);
    $pdf->Cell(16.5, 3.2, $overweightCount, 1, 0, 'C', 0);

    //OBESE
    $obese = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `bmi_category` = 'Obese'";
    $obeseResult = mysqli_query($conn, $obese);
    $obeseCount = mysqli_num_rows($obeseResult);
    $pdf->Cell(11.5, 3.2, $obeseCount, 1, 0, 'C', 0);

    $totalM = $severelyWastedCount + $wastedCount + $normalCount + $overweightCount + $obeseCount;
    $pdf->Cell(11.5, 3.2, $totalM, 1, 0, 'C', 0);

    //SEVERELY STUNTED
    $severelyStunted = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `hfa_category` = 'Severely stunted'";
    $severelyStuntedResult = mysqli_query($conn, $severelyStunted);
    $severelyStuntedCount = mysqli_num_rows($severelyStuntedResult);
    $pdf->Cell(28, 3.2, $severelyStuntedCount, 1, 0, 'C', 0);

    //STUNTED
    $stunted = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `hfa_category` = 'Stunted'";
    $stuntedResult = mysqli_query($conn, $stunted);
    $stuntedCount = mysqli_num_rows($stuntedResult);
    $pdf->Cell(12, 3.2,  $stuntedCount, 1, 0, 'C', 0);

    //NORMAL
    $normalHfa = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `hfa_category` = 'Normal'";
    $normalHfaResult = mysqli_query($conn, $normalHfa);
    $normalHfaCount = mysqli_num_rows($normalHfaResult);
    $pdf->Cell(16, 3.2, $normalHfaCount, 1, 0, 'C', 0);

    //TALL
    $tall = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'M' AND `hfa_category` = 'Tall'";
    $tallResult = mysqli_query($conn, $tall);
    $tallCount = mysqli_num_rows($tallResult);
    $pdf->Cell(17, 3.2, $tallCount, 1, 0, 'C', 0);

    $totalMHfa = $tallCount + $normalHfaCount + $stuntedCount + $severelyStuntedCount;
    $pdf->Cell(26, 3.2, $totalMHfa, 1, 1, 'C', 0);

    $pdf->Setx(9);
    $pdf->Cell(20.5, 3.2, '      FEMALE', 1, 0, 'L', 1);

    //SEVERELY WASTED
    $severelyWastedf = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `bmi_category` = 'Severely wasted'";
    $severelyWastedResultf = mysqli_query($conn, $severelyWastedf);
    $severelyWastedCountf = mysqli_num_rows($severelyWastedResultf);
    $pdf->Cell(18, 3.2, $severelyWastedCountf, 1, 0, 'C', 0);

    //WASTED
    $wastedf = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `bmi_category` = 'Wasted'";
    $wastedResultf = mysqli_query($conn, $wastedf);
    $wastedCountf = mysqli_num_rows($wastedResultf);
    $pdf->Cell(11.5, 3.2, $wastedCountf, 1, 0, 'C', 0);

    //NORMAL
    $normalf = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `bmi_category` = 'Normal'";
    $normalResultf = mysqli_query($conn, $normalf);
    $normalCountf = mysqli_num_rows($normalResultf);
    $pdf->Cell(11.5, 3.2, $normalCountf, 1, 0, 'C', 0);

    //OVERWEIGHT
    $overweightf = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `bmi_category` = 'Overweight'";
    $overweightResultf = mysqli_query($conn, $overweightf);
    $overweightCountf = mysqli_num_rows($overweightResultf);
    $pdf->Cell(16.5, 3.2, $overweightCountf, 1, 0, 'C', 0);

    //OBESE
    $obesef = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `bmi_category` = 'Obese'";
    $obeseResultf = mysqli_query($conn, $obesef);
    $obeseCountf = mysqli_num_rows($obeseResultf);
    $pdf->Cell(11.5, 3.2, $obeseCountf, 1, 0, 'C', 0);

    $totalF = $severelyWastedCountf + $wastedCountf + $normalCountf + $overweightCountf + $obeseCountf;
    $pdf->Cell(11.5, 3.2, $totalF, 1, 0, 'C', 0);

    //SEVERELY STUNTED
    $severelyStuntedF = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `hfa_category` = 'Severely stunted'";
    $severelyStuntedResultF = mysqli_query($conn, $severelyStuntedF);
    $severelyStuntedCountF = mysqli_num_rows($severelyStuntedResultF);
    $pdf->Cell(28, 3.2, $severelyStuntedCountF, 1, 0, 'C', 0);

    //STUNTED
    $stuntedF = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `hfa_category` = 'Stunted'";
    $stuntedResultF = mysqli_query($conn, $stuntedF);
    $stuntedCountF = mysqli_num_rows($stuntedResultF);
    $pdf->Cell(12, 3.2,  $stuntedCountF, 1, 0, 'C', 0);

    //NORMAL
    $normalHfaF = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `hfa_category` = 'Normal'";
    $normalHfaResultF = mysqli_query($conn, $normalHfaF);
    $normalHfaCountF = mysqli_num_rows($normalHfaResultF);
    $pdf->Cell(16, 3.2, $normalHfaCountF, 1, 0, 'C', 0);

    //TALL
    $tallF = "SELECT * FROM `student` WHERE `section` = '$section' AND is_archived = 0 AND `sex` = 'F' AND `hfa_category` = 'Tall'";
    $tallResultF = mysqli_query($conn, $tallF);
    $tallCountF = mysqli_num_rows($tallResultF);
    $pdf->Cell(17, 3.2, $tallCountF, 1, 0, 'C', 0);

    //TOTAL
    $totalMHfaF = $tallCountF + $normalHfaCountF + $stuntedCountF + $severelyStuntedCountF;
    $pdf->Cell(26, 3.2, $totalMHfaF, 1, 1, 'C', 0);

    $pdf->Setx(9);
    $pdf->Cell(20.5, 3.2, '        TOTAL', 1, 0, 'L', 1);

    $totalSeverelyWasted = $severelyWastedCount + $severelyWastedCountf;
    $pdf->Cell(18, 3.2, $totalSeverelyWasted, 1, 0, 'C', 0);

    $totalWasted = $wastedCount + $wastedCountf;
    $pdf->Cell(11.5, 3.2, $totalWasted, 1, 0, 'C', 0);

    $totalNormal = $normalCount + $normalCountf;
    $pdf->Cell(11.5, 3.2, $totalNormal, 1, 0, 'C', 0);

    $totalOverweight = $overweightCount + $overweightCountf;
    $pdf->Cell(16.5, 3.2, $totalOverweight, 1, 0, 'C', 0);

    $totalObese = $obeseCount + $obeseCountf;
    $pdf->Cell(11.5, 3.2, $totalObese, 1, 0, 'C', 0);
    $total = $totalM + $totalF;
    $pdf->Cell(11.5, 3.2, $total, 1, 0, 'C', 0);

    $totalSeverelyStunted = $severelyStuntedCount + $severelyStuntedCountF;
    $pdf->Cell(28, 3.2, $totalSeverelyStunted, 1, 0, 'C', 0);

    $totalStunted = $stuntedCount + $stuntedCountF;
    $pdf->Cell(12, 3.2, $totalStunted, 1, 0, 'C', 0);

    $totalNormalHFA = $normalHfaCount + $normalHfaCountF;
    $pdf->Cell(16, 3.2, $totalNormalHFA, 1, 0, 'C', 0);

    $totalTall = $tallCount + $tallCountF;
    $pdf->Cell(17, 3.2, $totalTall, 1, 0, 'C', 0);

    $totalHFA = $totalMHfa + $totalMHfaF;
    $pdf->Cell(26, 3.2, $totalHFA, 1, 1, 'C', 0);


    $pdf->SetFont('helvetica', '', 5.8);
    $pdf->Setx(9);
    $pdf->Cell(20.5, 3.2, '', 0, 1, 'L', 0);
    $pdf->Setx(9);
    $pdf->Cell(20.5, 3.2, 'Date of Assessment', 0, 0, 'L', 0);
    $pdf->Cell(18, 3.2, '', 0, 0, 'C', 0);
    $pdf->Cell(33, 3.2, 'Conducted/Assessed By:', 0, 0, 'L', 0);
    $pdf->Cell(18, 3.2, '', 0, 0, 'C', 0);
    $pdf->Cell(19, 3.2, 'Certified Correct By:', 0, 0, 'C', 0);
    $pdf->Cell(5, 3.2, '', 0, 0, 'C', 0);
    $pdf->Cell(27, 3.2, '', 0, 0, 'C', 0);
    $pdf->Cell(20, 3.2, 'Reviewed By:', 0, 1, 'L', 0);

    $currentDate = new DateTime(); // Create a new DateTime object with the current date and time
    $formattedDate = $currentDate->format('l, d F Y'); // Format the date in the desired format

    $pdf->ln(2);
    $pdf->Setx(9);
    $pdf->Cell(32, 3.2, $formattedDate, 'B', 0, 'C', 0);
    $pdf->Cell(7, 3.2, '', 0, 0, 'C', 0);
    $pdf->Cell(39, 3.2, '', 'B', 0, 'C', 0);
    $pdf->Cell(11.5, 3.2, '', 0, 0, 'C', 0);
    $pdf->Cell(39.5, 3.2, '', 'B', 0, 'C', 0);
    $pdf->Cell(12, 3.2, '', 0, 0, 'C', 0);
    $pdf->Cell(59, 3.2, '', 'B', 0, 'C', 0);
}
$pdf->Output();
