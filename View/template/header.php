
<html>
    <head>
        <base href="<?php echo URL; ?>">
        <meta charset="utf-8">
        <title>HodnotímeFilmy.cz</title>
        <link rel="stylesheet" href="Public/bootstrap-3.3.5-dist/css/bootstrap.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="Public/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="Public/styl.css">
        <link rel="shortcut icon" href="Public/img/logo-thumbnail.png" type="image/x-icon"/>
    </head>
    <body>
        <div id="logo">
            <a href="<?php echo URL; ?>home"><img src="Public/img/logo-top.png" class="img-active"></a><span class="visible-lg-block" id="logo-text">Recenze a hodnocení nejnovějších filmů</span>
        </div>
        <nav class="navbar navbar-default navbar-inverse" data-spy="affix" data-offset-top="140" style="z-index:1100">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                         
                    </button>
                    <a class="navbar-brand" href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Informace
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo URL; ?>home/rules">Pravidla</a></li>
                                <li><a href="<?php echo URL; ?>home/lorem">Lorem</a></li>
                                <li><a href="<?php echo URL; ?>home/ipsum">Ipsum</a></li>
                            </ul>
                        </li>
                        <?php
                        if(isset($_SESSION['id'])){ ?>
                            <li><a href="<?php echo URL; ?>article">Články</a></li>
                            <?php

                            if ($user->rights == 'recenzent') { ?>
                                <li>
                                    <a href="<?php echo URL; ?>review">
                                        Recenze
                                        <?php
                                        if ($reviewsNum->counter != 0) echo " <span class='badge'>" . $reviewsNum->counter . "</span>"
                                        ?>
                                    </a>
                                </li>
                            <?php }
                            if ($user->rights == 'admin') { ?>
                                <li><a href="<?php echo URL; ?>admin">Administrace</a></li>
                            <?php } ?>
                        <?php }?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (isset($_SESSION['id'])) { ?>
                            <li><a href="<?php echo URL; ?>user"><span
                                        class="glyphicon glyphicon-user"></span> <?php echo "<b>" . $user->login . "</b>, " . $user->rights; ?>
                                </a></li>
                            <li><a href="<?php echo URL; ?>login/log_out"><span
                                        class="glyphicon glyphicon-log-out"></span> Odhlásit se</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="<?php echo URL; ?>login"><span class="glyphicon glyphicon-user"></span>
                                    Přihlášení</a></li>
                            <li><a href="<?php echo URL; ?>register"><span class="glyphicon glyphicon-log-in"></span>
                                    Registrace</a></li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid" id="main-container">