<?php //session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Nghia is a member of TEchasmter">
    <meta name="author" content="Nghia">

    <title>TEC Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo BASE_PATH ?>/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Theme CSS -->
    <link href="<?php echo BASE_PATH ?>/public/css/clean-blog.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH ?>/public/css/style.css" rel="stylesheet" type="text/css">
    <!-- Custom Fonts -->
    <link href="<?php echo BASE_PATH ?>/public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link
        href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?php echo BASE_PATH ?>">Ti's Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo BASE_PATH ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH ?>/about">About</a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH ?>/post/1">Sample Post</a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH ?>/contact">Contact</a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH ?>/p404">404</a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH ?>/submit">SUBMIT</a>
                </li>
                <li>
                    <?php
                    if (!isset($_SESSION['input']['old_username'])) {
                        echo '<a href="' . BASE_PATH . '/login">Signin/Signup</a>';
                    } else {
                        echo '<p class="btn btn-default">' . $_SESSION['input']['old_username'] . '</p>';
                    }
                    ?>

                </li>
                <li>

                    <?php
                    if (isset($_SESSION['input']['old_username'])) {
                        echo '<form name="logout" action="'.BASE_PATH.'/logout" method="get">
                              <a href="' . BASE_PATH . '/login"><button class="btn" type="submit">logout</button></a>
                              </form>';
                    }
                    ?>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>