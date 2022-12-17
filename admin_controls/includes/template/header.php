<!DOCTYPE html>
<html>
<head>
    <title><?php echo "لوحة التحكم" . $page_name; ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="this is a dashboard help managers to manage gam3ety system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&display=swap" rel="stylesheet">


    <link style="width: 100%;" rel="icon" type="image/png" href="./img/logo.png" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo $cssPath?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $cssPath?>all.min.css">
    <link rel="stylesheet" href="<?php echo $cssPath?>semantic.min.css">
    <link rel="stylesheet" href="<?php echo $cssPath?>DMSans-Regular.ttf">
    <link rel="stylesheet" href="asset/css/styles.css">
    <link rel="stylesheet" href="<?php echo $cssPath?>toastr.min.css">
    <?php if(isset($style)){ ?>
    <link rel="stylesheet" href="<?php echo $cssPath?><?php echo $style ?>">
    <?php } ?>
    <link rel="stylesheet" href="<?php echo $cssPath?>navs_updates.css">
    <script src="<?php echo $jsPath?>jquery-3.5.1.min.js"></script>
    <script src="<?php echo $jsPath?>toastr.min.js"></script>
    <style>
        body{
            font-family: 'Cairo', sans-serif !important;
        }
        h1,h2,h3,h5,h4,h6,p,span{
        font-family: 'Cairo', sans-serif !important;
        }
        .sb-sidenav .sb-sidenav-menu .nav .nav-link .sb-nav-link-icon{
            font-size: 1.2rem !important;
        }
        .side_left_icons{
            width: 24px;
            opacity: .65;
            display: inline-block;
        }
    </style>
</head>
<body>