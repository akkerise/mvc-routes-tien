<?php //echo "<pre>";var_dump($r);echo "</pre>"; exit; ?>
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('public/img/home-bg.png')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1><?php echo $title ?></h1>
                    <hr class="small">
                    <span class="subheading"><?php echo $description ?> </span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <!--            tim kiem-->
            <form name="search_key" action="<?php echo BASE_PATH ?>/search" method="get">
                TÌM KIẾM: <input type="text" name="search_name">
                <button type="submit" class="btn btn-default">SEARCH</button>
            </form>

            <br>
            <?php foreach ($result as $row) : ?>
                <div class="post-preview">
                    <a href="search/<?php echo $row['id'] ?>">
                        <h2 class="post-title">
                            <?php echo $row['title'] ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php echo substr($row['content'], 0, 100) ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#"><?php echo $row['user_name'] ?></a> on September 24, 2014
                    </p>
                </div>
                <hr>

            <?php endforeach; ?>
            <!-- Pager -->
            <ul class="pager">

                <?php if ($current_page > 1) {?>
                    <li class="prev">
                        <a style="float: left" href="?page=<?php echo($current_page - 1) ?>">&#x2190;  Newwer Posts </a>
                    </li>
                <?php }else{?>
                    Click vô đây nè ->>>>>>>>>>
                <?php }?>

                <?php if ($current_page < $total_page) : ?>
                    <li class="next">
                        <a href="?page=<?php echo($current_page + 1) ?>">Older Posts →</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_page; $i++){
                    echo "<li><a href='?search_name=".$key.",page=".$i."'>".$i."</a></li>";
                }?>
            </ul>
        </div>
    </div>
</div>

<hr>

