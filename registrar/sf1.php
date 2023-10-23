<?php
include("../config.php");
session_start();

require_once('../TCPDF/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', 'mm', 'A4');

$sections = "SELECT * FROM `section` ORDER BY `name` ASC";
$result = mysqli_query($conn, $sections);

while ($row = mysqli_fetch_assoc($result)) {
  // set document information
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);

  // add a page
  $pdf->AddPage();
  $pdf->Image('../images/sf_logo.gif', 6, 4, 21.9, 23.0);
  $pdf->Image('../images/sf_logo2.png', 264, 5, 20.7, 12.0);
  $pdf->Image('../images/gender.jpg', 78, 41.5, 2, 7);
  $pdf->SetFont('helvetica', 'B', 15);
  $pdf->Text(65, 5, ' School Form 1 School Register for Senior High School (SF1-SHS) ');

  $pdf->SetFont('helvetica', 'B', 5);
  $pdf->Text(46.5, 43, "NAME");
  $pdf->Text(25.7, 45, "(Last Name, First Name, Name Extension, Middle Name)");

  $pdf->Text(85, 44.5, "BIRTH DATE");
  $pdf->Text(84.5, 46.5, "(mm/dd/yyyy)");
  $pdf->SetFont('helvetica', 'B', 4);

  $pdf->Text(186.5, 45, "Father's Name (Last ");
  $pdf->Text(184.5,  47, "Name, First Name, Middle)");
  $pdf->Text(191.5, 49, "Name)");

  $pdf->Text(272.5, 46, '(Please refer to the');
  $pdf->Text(271.5, 48, 'legend on the last page)');
  $pdf->Text(262, 43.5, 'Learning');
  $pdf->Text(262, 45.5, 'Modality');
  $pdf->Text(252.5, 41.5, 'Contact');
  $pdf->Text(251.5, 43.5, 'Number of');
  $pdf->Text(252, 45.5, 'Parent or');
  $pdf->Text(252, 47.5, 'Guardian');
  $pdf->Text(231, 38.5, 'GUARDIAN');
  $pdf->Text(223, 40.5, '(if learner is not Living with Parent)');
  $pdf->Text(226, 44, 'Name');
  $pdf->Text(219, 46, '(Last Name, First Name,');
  $pdf->Text(221.5, 48, 'Extension Name,');
  $pdf->Text(225, 50, 'Middle)');
  $pdf->Text(205, 44, "Mother's Maiden");
  $pdf->Text(204.5, 46, 'Name (Last Name,');
  $pdf->Text(204, 48, ' First Name, Middle');
  $pdf->Text(208, 50, ' Name)');
  /*-First Row-*/
  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(32, 21.8, 'School Name');

  $pdf->SetLineWidth(0.1);
  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(46, 20.5);
  $pdf->Cell(48.5, 5, 'Tagaytay City National High School-Integrated ', 1, 0, 'C', 0);

  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(34, 27.8, 'Semester');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(46, 26.5);
  $pdf->Cell(48.5, 5, $row["semester"], 1, 0, 'C', 0);

  $pdf->SetLineWidth(0.1);
  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(37.5, 33.8, 'Section');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(46, 32.5);
  $pdf->Cell(48.5, 5, $row["name"], 1, 0, 'C', 0);

  /*-Second Row-*/
  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(103, 21.8, 'School ID');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(114, 20.5);
  $pdf->Cell(20, 5, '301216 ', 1, 0, 'C', 0);

  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(101, 27.5, 'School Year');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(114, 26.5);
  $pdf->Cell(20, 5, $row["start_year"] . " - " . $row["end_year"], 1, 0, 'C', 0);

  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(101, 33.8, 'Course(for TVL only) ');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(123, 32.5);
  if ($row["track"] == "Technical-Vocational-Livelihood") {
    $pdf->Cell(60, 5, $row["strand"], 1, 0, 'C', 0);
  } else {
    $pdf->Cell(60, 5, '', 1, 0, 'C', 0);
  }

  /*-Third row-*/

  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(146, 21.8, 'District');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(154, 20.5);
  $pdf->Cell(29, 5, 'Tagaytay City  ', 1, 0, 'C', 0);

  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(147, 27.8, 'Grade Level');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(160, 26.5);
  $pdf->Cell(23, 5, "Grade " . $row["grade"], 1, 0, 'C', 0);

  /*-Fourth row-*/

  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(191, 21.8, 'Division');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(200, 20.5);
  $pdf->Cell(33, 5, 'Cavite', 1, 0, 'C', 0);

  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(192, 27.8, 'Track and strand');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(209, 26.5);
  if ($row["track"] == "Technical-Vocational-Livelihood") {
    $pdf->Cell(64.5, 5, $row["track"], 1, 0, 'C', 0);
  } elseif ($row["track"] == "Academic") {
    $pdf->Cell(64.5, 5, $row["track"] . " - " . $row["strand"], 1, 0, 'C', 0);
  }

  $pdf->SetFont('helvetica', '', 6);
  $pdf->Text(236, 21.8, 'Region');

  $pdf->SetFont('helvetica', '', 6);
  $pdf->SetXY(244, 20.5);
  $pdf->Cell(29.5, 5, 'Cavite', 1, 0, 'C', 0);


  $pdf->SetFont('helvetica', 'B', 5);
  $pdf->SetXY(5, 37.5);
  $pdf->Cell(16, 15, 'LRN', 1, 0, 'C', 0);
  $pdf->Cell(56, 15, '', 1, 0, 'C', 0);
  $pdf->Cell(4, 15, '', 1, 0, 'C', 0);
  $pdf->Cell(18, 15, '', 1, 0, 'C', 0);
  $pdf->SetFont('helvetica', 'B', 4);
  $pdf->MultiCell(5.5, 15, '           Age  as of October 31st           ', 1, 'C',);
  $pdf->SetFont('helvetica', 'B', 5);
  $pdf->SetXY(104.5, 37.5);
  $pdf->Cell(20, 15, 'Religious Affication', 1, 0, 'C', 0);
  $pdf->Cell(60, 6, 'COMPLETE ADDRESS', 1, 0, 'C', 0);
  $pdf->Cell(35, 6, 'Parents', 1, 0, 'C', 0);
  $pdf->Cell(32, 6, '', 1, 0, 'C', 0);
  $pdf->Cell(9, 15, '', 1, 0, 'C', 0);
  $pdf->Cell(10, 15, '', 1, 0, 'C', 0);
  $pdf->Cell(20, 6, 'Remarks', 1, 0, 'C', 0);

  $pdf->SetXY(124.5, 43.5);
  $pdf->SetFont('helvetica', 'B', 4);
  $pdf->Cell(20, 9, 'House#/ Street/ Sitio/ Purok', 1, 0, 'C', 0);
  $pdf->Cell(13, 9, 'Barangay', 1, 0, 'C', 0);
  $pdf->Cell(15, 9, 'Municipality/ City', 1, 0, 'C', 0);
  $pdf->Cell(12, 9, 'Province', 1, 0, 'C', 0);

  $pdf->SetXY(184.5, 43.5);
  $pdf->SetFont('helvetica', 'B', 4);
  $pdf->Cell(19, 9, "", 1, 0, 'C', 0);
  $pdf->Cell(16, 9, "", 1, 0, 'C', 0);
  $pdf->Cell(17, 9, "", 1, 0, 'C', 0);
  $pdf->Cell(15, 9, 'Relationship', 1, 0, 'C', 0);

  $pdf->SetXY(270.5, 43.5);
  $pdf->SetFont('helvetica', 'B', 4);
  $pdf->Cell(20, 9, '', 1, 1, 'C', 0);


  /*-TABLES-*/
  $pdf->ln(0);
  $pdf->SetFont('helvetica', '', 5);
  $html =
    '<table>';

  $section = $row["name"];
  $select_male = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'M' ORDER BY `name` ASC";
  $result_select_male = mysqli_query($conn, $select_male);
  foreach ($result_select_male as $emp) {
    $html .=
      '
  <tr nobr="true";>
    <td style="width:7.76%;" >' . $emp['lrn'] . '</td>
    <td style="width:27.2%">' . $emp['name'] . '</td>
    <td style="width:1.93%">' . $emp['sex'] . '</td>
    <td style="width:8.74%">' . $emp['birth_date'] . '</td>
    <td style="width:2.67%">' . $emp['age'] . '</td>
    <td style="width:9.7%">' . $emp['ra'] . '</td>
    <td style="width:9.72%">' . $emp['house_no'] . '</td>
    <td style="width:6.3%">' . $emp['barangay'] . '</td>
    <td style="width:7.3%">' . $emp['municipality'] . '</td>
    <td style="width:5.8%">' . $emp['province'] . '</td>
    <td style="width:9.25%">' . $emp['father'] . '</td>
    <td style="width:7.75%">' . $emp['mother'] . '</td>
    <td style="width:8.25%">' . $emp['guardian'] . '</td>
    <td style="width:7.3%">' . $emp['relationship'] . '</td>
    <td style="width:4.35%">' . $emp['contact'] . '</td>
    <td style="width:4.85%">' . $emp['lm'] . '</td>
    <td style="width: 9.73%">' . $emp['indicator'] . " " . $emp['ri'] . '</td>
  </tr>';
  }
  $html .= '
</table>
<style>
table {
	border-collapse: collapse;
	width: 100%;

  }
td{
	border: 0.4px solid black;
  height: 10px;
  text-align:center;
  white-space: nowrap;
  }

</style>
';
  //TOTAL MALE
  $select_total_male = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'M'";
  $result_total_male = mysqli_query($conn, $select_total_male);
  $row_total_male = mysqli_num_rows($result_total_male);

  $pdf->WriteHTMLCell(208, 0, 4, '', $html, 0, 1, 0, true, '', true);
  $pdf->SetX(5);
  $pdf->Cell(16, 5, $row_total_male, 1, 0, 'R', 0);
  $pdf->Cell(269.54, 5, '<=== TOTAL MALE', 1, 1, '', 0);

  $html =
    '<table>

 ';
  //FEMALE TABLE
  $select_female = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'F' ORDER BY `name` ASC";
  $result_select_female = mysqli_query($conn, $select_female);
  foreach ($result_select_female as $empf) {
    $html .=
      '
      <tr nobr="true";>
      <td style="width:7.76% nobr="true"" >' . $empf['lrn'] . '</td>
      <td style="width:27.2% nobr="true" ">' . $empf['name'] . '</td>
      <td style="width:1.93% nobr="true" ">' . $empf['sex'] . '</td>
      <td style="width:8.74% nobr="true" ">' . $empf['birth_date'] . '</td>
      <td style="width:2.67% nobr="true" ">' . $empf['age'] . '</td>
      <td style="width:9.7% nobr="true" ">' . $empf['ra'] . '</td>
      <td style="width:9.72% nobr="true" ">' . $empf['house_no'] . '</td>
      <td style="width:6.3% nobr="true" ">' . $empf['barangay'] . '</td>
      <td style="width:7.3% nobr="true" ">' . $empf['municipality'] . '</td>
      <td style="width:5.8% nobr="true" ">' . $empf['province'] . '</td>
      <td style="width:9.25% nobr="true" ">' . $empf['father'] . '</td>
      <td style="width:7.75%  nobr="true" ">' . $empf['mother'] . '</td>
      <td style="width:8.25% nobr="true" ">' . $empf['guardian'] . '</td>
      <td style="width:7.3% nobr="true" ">' . $empf['relationship'] . '</td>
      <td style="width:4.35% nobr="true" ">' . $empf['contact'] . '</td>
      <td style="width:4.85% nobr="true" ">' . $empf['lm'] . '</td>
      <td style="width: 9.73% nobr="true" ">' . $empf['indicator'] . " " . $empf['ri'] . " " . $empf['rid'] . '</td>
    </tr>';
  }
  $html .= '
</table>
<style>
table {
	border-collapse: collapse;
	width: 100%;
  }

td {
	border: 0.4px solid black;
  height: 10px;
  text-align:center;
  white-space: nowrap;
  }
</style>
';


  // TOTAL FEMALE
  $section = $row["name"];
  $select_total_female = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'F'";
  $result_total_female = mysqli_query($conn, $select_total_female);
  $row_total_female = mysqli_num_rows($result_total_female);

  $pdf->WriteHTMLCell(208, 0, 4, '', $html, 0, 1, 0, true, '', true);
  $pdf->SetX(5);
  $pdf->Cell(16, 5, $row_total_female, 1, 0, 'R', 0);
  $pdf->Cell(269.54, 5, '<=== TOTAL FEMALE', 1, 1, '', 0);


  //COMBINED
  $section = $row["name"];
  $select_combined = "SELECT * FROM `student` WHERE `section` = '$section'";
  $result_combined = mysqli_query($conn, $select_combined);
  $row_combined = mysqli_num_rows($result_combined);

  $pdf->SetX(5);
  $pdf->Cell(16, 5, $row_combined, 1, 0, 'R', 0);
  $pdf->Cell(269.54, 5, 'COMBINED', 1, 1, '', 0);

  $pdf->SetX(5.5);
  $pdf->SetFont('helvetica', 'B', 5);
  $pdf->Cell(268.5, 4, 'Legend: List and Code of Indicators under REMARKS column', 0, 1, 'L', 0);
  $pdf->SetFont('helvetica', 'B', 3);
  $pdf->SetX(5);
  $pdf->Cell(16, 4, 'Indicator', 1, 0, 'L', 0);
  $pdf->Cell(8, 4, 'Code', 1, 0, 'C', 0);
  $pdf->Cell(38, 4, 'Required Information', 1, 0, 'L', 0);
  $pdf->Cell(16, 4, 'Indicator', 1, 0, 'L', 0);
  $pdf->Cell(8, 4, 'Code', 1, 0, 'C', 0);
  $pdf->Cell(38, 4, 'Required Information', 1, 0, 'L', 0);

  $pdf->Cell(5, 4, '', 0, 0, 'L', 0);
  $pdf->Cell(11, 4, 'REGISTERED', 1, 0, 'L', 0);
  $pdf->Cell(14, 4, '', 1, 0, 'L', 0);
  $pdf->Cell(12, 4, '', 1, 0, 'L', 0);


  $pdf->SetFont('helvetica', 'B', 3);
  $pdf->Cell(18, 4, '', 0, 0, 'L', 0);

  $pdf->Cell(12, 1, 'Prepared by:', 0, 1, 'L', 0);


  $pdf->Ln(2.7);
  $pdf->SetX(5);
  $pdf->Cell(16, 2, 'Transferred Out', 'LR', 0, 'T', 0);
  $pdf->Cell(8, 2, 'T/O', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
  $pdf->Cell(16, 2, 'CCT Recipient', 'LR', 0, 'L', 0);
  $pdf->Cell(8, 2, 'CCT', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, 'CCT Control/reference number &', 'LR', 0, 'L', 0);
  $pdf->Cell(5, 4, '', 0, 0, 'L', 0);
  $pdf->Cell(11, 5, 'MALE', 1, 0, 'C', 0);
  $pdf->Cell(14, 5, $row_total_male, 1, 0, 'C', 0);
  $pdf->Cell(12, 5, '', 1, 0, 'L', 0);
  $pdf->Cell(18, 5, '', 0, 0, 'L', 0);
  $pdf->SetFont('helvetica', 'B', 3);
  $pdf->Cell(130, 0, '____________________________________________________________________' . $row['faculty'] . '_____________________________________________________________________________', 0, 1, 'L', 0);




  $pdf->Ln(-0.11111);
  $pdf->SetX(5);
  $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
  $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
  $pdf->Cell(16, 2, '', 'LR', 0, 'L', 0);
  $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, 'Effectivity Date', 'LR', 0, 'L', 0);
  $pdf->Cell(5, 4, '', 0, 0, 'L', 0);
  $pdf->Ln(3.8);
  $pdf->Cell(124);
  $pdf->Cell(11, 4, 'Female', 1, 0, 'C', 0);
  $pdf->Cell(14, 4, $row_total_female, 1, 0, 'C', 0);
  $pdf->Cell(12, 4, '', 1, 0, 'L', 0);
  $pdf->Cell(15, 5, '', 0, 0, 'L', 0);
  $pdf->Ln(-2);
  $pdf->Cell(208);
  $pdf->SetFont('helvetica', 'B', 4);
  $pdf->Cell(35, 2, '(Signature of Adviser over Printed Name)', 0, 1, 'L', 0);

  $pdf->SetFont('helvetica', 'B', 3);
  $pdf->Ln(-2.4);
  $pdf->SetX(5);
  $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
  $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, 'Name of the School, Date of 1st Attendance and ', 'LR', 0, 'L', 0);
  $pdf->Cell(16, 2, 'Balik Aral', 'LR', 0, 'L', 0);
  $pdf->Cell(8, 2, 'B/A', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, 'Name of school last attended & Year', 'LR', 0, 'L', 0);


  $pdf->Ln(6.4);
  $pdf->Cell(119);
  $pdf->Cell(5, 4, '', 0, 0, 'L', 0);
  $pdf->Cell(11, 5, 'TOTAL', 1, 0, 'C', 0);
  $pdf->Cell(14, 5, $row_combined, 1, 0, 'C', 0);
  $pdf->Cell(12, 5, '', 1, 0, 'L', 0);
  $pdf->Cell(19, 4, '', 0, 0, 'L', 0);
  $pdf->Cell(23, 5, $row["start_year"] . ' 12:00 AM', 1, 0, 'L', 0);
  $pdf->Cell(27, 4, '', 0, 0, 'L', 0);
  $pdf->Cell(23, 5, $row["end_year"] . ' 12:00 AM', 1, 0, 'L', 0);
  $pdf->Ln(-2.5);
  $pdf->Cell(179);
  $pdf->Cell(35, 2, 'Begining of the Semester Date:', 0, 0, 'L', 0);
  $pdf->Cell(15.5, 4, '', 0, 0, 'L', 0);
  $pdf->Cell(35, 2, 'End of the Semester Date:', 0, 1, 'L', 0);

  $pdf->Ln(-4.8);
  $pdf->SetX(5);
  $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
  $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, 'Date of Last Attendace if Transffered Out', 'LR', 0, 'L', 0);
  $pdf->Cell(16, 2, '', 'LR', 0, 'L', 0);
  $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
  $pdf->Cell(5, 4, '', 0, 1, 'L', 0);

  $pdf->Ln(-2.8);
  $pdf->SetX(5);
  $pdf->Cell(16, 2, 'Transffered In', 'LR', 0, 'T', 0);
  $pdf->Cell(8, 2, 'T/I', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
  $pdf->Cell(16, 2, 'Learner With', 'LR', 0, 'L', 0);
  $pdf->Cell(8, 2, 'LWE', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, 'Specify Exceptionality if the Learner', 'LR', 1, 'L', 0);

  $pdf->Ln(-.8);
  $pdf->SetX(5);
  $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
  $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
  $pdf->Cell(16, 2, 'Exceptionality', 'LR', 0, 'L', 0);
  $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LR', 1, 'L', 0);

  $pdf->Ln(-.8);
  $pdf->SetX(5);
  $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
  $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
  $pdf->Cell(16, 2, 'Accelerated', 'LR', 0, 'L', 0);
  $pdf->Cell(8, 2, 'ACL', 'LR', 0, 'C', 0);
  $pdf->Cell(38, 2, 'Specify Level & Effectivity Date', 'LR', 1, 'L', 0);

  $pdf->Ln(-1);
  $pdf->SetX(5);
  $pdf->Cell(16, 2, '', 'LBR', 0, 'T', 0);
  $pdf->Cell(8, 2, '', 'LBR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LBR', 0, 'L', 0);
  $pdf->Cell(16, 2, '', 'LBR', 0, 'L', 0);
  $pdf->Cell(8, 2, '', 'LBR', 0, 'C', 0);
  $pdf->Cell(38, 2, '', 'LBR', 1, 'L', 0);

  $pdf->Ln(1);
  $pdf->SetX(5);
  $pdf->SetFont('helvetica', '', 4);
  $pdf->Cell(38, 2, 'Generated on: ' . date("l") . ', June 20, 2023', 0, 1, 'L', 0);
}

/*

$pdf->SetFont('helvetica', 'B', 3);
$pdf->SetXY(91,157);
$pdf->Cell(38, 2, 'Effectivity Date', 'LR', 0, 'L', 0);

$pdf->SetXY(83,157);
$pdf->Cell(8, 2, '', 'LR', 0, 'L', 0);

$pdf->SetXY(67,157);
$pdf->Cell(16, 2, '', 'LR', 0, 'L', 0);

$pdf->SetXY(5,157);
$pdf->Cell(16, 2, '', 'LR', 0, 'L', 0);

$pdf->SetXY(21,157);
$pdf->Cell(8, 2, '', 'LR', 0, 'L', 0);
*/
//Close and output PDF document
$pdf->Output();
