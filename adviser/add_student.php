<?php
include("../config.php");
session_start();

//ADD STUDENT
if (isset($_POST["add_student"])) {
    $sy = "SELECT * FROM school_year WHERE is_archived = 0";
    $syResult = $conn->query($sy);
    $syRow = $syResult->fetch_assoc();
    $school_year_id = $syRow['id'];
    $syName = $syRow['sy'];

    $lrn = mysqli_real_escape_string($conn, $_POST["lrn"]);
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $mname = mysqli_real_escape_string($conn, $_POST["mname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $suffix = mysqli_real_escape_string($conn, $_POST["suffix"]);
    $name = $lname . ", " . $fname . " " . $suffix . " " . $mname;
    $sex = mysqli_real_escape_string($conn, $_POST["sex"]);
    $birth_date = mysqli_real_escape_string($conn, $_POST["birth_date"]);
    $birth_date2 = mysqli_real_escape_string($conn, $_POST["birth_date"]);
    $date = new DateTime($birth_date);
    $formattedBirthDate = $date->format("m-d-Y");

    //calculate age
    $dob = new DateTime($birth_date);
    $now = new DateTime();
    $diff = $now->diff($dob);
    $age = $diff->y;
    //

    $birthdayDate = date("m-d", strtotime($birth_date));
    if ($birthdayDate <= "10-30") {
        $age--;
    }

    $ra = mysqli_real_escape_string($conn, $_POST["ra"]);
    $house_no = mysqli_real_escape_string($conn, $_POST["house_no"]);
    $barangay_id = mysqli_real_escape_string($conn, $_POST["barangay"]);
    $municipality_id = mysqli_real_escape_string($conn, $_POST["municipality"]);
    $province_id = mysqli_real_escape_string($conn, $_POST["province"]);

    $barangaySQL = "SELECT * FROM table_barangay WHERE barangay_id = '$barangay_id'";
    $barangayResult = $conn->query($barangaySQL);
    $barangayRow = $barangayResult->fetch_assoc();
    $barangay = $barangayRow['barangay_name'];

    $municipalitySQL = "SELECT * FROM table_municipality WHERE municipality_id = '$municipality_id'";
    $municipalityResult = $conn->query($municipalitySQL);
    $municipalityRow = $municipalityResult->fetch_assoc();
    $municipality = $municipalityRow['municipality_name'];

    $provinceSQL = "SELECT * FROM table_province WHERE province_id = '$province_id'";
    $provinceResult = $conn->query($provinceSQL);
    $provinceRow = $provinceResult->fetch_assoc();
    $province = $provinceRow['province_name'];

    $father = mysqli_real_escape_string($conn, $_POST["father"]);
    $mother = mysqli_real_escape_string($conn, $_POST["mother"]);
    $guardian = mysqli_real_escape_string($conn, $_POST["guardian"]);
    $relationship = mysqli_real_escape_string($conn, $_POST["relationship"]);
    $lm = mysqli_real_escape_string($conn, $_POST["lm"]);
    $contact = '0' . mysqli_real_escape_string($conn, $_POST["contact"]);
    $section = mysqli_real_escape_string($conn, $_POST["section"]);

    $sectionName = "SELECT * FROM `section` WHERE `name` = '$section' AND is_archived = 0 AND school_year_id = '$school_year_id'";
    $sectionNameResult = mysqli_query($conn, $sectionName);
    $sectionNameRow = mysqli_fetch_assoc($sectionNameResult);

    $track = $sectionNameRow["track"];
    $strand = $sectionNameRow["strand"];
    $grade = $sectionNameRow["grade"];

    $indicator = mysqli_real_escape_string($conn, $_POST["indicator"]);
    $ri = mysqli_real_escape_string($conn, $_POST["ri"]);
    $rid = mysqli_real_escape_string($conn, $_POST["rid"]);

    $student = "SELECT * FROM `student` WHERE `lrn` = '$lrn'";
    $studentResult = mysqli_query($conn, $student);

    if (mysqli_num_rows($studentResult) > 0) {
        header("location:student_table.php?errmsg=The student already exist!");
        exit();
    } else {
        $insert = "INSERT INTO `student`(`lrn`, `fname`, `mname`, `lname`, `suffix`, `name`, `sex`, `birth_date`, `birth_date2`, `age`, `ra`, `house_no`, `barangay`, `municipality`, `province`, `father`, `mother`, `guardian`, `relationship`, `lm`, `contact`, `section`, `school_year_id`, `school_year`,`track`,`strand`, `grade`, `indicator`, `ri`, `rid`, `barangay_id`, `municipality_id`, `province_id`)
         VALUES 
         ('$lrn','$fname','$mname','$lname', '$suffix','$name','$sex','$formattedBirthDate','$birth_date2','$age','$ra','$house_no','$barangay','$municipality','$province','$father','$mother','$guardian','$relationship','$lm','$contact', '$section', '$school_year_id', '$syName',  '$track',  '$strand',  '$grade', '$indicator', '$ri', '$rid', '$barangay_id', '$municipality_id', '$province_id')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'student_table.php?msg=Student added successfully!';</script>");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>

    <script>
        function calculateAge() {
            // Get the selected birthdate from the input
            const birthdateInput = document.getElementById("birth_date").value;

            // Create a Date object for the birthdate
            const birthdate = new Date(birthdateInput);

            // Get the current date
            const currentDate = new Date();

            // Calculate the age
            let age = currentDate.getFullYear() - birthdate.getFullYear();

            // Check if the birthdate hasn't occurred yet this year
            const birthdateMonth = birthdate.getMonth();
            const birthdateDay = birthdate.getDate();
            const currentMonth = currentDate.getMonth();
            const currentDay = currentDate.getDate();

            if (currentMonth < birthdateMonth || (currentMonth === birthdateMonth && currentDay < birthdateDay)) {
                age--;
            }

            // Display the calculated age in the input element
            document.getElementById("age").value = age;
        }
    </script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">Student</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="student_table.php">Student Table</a></li>
                            <li class="breadcrumb-item active">Add Student</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-5">
                        <div class="card-header">
                            <h4>Add Student</h4>
                        </div>
                        <div class="card-body row g-1">
                            <div class="form-floating mb-3 col-2 d-inline-block">
                                <input type="number" name="lrn" id="lrn" placeholder="lrn" class="form-control bg-body-tertiary" required />
                                <label for="lrn">LRN</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter LRN.</div>
                            </div>
                            <div class="form-floating mb-3 col-3 d-inline-block">
                                <input type="text" name="fname" id="fname" placeholder="fname" class="form-control bg-body-tertiary" required />
                                <label for="fname">First name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter student first name.</div>
                            </div>
                            <div class="form-floating mb-3 col-3 d-inline-block">
                                <input type="text" name="mname" id="mname" placeholder="mname" class="form-control bg-body-tertiary" />
                                <label for="mname">Middle name <sup class="text-primary">(optional)</sup></label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter student middle initial.</div>
                            </div>
                            <div class="form-floating mb-3 col-3 d-inline-block">
                                <input type="text" name="lname" id="lname" placeholder="lname" class="form-control bg-body-tertiary" required />
                                <label for="lname">Last name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter student last name.</div>
                            </div>
                            <div class="form-floating mb-3 col-1 d-inline-block">
                                <input type="text" name="suffix" id="suffix" placeholder="suffix" class="form-control bg-body-tertiary" maxlength="3" />
                                <label for="suffix">Suffix <br><sup class="text-primary">(optional)</sup></label>
                            </div>
                            <div class="form-floating mb-3 col-3 d-inline-block">
                                <?php
                                $faculty = $_SESSION['name'];
                                $section = "SELECT * FROM `user` WHERE `name` = '$faculty'";
                                $sectionResult = $conn->query($section);
                                $sectionRow = $sectionResult->fetch_assoc();
                                ?>
                                <input type="text" class="form-control bg-body-tertiary" name="section" id="section" value="<?php echo $sectionRow["section"] ?>" readonly>
                                <label for="section">Section</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select section.</div>
                            </div>
                            <div class="form-floating mb-3 col-2 pe-0 d-inline-block">
                                <select class="form-select bg-body-tertiary" name="sex" id="sex">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                <label for="sex">Sex</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select sex.</div>
                            </div>
                            <div class="form-floating mb-3 d-inline-block col-2">
                                <input type="date" name="birth_date" id="birth_date" placeholder="birth_date" class="form-control bg-body-tertiary" required onchange="calculateAge()" />
                                <label for="birth_date">Birthdate</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please choose a birth date.</div>
                            </div>
                            <div class="form-floating mb-3 d-inline-block col-1 col d-inline-block">
                                <input type="number" name="age" id="age" placeholder="age" class="form-control bg-body-tertiary" readonly />
                                <label for="age">Age</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter age.</div>
                            </div>
                            <div class="form-floating mb-3 d-inline-block col-4 col d-inline-block">
                                <input type="text" name="ra" id="ra" placeholder="ra" class="form-control bg-body-tertiary" required />
                                <label for="ra">Religious Affiliation</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a religious affiliation.</div>
                            </div>
                            <div class="form-floating mb-3 col-4 col pe-0 d-inline-block">
                                <select class="form-select bg-body-tertiary" name="province" id="province" required onchange="loadMunicipalities()">
                                    <option selected></option>
                                    <?php
                                    $provinceSQL = "SELECT * FROM table_province ORDER BY province_name ASC";
                                    $provinceSQLResult = $conn->query($provinceSQL);
                                    while ($provinceSQLRow = $provinceSQLResult->fetch_assoc()) { ?>
                                        <option value="<?php echo $provinceSQLRow['province_id'] ?>"><?php echo $provinceSQLRow['province_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <label for="province">Province</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a province.</div>
                            </div>
                            <div class="form-floating mb-3 col-4 col pe-0 d-inline-block">
                                <select class="form-select bg-body-tertiary" name="municipality" id="municipality" required onchange="loadBarangays()" disabled>

                                </select>
                                <label for="municipality">Municipality</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a municipality.</div>
                            </div>
                            <div class="form-floating mb-3 col-4 col pe-0 d-inline-block">
                                <select class="form-select bg-body-tertiary" name="barangay" id="barangay" required disabled>

                                </select>
                                <label for="barangay">Barangay</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a barangay.</div>
                            </div>
                            <div class="form-floating mb-3 d-inline-block col-12">
                                <input type="text" name="house_no" id="house_no" placeholder="house_no" class="form-control bg-body-tertiary" required />
                                <label for="house_no">House No. / Street / Sitio / Purok </label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter house no.</div>
                            </div>
                            <div class="form-floating mb-3 d-inline-block col-6">
                                <input type="text" name="father" id="father" placeholder="father" class="form-control bg-body-tertiary" required />
                                <label for="father">Father's name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a father's name.</div>
                            </div>
                            <div class="form-floating mb-3 d-inline-block col-6">
                                <input type="text" name="mother" id="mother" placeholder="mother" class="form-control bg-body-tertiary" required />
                                <label for="mother">Mother's maiden name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a mother's name.</div>
                            </div>
                            <div class="form-floating mb-3 d-inline-block col-6 d-inline-block">
                                <input type="text" name="guardian" id="guardian" placeholder="guardian" class="form-control bg-body-tertiary" required />
                                <label for="guardian">Guardian's name</label>
                            </div>
                            <div class="form-floating mb-3 col-3 d-inline-block">
                                <input type="text" name="relationship" id="relationship" placeholder="relationship" class="form-control bg-body-tertiary" required />
                                <label for="relationship">Relationship</label>
                            </div>
                            <div class="input-group mb-3 col" style="height: 58px;">
                                <span class="input-group-text" id="basic-addon1" style="height: 58px;">+63</span>
                                <div class="form-floating mb-3 col-4 d-inline-block">
                                    <input type="text" name="contact" id="contact" placeholder="contact" class="form-control bg-body-tertiary" required maxlength="10" />
                                    <label for="contact">Contact no.</label>
                                    <div class="valid-feedback ps-1">Great!</div>
                                    <div class="invalid-feedback ps-1"> Please enter contact no.</div>
                                </div>
                            </div>
                            <div class="form-floating mb-3 col-3 pe-0 d-inline-block">
                                <select class="form-select bg-body-tertiary" name="lm" id="lm" required>
                                    <option value="Face to face">Face to face</option>
                                    <option value="Online class">Online class</option>
                                </select>
                                <label for="lm">Learning modality</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select learning modality.</div>
                            </div>
                            <div class="input-group mb-3 col" style="height: 58px;">
                                <div class="form-floating mb-3 d-inline-block col">
                                    <select class="form-select bg-body-tertiary" name="indicator" id="indicator">
                                        <option value="" selected>Indicator</option>
                                        <option value="T/O">T/O</option>
                                        <option value="T/I">T/I</option>
                                        <option value="CCT">CCT</option>
                                        <option value="B/A">B/A</option>
                                        <option value="LWE">LWE</option>
                                        <option value="ACL">ACL</option>
                                    </select>
                                    <label for="indicator">Indicator<sup class="text-primary">(optional)</sup></label>
                                </div>
                                <span class="input-group-text" style="height: 58px;">&</span>
                                <div class="form-floating mb-3 col d-inline-block">
                                    <input type="text" name="ri" id="ri" placeholder="ri" class="form-control bg-body-tertiary" />
                                    <label for="ri">Required Information<sup class="text-primary">(optional)</sup></label>
                                    <div class="valid-feedback ps-1">Great!</div>
                                    <div class="invalid-feedback ps-1"> Please enter required information.</div>
                                </div>
                                <div class="form-floating mb-3 col d-inline-block">
                                    <input type="date" name="rid" id="rid" placeholder="rid" class="form-control bg-body-tertiary" />
                                    <label for="rid">Date<sup class="text-primary">(optional)</sup></label>
                                    <div class="valid-feedback ps-1">Great!</div>
                                    <div class="invalid-feedback ps-1"> Please enter required information date.</div>
                                </div>
                            </div>
                            <img src="../images/sf1RI.png" alt="sf 1 chart" class="" height="150px;" width="500px">
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <input type="submit" value="Add" name="add_student" class="btn btn-primary">
                                <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script>
        function loadMunicipalities() {
            // Get the selected province value
            var selectedProvince = document.getElementById("province").value;

            // Enable the municipality dropdown
            document.getElementById("municipality").disabled = false;

            // Make an AJAX request to fetch municipalities based on the selected province
            // Replace 'fetchMunicipalities.php' with the actual server-side script
            // that will fetch the municipalities based on the selected province
            var url = 'fetchMunicipalities.php?province=' + selectedProvince;

            // Use Fetch API or XMLHttpRequest to make the AJAX request
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Populate the municipality dropdown with fetched data
                    var municipalityDropdown = document.getElementById("municipality");
                    municipalityDropdown.innerHTML = "<option value=''>Select Municipality</option>";

                    data.forEach(function(municipality) {
                        var option = document.createElement("option");
                        option.value = municipality.municipality_id;
                        option.text = municipality.municipality_name;
                        municipalityDropdown.add(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function loadBarangays() {
            // Get the selected municipality value
            var selectedMunicipality = document.getElementById("municipality").value;

            // Enable the barangay dropdown
            document.getElementById("barangay").disabled = false;

            // Make an AJAX request to fetch barangays based on the selected municipality
            // Replace 'fetchBarangays.php' with the actual server-side script
            // that will fetch the barangays based on the selected municipality
            var url = 'fetchBarangays.php?municipality=' + selectedMunicipality;

            // Use Fetch API or XMLHttpRequest to make the AJAX request
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Populate the barangay dropdown with fetched data
                    var barangayDropdown = document.getElementById("barangay");
                    barangayDropdown.innerHTML = "<option value=''>Select Barangay</option>";

                    data.forEach(function(barangay) {
                        var option = document.createElement("option");
                        option.value = barangay.barangay_id;
                        option.text = barangay.barangay_name;
                        barangayDropdown.add(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
    <script src="../index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>
<?php

$conn->close();
