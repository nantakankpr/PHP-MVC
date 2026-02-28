<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-icons.css">
</head>

<body>

    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2"><i class="bi bi-cloud-fill"></i></span> <span class="text-white">NCT BOT</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class="<?php echo $active == 'dashboard' ? "active" : "" ?>"><a href="/dashboard" class="text-decoration-none px-3 py-2 d-block"> Dashboard</a></li>
                <li class="<?php echo $active == 'management' ? "active" : "" ?>"><a href="/management" class="text-decoration-none px-3 py-2 d-block"> User Management</a></li>
                <li class="<?php echo $active == 'service' ? "active" : "" ?>"><a href="/service" class="text-decoration-none px-3 py-2 d-block"> Services</a></li>
                <li class="<?php echo $active == 'setting' ? "active" : "" ?>"><a href="/setting" class="text-decoration-none px-3 py-2 d-block"> Settings</a></li>

            </ul>

        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-body-secondary">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <div class="dropdown">
                                <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i> <?php echo $_SESSION['user']['username'] ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/api/logout">Logout</a>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
            <?= $content ?>
        </div>

    </div>



    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/sidebar.js"></script>
</body>

</html>