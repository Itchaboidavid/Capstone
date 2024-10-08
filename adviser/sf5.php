<?PHP
include('../FPDF/pdf_mc_table.php');
include("../config.php");
session_start();

$pdf = new PDF_MC_TABLE();
$pdf->AddPage('L', 'A4');
$pdf->SetMargins(10, 0, 5);

$id = $_SESSION['id'];

$sy = "SELECT * FROM school_year WHERE is_archived = 0";
$syResult = $conn->query($sy);
$syRow = $syResult->fetch_assoc();
$school_year_id = $syRow['id'];

$sectionsf5 = "SELECT * FROM `section` WHERE `adviser_id` = '$id' AND school_year_id = '$school_year_id' AND is_archived = 0";
$sectionsf5Result = $conn->query($sectionsf5);
$sectionsf5Row = $sectionsf5Result->fetch_assoc();

$school = "SELECT * FROM `school` WHERE `id` = '1'";
$schoolResult = $conn->query($school);
$schoolRow = $schoolResult->fetch_assoc();

$pdf->SetAutoPageBreak(true, 5);
$pdf->Image('../images/circleLogosf5.jpg', 6, 3, 20, 21);
$pdf->Image('../images/depedlogosf5.jpg', 239, 4, 31, 18);

$pdf->SetXY(47, 8);
$pdf->SetFont('Arial', '', 15.2);
$pdf->Cell(16, 6, 'School Form 5A End of Semester and School Year Status of Learners for', 0, 1, '', 0);
$pdf->SetXY(97, 15);
$pdf->SetFont('Arial', '', 15.2);
$pdf->Cell(16, 6, 'Senior High School (SF5-SHS)', 0, 0, '', 0);

$pdf->SetXY(16, 24.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'School Name', 0, 0, '', 0);
$pdf->SetXY(36.5, 24.9);
$pdf->SetLineWidth(0.3);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(55.5, 7, $schoolRow['school_name'], 1, 0, 'L', 0);

$pdf->SetXY(21.5, 33.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Semester', 0, 0, '', 0);
$pdf->SetXY(36.5, 33.5);
$pdf->SetFont('Arial', 'B', 7);
$currentMonth = date('m');
if ($currentMonth >= 8) {
    $pdf->Cell(55.5, 7, '1st', 1, 0, 'L', 0);
} else {
    $pdf->Cell(55.5, 7, '2nd', 1, 0, 'L', 0);
}
$pdf->SetXY(10.5, 42.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Track and Strand', 0, 0, '', 0);
$pdf->SetXY(36.5, 42.5);
$pdf->SetFont('Arial', 'B', 7);
if ($sectionsf5Row["track"] == "Technical-Vocational-Livelihood") {
    $pdf->Cell(99, 7, $sectionsf5Row["track"], 1, 0, 'L', 0);
} else {
    $pdf->Cell(99, 7, $sectionsf5Row["track"] . " - " . $sectionsf5Row["strand"], 1, 0, 'L', 0);
}


$pdf->SetXY(100.2, 24.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'School ID', 0, 0, '', 0);
$pdf->SetXY(115.7, 24.9);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(20, 7, $schoolRow['school_id'], 1, 0, 'L', 0);


$pdf->SetXY(96.5, 33.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'School Year', 0, 0, '', 0);
$pdf->SetXY(115.7, 33.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(20, 7, $sectionsf5Row['school_year'], 1, 0, 'L', 0);

$pdf->SetXY(148.5, 24.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'District', 0, 0, '', 0);
$pdf->SetXY(160.5, 24.9);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(20.5, 7, $schoolRow['school_district'], 1, 0, 'L', 0);

$pdf->SetXY(141, 33.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Grade level', 0, 0, '', 0);
$pdf->SetXY(160.5, 33.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(20.5, 7, $sectionsf5Row["grade"], 1, 0, 'L', 0);


$pdf->SetXY(188, 24.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Divison', 0, 0, '', 0);
$pdf->SetXY(200.5, 24.9);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(27.5, 7, $schoolRow['school_division'], 1, 0, 'L', 0);

$pdf->SetXY(188.2, 33.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Section', 0, 0, '', 0);
$pdf->SetXY(200.5, 33.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(71, 7, $sectionsf5Row["name"], 1, 0, 'L', 0);

$pdf->SetXY(149, 42.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Course (only for TVL)', 0, 0, '', 0);
$pdf->SetXY(183.5, 42.5);
$pdf->SetFont('Arial', 'B', 7);
if ($sectionsf5Row["track"] == "Technical-Vocational-Livelihood") {
    $pdf->Cell(88, 7, 'Animation (NC II), Computer Programming(NC IV)', 1, 0, 'L', 0);
} else {
    $pdf->Cell(88, 7, '', 1, 0, 'L', 0);
}

$pdf->SetXY(237, 24.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Region', 0, 0, '', 0);
$pdf->SetXY(249, 24.9);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(22.5, 7, $schoolRow['school_region'], 1, 0, 'L', 0);

$pdf->Ln(28);
$pdf->Cell(-5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Ln(0);
$pdf->Cell(-5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(9, 30, 'NO', 1, 0, 'C', 0);
$pdf->Cell(26, 30, 'LRN', 1, 0, 'C', 0);
$pdf->Cell(50.5, 30, '', 1, 0, 'C', 0);
$pdf->Text(54.5, 67, "LEARNERS NAME", "B", 1, 'C', 0);
$pdf->Text(42.5, 70, "(Last Name, First Name, Middle Name)", "B", 1, 'C', 0);
$pdf->Cell(37, 30, '', 1, 0, '', 0);
$pdf->Text(92, 65.5, "BACK SUBJECTS (List Down", "B", 1, 'C', 0);
$pdf->Text(91.5, 68.5, "Subjects where learner obtain", "B", 1, 'C', 0);
$pdf->Text(97.5, 71.5, "a rating below 75%)", "B", 1, 'C', 0);
$pdf->Cell(33, 30, 'STATUS', 1, 0, 'C', 0);
$pdf->Text(132.5, 65.5, "END OF SEMESTER", "B", 1, 'C', 0);
$pdf->Text(139, 68.5, "", "B", 1, 'C', 0);
$pdf->Text(130.5, 71.5, "(Complete/Incomplete)", "B", 1, 'C', 0);
$pdf->Cell(30.5, 30, '', 1, 1, 'C', 0);
$pdf->Text(162, 65.5, "END OF SCHOOL YEAR", "B", 1, 'C', 0);
$pdf->Text(161.5, 68.5, "STATUS(Regular/Irregul", "B", 1, 'C', 0);
$pdf->Text(175.5, 71.5, "r)", "B", 1, 'C', 0);
$pdf->Cell(-5);
$pdf->Cell(9, 6.5, '', 1, 0, 'C', 0);
$pdf->Cell(26, 6.5, 'MALE', 1, 0, 'C', 0);
$pdf->Cell(50.5, 6.5, '', 1, 0, '', 0);
$pdf->Cell(37, 6.5, '', 1, 0, '', 0);
$pdf->Cell(33, 6.5, '', 1, 0, '', 0);
$pdf->Cell(30.5, 6.5, '', 1, 1, '', 0);

$pdf->Ln(-36.5);
$pdf->Cell(185.5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(76, 7, 'Summary table 1st Sem', 1, 1, 'C', 0);
$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'STATUS', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Male', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Female', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Total', 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Complete', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$sectionName = $sectionsf5Row['name'];

//COMPLETE MALE 1ST SEM
$completeMale1st_sf9 = "SELECT DISTINCT `student_id` FROM `sf9` WHERE `section` = '$sectionName' AND `final_grade` >= 75 AND `sex` = 'M' AND `semester` = '1st' AND school_year_id = '$school_year_id'";
$completeMale1st_sf10remedial = "SELECT DISTINCT `student_id` FROM `sf10remedial` WHERE `section` = '$sectionName' AND `final_grade` >= 75 AND `sex` = 'M' AND `semester` = '1st' AND school_year_id = '$school_year_id'";
$completeMale1st = "$completeMale1st_sf9 UNION $completeMale1st_sf10remedial";
$completeMale1stResult = $conn->query($completeMale1st);
$completeMale1stCount = $completeMale1stResult->num_rows;
//INCOMPLETE MALE 1ST SEM
$incompleteMale1st_sf9 = "SELECT DISTINCT `student_id` FROM `sf9` WHERE `section` = '$sectionName' AND `final_grade` < 75 AND `final_grade` > 0 AND `sex` = 'M' AND `semester` = '1st'";
$incompleteMale1st_sf10remedial = "SELECT DISTINCT `student_id` FROM `sf10remedial` WHERE `section` = '$sectionName' AND `final_grade` < 75 AND `final_grade` > 0 AND `sex` = 'M' AND `semester` = '1st'";
$incompleteMale1st = "$incompleteMale1st_sf9 UNION $incompleteMale1st_sf10remedial";
$incompleteMale1stResult = $conn->query($incompleteMale1st);
$incompleteMale1stCount = $incompleteMale1stResult->num_rows;
//COMPLETE FEMALE 1ST SEM
$completeFemale1st_sf9 = "SELECT DISTINCT `student_id` FROM `sf9` WHERE `section` = '$sectionName' AND `final_grade` >= 75 AND `sex` = 'F' AND `semester` = '1st' AND school_year_id = '$school_year_id'";
$completeFemale1st_sf10remedial = "SELECT DISTINCT `student_id` FROM `sf10remedial` WHERE `section` = '$sectionName' AND `final_grade` >= 75 AND `sex` = 'F' AND `semester` = '1st' AND school_year_id = '$school_year_id'";
$completeFemale1st = "$completeFemale1st_sf9 UNION $completeFemale1st_sf10remedial";
$completeFemale1stResult = $conn->query($completeFemale1st);
$completeFemale1stCount = $completeFemale1stResult->num_rows;
//INCOMPLETE FEMALE 1ST SEM
$incompleteFemale1st_sf9 = "SELECT DISTINCT `student_id` FROM `sf9` WHERE `section` = '$sectionName' AND `final_grade` < 75 AND `final_grade` > 0 AND `sex` = 'F' AND `semester` = '1st' AND school_year_id = '$school_year_id'";
$incompleteFemale1st_sf10remedial = "SELECT DISTINCT `student_id` FROM `sf10remedial` WHERE `section` = '$sectionName' AND `final_grade` < 75 AND `final_grade` > 0 AND `sex` = 'F' AND `semester` = '1st' AND school_year_id = '$school_year_id'";
$incompleteFemale1st = "$incompleteFemale1st_sf9 UNION $incompleteFemale1st_sf10remedial";
$incompleteFemale1stResult = $conn->query($incompleteFemale1st);
$incompleteFemale1stCount = $incompleteFemale1stResult->num_rows;

$completeMale1stCount = $completeMale1stCount - $incompleteMale1stCount;
$pdf->Cell(17.16, 7, $completeMale1stCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);

$completeFemale1stCount = $completeFemale1stCount - $incompleteFemale1stCount;
$pdf->Cell(17.16, 7, $completeFemale1stCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeMale1stCount + $completeFemale1stCount, 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Incomplete', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteMale1stCount, 1, 0, 'C', 0);

$pdf->Cell(-0.000001);

$pdf->Cell(17.16, 7, $incompleteFemale1stCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteMale1stCount + $incompleteFemale1stCount, 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Total', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteMale1stCount + $completeMale1stCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeFemale1stCount + $incompleteFemale1stCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$total1stSem = $incompleteMale1stCount + $completeMale1stCount + $completeFemale1stCount + $incompleteFemale1stCount;
$pdf->Cell(17.16, 7, $total1stSem, 1, 1, 'C', 0);


$pdf->Ln(5);
$pdf->Cell(185.5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(76, 7, 'Summary table 2nd Sem', 1, 1, 'C', 0);
$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'STATUS', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Male', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Female', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Total', 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Complete', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);

//COMPLETE MALE 2nd SEM
$completeMale2nd_sf9 = "SELECT DISTINCT `student_id` FROM `sf9` WHERE `section` = '$sectionName' AND `final_grade` >= 75 AND `sex` = 'M' AND `semester` = '2nd' AND school_year_id = '$school_year_id'";
$completeMale2nd_sf10remedial = "SELECT DISTINCT `student_id` FROM `sf10remedial` WHERE `section` = '$sectionName' AND `final_grade` >= 75 AND `sex` = 'M' AND `semester` = '2nd' AND school_year_id = '$school_year_id'";
$completeMale2nd = "$completeMale2nd_sf9 UNION $completeMale2nd_sf10remedial";
$completeMale2ndResult = $conn->query($completeMale2nd);
$completeMale2ndCount = $completeMale2ndResult->num_rows;
//INCOMPLETE MALE 2nd SEM
$incompleteMale2nd_sf9 = "SELECT DISTINCT `student_id` FROM `sf9` WHERE `section` = '$sectionName' AND `final_grade` < 75 AND `final_grade` > 0 AND `sex` = 'M' AND `semester` = '2nd'";
$incompleteMale2nd_sf10remedial = "SELECT DISTINCT `student_id` FROM `sf10remedial` WHERE `section` = '$sectionName' AND `final_grade` < 75 AND `final_grade` > 0 AND `sex` = 'M' AND `semester` = '2nd'";
$incompleteMale2nd = "$incompleteMale2nd_sf9 UNION $incompleteMale2nd_sf10remedial";
$incompleteMale2ndResult = $conn->query($incompleteMale2nd);
$incompleteMale2ndCount = $incompleteMale2ndResult->num_rows;
//COMPLETE FEMALE 2nd SEM
$completeFemale2nd_sf9 = "SELECT DISTINCT `student_id` FROM `sf9` WHERE `section` = '$sectionName' AND `final_grade` >= 75 AND `sex` = 'F' AND `semester` = '2nd' AND school_year_id = '$school_year_id'";
$completeFemale2nd_sf10remedial = "SELECT DISTINCT `student_id` FROM `sf10remedial` WHERE `section` = '$sectionName' AND `final_grade` >= 75 AND `sex` = 'F' AND `semester` = '2nd' AND school_year_id = '$school_year_id'";
$completeFemale2nd = "$completeFemale2nd_sf9 UNION $completeFemale2nd_sf10remedial";
$completeFemale2ndResult = $conn->query($completeFemale2nd);
$completeFemale2ndCount = $completeFemale2ndResult->num_rows;
//INCOMPLETE FEMALE 2nd SEM
$incompleteFemale2nd_sf9 = "SELECT DISTINCT `student_id` FROM `sf9` WHERE `section` = '$sectionName' AND `final_grade` < 75 AND `final_grade` > 0 AND `sex` = 'F' AND `semester` = '2nd' AND school_year_id = '$school_year_id'";
$incompleteFemale2nd_sf10remedial = "SELECT DISTINCT `student_id` FROM `sf10remedial` WHERE `section` = '$sectionName' AND `final_grade` < 75 AND `final_grade` > 0 AND `sex` = 'F' AND `semester` = '2nd' AND school_year_id = '$school_year_id'";
$incompleteFemale2nd = "$incompleteFemale2nd_sf9 UNION $incompleteFemale2nd_sf10remedial";
$incompleteFemale2ndResult = $conn->query($incompleteFemale2nd);
$incompleteFemale2ndCount = $incompleteFemale2ndResult->num_rows;

$completeMale2ndCountComputed = $completeMale2ndCount - $incompleteMale2ndCount;
$pdf->Cell(17.16, 7, $completeMale2ndCountComputed, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);

$completeFemale2ndCountComputed = $completeFemale2ndCount - $incompleteFemale2ndCount;
$pdf->Cell(17.16, 7, $completeFemale2ndCountComputed, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeMale2ndCountComputed + $completeFemale2ndCountComputed, 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Incomplete', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteMale2ndCount, 1, 0, 'C', 0);

$pdf->Cell(-0.000001);

$pdf->Cell(17.16, 7, $incompleteFemale2ndCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteMale2ndCount + $incompleteFemale2ndCount, 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Total', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteMale2ndCount + $completeMale2ndCountComputed, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeFemale2ndCountComputed + $incompleteFemale2ndCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$total2ndSem = $incompleteMale2ndCount + $completeMale2ndCountComputed + $completeFemale2ndCountComputed + $incompleteFemale2ndCount;
$pdf->Cell(17.16, 7, $total2ndSem, 1, 1, 'C', 0);

$pdf->Ln(5);
$pdf->Cell(185.5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(76, 7, 'Summary table(End of School Year Only)', 1, 1, 'C', 0);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'STATUS', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Male', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Female', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, 'Total', 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Regular', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeMale2ndCountComputed, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeFemale2ndCountComputed, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeMale2ndCountComputed + $completeFemale2ndCountComputed, 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Irregular', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteMale2ndCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteFemale2ndCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $incompleteMale2ndCount + $incompleteFemale2ndCount, 1, 1, 'C', 0);

$pdf->Cell(185.5);
$pdf->Cell(24.5, 7, 'Total', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeMale2ndCountComputed + $incompleteMale2ndCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $completeFemale2ndCountComputed + $incompleteFemale2ndCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(17.16, 7, $total2ndSem, 1, 1, 'C', 0);




$pdf->SetXY(194.8, 166);
$pdf->SetFont('Arial', '', 7);
$pdf->CellFitSpaceForce(77.5, 10, "GUIDELINES: This form shall be accomplished after each semester in", 0, 1, '', 0);
$pdf->SetXY(194.8, 169);
$pdf->CellFitSpaceForce(77.5, 10, "a school year,  leaving the End of School Year Status Column and", 0, 1, '', 0);
$pdf->SetXY(194.8, 172);
$pdf->CellFitSpaceForce(77.5, 10, "Summary Table for End of School Year Status blank/unfilled at the end", 0, 1, '', 0);
$pdf->SetXY(194.8, 175);
$pdf->CellFitSpaceForce(77.5, 10, "of the 1st Semester.  These data elements shall be filled up only after", 0, 1, '', 0);
$pdf->SetXY(194.8, 179);
$pdf->Cell(77.5, 8, "the 2nd semester or at the end of the School Year.", 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(194.8, 190.5);
$pdf->CellFitSpaceForce(77.5, 8, "INDICATORS: End of Semester Status: Complete - number", 0, 1);
$pdf->SetXY(194.8, 194);
$pdf->CellFitSpaceForce(77.5, 8, "of learners who completed/satisfied the requirements in all", 0, 1);



//MALE TABLE
$nameOfSection = $sectionsf5Row["name"];
$maleStudent = "SELECT * FROM `student` WHERE `sex` = 'M' AND `section` = '$nameOfSection' AND is_archived = 0 AND school_year_id = '$school_year_id' ORDER BY `name` ASC";
$resultMaleStudent = mysqli_query($conn, $maleStudent);
$totalMale = $resultMaleStudent->num_rows;
$pdf->SetXY(10, 89.5);
$countsf5A = 1;
while ($rowMaleStudent = mysqli_fetch_assoc($resultMaleStudent)) {
    $currentStudent = $rowMaleStudent["id"];

    $pdf->SetFont('Arial', 'I', 6);
    $pdf->SetLineWidth(0.5);
    $pdf->SetTopMargin(7);
    $pdf->Cell(-5);
    $pdf->Cell(9, 7, $countsf5A, 1, 0, 'C', 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(26, 7, $rowMaleStudent["lrn"], 1, 0, 'C', 0);
    $pdf->Cell(50.5, 7, $rowMaleStudent["name"], 1, 0, 'C', 0);
    $backSubject = "
        SELECT student_id, final_grade
        FROM sf9
        WHERE student_id = '$currentStudent' AND final_grade < 75 AND final_grade > 0

        UNION

        SELECT student_id, final_grade
        FROM sf10remedial
        WHERE student_id = '$currentStudent' AND final_grade >= 75 AND final_grade <= 0;
    ";
    $backSubjectResult = $conn->query($backSubject);

    // Variable to store concatenated subject titles with line breaks
    $allSubjectTitles = "";

    // Check if there are rows in the result
    if ($backSubjectResult->num_rows > 0) {
        // Loop through each row
        while ($backSubjectRow = $backSubjectResult->fetch_assoc()) {
            // Concatenate subject titles with line breaks
            $allSubjectTitles .= $backSubjectRow['subject_title'] . "\n";
        }
        // Trim the trailing newline character
        $allSubjectTitles = rtrim($allSubjectTitles, "\n");
        $pdf->SetFont('Arial', '', 6);
        // Output a single cell with concatenated subject titles
        $pdf->Cell(37, 7, $allSubjectTitles, 1, 0, 'C', 0);
        $pdf->Cell(33, 7, 'Incomplete', 1, 0, 'C', 0);
        $pdf->Cell(30.5, 7, 'Irregular', 1, 1, 'C', 0);
    } else {
        // Output a cell with empty content if no rows are found
        $pdf->Cell(37, 7, "", 1, 0, 'C', 0);
        $pdf->Cell(33, 7, 'Complete', 1, 0, 'C', 0);
        $pdf->Cell(30.5, 7, 'Regular', 1, 1, 'C', 0);
    }
    $countsf5A++;
}

$pdf->Cell(-5);
$pdf->Cell(9, 7, "", 1, 0, 'C', 0);
$pdf->Cell(26, 7, $totalMale, 1, 0, 'C', 0);
$pdf->Cell(50.5, 7, "<=== TOTAL MALE", 1, 0, 'C', 0);
$pdf->Cell(37, 7, '', 1, 0, 'C', 0);
$pdf->Cell(33, 7, '', 1, 0, 'C', 0);
$pdf->Cell(30.5, 7, '', 1, 1, 'C', 0);

/*--Female table--*/
$femaleStudent = "SELECT * FROM `student` WHERE `sex` = 'F' AND `section` = '$nameOfSection' AND is_archived = 0 AND school_year_id = '$school_year_id' ORDER BY `name` ASC";
$resultFemaleStudent = mysqli_query($conn, $femaleStudent);
$totalFemale = $resultFemaleStudent->num_rows;
while ($rowFemaleStudent = mysqli_fetch_assoc($resultFemaleStudent)) {
    $currentStudent = $rowFemaleStudent["id"];

    $pdf->SetFont('Arial', 'I', 6);
    $pdf->SetLineWidth(0.5);
    $pdf->SetTopMargin(7);
    $pdf->Cell(-5);
    $pdf->Cell(9, 7, $countsf5A, 1, 0, 'C', 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(26, 7, $rowFemaleStudent["lrn"], 1, 0, 'C', 0);
    $pdf->Cell(50.5, 7, $rowFemaleStudent["name"], 1, 0, 'C', 0);
    $backSubject = "
        SELECT student_id, final_grade, subject_title
        FROM sf9
        WHERE student_id = '$currentStudent' AND final_grade < 75 AND final_grade > 0

        UNION

        SELECT student_id, final_grade, subject_title
        FROM sf10remedial
        WHERE student_id = '$currentStudent' AND final_grade < 75 AND final_grade > 0;
    ";
    $backSubjectResult = $conn->query($backSubject);

    // Variable to store concatenated subject titles with line breaks
    $allSubjectTitles = "";

    if ($backSubjectResult->num_rows > 0) {
        // Loop through each row
        while ($backSubjectRow = $backSubjectResult->fetch_assoc()) {
            // Concatenate subject titles with line breaks
            $allSubjectTitles .= $backSubjectRow['subject_title'] . "\n";
        }
        // Trim the trailing newline character
        $allSubjectTitles = rtrim($allSubjectTitles, "\n");
        $pdf->SetFont('Arial', '', 6);
        // Output a single cell with concatenated subject titles
        $pdf->Cell(37, 7, $allSubjectTitles, 1, 0, 'C', 0);
        $pdf->Cell(33, 7, 'Incomplete', 1, 0, 'C', 0);
        $pdf->Cell(30.5, 7, 'Irregular', 1, 1, 'C', 0);
    } else {
        // Output a cell with empty content if no rows are found
        $pdf->Cell(37, 7, "", 1, 0, 'C', 0);
        $pdf->Cell(33, 7, 'Complete', 1, 0, 'C', 0);
        $pdf->Cell(30.5, 7, 'Regular', 1, 1, 'C', 0);
    }
    $countsf5A++;
}

$pdf->Cell(-5);
$pdf->Cell(9, 7, "", 1, 0, 'C', 0);
$pdf->Cell(26, 7, $totalFemale, 1, 0, 'C', 0);
$pdf->Cell(50.5, 7, "<=== TOTAL FEMALE", 1, 0, 'C', 0);
$pdf->Cell(37, 7, '', 1, 0, 'C', 0);
$pdf->Cell(33, 7, '', 1, 0, 'C', 0);
$pdf->Cell(30.5, 7, '', 1, 1, 'C', 0);

//TOTAL STUDENTS
$rowTotal = $totalMale + $totalFemale;

$pdf->Cell(-5);
$pdf->Cell(9, 7, "", 1, 0, 'C', 0);
$pdf->Cell(26, 7, $rowTotal, 1, 0, 'C', 0);
$pdf->Cell(50.5, 7, "<=== COMBINED", 1, 0, 'C', 0);
$pdf->Cell(37, 7, '', 1, 0, 'C', 0);
$pdf->Cell(33, 7, '', 1, 0, 'C', 0);
$pdf->Cell(30.5, 7, '', 1, 1, 'C', 0);

if ($pdf->CheckPageBreak(100)) {
    $pdf->AddPage(); // Add a new page
}
$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(194.8, 5);
$pdf->CellFitSpaceForce(77.5, 8, "subject areas (with grade of at least 75%) Incomplete -", 0, 1);
$pdf->SetXY(194.8, 8.5);
$pdf->CellFitSpaceForce(77.5, 8, "number of learners who did not meet expectations in one or", 0, 1);
$pdf->SetXY(194.8, 12);
$pdf->CellFitSpaceForce(77.5, 8, "more subject areas, regardless of number of subjects failed", 0, 1);
$pdf->SetXY(194.8, 15.5);
$pdf->CellFitSpaceForce(77.5, 8, "(with grade less than 75%) End of Program Status: Regular -", 0, 1);
$pdf->SetXY(194.8, 19);
$pdf->CellFitSpaceForce(77.5, 8, "number of learners who completed/satisfied requirements in", 0, 1);
$pdf->SetXY(194.8, 22.5);
$pdf->CellFitSpaceForce(77.5, 8, "all subject areas  both in the 1st and 2nd semester Irregular -", 0, 1);
$pdf->SetXY(194.8, 26);
$pdf->CellFitSpaceForce(77.5, 8, "number of learners who were not able to satisfy/complete", 0, 1);
$pdf->SetXY(194.8, 29.5);
$pdf->Cell(77.5, 8, "requirements in one or both semesters", 0, 1);

$pdf->SetFont('Arial', '', 6);
$pdf->SetXY(194.8, 40);
$pdf->Cell(77.5, 8, "Note: Do not include learners who are No Longer in School ", 0, 1);
$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(194.8, 44);
$pdf->Cell(77.5, 8, "Instructions:", 0, 1);

$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(194.8, 48);
$pdf->Cell(77.5, 8, "1. The SCC shall conduct checking in their own school, no", 0, 1);
$pdf->SetXY(194.8, 51);
$pdf->Cell(77.5, 8, "swapping of SCC from one school to another is permitted.", 0, 1);
$pdf->SetXY(194.8, 54);
$pdf->Cell(77.5, 8, "2. The name of SCC members shall be printed and put their", 0, 1);
$pdf->SetXY(194.8, 57);
$pdf->Cell(77.5, 8, "signature on top (additional space may be added)", 0, 1);
$pdf->SetXY(194.8, 60);
$pdf->Cell(77.5, 8, "3. The school head is accountable and liable for any", 0, 1);
$pdf->SetXY(194.8, 63);
$pdf->Cell(77.5, 8, "wrongful entry on the forms (Deped Order 4, 2014 par.5)", 0, 1);
$pdf->SetXY(194.8, 66);
$pdf->Cell(77.5, 8, "therefore, the DCC is not required to put their names", 0, 1);
$pdf->SetXY(194.8, 69);
$pdf->Cell(77.5, 8, "and signatures in SF 5", 0, 1);
$pdf->SetXY(194.8, 72);
$pdf->Cell(77.5, 8, "4. Only LIS generated SF5 shall be recognized (DO 11,", 0, 1);
$pdf->SetXY(194.8, 75);
$pdf->Cell(77.5, 8, "2018, page 7)", 0, 1);
$pdf->SetXY(194.8, 78);
$pdf->Cell(77.5, 8, "5. This form shall be submitted to the DCC together with the", 0, 1);
$pdf->SetXY(194.8, 81);
$pdf->Cell(77.5, 8, "accomplished SFCR1 - SCC- (Deped Order 11, 2018, page", 0, 1);
$pdf->SetXY(194.8, 84);
$pdf->Cell(77.5, 8, "11)", 0, 1);

$pdf->SetLineWidth(0.3);
$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(194.8, 101);
$pdf->Cell(77.5, 7, "PREPARED BY:", 0, 1);
$pdf->SetFont('Arial', '', 8.5);
$pdf->SetXY(195.8, 108);
$faculty = $_SESSION['name'];
$pdf->Cell(76.5, 4, $faculty, "B", 1, 'C', 0);

$pdf->SetFont('Arial', 'I', 6);
$pdf->Text(226.5, 115, "Class Adviser", "B", 1, 'C', 0);
$pdf->Text(222, 118, "(Name and Signature)", "B", 1, 'C', 0);
$pdf->Text(219.5, 133.5, "School Head & SCC Chair", "B", 1, 'C', 0);
$pdf->Text(222, 136.5, "(Name and Signature)", "B", 1, 'C', 0);

$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(194.8, 119);
$pdf->Cell(77.5, 7, "CERTIFIED CORRECT & SUBMITTED BY:", 0, 1);
$pdf->SetXY(195.8, 126.5);
$pdf->SetFont('Arial', '', 8.5);
$pdf->Cell(76.5, 4, $schoolRow['school_head'], "B", 1, 'C', 0);



$pdf->SetXY(194.8, 137);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(77.5, 7, "REVIEWED BY: SCC Members", 0, 1);
$pdf->SetXY(195.8, 148);
$pdf->Cell(76.5, 4, "", "B", 1, 'C', 0);
$pdf->SetXY(195.8, 165);
$pdf->Cell(76.5, 4, "", "B", 1, 'C', 0);
$pdf->SetXY(195.8, 182);
$pdf->Cell(76.5, 4, "", "B", 1, 'C', 0);
$pdf->SetXY(195.8, 199);
$pdf->Cell(76.5, 4, "", "B", 1, 'C', 0);

$pdf->SetFont('Arial', 'I', 7);
$pdf->Text(216, 155, "Signature over Printed Name", "B", 1, 'C', 0);
$pdf->Text(216, 172, "Signature over Printed Name", "B", 1, 'C', 0);
$pdf->Text(216, 189, "Signature over Printed Name", "B", 1, 'C', 0);
$pdf->Text(216, 206, "Signature over Printed Name", "B", 1, 'C', 0);

//SF5 B
$pdf->AddPage('L', 'A4');

$pdf->SetMargins(10, 0, 5);

$pdf->SetAutoPageBreak(true, 5);
$pdf->Image('../images/circleLogosf5.jpg', 6, 3, 20, 21);
$pdf->Image('../images/depedlogosf5.jpg', 239, 4, 31, 18);

$pdf->SetXY(37, 10);
$pdf->SetFont('Arial', '', 15.2);
$pdf->Cell(16, 6, 'School Form 5B List of Learners with Complete SHS Requirements (SF5B-SHS)', 0, 1, '', 0);
$pdf->SetXY(97, 15);



$pdf->SetXY(15, 25.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'School Name', 0, 0, '', 0);
$pdf->SetXY(35.5, 25.9);
$pdf->SetLineWidth(0.3);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(55, 7, $schoolRow['school_name'], 1, 0, 'C', 0);

$pdf->SetXY(20.5, 34.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Semester', 0, 0, '', 0);
$pdf->SetXY(35.5, 34.5);
$pdf->SetFont('Arial', 'B', 7);
$currentMonth = date('m');
if ($currentMonth >= 8) {
    $pdf->Cell(55, 7, '1st', 1, 0, 'C', 0);
} else {
    $pdf->Cell(55, 7, '2nd', 1, 0, 'C', 0);;
}


$pdf->SetXY(9.5, 43.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Track and Strand', 0, 0, '', 0);
$pdf->SetXY(35.5, 43.5);
$pdf->SetFont('Arial', 'B', 7);
if ($sectionsf5Row["track"] == "Technical-Vocational-Livelihood") {
    $pdf->Cell(98, 7, $sectionsf5Row["track"], 1, 0, 'C', 0);
} else {
    $pdf->Cell(98, 7, $sectionsf5Row["track"] . " - " . $sectionsf5Row["strand"], 1, 0, 'C', 0);
}


$pdf->SetXY(98.7, 25.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'School ID', 0, 0, '', 0);
$pdf->SetXY(114.2, 25.9);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(23.5, 7, $schoolRow['school_id'], 1, 0, 'C', 0);


$pdf->SetXY(94, 34.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'School Year', 0, 0, '', 0);
$pdf->SetXY(114.2, 34.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(23.5, 7, $sectionsf5Row['school_year'], 1, 0, 'C', 0);

$pdf->SetXY(147.5, 25.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'District', 0, 0, '', 0);
$pdf->SetXY(159.5, 25.9);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(21, 7, $schoolRow['school_district'], 1, 0, 'C', 0);

$pdf->SetXY(141, 34.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Grade level', 0, 0, '', 0);
$pdf->SetXY(159.5, 34.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(21, 7, $sectionsf5Row["grade"], 1, 0, 'C', 0);


$pdf->SetXY(187, 25.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Divison', 0, 0, '', 0);
$pdf->SetXY(199.5, 25.9);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(27.5, 7, $schoolRow['school_division'], 1, 0, 'C', 0);

$pdf->SetXY(187.2, 34.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Section', 0, 0, '', 0);
$pdf->SetXY(199.5, 34.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(71.5, 7, $sectionsf5Row["name"], 1, 0, 'C', 0);

$pdf->SetXY(148, 43.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Course (only for TVL)', 0, 0, '', 0);
$pdf->SetXY(182.5, 43.5);
$pdf->SetFont('Arial', 'B', 7);
if ($sectionsf5Row["track"] == "Technical-Vocational-Livelihood") {
    $pdf->Cell(88.5, 7, 'Animation (NC II), Computer Programming(NC IV)', 1, 0, 'C', 0);
} else {
    $pdf->Cell(88.5, 7, '', 1, 0, 'C', 0);
}

$pdf->SetXY(235, 25.9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(55, 7, 'Region', 0, 0, '', 0);
$pdf->SetXY(247, 25.9);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(24, 7, $schoolRow['school_region'], 1, 0, 'C', 0);

$pdf->Ln(28);
$pdf->Cell(-5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Ln(0);
$pdf->Cell(-5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(9.5, 29, 'NO', 1, 0, 'C', 0);
$pdf->Cell(25, 29, 'LRN', 1, 0, 'C', 0);
$pdf->Cell(64, 29, '', 1, 0, 'C', 0);
$pdf->Text(56, 66.5, "LEARNERS NAME", "B", 1, 'C', 0);
$pdf->Text(42.5, 70.5, "(Last Name, First Name, Middle Name)", "B", 1, 'C', 0);

$pdf->Cell(37, 29, '', 1, 0, '', 0);
$pdf->Text(102, 66.5, "      Completed SHS in 2", "B", 1, 'C', 0);
$pdf->Text(112, 70.5, "SY's (Yes/No)", "B", 1, 'C', 0);



$pdf->SetFont('Arial', 'B', 7.7);
$pdf->Cell(49.5, 29, '', 1, 1, 'C', 0);
$pdf->Text(142, 66.5, "National Certification Level Attained ", "B", 1, 'C', 0);
$pdf->Text(153.5, 70.5, "(only if applicable)", "B", 1, 'C', 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(-5);
$pdf->Cell(9.5, 6.5, '', 1, 0, 'C', 0);
$pdf->Cell(25, 6.5, 'MALE', 1, 0, 'C', 0);
$pdf->Cell(64, 6.5, '', 1, 0, '', 0);
$pdf->Cell(37, 6.5, '', 1, 0, '', 0);
$pdf->Cell(49.5, 6.5, '', 1, 1, '', 0);

$pdf->Ln(-35.5);
$pdf->Cell(184.5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(76.3, 7, 'Summary Table', 1, 1, 'C', 0);
$pdf->Cell(184.5);
$pdf->Cell(36.3, 7, 'STATUS', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, 'Male', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, 'Female', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, 'Total', 1, 1, 'C', 0);

$pdf->Cell(184.5);
$pdf->Cell(36.3, 18, '', 1, 0, 'C', 0);
$pdf->SetFont('Arial', 'B', 6.9);
$pdf->Text(195.5, 73.5, "Learners who completed SHS", "B", 1, 'C', 0);
$pdf->Text(197.5, 76.5, "Program within 2 SYs or 4", "B", 1, 'C', 0);
$pdf->Text(209.5, 79.5, "Sems", "B", 1, 'C', 0);


$pdf->Cell(-0.000001);
$completedMale = "SELECT * FROM `sf5b` WHERE `completed` = 'Yes' AND `sex` = 'M' AND `section` = '$sectionName' AND school_year_id = '$school_year_id'";
$completedMaleResult = $conn->query($completedMale);
$completedMaleCount = $completedMaleResult->num_rows;
$pdf->Cell(13.33, 18, $completedMaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);

$completedFemale = "SELECT * FROM `sf5b` WHERE `completed` = 'Yes' AND `sex` = 'F' AND `section` = '$sectionName' AND school_year_id = '$school_year_id'";
$completedFemaleResult = $conn->query($completedFemale);
$completedFemaleCount = $completedFemaleResult->num_rows;
$pdf->Cell(13.33, 18, $completedFemaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 18, $completedMaleCount + $completedFemaleCount, 1, 1, 'C', 0);

$pdf->Cell(184.5);
$pdf->Cell(36.3, 22, '', 1, 0, 'C', 0);
$pdf->SetFont('Arial', 'B', 6.9);
$pdf->Text(195.5, 93.5, "Learners who completed SHS", "B", 1, 'C', 0);
$pdf->Text(195.2, 96.5, "Program more than 2 SYs or 4", "B", 1, 'C', 0);
$pdf->Text(209.5, 99.5, "Sems", "B", 1, 'C', 0);

$pdf->Cell(-0.000001);
$incompleteMale = "SELECT * FROM `sf5b` WHERE `completed` = 'No' AND `sex` = 'M' AND `section` = '$sectionName' AND school_year_id = '$school_year_id'";
$incompleteMaleResult = $conn->query($incompleteMale);
$incompleteMaleCount = $incompleteMaleResult->num_rows;
$pdf->Cell(13.33, 22, $incompleteMaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);

$incompleteFemale = "SELECT * FROM `sf5b` WHERE `completed` = 'No' AND `sex` = 'F' AND `section` = '$sectionName' AND school_year_id = '$school_year_id'";
$incompleteFemaleResult = $conn->query($incompleteFemale);
$incompleteFemaleCount = $incompleteFemaleResult->num_rows;
$pdf->Cell(13.33, 22, $incompleteFemaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 22, $incompleteMaleCount + $incompleteFemaleCount, 1, 1, 'C', 0);

$pdf->Cell(184.5);
$pdf->Cell(36.3, 7, 'Total', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $completedMaleCount + $incompleteMaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $completedFemaleCount + $incompleteFemaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $completedMaleCount + $incompleteMaleCount + $completedFemaleCount + $incompleteFemaleCount, 1, 1, 'C', 0);

$pdf->Ln(5);
$pdf->Cell(184.5);
$pdf->SetLineWidth(0.5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(76.3, 7, 'Summary table B', 1, 1, 'C', 0);
$pdf->Cell(184.5);
$pdf->Cell(36.3, 7, 'STATUS', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, 'Male', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, 'Female', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, 'Total', 1, 1, 'C', 0);

$pdf->Cell(184.5);
$pdf->Cell(36.3, 7, 'NC III', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$nc3Male = "SELECT * FROM `sf5b` WHERE `nc` = 'NC III' AND `section` = '$sectionName' AND school_year_id = '$school_year_id' AND `sex` = 'M'";
$nc3MaleResult = $conn->query($nc3Male);
$nc3MaleCount = $nc3MaleResult->num_rows;
$pdf->Cell(13.33, 7, $nc3MaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$nc3Female = "SELECT * FROM `sf5b` WHERE `nc` = 'NC III' AND `section` = '$sectionName' AND school_year_id = '$school_year_id' AND `sex` = 'F'";
$nc3FemaleResult = $conn->query($nc3Female);
$nc3FemaleCount = $nc3FemaleResult->num_rows;
$pdf->Cell(13.33, 7, $nc3FemaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $nc3FemaleCount + $nc3MaleCount, 1, 1, 'C', 0);

$pdf->Cell(184.5);
$pdf->Cell(36.3, 7, 'NC II', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$nc2Male = "SELECT * FROM `sf5b` WHERE `nc` = 'NC II' AND `section` = '$sectionName' AND school_year_id = '$school_year_id' AND `sex` = 'M'";
$nc2MaleResult = $conn->query($nc2Male);
$nc2MaleCount = $nc2MaleResult->num_rows;
$pdf->Cell(13.33, 7, $nc2MaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$nc2Female = "SELECT * FROM `sf5b` WHERE `nc` = 'NC II' AND `section` = '$sectionName' AND school_year_id = '$school_year_id' AND `sex` = 'F'";
$nc2FemaleResult = $conn->query($nc2Female);
$nc2FemaleCount = $nc2FemaleResult->num_rows;
$pdf->Cell(13.33, 7, $nc2FemaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $nc2FemaleCount + $nc2MaleCount, 1, 1, 'C', 0);

$pdf->Cell(184.5);
$pdf->Cell(36.3, 7, 'NC I', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$nc1Male = "SELECT * FROM `sf5b` WHERE `nc` = 'NC I' AND `section` = '$sectionName' AND school_year_id = '$school_year_id' AND `sex` = 'M'";
$nc1MaleResult = $conn->query($nc1Male);
$nc1MaleCount = $nc1MaleResult->num_rows;
$pdf->Cell(13.33, 7, $nc1MaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$nc1Female = "SELECT * FROM `sf5b` WHERE `nc` = 'NC I' AND `section` = '$sectionName' AND school_year_id = '$school_year_id' AND `sex` = 'F'";
$nc1FemaleResult = $conn->query($nc1Female);
$nc1FemaleCount = $nc1FemaleResult->num_rows;
$pdf->Cell(13.33, 7, $nc1FemaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $nc1FemaleCount + $nc1MaleCount, 1, 1, 'C', 0);

$pdf->Cell(184.5);
$pdf->Cell(36.3, 7, 'Total', 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $nc3MaleCount + $nc2MaleCount + $nc1MaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $nc3FemaleCount + $nc2FemaleCount + $nc1FemaleCount, 1, 0, 'C', 0);
$pdf->Cell(-0.000001);
$pdf->Cell(13.33, 7, $nc3MaleCount + $nc2MaleCount + $nc1MaleCount + $nc3FemaleCount + $nc2FemaleCount + $nc1FemaleCount, 1, 1, 'C', 0);


$pdf->SetXY(195, 165);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(77.5, 7, "GUIDELINESS:", 0, 1);

$pdf->SetXY(195, 169.5);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(77.5, 7, "1. This form should be accomplished by the Class Adviser ", 0, 1);
$pdf->SetXY(195, 173);
$pdf->Cell(77.5, 7, "at End of School Year.", 0, 1);
$pdf->SetXY(195, 176.5);
$pdf->Cell(77.5, 7, "2. It should be compiled and checked by the School", 0, 1);
$pdf->SetXY(195, 180);
$pdf->Cell(77.5, 7, "Head and passed to the Division Office before graduation.", 0, 1);

// MALE TABLE
$maleStudent = "SELECT * FROM `sf5b` WHERE `sex` = 'M' AND `section` = '$nameOfSection' AND school_year_id = '$school_year_id' ORDER BY `student_name` ASC";
$resultMaleStudent = mysqli_query($conn, $maleStudent);
$countMaleStudent = $resultMaleStudent->num_rows;
$pdf->SetXY(10, 89.5);
$countsf5B = 1;
while ($rowMaleStudent = mysqli_fetch_assoc($resultMaleStudent)) {
    $pdf->SetFont('Arial', 'I', 6);
    $pdf->SetLineWidth(0.5);
    $pdf->SetTopMargin(7);
    $pdf->Cell(-5);
    $pdf->Cell(9.5, 7, $countsf5B, 1, 0, 'C', 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(25, 7, $rowMaleStudent["lrn"], 1, 0, 'C', 0);
    $pdf->Cell(64, 7, $rowMaleStudent["student_name"], 1, 0, 'C', 0);
    $pdf->Cell(37, 7, $rowMaleStudent["completed"], 1, 0, 'C', 0);
    $pdf->Cell(49.5, 7, $rowMaleStudent["nc"], 1, 1, 'C', 0);
    $countsf5B++;
}

$pdf->Cell(-5);
$pdf->Cell(9.5, 7, "", 1, 0, 'C', 0);
$pdf->Cell(25, 7, $countMaleStudent, 1, 0, 'L', 0);
$pdf->Cell(64, 7, "<=== TOTAL MALE", 1, 0, 'L', 0);
$pdf->Cell(37, 7, '', 1, 0, 'C', 0);
$pdf->Cell(49.5, 7, '', 1, 1, 'C', 0);


//FEMALE TABLE
$femaleStudent = "SELECT * FROM `sf5b` WHERE `sex` = 'F' AND `section` = '$nameOfSection' AND school_year_id = '$school_year_id' ORDER BY `student_name` ASC";
$resultFemaleStudent = mysqli_query($conn, $femaleStudent);
$countFemaleStudent = $resultFemaleStudent->num_rows;
while ($rowFemaleStudent = mysqli_fetch_assoc($resultFemaleStudent)) {
    $pdf->SetFont('Arial', 'I', 6);
    $pdf->SetLineWidth(0.5);
    $pdf->SetTopMargin(7);
    $pdf->Cell(-5);
    $pdf->Cell(9.5, 7, $countsf5B, 1, 0, 'C', 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(25, 7, $rowFemaleStudent["lrn"], 1, 0, 'C', 0);
    $pdf->Cell(64, 7, $rowFemaleStudent["student_name"], 1, 0, 'C', 0);
    $pdf->Cell(37, 7, $rowFemaleStudent["completed"], 1, 0, 'C', 0);
    $pdf->Cell(49.5, 7, $rowFemaleStudent["nc"], 1, 1, 'C', 0);
    $countsf5B++;
}

$pdf->Cell(-5);
$pdf->Cell(9.5, 7, "", 1, 0, 'C', 0);
$pdf->Cell(25, 7, $countFemaleStudent, 1, 0, 'L', 0);
$pdf->Cell(64, 7, "<=== TOTAL FEMALE", 1, 0, 'L', 0);
$pdf->Cell(37, 7, '', 1, 0, 'C', 0);
$pdf->Cell(49.5, 7, '', 1, 1, 'C', 0);

$pdf->Cell(-5);
$pdf->Cell(9.5, 7, "", 1, 0, 'C', 0);
$pdf->Cell(25, 7, $countMaleStudent + $countFemaleStudent, 1, 0, 'L', 0);
$pdf->Cell(64, 7, "<=== COMBINED", 1, 0, 'L', 0);
$pdf->Cell(37, 7, '', 1, 0, 'C', 0);
$pdf->Cell(49.5, 7, '', 1, 1, 'C', 0);

if ($pdf->CheckPageBreak(100)) {
    $pdf->AddPage(); // Add a new page
}

$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(194.8, 5);
$pdf->Cell(77.5, 8, "Instructions:", 0, 1);
$pdf->SetFont('Arial', '', 7);
$pdf->SetXY(194.8, 8.5);
$pdf->Cell(77.5, 8, "1. The SCC shall conduct checking in their own school, no swapping", 0, 1);
$pdf->SetXY(194.8, 12);
$pdf->Cell(77.5, 8, "of SCC from one school to another is permitted.", 0, 1);
$pdf->SetXY(194.8, 15.5);
$pdf->Cell(77.5, 8, "2. The name of SCC members shall be printed and put their signature", 0, 1);
$pdf->SetXY(194.8, 19);
$pdf->Cell(77.5, 8, "on top (additional space may be added)", 0, 1);
$pdf->SetXY(194.8, 22.5);
$pdf->Cell(77.5, 8, "3. The school head is accountable and liable for any wrongful entry on", 0, 1);
$pdf->SetXY(194.8, 26);
$pdf->Cell(77.5, 8, "the forms (Deped Order 4, 2014 par.5) therefore, the DCC is not", 0, 1);
$pdf->SetXY(194.8, 29.5);
$pdf->Cell(77.5, 8, "required to put their names and signatures in SF 5", 0, 1);
$pdf->SetXY(194.8, 33);
$pdf->Cell(77.5, 8, "4. Only LIS generated SF5 shall be recognized (DO 11, 2018, page 7)", 0, 1);
$pdf->SetXY(194.8, 36.5);
$pdf->Cell(77.5, 8, "5. This form shall be submitted to the DCC together with the", 0, 1);
$pdf->SetXY(194.8, 40);
$pdf->Cell(77.5, 8, "accomplished SFCR1 - SCC- (Deped Order 11, 2018, page 11)", 0, 1);




$pdf->SetLineWidth(0);
$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(194.8, 53);
$pdf->Cell(77.5, 7, "PREPARED BY:", 0, 1);
$pdf->SetFont('Arial', '', 8.5);
$pdf->SetXY(195.8, 60);
$pdf->Cell(76.5, 4, $faculty, "B", 1, 'C', 0);


$pdf->SetFont('Arial', 'I', 6);
$pdf->Text(226.5, 67, "Class Adviser", "B", 1, 'C', 0);
$pdf->Text(222, 70, "(Name and Signature)", "B", 1, 'C', 0);
$pdf->Text(219.5, 96.5, "School Head & SCC Chair", "B", 1, 'C', 0);
$pdf->Text(222, 99.5, "(Name and Signature)", "B", 1, 'C', 0);




$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(194.8, 81);
$pdf->Cell(77.5, 7, "CERTIFIED CORRECT & SUBMITTED BY:", 0, 1);
$pdf->SetXY(195.8, 88.5);
$pdf->SetFont('Arial', '', 8.5);
$pdf->Cell(76.5, 4, $schoolRow['school_head'], "B", 1, 'C', 0);


$pdf->SetXY(194.8, 109);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(77.5, 7, "REVIEWED BY: SCC Members", 0, 1);
$pdf->SetXY(195.8, 120);
$pdf->Cell(76.5, 4, "", "B", 1, 'C', 0);
$pdf->SetXY(195.8, 137);
$pdf->Cell(76.5, 4, "", "B", 1, 'C', 0);
$pdf->SetXY(195.8, 154);
$pdf->Cell(76.5, 4, "", "B", 1, 'C', 0);
$pdf->SetXY(195.8, 171);
$pdf->Cell(76.5, 4, "", "B", 1, 'C', 0);



$pdf->SetFont('Arial', 'I', 7);
$pdf->Text(216, 127, "Signature over Printed Name", "B", 1, 'C', 0);
$pdf->Text(216, 144, "Signature over Printed Name", "B", 1, 'C', 0);
$pdf->Text(216, 161, "Signature over Printed Name", "B", 1, 'C', 0);
$pdf->Text(216, 178, "Signature over Printed Name", "B", 1, 'C', 0);

$pdf->Output();
