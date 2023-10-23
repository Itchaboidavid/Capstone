<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#track").change(function() {
                var track_name = $(this).val();
                $.ajax({
                    url: "dropdown.php",
                    method: "POST",
                    data: {
                        trackName: track_name
                    },
                    success: function(data) {
                        $("#strand").html(data);
                    }
                })
            })
        })
    </script>
</head>

<body>
    <!-- MODAL ADD SECTION -->
    <div class="modal fade" id="addSectionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <form action="add_section.php" method="POST" class="needs-validation" novalidate>
                        <div class="form-floating mb-3 ">
                            <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" required />
                            <label for="name">Section</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please enter a section name.</div>
                        </div>
                        <div class="form-floating mb-3 ">
                            <select class="form-select bg-body-tertiary" name="grade" id="grade">
                                <option selected>Grade</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <label for="grade">Grade</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please select the grade level.</div>
                        </div>
                        <div class="form-floating mb-3 ">
                            <select class="form-select bg-body-tertiary" name="track" id="track">
                                <option value="" selected>Track</option>
                                <?php
                                $select = "SELECT * FROM track ORDER BY `name` ASC";
                                $result = mysqli_query($conn, $select);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row["name"] != "All") {
                                ?>
                                        <option value="<?php echo $row["name"] ?>"><?php echo $row["name"] ?></option>
                                <?php }
                                }
                                ?>
                            </select>
                            <label for="track">Track</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please select track.</div>
                        </div>
                        <div class="form-floating mb-3 ">
                            <select class="form-select bg-body-tertiary" name="strand" id="strand">
                                <option value="" selected disabled>Strand</option>
                            </select>
                            <label for="strand">Strand</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please select strand.</div>
                        </div>
                        <div class="form-floating mb-3 ">
                            <select class="form-select bg-body-tertiary" name="faculty" id="faculty">
                                <option value="" selected>Faculty</option>
                                <?php
                                $select = "SELECT * FROM `user` WHERE `user_type` = 'adviser' ORDER BY `name` ASC";
                                $result = mysqli_query($conn, $select);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row["name"] != "admin") {
                                ?>
                                        <option value="<?php echo $row["name"] ?>"><?php echo $row["name"] ?></option>
                                <?php  }
                                }
                                ?>
                            </select>
                            <label for="faculty">faculty</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please select a faculty.</div>
                        </div>
                        <div class="form-floating mb-3 ">
                            <select class="form-select bg-body-tertiary" name="semester" id="semester" placeholder="semester" required>
                                <?php
                                $select = "SELECT * FROM `semester`";
                                $result = mysqli_query($conn, $select);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $row["output"] ?>"><?php echo $row["output"] ?></option>
                                <?php }
                                ?>
                            </select>
                            <label for=" semester">Semester</label>
                            <div class="valid-feedback ps-1">Great!</div>
                            <div class="invalid-feedback ps-1"> Please select a semester.</div>
                        </div>
                        <div class="mt-4 me-auto">
                            <input type="submit" value="Register" class="btn btn-primary" name="submit">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>