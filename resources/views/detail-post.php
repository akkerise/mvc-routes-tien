<?php //echo "<pre>"; var_dump($data); echo "</pre>";exit();?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('<?php echo BASE_PATH ?>/public/img/detail-post-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1><?php echo $data['title']?></h1>
                        <h2 class="subheading"><?php echo substr($data['content'],0,70);?></h2>
                        <span class="meta">Posted by <a href="#"><?php echo $data['user_name']?></a> On <?php echo $data['created_time']?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <?php echo $data['content'];?>
                </div>
            </div>
        </div>
    </article>

    <hr>

