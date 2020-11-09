<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($title)) ? $title : "Титул"; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="site_name">
                <h1>Личный кабинет</h1>
            </div>
            <div class="auth" style="padding-top: 11px;">
                <span class="singin"><a href="<?php if (isset($_SESSION['logged_in'])) : ?><?php echo (site_url()) . "/user"; ?><?php else : ?><?php echo (site_url()) . "/auth"; ?><?php endif ?>"><?php echo (isset($_SESSION['logged_in'])) ? $_SESSION['login'] : "Вход/Регистрация"; ?></a></span><br>
            </div>
        </div>
    </div>