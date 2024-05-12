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
    <title>Archived Classes</title>
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
                        <h1 class="mt-4">Archived Classes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Archived Classes Table</li>
                        </ol>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Archived Classes Table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Section</th>
                                    <th>Strand</th>
                                    <th>Class Adviser</th>
                                    <th>Grade</th>
                                    <th>School year</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $_SESSION['id'];
                                $archivedSection = "SELECT * FROM `section` WHERE is_archived = 1 AND adviser_id = '$id'";
                                $archivedSectionResult = $conn->query($archivedSection);
                                $archivedSectionCount = 1;
                                while ($archivedSectionRow = $archivedSectionResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $archivedSectionCount ?></td>
                                        <td><?php echo $archivedSectionRow["name"] ?></td>
                                        <td><?php echo $archivedSectionRow["strand"] ?></td>
                                        <td><?php echo $archivedSectionRow["adviser"] ?></td>
                                        <td><?php echo $archivedSectionRow["grade"] ?></td>
                                        <td><?php echo $archivedSectionRow["school_year"] ?></td>
                                        <td>
                                            <a href="archived_student.php?archived_student_id=<?php echo $archivedSectionRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;">
                                                View
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $archivedSectionCount++;
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
    <script src="../index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>

<?php
if (isset($_POST["add_strand"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $track = mysqli_real_escape_string($conn, $_POST["track"]);

    $select = "SELECT * FROM `strand` WHERE `name` = '$name'";
    $result = $conn->query($select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'strand_table.php?errmsg=The strand already exist!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `strand` (`name`, `track`) VALUES ('$name', '$track')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'strand_table.php?msg=Strand successfully added!';</script>");
        exit();
    }
}
$conn->close();
?>