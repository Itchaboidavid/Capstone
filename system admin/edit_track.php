<?php
include("../config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Strand</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">Track</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="track_table.php">Track Table</a></li>
                            <li class="breadcrumb-item active">Edit Track</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Edit Track</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET["id"];
                            $track = "SELECT * FROM `track` WHERE id = $id";
                            $trackResult = mysqli_query($conn, $track);
                            $trackRow = mysqli_fetch_assoc($trackResult);
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $trackRow["name"] ?>" required />
                                <label for="name">Track title</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a track title.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="track_status" id="track_status" placeholder="track_status" required>
                                    <option value="Active" class="text-success" <?php echo ($trackRow["track_status"] == 'Active') ? "selected" : ""; ?>>Active</option>
                                    <option value="Disabled" class="text-danger" <?php echo ($trackRow["track_status"] == 'Disabled') ? "selected" : ""; ?>>Disabled</option>
                                </select>
                                <label for="track_status">Track Status</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a track status.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_track">Save</button>
                                <a href="track_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                </form>
            </div>
        </main>
    </div>
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
//EDIT TRACK
if (isset($_POST['edit_track'])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $track_status = mysqli_real_escape_string($conn, $_POST["track_status"]);

    $update = "UPDATE `track` SET `name`='$name', `track_status`='$track_status' WHERE id = $id";
    $updateResult = mysqli_query($conn, $update);
    echo ("<script>location.href = 'track_table.php?msg=Track updated successfully!';</script>");
    exit();
}
