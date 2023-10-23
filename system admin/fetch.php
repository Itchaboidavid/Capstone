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
    <title>SECTION TABLE</title>

    <!-- DATA TABLES -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <script defer src="data_table.js"></script>
    <script defer src="../index.js"></script>
</head>

<body>
    <?php
    include("../config.php");
    if (isset($_POST['request'])) {
        $request = $_POST['request'];

        $query = "SELECT * FROM `section` WHERE `semester` = '$request'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
    }
    ?>
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
    <table id="adviserTable" class="table table-striped table-hover table-secondary" style="width:100%">
        <?php
        if ($count) {
        ?>
            <thead>
                <tr>
                    <th>Section</th>
                    <th>Track</th>
                    <th>Strand</th>
                    <th>Grade</th>
                    <th>Faculty</th>
                    <th>Semester</th>
                    <th></th>
                </tr>
            <?php
        } else {
            echo "Sorry! No record found";
        }
            ?>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?> <tr>
                        <td><?php echo $row["name"] ?></td>
                        <td><?php echo $row["track"] ?></td>
                        <td><?php echo $row["strand"] ?></td>
                        <td><?php echo $row["grade"] ?></td>
                        <td><?php echo $row["faculty"] ?></td>
                        <td><?php echo $row["semester"] ?></td>
                        <td class="text-center">
                            <a href="edit_section.php?id=<?php echo $row['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
    </table>
</body>

</html>