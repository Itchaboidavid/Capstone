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
    <title>Track</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script>
        // This script removes the 'msg' and 'errmsg' parameters from the URL without refreshing the page
        const url = new URL(window.location.href);
        url.searchParams.delete('msg');
        url.searchParams.delete('errmsg');
        window.history.replaceState({}, document.title, url);
    </script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center mt-0">
                    <div>
                        <h1 class="mt-4">Track</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Track table</li>
                        </ol>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" style="align-self: end;" class="btn btn-sm btn-success px-3 py-1 mb-3" data-bs-toggle="modal" data-bs-target="#trackModal">
                        Add track
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class=" modal-title fs-5" id="trackModalLabel">Add track</h1>
                                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" required />
                                            <label for="name">Track title</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a track title.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select bg-body-tertiary" name="track_status" id="track_status" placeholder="track_status" required>
                                                <option value="Active" class="text-success">Active</option>
                                                <option value="Disabled" class="text-danger">Disabled</option>
                                            </select>
                                            <label for="track_status">Track Status</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select a track status.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="add_track">Add</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'
                        . $msg .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                }

                if (isset($_GET['errmsg'])) {
                    $errmsg = $_GET['errmsg'];
                    echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'
                        . $errmsg .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                }
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Track table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Track Title</th>
                                    <th>Track Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $track = "SELECT * FROM `track`";
                                $trackResult = $conn->query($track);
                                $trackCount = 1;
                                while ($trackRow = $trackResult->fetch_assoc()) :
                                    if ($trackRow['name'] != "All") :
                                ?>
                                        <tr>
                                            <td><?php echo $trackCount ?></td>
                                            <td><?php echo $trackRow["name"] ?></td>
                                            <td>
                                                <?php
                                                if ($trackRow["track_status"] === "Active") {
                                                    echo '<span class="text-success">Active</span>';
                                                } else {
                                                    echo '<span class="text-danger">Disabled</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="edit_track.php?id=<?php echo $trackRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;">
                                                    Edit <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                        $trackCount++;
                                    endif;
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <script src="../index.js"></script>
</body>

</html>

<?php
if (isset($_POST["add_track"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $track_status = mysqli_real_escape_string($conn, $_POST["track_status"]);

    $select = "SELECT `name` FROM `track` WHERE `name` = '$name'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'track_table.php?errmsg=The track already exist!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `track` (`name`, `track_status`) VALUES ('$name', '$track_status')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'track_table.php?msg=Track successfully added!';</script>");
        exit();
    }
}
$conn->close();
?>