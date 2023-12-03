<?php
include("../config.php");
session_start();
require_once('../TCPDF/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', 'mm', 'LETTER');
// set document information
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// add a page
$pdf->AddPage();

$id = $_GET["id"];
$student = "SELECT * FROM `student` WHERE `id` = '$id'";
$studentResult = mysqli_query($conn, $student);
$studentRow = mysqli_fetch_assoc($studentResult);

$section_name = $studentRow["section"];
$section = "SELECT * FROM `section` WHERE `name` = '$section_name'";
$sectionResult = mysqli_query($conn, $section);
$sectionRow = mysqli_fetch_assoc($sectionResult);

$adviserSection = $sectionRow['name'];
$adviser = "SELECT * FROM `user` WHERE `section` = '$adviserSection' AND `user_type` = 'adviser'";
$adviserResult = $conn->query($adviser);
$adviserRow = $adviserResult->fetch_assoc();

$school = "SELECT * FROM school WHERE id = '1'";
$schoolResult = $conn->query($school);
$schoolRow = $schoolResult->fetch_assoc();

//SF 10

// add a page
// $pdf->AddPage();

/*Header */
$pdf->SetLineWidth(.3);
$pdf->SetFont('helveticanarrowb', 'B', 7.4);
$pdf->SetXY(11, 6.3);
$pdf->Cell(13, 3.2, 'Page 2', 'B', 0, 0);
$pdf->Cell(180.5, 3.2, $studentRow["name"], 'B', 1, 1,);
$pdf->SetFont('helvetica', 'B', 6.3);
$pdf->SetXY(188, 6);
$pdf->Cell(0, 4, 'SF10-SHS', 0, 1, 1);

$pdf->ln(0.4);
$pdf->SetFont('helveticanarrowb', 'B', 7.4);
$pdf->SetLineWidth(0.1);
$pdf->SetX(11);
$pdf->Cell(12.5, 3, ' SCHOOL:', 0, 0, 0);
$pdf->Cell(68, 3, 'TAGAYTAY CITY NATIONAL HIGH SCHOOL - ISHS', 'B', 0, 'L',);
$pdf->Cell(15.5, 3, ' SCHOOL ID:', 0, 0, 0);
$pdf->Cell(20.5, 3, '301216', 'B', 0, 'C');
$pdf->Cell(18.5, 3, 'GRADE LEVEL:', 0, 0, 0);
$pdf->Cell(17, 3, $studentRow["grade"], 'B', 0, 'C');
$pdf->Cell(5.5, 3, 'SY:', 0, 0, 0);
$pdf->Cell(20, 3, $studentRow["school_year"], 'B', 0, 'C');
$pdf->Cell(7.5, 3, 'SEM:', 0, 0, 0);
$pdf->Cell(8.5, 3, '1ST', 'B', 1, 'C');
$pdf->SetLineWidth(0.1);
$pdf->SetX(11);
$pdf->Cell(19.5, 3, ' TRACK/STRAND:', 0, 0, 0);
$pdf->Cell(99.5, 3, $studentRow["track"] . " / " . $studentRow["strand"], 'B', 0, 'L',);
$pdf->Cell(15, 3, '    SECTION:', 0, 0, 0);
$pdf->Cell(59.5, 3, $studentRow["section"], 'B', 0, 'C');


$pdf->ln(4);
/*Header of tables*/
$pdf->SetX(11);
$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 0);
$pdf->Cell(193.5, 0.2, '', 1, 1, 'C', 1, 1);
$pdf->SetX(11);
$pdf->SetFont('unicodehelvetin', '', 7);
$pdf->Cell(.2, 8.5, '', 1, 0, 'C', 1, 1);
$pdf->SetFillColor(192);

$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(105.8, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(25.5, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(16, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(15.8, 8.5, '', 1, 0, 'C', 1);
$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 7.5);
$pdf->Cell(.2, 8.5, '', 1, 1, 'C', 1, 1);

$pdf->ln(-10);
$pdf->SetX(11);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'Indicate if Subject is CORE,', 0, 0, 'C', 0);

$pdf->ln(3);
$pdf->SetX(11);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'APPLIED, or SPECIALIZED', 0, 0, 'C', 0);

$pdf->ln(-1.5);
$pdf->SetX(78.1);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'SUBJECTS', 0, 0, 'C', 0);

$pdf->ln(0);
$pdf->SetX(147);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(25.5, 4.25, 'Quarter', 1, 0, 'C', 0);
$pdf->Cell(16, 5, 'SEM FINAL', 0, 0, 'C', 0);
$pdf->Cell(15.8, 5, 'ACTION', 0, 1, 'C', 0);
$pdf->ln(-0.76);
$pdf->SetX(147);
$pdf->Cell(12.75, 4.25, '1ST', 1, 0, 'C', 0);
$pdf->Cell(12.75, 4.25, '2ND', 1, 1, 'C', 0);

$pdf->ln(-5);
$pdf->SetX(174);
$pdf->Cell(12.8, 4.25, 'GRADE', 0, 0, 'C', 0);
$pdf->SetX(188.5);
$pdf->Cell(15.8, 4.25, 'TAKEN', 0, 1, 'C', 0);
$pdf->ln(0.7);

$studentName = $studentRow['name'];
$sf9 = "SELECT * FROM `sf9` WHERE `student_name` = '$studentName' AND `semester` = '1st' AND `subject_type` != '' AND `subject_title` != '' ORDER BY `subject_type`, `subject_title` ASC";
$sf9Result = $conn->query($sf9);
$sf9Count = $sf9Result->num_rows;
$finalGrade = 0;

if ($sf9Count === 0) {
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->SetX(11);
    $pdf->SetFillColor(0);
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->Cell(.2, 5, '', 1, 0, 'C', 1);
    $pdf->Cell(30, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(105.8, 5, '', 1, 0, 'L', 0);
    $pdf->Cell(12.75, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(12.75, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(15.8, 5, '', 1, 0, 'C', 0);
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->Cell(.2, 5, '', 1, 1, 'C', 1);
    $pdf->SetFillColor(0);
    $pdf->SetX(11);
    $pdf->SetFont('unicodehelvetin', '', 7.4);
    $pdf->Cell(.2, 4, '', 1, 0, 'C', 1);
    $pdf->SetFillColor(192);
} else {
    while ($sf9Row = $sf9Result->fetch_assoc()) {
        $finalGrade += (float) $sf9Row['final_grade'];
        /*1st Semester Table*/
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->SetX(11);
        $pdf->SetFillColor(0);
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->Cell(.2, 5, '', 1, 0, 'C', 1);
        $pdf->Cell(30, 5, $sf9Row['subject_type'], 1, 0, 'C', 0);
        $pdf->Cell(105.8, 5, $sf9Row['subject_title'], 1, 0, 'L', 0);
        $pdf->Cell(12.75, 5, $sf9Row['sem_grade1'], 1, 0, 'C', 0);
        $pdf->Cell(12.75, 5, $sf9Row['sem_grade2'], 1, 0, 'C', 0);
        $pdf->Cell(16, 5, $sf9Row['final_grade'], 1, 0, 'C', 0);
        if ($sf9Row['final_grade'] >= 75) {
            $pdf->Cell(15.8, 5, 'PASSED', 1, 0, 'C', 0);
        } else {
            $pdf->Cell(15.8, 5, 'FAILED', 1, 0, 'C', 0);
        }
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->Cell(.2, 5, '', 1, 1, 'C', 1);
        $pdf->SetFillColor(0);
        $pdf->SetX(11);
        $pdf->SetFont('unicodehelvetin', '', 7.4);
        $pdf->Cell(.2, 4, '', 1, 0, 'C', 1);
        $pdf->SetFillColor(192);
    }
}

$finalGradeAverage = $sf9Count > 0 ? $finalGrade / $sf9Count : 0;
$finalGradeRemarks = $finalGradeAverage >= 75 ? "PASSED" : "FAILED";
$pdf->SetFont('helveticanarrowb', '', 6.5);
$pdf->Cell(161.3, 4, 'General Ave. for the Semester:', 1, 0, 'R', 1);
$pdf->Cell(16, 4, round($finalGradeAverage), 1, 0, 'C', 0);
$pdf->Cell(15.8, 4, $finalGradeRemarks, 1, 0, 'C', 0);

$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 7.4);
$pdf->Cell(.2, 4, '', 1, 1, 'C', 1, 1);
$pdf->SetX(11);
$pdf->SetFont('unicodehelvetin', '', 0);
$pdf->Cell(193.5, 0.2, '', 1, 1, 'C', 1, 1);

$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(18, 4, 'REMARKS:', 0, 0, 'L');
$pdf->Cell(176.5, 4, '', 'B', 1, 'C', 0);

$currentDate = new DateTime();
$formattedDate = $currentDate->format("m/d/Y");
$pdf->Cell(65, 4, 'Prepared by:', 0, 0, 'L');
$pdf->Cell(87, 4, 'Certified True and Correct:', 0, 0, 'L');
$pdf->Cell(18, 4, 'Date Checked (MM/DD/YYYY):', 0, 1, 'L');
$pdf->Cell(18, 4, '', 0, 1, 'L');
$pdf->Cell(63, 4, $adviserRow['name'], 'B', 0, 'C');
$pdf->Cell(13, 4, '', 0, 0, 'L');
$pdf->Cell(65, 4, $schoolRow['school_head'] . ', ' . $schoolRow['schoolhead_designation'], 'B', 0, 'C');
$pdf->Cell(12, 4, '', 0, 0, 'L');
$pdf->Cell(41.5, 4, $formattedDate, 'B', 1, 'C');
$pdf->SetFont('unicodehelvetin', '', 7);
$pdf->Cell(63, 4, 'Signature of Adviser over Printed Name', 0, 0, 'C');
$pdf->Cell(13, 4, '', 0, 0, 'L');
$pdf->Cell(65, 4, 'Signature of Authorized Person over Printed Name, Designation', 0, 1, 'C');

$pdf->ln(-2);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(18, 0.001, '', 0, 1, 'L');
$remedialDate = "SELECT * FROM `sf10remedialDate` WHERE `student_name` = '$studentName'";
$remedialDateResult = $conn->query($remedialDate);
$remedialDateRow = $remedialDateResult->fetch_assoc();
$firstSem = $remedialDateRow['start_date1'];
$convertedFirstSem = strtotime($firstSem);
$firstSemDate = date("m/d/Y", $convertedFirstSem);

$firstSemEnd = $remedialDateRow['end_date1'];
$convertedFirstSemEnd = strtotime($firstSemEnd);
$firstSemDateEnd = date("m/d/Y", $convertedFirstSemEnd);
$pdf->Cell(57.5, 4, 'REMEDIAL CLASSES  Conducted from (MM/DD/YYYY):', 0, 0, 'L');
$pdf->Cell(13.5, 4, $firstSemDate, 'B', 0, 'C');
$pdf->Cell(17.5, 4, '(MM/DD/YYYY):', 0, 0, 'L');
$pdf->Cell(13.5, 4, $firstSemDateEnd, 'B', 0, 'C');
$pdf->Cell(1, 4, '', 0, 0, 'C');
$pdf->Cell(12, 4, 'SCHOOL:', 0, 0, 'L');
$pdf->Cell(53, 4, 'TAGAYTAY CITY NATIONAL HIGH SCHOOL - ISHS', 'B', 0, 'C');
$pdf->Cell(1, 4, '', 0, 0, 'C');
$pdf->Cell(14.5, 4, 'SCHOOL ID:', 0, 0, 'L');
$pdf->Cell(11, 4, '301216', 'B', 1, 'C');

/*Header of 2nd tables*/

$pdf->ln(0.5);
$pdf->SetX(11);
$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 0);
$pdf->Cell(193.5, 0.2, '', 1, 1, 'C', 1, 1);
$pdf->SetX(11);
$pdf->SetFont('unicodehelvetin', '', 7);
$pdf->Cell(.2, 8.5, '', 1, 0, 'C', 1, 1);
$pdf->SetFillColor(192);

$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(105.8, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(12.75, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(12.75, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(16, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(15.8, 8.5, '', 1, 0, 'C', 1);
$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 7.5);
$pdf->Cell(.2, 8.5, '', 1, 1, 'C', 1, 1);

$pdf->ln(-10);
$pdf->SetX(11);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'Indicate if Subject is CORE,', 0, 0, 'C', 0);

$pdf->ln(3);
$pdf->SetX(11);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'APPLIED, or SPECIALIZED', 0, 0, 'C', 0);

$pdf->ln(-1.5);
$pdf->SetX(78.1);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'SUBJECTS', 0, 0, 'C', 0);

$pdf->ln(1);
$pdf->SetX(147);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'SEM FINAL', 0, 0, 'C', 0);
$pdf->ln(2.5);
$pdf->SetX(147);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'GRADE', 0, 0, 'C', 0);

$pdf->ln(-4);
$pdf->SetX(160);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'REMEDIAL', 0, 0, 'C', 0);

$pdf->ln(2.5);
$pdf->SetX(160);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'CLASS', 0, 0, 'C', 0);

$pdf->ln(3);
$pdf->SetX(160);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'MARK', 0, 0, 'C', 0);

$pdf->ln(-4);
$pdf->SetX(174);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'RECOMPUTED', 0, 0, 'C', 0);
$pdf->SetX(189);
$pdf->Cell(15.8, 4.25, 'ACTION', 0, 0, 'C', 0);
$pdf->ln(3);
$pdf->SetX(174);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'FINAL GRADE', 0, 0, 'C', 0);
$pdf->SetX(189);
$pdf->Cell(15.8, 4.25, 'TAKEN', 0, 1, 'C', 0);

//REMEDIAL
$pdf->ln(0.4);
$studentName = $studentRow['name'];
$sf10Remedial = "SELECT * FROM `sf10remedial` WHERE `student_name` = '$studentName' AND `semester` = '1st' ORDER BY `subject_type` ASC";
$sf10ResultRemedial = $conn->query($sf10Remedial);
$sf10Count = $sf10ResultRemedial->num_rows;
if ($sf10Count === 0) {
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->SetX(11);
    $pdf->SetFillColor(0);
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->Cell(.2, 5, '', 1, 0, 'C', 1);
    $pdf->Cell(30, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(105.8, 5, '', 1, 0, 'L', 0);
    $pdf->Cell(12.75, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(12.75, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(15.8, 5, '', 1, 0, 'C', 0);
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->Cell(.2, 5, '', 1, 1, 'C', 1);
} else {
    while ($sf10RowRemedial = $sf10ResultRemedial->fetch_assoc()) {
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->SetX(11);
        $pdf->SetFillColor(0);
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->Cell(.2, 5, '', 1, 0, 'C', 1);
        $pdf->Cell(30, 5, $sf10RowRemedial['subject_type'], 1, 0, 'C', 0);
        $pdf->Cell(105.8, 5, $sf10RowRemedial['subject_title'], 1, 0, 'L', 0);
        $pdf->Cell(12.75, 5, $sf10RowRemedial['old_grade'], 1, 0, 'C', 0);
        $pdf->Cell(12.75, 5, $sf10RowRemedial['new_grade'], 1, 0, 'C', 0);
        $pdf->Cell(16, 5, $sf10RowRemedial['final_grade'], 1, 0, 'C', 0);
        $pdf->Cell(15.8, 5, $sf10RowRemedial['action'], 1, 0, 'C', 0);
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->Cell(.2, 5, '', 1, 1, 'C', 1);
    }
}

$pdf->SetFillColor(0);
$pdf->SetX(11);
$pdf->SetFont('unicodehelvetin', '', 0);
$pdf->Cell(193.5, 0.2, '', 1, 1, 'C', 1, 1);
$pdf->Cell(12, 2, '', 0, 1, 'L');


$pdf->SetFont('unicodehelvetin', '', 7);
$pdf->SetX(10);
$pdf->Cell(35, 3.5, ' Name of the Teacher/Adviser:', 0, 0, 'L', 0);
$pdf->Cell(103, 3.5, $adviserRow['name'], 'B', 0, 'L', 0);
$pdf->Cell(3, 2, '', 0, 0, 'L');
$pdf->Cell(11, 4.25, 'Signature:', 0, 0, 'L', 0);
$pdf->Cell(42.5, 4.25, '', 'B', 1, 'C', 0);
$pdf->Cell(3, 2, '', 0, 0, 'L');

//2ND SEM
$pdf->ln(0.4);
$pdf->SetFont('helveticanarrowb', 'B', 7.4);
$pdf->SetLineWidth(0.1);
$pdf->SetX(11);
$pdf->Cell(12.5, 3, ' SCHOOL:', 0, 0, 0);
$pdf->Cell(68, 3, 'TAGAYTAY CITY NATIONAL HIGH SCHOOL - ISHS', 'B', 0, 'L',);
$pdf->Cell(15.5, 3, ' SCHOOL ID:', 0, 0, 0);
$pdf->Cell(20.5, 3, '301216', 'B', 0, 'C');
$pdf->Cell(18.5, 3, 'GRADE LEVEL:', 0, 0, 0);
$pdf->Cell(17, 3, $studentRow["grade"], 'B', 0, 'C');
$pdf->Cell(5.5, 3, 'SY:', 0, 0, 0);
$pdf->Cell(20, 3, $studentRow["school_year"], 'B', 0, 'C');
$pdf->Cell(7.5, 3, 'SEM:', 0, 0, 0);
$pdf->Cell(8.5, 3, '2ND', 'B', 1, 'C');
$pdf->SetLineWidth(0.1);
$pdf->SetX(11);
$pdf->Cell(19.5, 3, ' TRACK/STRAND:', 0, 0, 0);
$pdf->Cell(99.5, 3, $studentRow["track"] . " / " . $studentRow["strand"], 'B', 0, 'L',);
$pdf->Cell(15, 3, '    SECTION:', 0, 0, 0);
$pdf->Cell(59.5, 3, $studentRow["section"], 'B', 0, 'C');


$pdf->ln(4);
/*Header of tables*/
$pdf->SetX(11);
$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 0);
$pdf->Cell(193.5, 0.2, '', 1, 1, 'C', 1, 1);
$pdf->SetX(11);
$pdf->SetFont('unicodehelvetin', '', 7);
$pdf->Cell(.2, 8.5, '', 1, 0, 'C', 1, 1);
$pdf->SetFillColor(192);

$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(105.8, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(25.5, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(16, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(15.8, 8.5, '', 1, 0, 'C', 1);
$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 7.5);
$pdf->Cell(.2, 8.5, '', 1, 1, 'C', 1, 1);

$pdf->ln(-10);
$pdf->SetX(11);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'Indicate if Subject is CORE,', 0, 0, 'C', 0);

$pdf->ln(3);
$pdf->SetX(11);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'APPLIED, or SPECIALIZED', 0, 0, 'C', 0);

$pdf->ln(-1.5);
$pdf->SetX(78.1);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'SUBJECTS', 0, 0, 'C', 0);

$pdf->ln(0);
$pdf->SetX(147);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(25.5, 4.25, 'Quarter', 1, 0, 'C', 0);
$pdf->Cell(16, 5, 'SEM FINAL', 0, 0, 'C', 0);
$pdf->Cell(15.8, 5, 'ACTION', 0, 1, 'C', 0);
$pdf->ln(-0.76);
$pdf->SetX(147);
$pdf->Cell(12.75, 4.25, '3RD', 1, 0, 'C', 0);
$pdf->Cell(12.75, 4.25, '4TH', 1, 1, 'C', 0);

$pdf->ln(-5);
$pdf->SetX(174);
$pdf->Cell(12.8, 4.25, 'GRADE', 0, 0, 'C', 0);
$pdf->SetX(188.5);
$pdf->Cell(15.8, 4.25, 'TAKEN', 0, 1, 'C', 0);

$studentName = $studentRow['name'];
$sf92 = "SELECT * FROM `sf9` WHERE `student_name` = '$studentName' AND `semester` = '2nd' AND `subject_type` != '' AND `subject_title` != '' ORDER BY `subject_type`, `subject_title` ASC";
$sf92Result = $conn->query($sf92);
$sf92Count = $sf92Result->num_rows;
$finalGrade2 = 0;
$pdf->ln(0.7);
/*2ND Semester Table*/
if ($sf92Count == 0) {
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->SetX(11);
    $pdf->SetFillColor(0);
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->Cell(.2, 5, '', 1, 0, 'C', 1);
    $pdf->Cell(30, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(105.8, 5, '', 1, 0, 'L', 0);
    $pdf->Cell(12.75, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(12.75, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(15.8, 5, '', 1, 0, 'C', 0);
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->Cell(.2, 5, '', 1, 1, 'C', 1);
} else {
    while ($sf92Row = $sf92Result->fetch_assoc()) {
        $finalGrade2 += (float) $sf92Row['final_grade'];
        $pdf->SetX(11);
        $pdf->SetFillColor(0);
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->Cell(.2, 5, '', 1, 0, 'C', 1);
        $pdf->Cell(30, 5, $sf92Row['subject_type'], 1, 0, 'C', 0);
        $pdf->Cell(105.8, 5, $sf92Row['subject_title'], 1, 0, 'L', 0);
        $pdf->Cell(12.75, 5, $sf92Row['sem_grade1'], 1, 0, 'C', 0);
        $pdf->Cell(12.75, 5, $sf92Row['sem_grade2'], 1, 0, 'C', 0);
        $pdf->Cell(16, 5, $sf92Row['final_grade'], 1, 0, 'C', 0);
        if ($sf92Row['final_grade'] >= 75) {
            $pdf->Cell(15.8, 5, 'PASSED', 1, 0, 'C', 0);
        } else {
            $pdf->Cell(15.8, 5, 'FAILED', 1, 0, 'C', 0);
        }
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->Cell(.2, 5, '', 1, 1, 'C', 1);
        $pdf->SetFillColor(0);
        $pdf->SetX(11);
        $pdf->SetFont('unicodehelvetin', '', 7.4);
        $pdf->Cell(.2, 4, '', 1, 0, 'C', 1);
        $pdf->SetFillColor(192);
    }
}

$finalGradeAverage2 = $sf92Count > 0 ? $finalGrade2 / $sf92Count : 0;
$finalGradeRemarks2 = $finalGradeAverage2 >= 75 ? "PASSED" : "FAILED";
$pdf->SetFont('helveticanarrowb', '', 6.5);
$pdf->Cell(161.3, 4, 'General Ave. for the Semester:', 1, 0, 'R', 1);
$pdf->Cell(16, 4, round($finalGradeAverage2), 1, 0, 'C', 0);
$pdf->Cell(15.8, 4, $finalGradeRemarks2, 1, 0, 'C', 0);

$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 7.4);
$pdf->Cell(.2, 4, '', 1, 1, 'C', 1, 1);
$pdf->SetX(11);
$pdf->SetFont('unicodehelvetin', '', 0);
$pdf->Cell(193.5, 0.2, '', 1, 1, 'C', 1, 1);

$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(18, 4, 'REMARKS:', 0, 0, 'L');
$pdf->Cell(176.5, 4, 'REMARKS', 'B', 1, 'C', 0);

$pdf->Cell(65, 4, 'Prepared by:', 0, 0, 'L');
$pdf->Cell(87, 4, 'Certified True and Correct:', 0, 0, 'L');
$pdf->Cell(18, 4, 'Date Checked (MM/DD/YYYY):', 0, 1, 'L');
$pdf->Cell(18, 4, '', 0, 1, 'L');
$pdf->Cell(63, 4, $adviserRow['name'], 'B', 0, 'C');
$pdf->Cell(13, 4, '', 0, 0, 'L');
$pdf->Cell(65, 4, $schoolRow['school_head'] . ', ' . $schoolRow['schoolhead_designation'], 'B', 0, 'C');
$pdf->Cell(12, 4, '', 0, 0, 'L');
$pdf->Cell(41.5, 4, $formattedDate, 'B', 1, 'C');
$pdf->SetFont('unicodehelvetin', '', 7);
$pdf->Cell(63, 4, 'Signature of Adviser over Printed Name', 0, 0, 'C');
$pdf->Cell(13, 4, '', 0, 0, 'L');
$pdf->Cell(65, 4, 'Signature of Authorized Person over Printed Name, Designation', 0, 1, 'C');

$pdf->ln(-2);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(18, 0.001, '', 0, 1, 'L');
$secondSem = $remedialDateRow['start_date2'];
$convertedSecondSem = strtotime($secondSem);
$secondSemDate = date("m/d/Y", $convertedSecondSem);

$secondSemEnd = $remedialDateRow['end_date2'];
$convertedSecondSemEnd = strtotime($secondSemEnd);
$secondSemDateEnd = date("m/d/Y", $convertedSecondSemEnd);
$pdf->Cell(57.5, 4, 'REMEDIAL CLASSES  Conducted from (MM/DD/YYYY):', 0, 0, 'L');
$pdf->Cell(13.5, 4, $secondSemDate, 'B', 0, 'C');
$pdf->Cell(17.5, 4, '(MM/DD/YYYY):', 0, 0, 'L');
$pdf->Cell(13.5, 4, $secondSemDateEnd, 'B', 0, 'C');
$pdf->Cell(1, 4, '', 0, 0, 'C');
$pdf->Cell(12, 4, 'SCHOOL:', 0, 0, 'L');
$pdf->Cell(53, 4, 'TAGAYTAY CITY NATIONAL HIGH SCHOOL - ISHS', 'B', 0, 'C');
$pdf->Cell(1, 4, '', 0, 0, 'C');
$pdf->Cell(14.5, 4, 'SCHOOL ID:', 0, 0, 'L');
$pdf->Cell(11, 4, '301216', 'B', 1, 'C');

/*Header of 2nd tables*/
$pdf->ln(0.5);
$pdf->SetX(11);
$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 0);
$pdf->Cell(193.5, 0.2, '', 1, 1, 'C', 1, 1);
$pdf->SetX(11);
$pdf->SetFont('unicodehelvetin', '', 7);
$pdf->Cell(.2, 8.5, '', 1, 0, 'C', 1, 1);
$pdf->SetFillColor(192);

$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(105.8, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(12.75, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(12.75, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(16, 8.5, '', 1, 0, 'C', 1);
$pdf->Cell(15.8, 8.5, '', 1, 0, 'C', 1);
$pdf->SetFillColor(0);
$pdf->SetFont('unicodehelvetin', '', 7.5);
$pdf->Cell(.2, 8.5, '', 1, 1, 'C', 1, 1);

$pdf->ln(-10);
$pdf->SetX(11);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'Indicate if Subject is CORE,', 0, 0, 'C', 0);

$pdf->ln(3);
$pdf->SetX(11);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'APPLIED, or SPECIALIZED', 0, 0, 'C', 0);

$pdf->ln(-1.5);
$pdf->SetX(78.1);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(30, 8.5, 'SUBJECTS', 0, 0, 'C', 0);

$pdf->ln(1);
$pdf->SetX(147);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'SEM FINAL', 0, 0, 'C', 0);
$pdf->ln(2.5);
$pdf->SetX(147);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'GRADE', 0, 0, 'C', 0);

$pdf->ln(-4);
$pdf->SetX(160);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'REMEDIAL', 0, 0, 'C', 0);

$pdf->ln(2.5);
$pdf->SetX(160);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'CLASS', 0, 0, 'C', 0);

$pdf->ln(3);
$pdf->SetX(160);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'MARK', 0, 0, 'C', 0);

$pdf->ln(-4);
$pdf->SetX(174);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'RECOMPUTED', 0, 0, 'C', 0);
$pdf->SetX(189);
$pdf->Cell(15.8, 4.25, 'ACTION', 0, 0, 'C', 0);
$pdf->ln(3);
$pdf->SetX(174);
$pdf->SetFont('helveticanarrowb', '', 7);
$pdf->Cell(12.75, 4.25, 'FINAL GRADE', 0, 0, 'C', 0);
$pdf->SetX(189);
$pdf->Cell(15.8, 4.25, 'TAKEN', 0, 1, 'C', 0);

//REMEDIAL 2ND SEM
$pdf->ln(0.4);
$studentName = $studentRow['name'];
$sf10Remedial2 = "SELECT * FROM `sf10remedial` WHERE `student_name` = '$studentName' AND `semester` = '2nd' ORDER BY `subject_type` ASC";
$sf10ResultRemedial2 = $conn->query($sf10Remedial2);
$sf10Count2 = $sf10ResultRemedial2->num_rows;
if ($sf10Count2 === 0) {
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->SetX(11);
    $pdf->SetFillColor(0);
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->Cell(.2, 5, '', 1, 0, 'C', 1);
    $pdf->Cell(30, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(105.8, 5, '', 1, 0, 'L', 0);
    $pdf->Cell(12.75, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(12.75, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, '', 1, 0, 'C', 0);
    $pdf->Cell(15.8, 5, '', 1, 0, 'C', 0);
    $pdf->SetFont('unicodehelvetin', '', 7);
    $pdf->Cell(.2, 5, '', 1, 1, 'C', 1);
} else {
    while ($sf10RowRemedial2 = $sf10ResultRemedial2->fetch_assoc()) {
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->SetX(11);
        $pdf->SetFillColor(0);
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->Cell(.2, 5, '', 1, 0, 'C', 1);
        $pdf->Cell(30, 5, $sf10RowRemedial2['subject_type'], 1, 0, 'C', 0);
        $pdf->Cell(105.8, 5, $sf10RowRemedial2['subject_title'], 1, 0, 'L', 0);
        $pdf->Cell(12.75, 5, $sf10RowRemedial2['old_grade'], 1, 0, 'C', 0);
        $pdf->Cell(12.75, 5, $sf10RowRemedial2['new_grade'], 1, 0, 'C', 0);
        $pdf->Cell(16, 5, $sf10RowRemedial2['final_grade'], 1, 0, 'C', 0);
        $pdf->Cell(15.8, 5, $sf10RowRemedial2['action'], 1, 0, 'C', 0);
        $pdf->SetFont('unicodehelvetin', '', 7);
        $pdf->Cell(.2, 5, '', 1, 1, 'C', 1);
    }
}

$pdf->SetFillColor(0);
$pdf->SetX(11);
$pdf->SetFont('unicodehelvetin', '', 0);
$pdf->Cell(193.5, 0.2, '', 1, 1, 'C', 1, 1);
$pdf->Cell(12, 2, '', 0, 1, 'L');


$pdf->SetFont('unicodehelvetin', '', 7);
$pdf->SetX(10);
$pdf->Cell(35, 4.25, ' Name of the Teacher/Adviser:', 0, 0, 'L', 0);
$pdf->Cell(103, 3.5, $adviserRow['name'], 'B', 0, 'L', 0);
$pdf->Cell(3, 2, '', 0, 0, 'L');
$pdf->Cell(11, 4.25, 'Signature:', 0, 0, 'L', 0);
$pdf->Cell(42.5, 3.5, '', 'B', 1, 'C', 0);
$pdf->Cell(3, 2, '', 0, 0, 'L');
$pdf->Output();
