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
                        <h1 class="mt-4">Strand</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="strand_table.php">Strand Table</a></li>
                            <li class="breadcrumb-item active">Edit Strand</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Edit Strand</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET["id"];
                            $strand = "SELECT * FROM `strand` WHERE id = $id";
                            $strandResult = $conn->query($strand);
                            $strandRow = $strandResult->fetch_assoc();
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $strandRow["name"] ?>" required />
                                <label for="name">Strand title</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a strand title.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="track" id="track" placeholder="track" required>
                                    <option value="<?php echo $strandRow["track"] ?>"><?php echo $strandRow["track"] ?></option>
                                    <?php
                                    $track = "SELECT * FROM `track` ORDER BY `name` ASC";
                                    $trackResult = mysqli_query($conn, $track);
                                    while ($trackRow = mysqli_fetch_assoc($trackResult)) {
                                        if ($trackRow["name"] != "All" && $trackRow["name"] != $strandRow["track"]) {
                                    ?>
                                            <option value="<?php echo $trackRow["name"] ?>"><?php echo $trackRow["name"] ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                                <label for=" track">Track</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a track.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="strand_status" id="strand_status" placeholder="strand_status" required>
                                    <option value="Active" class="text-success" <?php echo ($strandRow["strand_status"] == 'Active') ? "selected" : "" ?>>Active</option>
                                    <option value="Disabled" class="text-danger" <?php echo ($strandRow["strand_status"] == 'Disabled') ? "selected" : "" ?>>Disabled</option>
                                </select>
                                <label for="strand_status">Strand Status</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a strand status.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_strand">Save</button>
                                <a href="strand_table.php" type="button" class="btn btn-danger">Close</a>
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
//EDIT STRAND
if (isset($_POST['edit_strand'])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $track = mysqli_real_escape_string($conn, $_POST["track"]);
    $strand_status = mysqli_real_escape_string($conn, $_POST["strand_status"]);

    $update = "UPDATE `strand` SET `name`='$name', `track`='$track', `strand_status`='$strand_status' WHERE id = $id";
    $updateResult = mysqli_query($conn, $update);
    echo ("<script>location.href = 'strand_table.php?msg=Strand updated successfully!';</script>");
    exit();
}
