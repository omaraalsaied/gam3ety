<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Gam3ety-Team" />
    <meta name="description" content="موقع جامعتي التعليمي لتقديم المحاضرات في كافة المواد العلميه" />
    <meta name="keywords" content="e-learning,gam3ety,gam3ity,gamety,ain-shams university" />
    <link style="width: 100%;" rel="icon" type="image/png" href="./img/logo.png" />

    <title><?php echo "جامعتي - " . $page_name; ?></title>
    <link rel="stylesheet" href="<?php echo $cssPath?>all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $cssPath?>toastr.min.css">


    <?php if($page_name == "عربة التسوق" || $page_name == "المحاضرات" || $page_name == "السنين الدراسيه" || $page_name == "الكورسات" || $page_name == "التسجيل في الموقع" || $page_name == "الكورسات المسجله" || $page_name == "الصفحه الشخصيه" || $page_name == "عمليات الدفع" || $page_name == "المواد الدراسيه"){?>
        <link rel="stylesheet" href="<?php echo $cssPath?>semantic.min.css">
   <?php }
    ?>

    <?php if($page_name == "الرئيسيه" || $page_name == "من نحن"){?>
        <link rel="stylesheet" href="<?php echo $cssPath?>owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo $cssPath?>owl.theme.default.min.css">
    <?php }
    ?>
    
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $cssPath?>nav-bar.css">
    <link rel="stylesheet" href="<?php echo $cssPath?><?php echo $style ?>">

    <script src="<?php echo $jsPath?>jquery-3.5.1.min.js"></script>
    <script src="<?php echo $jsPath?>toastr.min.js"></script>
</head>
<body>
