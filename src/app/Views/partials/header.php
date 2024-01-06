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
						<? if (session()->get('isLoggedIn') || (isset($logReg) && $logReg ==1)){?>
							<a class="nav-link" href="<?base_url('public/users/myrecipes')?>">Domov</a>
						<?} else{?>						
                            <a class="nav-link" href="<?base_url('public/users/login')?>">Domov</a>
						<?}?>	
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/public/recipes">Recepty</a>
                            <div class="dropdown-content">
                            <? if (session()->get('isLoggedIn') || (isset($logReg) && $logReg ==1)){?>
                                <div>
                                    <a class="nav-link" href="<?base_url()?>/public/recipes/newRecipe">Nový recept</a>
                                </div>
                            <?}?>
                                <div>
                                    <a class="nav-link" href="/public/users/list">Podľa používateľa</a>
                                </div>
                            </div>
                        </li>
                        <? if (!session()->get('isLoggedIn') || (isset($logReg) && $logReg ==1)){?>
                            <li class="nav-item">
                                <a class="nav-link" href="/public/users/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/public/users/register">Registrácia</a>
                            </li>
                        <?} else{?>
                        <li class="nav-item">
                            <a class="nav-link" href="/public/users/logout">Logout</a>
                        </li>
                        <?}?>

                    </ul>
                </div>
            </nav>
        </div>
</header>
