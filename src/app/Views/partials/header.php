<?php ?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/bootstrap.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/bootstrap-icons.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/menuStyle.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/styles.css");?>">
    <title>Recepty</title>
</head>
<body>
<header>
    <div class="header_section">
        <div class="container-fluid header_main">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="home">Domov</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/public/recipes">Recepty</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Menu2</a>
                            <div class="dropdown-content">
                                <div><a class="nav-link" href="Submenu1">Submenu1</a>
                                <div class="dropdown-subcontent">
                                    <a class="nav-link" href="Submenu1">SubSubmenu1</a>
                                    <a class="nav-link" href="Submenu2">SubSubmenu2</a>
                                    <a class="nav-link" href="Submenu3">SubSubmenu3</a>
                                </div></div>
                                <div><a class="nav-link" href="Submenu2">Submenu2</a>
                                <div class="dropdown-subcontent">
                                    <a class="nav-link" href="Submenu1">SubSubmenu1</a>
                                    <a class="nav-link" href="Submenu2">SubSubmenu2</a>
                                    <a class="nav-link" href="Submenu3.">SubSubmenu3</a>
                                </div></div>
                                <div><a class="nav-link" href="Submenu2">Submenu3</a>
                                <div class="dropdown-subcontent">
                                    <a class="nav-link" href="Submenu1">Submenu1</a>
                                    <a class="nav-link" href="Submenu2">Submenu2</a>
                                    <a class="nav-link" href="Submenu3">Submenu3</a>
                                </div></div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Menu3</a>
                            <div class="dropdown-content">
                                <a class="nav-link" href="Submenu1">Submenu1</a>
                                <a class="nav-link" href="Submenu2">Submenu2</a>
                                <a class="nav-link" href="Submenu3">Submenu3</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Menu4</a>
                            <div class="dropdown-content">
                                <a class="nav-link" href="Submenu1">Submenu1</a>
                                <a class="nav-link" href="Submenu2">Submenu2</a>
                                <a class="nav-link" href="Submenu3">Submenu3</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
</header>
