<?php
include("../config.php");
session_start();

//FPDF
require("../fpdf186/fpdf.php");
$pdf = new FPDF();

$sections = "SELECT * FROM `section` ORDER BY `name` ASC";
$result = mysqli_query($conn, $sections);

while ($row = mysqli_fetch_assoc($result)) {

    $pdf->AddPage('L', 'A4');
    $pdf->SetAutoPageBreak(true, 5);

    //NAME
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Text(46.5, 49.5, "NAME", "B", 1, 'C', 0);
    $pdf->Text(25.7, 51.5, "(Last Name, First Name, Name Extension, Middle Name)", "B", 1, 'C', 0);

    //BIRTHDATE
    $pdf->Text(85, 49.5, "BIRTH DATE", "B", 1, 'C', 0);
    $pdf->Text(84.5, 51.5, "(mm/dd/yyyy)", "B", 1, 'C', 0);

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Text(65, 16, ' School Form 1 School Register for Senior High School (SF1-SHS) ');
    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(33, 28.8, 'School Name');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(46, 25.5);
    $pdf->Cell(48.5, 5, 'Tagaytay City National High School-Integrated ', 1, 0, 'C', 0);

    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(35, 34.8, 'Semester');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(46, 31.5);
    $pdf->Cell(48.5, 5, $row["semester"], 1, 0, 'C', 0);


    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(38, 40.8, 'Section');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(46, 37.5);
    $pdf->Cell(48.5, 5, $row["name"], 1, 0, 'C', 0);

    /*-Second Row-*/
    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(102, 28.8, 'School ID');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(114, 25.5);
    $pdf->Cell(20, 5, '301216 ', 1, 0, 'C', 0);

    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(102, 34.8, 'School Year');


    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(114, 31.5);
    // $pdf->Cell(20, 5, $row["start_year"] . " - " . $row["end_year"], 1, 0, 'C', 0);

    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(102, 40.8, 'Course(for TVL only) ');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(123, 37.5);
    if ($row["track"] == "Technical-Vocational-Livelihood") {
        $pdf->Cell(60, 5, $row["strand"], 1, 0, 'C', 0);
    } else {
        $pdf->Cell(60, 5, '', 1, 0, 'C', 0);
    }
    /*-Third row-*/
    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(140, 28.8, 'District');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(147, 25.5);
    $pdf->Cell(36, 5, 'Tagaytay City  ', 1, 0, 'C', 0);

    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(141, 34.8, 'Grade Level');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(153, 31.5);
    $pdf->Cell(30, 5, "Grade " . $row["grade"], 1, 0, 'C', 0);

    /*-Fourth row-*/

    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(192, 28.8, 'Division');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(200, 25.5);
    $pdf->Cell(33, 5, 'Cavite', 1, 0, 'C', 0);

    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(192, 34.8, 'Track and strand');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(209, 31.5);

    if ($row["track"] == "Technical-Vocational-Livelihood") {
        $pdf->Cell(64.5, 5, $row["track"], 1, 0, 'C', 0);
    } elseif ($row["track"] == "Academic") {
        $pdf->Cell(64.5, 5, $row["track"] . " - " . $row["strand"], 1, 0, 'C', 0);
    }


    $pdf->SetFont('Arial', '', 6);
    $pdf->Text(237, 28.8, 'Region');

    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(244, 25.5);
    $pdf->Cell(29.5, 5, 'Cavite', 1, 0, 'C', 0);

    /*-TABLE-*/
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->SetXY(5, 42.5);
    $pdf->Cell(16, 15, 'LRN', 1, 0, 'C', 0);
    $pdf->Cell(56, 15, '', 1, 0, 'C', 0);
    $pdf->Cell(4, 15, '', 1, 0, 'C', 0);
    $pdf->Cell(18, 15, '', 1, 0, 'C', 0);
    $pdf->SetFont('Arial', 'B', 4);
    $pdf->MultiCell(5.5, 3, 'Age as of October 31st', 1, 'C');
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->SetXY(104.5, 42.5);
    $pdf->Cell(20, 15, 'Religious Affication', 1, 0, 'C', 0);
    $pdf->Cell(60, 6, 'COMPLETE ADDRESS', 1, 0, 'C', 0);
    $pdf->Cell(35, 6, 'PARENTS', 1, 0, 'C', 0);
    $pdf->Cell(32, 6, '', 1, 0, 'C', 0);
    $pdf->Cell(8.5, 15, '', 1, 0, 'C', 0);
    $pdf->Cell(10, 15, '', 1, 0, 'C', 0);
    $pdf->Cell(19.5, 6, 'Remarks', 1, 0, 'C', 0);

    $pdf->SetXY(124.5, 48.5);
    $pdf->SetFont('Arial', 'B', 4);
    $pdf->Cell(20, 9, 'House#/ Street/ Sitio/ Purok', 1, 0, 'C', 0);
    $pdf->Cell(13, 9, 'Barangay', 1, 0, 'C', 0);
    $pdf->Cell(15, 9, 'Municipality/ City', 1, 0, 'C', 0);
    $pdf->Cell(12, 9, 'Province', 1, 0, 'C', 0);

    $pdf->SetXY(184.5, 48.5);
    $pdf->SetFont('Arial', 'B', 4);
    $pdf->Cell(19, 9, "Father's Name", 1, 0, 'C', 0);
    $pdf->Cell(16, 9, "", 1, 0, 'C', 0);
    $pdf->Cell(19, 9, "", 1, 0, 'C', 0);
    $pdf->Cell(13, 9, 'Relationship', 1, 0, 'C', 0);

    $pdf->SetXY(270, 48.5);
    $pdf->SetFont('Arial', '', 4);
    $pdf->Cell(19.5, 9, '', 1, 1, 'C', 0);

    $pdf->SetFont('Arial', 'B', 4);
    $pdf->Text(272.5, 52.5, '(Please refer to the');
    $pdf->Text(271.5, 54.5, 'legend on the last page)');
    $pdf->Text(262, 49.5, 'Learning');
    $pdf->Text(262, 51.5, 'Modality');
    $pdf->Text(253.3, 47.5, 'Contact');
    $pdf->Text(252.3, 49.5, 'Number of');
    $pdf->Text(252.8, 51.5, 'Parent or');
    $pdf->Text(252.8, 53.5, 'Guardian');
    $pdf->Text(232.8, 45, 'GUARDIAN');
    $pdf->Text(224, 47, '(if learner is not Living with Parent)');
    $pdf->Text(227, 50.5, 'NAME');
    $pdf->Text(223, 52.5, '(Last Name, First');
    $pdf->Text(225, 54.5, 'Name, Name');
    $pdf->Text(223, 56.5, 'Extension, Middle)');
    $pdf->Text(205, 50.5, "Mother's Maiden");
    $pdf->Text(206, 52.5, '(Last Name, First');
    $pdf->Text(208, 54.5, 'Name, Name');

    $pdf->Text(206, 56.5, 'Extension, Middle)');
    $pdf->SetFont('Arial', '', 4);

    //MALE TABLE
    $section = $row["name"];
    $select_male = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'M' ORDER BY `name` ASC";
    $result_select_male = mysqli_query($conn, $select_male);

    while ($row_student_male = mysqli_fetch_assoc($result_select_male)) {
        $pdf->Cell(-5);
        $pdf->Cell(16, 6, $row_student_male["lrn"], 1, 0, 'L', 0);
        $pdf->Cell(56, 6, $row_student_male["name"], 1, 0, 'L', 0);
        $pdf->Cell(4, 6, $row_student_male["sex"], 1, 0, 'C', 0);
        $pdf->Cell(18, 6, $row_student_male["birth_date"], 1, 0, 'C', 0);
        $pdf->Cell(5.5, 6, $row_student_male["age"], 1, 0, 'C', 0);
        $pdf->Cell(20, 6, $row_student_male["ra"], 1, 0, 'C', 0);
        $pdf->Cell(20, 6, $row_student_male["house_no"], 1, 0, 'C', 0);
        $pdf->Cell(13, 6, $row_student_male["barangay"], 1, 0, 'C', 0);
        $pdf->Cell(15, 6, $row_student_male["municipality"], 1, 0, 'C', 0);
        $pdf->Cell(12, 6, $row_student_male["province"], 1, 0, 'C', 0);
        $pdf->Cell(19, 6, $row_student_male["father"], 1, 0, 'C', 0);
        $pdf->Cell(16, 6, $row_student_male["mother"], 1, 0, 'C', 0);
        $pdf->Cell(19, 6, $row_student_male["guardian"], 1, 0, 'C', 0);
        $pdf->Cell(13, 6, $row_student_male["relationship"], 1, 0, 'C', 0);
        $pdf->Cell(8.5, 6, $row_student_male["contact"], 1, 0, 'C', 0);
        $pdf->Cell(10, 6, $row_student_male["lm"], 1, 0, 'C', 0);
        $pdf->Cell(19.5, 6, $row_student_male["indicator"] . " " . $row_student_male["ri"], 1, 1, 'C', 0);
    }

    //TOTAL MALE
    $select_total_male = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'M'";
    $result_total_male = mysqli_query($conn, $select_total_male);
    $row_total_male = mysqli_num_rows($result_total_male);

    $pdf->Cell(-5);
    $pdf->Cell(16, 5, $row_total_male, 1, 0, 'R', 0);
    $pdf->Cell(268.5, 5, '<=== TOTAL MALE', 1, 1, '', 0);

    //FEMALE TABLE

    $select_female = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'F' ORDER BY `name` ASC";
    $result_select_female = mysqli_query($conn, $select_female);

    while ($row_student_female = mysqli_fetch_assoc($result_select_female)) {
        $pdf->Cell(-5);
        $pdf->Cell(16, 6, $row_student_female["lrn"], 1, 0, 'L', 0);
        $pdf->Cell(56, 6, $row_student_female["name"], 1, 0, 'L', 0);
        $pdf->Cell(4, 6, $row_student_female["sex"], 1, 0, 'C', 0);
        $pdf->Cell(18, 6, $row_student_female["birth_date"], 1, 0, 'R', 0);
        $pdf->Cell(5.5, 6, $row_student_female["age"], 1, 0, 'C', 0);
        $pdf->Cell(20, 6, $row_student_female["ra"], 1, 0, 'L', 0);
        $pdf->Cell(20, 6, $row_student_female["house_no"], 1, 0, 'C', 0);
        $pdf->Cell(13, 6, $row_student_female["barangay"], 1, 0, 'C', 0);
        $pdf->Cell(15, 6, $row_student_female["municipality"], 1, 0, 'C', 0);
        $pdf->Cell(12, 6, $row_student_female["province"], 1, 0, 'C', 0);
        $pdf->Cell(19, 6, $row_student_female["father"], 1, 0, 'C', 0);
        $pdf->Cell(16, 6, $row_student_female["mother"], 1, 0, 'C', 0);
        $pdf->Cell(19, 6, $row_student_female["guardian"], 1, 0, 'C', 0);
        $pdf->Cell(13, 6, $row_student_female["relationship"], 1, 0, 'C', 0);
        $pdf->Cell(8.5, 6, $row_student_female["contact"], 1, 0, 'C', 0);
        $pdf->Cell(10, 6, $row_student_female["lm"], 1, 0, 'C', 0);
        $pdf->Cell(19.5, 6, $row_student_female["indicator"] . " " . $row_student_female["ri"], 1, 1, 'C', 0);
    }

    // TOTAL FEMALE
    $section = $row["name"];
    $select_total_female = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'F'";
    $result_total_female = mysqli_query($conn, $select_total_female);
    $row_total_female = mysqli_num_rows($result_total_female);

    $pdf->Cell(-5);
    $pdf->Cell(16, 5, $row_total_female, 1, 0, 'R', 0);
    $pdf->Cell(268.5, 5, '<=== TOTAL FEMALE', 1, 1, '', 0);

    //COMBINED
    $section = $row["name"];
    $select_combined = "SELECT * FROM `student` WHERE `section` = '$section'";
    $result_combined = mysqli_query($conn, $select_combined);
    $row_combined = mysqli_num_rows($result_combined);

    $pdf->Cell(-5);
    $pdf->Cell(16, 5, $row_combined, 1, 0, 'R', 0);
    $pdf->Cell(268.5, 5, '<=== COMBINED', 1, 1, '', 0);

    $pdf->Cell(-5.5);
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(268.5, 4, 'Legend: List and Code of Indicators under REMARKS column', 0, 1, 'L', 0);
    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Cell(-5);
    $pdf->Cell(16, 4, 'Indicator', 1, 0, 'L', 0);
    $pdf->Cell(8, 4, 'Code', 1, 0, 'C', 0);
    $pdf->Cell(38, 4, 'Required Information', 1, 0, 'L', 0);
    $pdf->Cell(16, 4, 'Indicator', 1, 0, 'L', 0);
    $pdf->Cell(8, 4, 'Code', 1, 0, 'C', 0);
    $pdf->Cell(38, 4, 'Required Information', 1, 0, 'L', 0);

    $pdf->Cell(5, 4, '', 0, 0, 'L', 0);
    $pdf->Cell(11, 4, 'REGISTERED', 1, 0, 'C', 0);
    $pdf->SetFont('Arial', 'B', 2.8);
    $pdf->Cell(14, 4, 'Beginning of the Semester', 1, 0, 'C', 0);
    $pdf->Cell(12, 4, 'End of the Semester', 1, 0, 'C', 0);


    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Cell(18, 4, '', 0, 0, 'L', 0);

    $pdf->Cell(12, 1, 'Prepared by:', 0, 1, 'L', 0);


    $pdf->Ln(3);
    $pdf->Cell(-5);
    $pdf->Cell(16, 2, 'Transferred Out', 'LR', 0, 'T', 0);
    $pdf->Cell(8, 2, 'T/O', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
    $pdf->Cell(16, 2, 'CCT Recipient', 'LR', 0, 'L', 0);
    $pdf->Cell(8, 2, 'CCT', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, 'CCT Control/reference number &', 'LR', 0, 'L', 0);
    $pdf->Cell(5, 4, '', 0, 0, 'L', 0);
    $pdf->Cell(11, 5, 'MALE', 1, 0, 'C', 0);

    //TOTAL MALE
    $pdf->Cell(14, 5, $row_total_male, 1, 0, 'C', 0);
    $pdf->Cell(12, 5, '', 1, 0, 'L', 0);
    $pdf->Cell(18, 5, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Cell(130, 0, '_____________________________________________________________________________________________________________________________________________________', 0, 1, 'L', 0);


    $pdf->Ln(1.3);
    $pdf->Cell(-5);
    $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
    $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
    $pdf->Cell(16, 2, '', 'LR', 0, 'L', 0);
    $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, 'Effective Date', 'LR', 0, 'L', 0);
    $pdf->Cell(5, 4, '', 0, 0, 'L', 0);
    $pdf->Ln(3.7);
    $pdf->Cell(124);
    $pdf->Cell(11, 4, 'FEMALE', 1, 0, 'C', 0);

    //TOTAL FEMALE
    $pdf->Cell(14, 4, $row_total_female, 1, 0, 'C', 0);
    $pdf->Cell(12, 4, '', 1, 0, 'L', 0);
    $pdf->Cell(15, 5, '', 0, 0, 'L', 0);
    $pdf->Ln(-2);
    $pdf->Cell(208);
    $pdf->SetFont('Arial', 'B', 4);
    $pdf->Cell(35, 2, '(Signature of Adviser over Printed Name)', 0, 1, 'L', 0);

    $pdf->SetFont('Arial', 'B', 3);
    $pdf->Ln(-2.4);
    $pdf->Cell(-5);
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

    //COMBINED
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
    $pdf->Cell(-5);
    $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
    $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, 'Date of Last Attendace if Transffered Out', 'LR', 0, 'L', 0);
    $pdf->Cell(16, 2, '', 'LR', 0, 'L', 0);
    $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
    $pdf->Cell(5, 4, '', 0, 1, 'L', 0);

    $pdf->Ln(-2.8);
    $pdf->Cell(-5);
    $pdf->Cell(16, 2, 'Transffered In', 'LR', 0, 'T', 0);
    $pdf->Cell(8, 2, 'T/I', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
    $pdf->Cell(16, 2, 'Learner With', 'LR', 0, 'L', 0);
    $pdf->Cell(8, 2, 'LWE', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, 'Specify Exceptionality if the Learner', 'LR', 1, 'L', 0);

    $pdf->Ln(-.8);
    $pdf->Cell(-5);
    $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
    $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
    $pdf->Cell(16, 2, 'Exceptionality', 'LR', 0, 'L', 0);
    $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LR', 1, 'L', 0);

    $pdf->Ln(-.8);
    $pdf->Cell(-5);
    $pdf->Cell(16, 2, '', 'LR', 0, 'T', 0);
    $pdf->Cell(8, 2, '', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LR', 0, 'L', 0);
    $pdf->Cell(16, 2, 'Accelerated', 'LR', 0, 'L', 0);
    $pdf->Cell(8, 2, 'ACL', 'LR', 0, 'C', 0);
    $pdf->Cell(38, 2, 'Specify Level & Effectivity Date', 'LR', 1, 'L', 0);

    $pdf->Ln(-1);
    $pdf->Cell(-5);
    $pdf->Cell(16, 2, '', 'LBR', 0, 'T', 0);
    $pdf->Cell(8, 2, '', 'LBR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LBR', 0, 'L', 0);
    $pdf->Cell(16, 2, '', 'LBR', 0, 'L', 0);
    $pdf->Cell(8, 2, '', 'LBR', 0, 'C', 0);
    $pdf->Cell(38, 2, '', 'LBR', 1, 'L', 0);

    $pdf->Ln(1);
    $pdf->Cell(-5);
    $pdf->SetFont('Arial', '', 4);
    $pdf->Cell(38, 2, 'Generated on: ' . date("l") . ', June 20, 2023', 0, 1, 'L', 0);
}

$pdf->Output('created_pdf.pdf', 'I');
