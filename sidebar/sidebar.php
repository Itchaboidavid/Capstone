<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <!-- Add this link for Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Add these links for Bootstrap JavaScript and jQuery (if not already included) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="sidebars.css" rel="stylesheet" />
  <link rel="stylesheet" href="../index.css">
  <script src="../index.js"></script>
</head>

<body>
  <div class="flex-shrink-0 p-3" style="width: 280px; background-color:#003459;">
    <a href="dashboard.php" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
      <span class="fs-5 fw-semibold">Collapsible</span>
    </a>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          Home
        </button>
        <div class="collapse show" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Updates</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Reports</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Dashboard
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Weekly</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Monthly</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Annually</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Orders
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">New</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Processed</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Shipped</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Returned</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Account
        </button>
        <div class="collapse" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">New...</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Profile</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Settings</a>
            </li>
            <li>
              <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Sign out</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="sidebars.js"></script>
</body>

</html>