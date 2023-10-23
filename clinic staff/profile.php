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
    <title>PROFILE</title>
</head>

<body id="up">
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="py-3 px-5">
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
                <div class="card text-center">
                    <div class="card-header bg-primary">
                        <span class="text-light fw-bold" style="font-size: 40px; text-shadow: 1px 1px 3px black; letter-spacing: 1.5px;">Profile</span>
                    </div>
                    <div class="card-body row g-0">
                        <!-- PROFILE IMAGE -->
                        <div class="col-4">
                            <img src="../images/profile.webp" alt="profile image" class="img-fluid">
                        </div>
                        <!-- PROFILE DESCRIPTION -->
                        <div class="col-8 text-start px-4" style="border-left: 1px solid gray;">
                            <?php
                            $id = $_SESSION["id"];
                            $select = "SELECT * FROM `user` WHERE `id` = $id";
                            $result = mysqli_query($conn, $select);
                            $row = mysqli_fetch_assoc($result);

                            ?>
                            <table class="table">
                                <tr>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;"> Username:</td>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;"><?php echo $_SESSION["name"] ?></td>
                                </tr>
                                <tr>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;"> Password:</td>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;">
                                        <input type="password" value="<?php echo $row["password2"] ?>" style="border:none; width:90%;">
                                        <a href="changepass.php?id=<?php echo $row['id'] ?>" class="ms-2 fs-5">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;">Full name:</td>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;"><?php echo $row["name"] ?></td>
                                </tr>
                                <tr>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;">User type:</td>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;"><?php echo $row["user_type"] ?></td>
                                </tr>
                                <tr>
                                    <td class="fs-4 fw-bold" style="letter-spacing: 1px;">Status:</td>
                                    <td class="fs-4 fw-bold text-success" style="letter-spacing: 1px;"><?php echo $row["status"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-primary">
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>
</body>

</html>