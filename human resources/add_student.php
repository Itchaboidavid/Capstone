<?php
include("../config.php");
if (isset($_POST["submit"])) {
    $lrn = mysqli_real_escape_string($conn, $_POST["lrn"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $sex = mysqli_real_escape_string($conn, $_POST["sex"]);
    $birth_date = mysqli_real_escape_string($conn, $_POST["birth_date"]);
    //calculate age
    $dob = new DateTime($birth_date);
    $now = new DateTime();
    $diff = $now->diff($dob);
    $age = $diff->y;
    //
    $ra = mysqli_real_escape_string($conn, $_POST["ra"]);
    $house_no = mysqli_real_escape_string($conn, $_POST["house_no"]);
    $barangay = mysqli_real_escape_string($conn, $_POST["barangay"]);
    $municipality = mysqli_real_escape_string($conn, $_POST["municipality"]);
    $province = mysqli_real_escape_string($conn, $_POST["province"]);
    $father = mysqli_real_escape_string($conn, $_POST["father"]);
    $mother = mysqli_real_escape_string($conn, $_POST["mother"]);
    $guardian = mysqli_real_escape_string($conn, $_POST["guardian"]);
    $relationship = mysqli_real_escape_string($conn, $_POST["relationship"]);
    $lm = mysqli_real_escape_string($conn, $_POST["lm"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);
    $section = mysqli_real_escape_string($conn, $_POST["section"]);

    $select = "SELECT * FROM `section` WHERE `name` = '$section'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $grade = $row["grade"];


    $indicator = mysqli_real_escape_string($conn, $_POST["indicator"]);
    $ri = mysqli_real_escape_string($conn, $_POST["ri"]);
    $rid = mysqli_real_escape_string($conn, $_POST["rid"]);

    $select = "SELECT * FROM student WHERE lrn = '$lrn'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        header("location:student_table.php?errmsg=The student already exist!");
        exit();
    } else {
        $insert = "INSERT INTO `student`(`lrn`, `name`, `sex`, `birth_date`, `age`, `ra`, `house_no`, `barangay`, `municipality`, `province`, `father`, `mother`, `guardian`, `relationship`, `lm`, `contact`, `section`, `grade`, `indicator`, `ri`, `rid`)
         VALUES 
         ('$lrn','$name','$sex','$birth_date','$age','$ra','$house_no','$barangay','$municipality','$province','$father','$mother','$guardian','$relationship','$lm','$contact', '$section', '$grade', '$indicator', '$ri', '$rid')";
        mysqli_query($conn, $insert);
        header("location:student_table.php?msg=Student added successfully!");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/fb9a379660.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../index.css">
    <script src="../index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@sisukas/nitti@1.0.9"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <title>ADD STUDENT</title>
</head>

<body id="up">
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="py-4 px-3" style="background-color: #d8e2dc;">
                <form action="add_student.php" method="POST" class="needs-validation w-100 row g-1" validate>
                    <h2>School form 1</h2>
                    <hr>
                    <div class="form-floating mb-3 col-3 d-inline-block">
                        <input type="number" name="lrn" id="lrn" placeholder="lrn" class="form-control bg-body-tertiary" required />
                        <label for="lrn">LRN</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter LRN.</div>
                    </div>
                    <div class="form-floating mb-3 col-6 d-inline-block">
                        <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" required />
                        <label for="name">Full name</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter student full name.</div>
                    </div>
                    <div class="form-floating mb-3 col-2 d-inline-block">
                        <select class="form-select bg-body-tertiary" name="section" id="section">
                            <option value="" selected>Section</option>
                            <?php
                            $select = "SELECT * FROM section";
                            $result = mysqli_query($conn, $select);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row["name"] ?>"><?php echo $row["name"] ?></option>
                            <?php }
                            ?>
                        </select>
                        <label for="section">Section</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please select section.</div>
                    </div>
                    <div class="form-floating mb-3 col-1 pe-0 d-inline-block">
                        <select class="form-select bg-body-tertiary" name="sex" id="sex">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <label for="sex">Sex</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please select sex.</div>
                    </div>
                    <div class="form-floating mb-3 d-inline-block col-4">
                        <input type="date" name="birth_date" id="birth_date" placeholder="birth_date" class="form-control bg-body-tertiary" required />
                        <label for="birth_date">Birthdate</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please choose a birth date.</div>
                    </div>
                    <div class="form-floating mb-3 d-inline-block col-3 col d-inline-block">
                        <input type="number" name="age" id="age" placeholder="age" class="form-control bg-body-tertiary" r-calc="calculateAge(birth_date)" value='r-calc="calculateAge(birth_date)"' disabled />
                        <label for="age">Age</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter age.</div>
                    </div>
                    <div class="form-floating mb-3 d-inline-block col-5 col d-inline-block">
                        <input type="text" name="ra" id="ra" placeholder="ra" class="form-control bg-body-tertiary" required />
                        <label for="ra">Religious Affiliation</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a religious affiliation.</div>
                    </div>
                    <div class="form-floating mb-3 d-inline-block col-4">
                        <input type="text" name="province" id="province" placeholder="province" class="form-control bg-body-tertiary" required />
                        <label for="province">Province</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a province.</div>
                    </div>
                    <div class="form-floating mb-3 d-inline-block col-4 col d-inline-block">
                        <input type="text" name="municipality" id="municipality" placeholder="municipality" class="form-control bg-body-tertiary" required />
                        <label for="municipality">Municipality / City</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a municipality.</div>
                    </div>
                    <div class="form-floating mb-3 d-inline-block col-4 col d-inline-block">
                        <input type="text" name="barangay" id="barangay" placeholder="barangay" class="form-control bg-body-tertiary" required />
                        <label for="barangay">Barangay</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a barangay.</div>
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
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a guardian's name.</div>
                    </div>
                    <div class="form-floating mb-3 col-3 d-inline-block">
                        <input type="text" name="relationship" id="relationship" placeholder="relationship" class="form-control bg-body-tertiary" required />
                        <label for="relationship">Relationship</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a relationship.</div>
                    </div>
                    <div class="input-group mb-3 col" style="height: 58px;">
                        <span class="input-group-text" id="basic-addon1" style="height: 58px;">+63</span>
                        <div class="form-floating mb-3 col-4 d-inline-block">
                            <input type="text" name="contact" id="contact" placeholder="contact" class="form-control bg-body-tertiary" required />
                            <label for="contact">Contact no.</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please enter contact no.</div>
                        </div>
                    </div>
                    <div class="form-floating mb-3 col-3 pe-0 d-inline-block">
                        <select class="form-select bg-body-tertiary" name="lm" id="lm">
                            <option value="ftf">Face to face</option>
                            <option value="ol">Online class</option>
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
                            <label for="indicator">Indicator</label>
                        </div>
                        <span class="input-group-text" style="height: 58px;">&</span>
                        <div class="form-floating mb-3 col d-inline-block">
                            <input type="text" name="ri" id="ri" placeholder="ri" class="form-control bg-body-tertiary" />
                            <label for="ri">Required Information</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please enter required information.</div>
                        </div>
                        <div class="form-floating mb-3 col d-inline-block">
                            <input type="date" name="rid" id="rid" placeholder="rid" class="form-control bg-body-tertiary" />
                            <label for="rid">Date</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please enter required information date.</div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 me-auto">
                        <input type="submit" value="Add" class="btn btn-primary" name="submit">
                        <a type="button" class="btn btn-danger" href="student_table.php">Back</a>
                    </div>
                </form>
            </main>
        </div>
    </div>
    </div>
</body>

</html>