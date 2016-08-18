<?php //session_start();
//echo "<pre>"; var_dump($_SESSION['input']); echo "</pre>";exit();

?>
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('public/img/submit-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>POST Bài nào ae</h1>
                    <hr class="small">
                    <span class="subheading">abcxyz</span>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Main Content -->
<div class="container">
    <div class="row">
        <!--            ĐĂNG NHẬP -------------------------------------------------------------------->
        <?php if (!isset($_SESSION['mess']['register_success'])) : ?>
            <div <?php if (!isset($_SESSION['mess']['login_success'])) { echo 'class="col-lg-8 col-md-10" style="width: 50%;float:left;"';}else{ echo 'style="width: 60%;margin:0 auto;text-align:center;"';} ?>>
                <form name="login" action="<?php echo BASE_PATH ?>/login" method="post">
                    <div style="text-align:center;">
                        <div class="form-group col-xs-12">
                            <button class="btn btn-default btn-lg" style="background-color:#0085A1;color:white;">Đăng Nhập</button>
                        </div>
                    </div>
                    <!--hieenr thi loi -->
                    <?php if (isset($_SESSION['err']) || isset($_SESSION['mess']['login_success'])) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <ul>
                                <?php if (isset($_SESSION['mess']['login_success'])) echo "<li>" . $_SESSION['mess']['login_success'] . "</li>"; ?>
                                <?php if (isset($_SESSION['err'])) foreach ($_SESSION['err'] as $row) : ?>
                                    <li> <?php echo $row; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>


                    <!--                USER -->
                    <?php if (!isset($_SESSION['mess']['login_success'])) { ?>
                        <div class="control-group" style="width:100% !important;">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Tên Đăng Nhập:</label>
                                <input type="text" class="form-control" placeholder="Username" name="login_name"
                                       required
                                       data-validation-required-message="Điền Tên Đăng Nhập Vào!!!"
                                       value="<?php if (isset($_SESSION['input']['old_username'])) echo $_SESSION['input']['old_username']; ?>">
                                <p class="help-block text-danger">
                                    <?php ?>
                                </p>
                            </div>
                        </div>
                        <!--                pass -->
                        <div class="control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Mật Khẩu</label>
                                <input type="password" class="form-control" placeholder="Password" required
                                       name="login_pass" data-validation-required-message="Điền Mật Khẩu Vào!!"
                                       value="<?php if (isset($_SESSION['input']['old_password'])) echo $_SESSION['input']['old_password']; ?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-default">Send</button>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        <?php endif; ?>

        <!--        ĐĂNG KÍ -------------------------------------------------------------------->
        <?php if (!isset($_SESSION['mess']['login_success'])) : ?>
            <div <?php if (!isset($_SESSION['mess']['register_success'])) {echo 'class="col-lg-8 col-md-10" style="width: 50%;float:left; border-left: 1px solid;"';}else{ echo 'style="width: 60%;margin:0 auto;text-align:center;"';} ?>>
                <form name="register" action=" <?php echo BASE_PATH ?>/register" method="post">
                    <div style="text-align:center;">
                        <div class="form-group col-xs-12">
                            <button class="btn btn-default btn-lg" style="background-color:#0085A1;color:white;">Đăng
                                Kí
                            </button>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['mess']['register_success'])) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?php if (isset($_SESSION['mess']['register_success']))
                                echo "<h4><i class='icon fa fa-ban'></i>" . $_SESSION['mess']['register_success'] . "</h4>"
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['mess']['register_success'])) : ?>
                        <!--                USER -->
                        <div class="control-group" style="width:100% !important;">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Tên Đăng Kí</label>
                                <input type="text" class="form-control" placeholder="Username" name="register_name"
                                       required
                                       value="<?php if (isset($_SESSION['input']['old_usernameR'])) echo $_SESSION['input']['old_usernameR']; ?>">
                                <p class="help-block text-danger">
                                    <?php
                                    if (isset($_SESSION['err']['wrong_nameR'])) echo $_SESSION['err']['wrong_nameR'];
                                    if (isset($_SESSION['err']['exist_name'])) echo $_SESSION['err']['exist_name'];
                                    ?>
                                </p>
                            </div>
                        </div>
                        <!--                pass-->
                        <div class="control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Mật Khẩu</label>
                                <input type="password" class="form-control" placeholder="Password" required
                                       name="register_pass"
                                       value="<?php if (isset($_SESSION['input']['old_passwordR'])) echo $_SESSION['input']['old_passwordR']; ?>">
                                <p class="help-block text-danger">
                                    <?php
                                    if (isset($_SESSION['err']['wrong_passR'])) echo $_SESSION['err']['wrong_passR'];
                                    ?>
                                </p>
                            </div>
                        </div>
                        <!--                repeat-pas-->
                        <div class="control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control" placeholder="Repeat Password" required
                                       name="register_repeat_pass"
                                       value="<?php if (isset($_SESSION['input']['old_repeat_passwordR'])) echo $_SESSION['input']['old_repeat_passwordR']; ?>">
                                <p class="help-block text-danger">
                                    <?php
                                    if (isset($_SESSION['err']['wrong_repeat_passR'])) echo $_SESSION['err']['wrong_repeat_passR'];
                                    ?>
                                </p>
                            </div>
                        </div>
                        <!--                EMAIL-->
                        <div class="control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Email" required
                                       name="register_email"
                                       value="<?php if (isset($_SESSION['input']['old_emailR'])) echo $_SESSION['input']['old_emailR']; ?>">
                                <p class="help-block text-danger">
                                    <?php
                                    if (isset($_SESSION['err']['wrong_emailR'])) echo $_SESSION['err']['wrong_emailR'];
                                    if (isset($_SESSION['err']['exist_email'])) echo $_SESSION['err']['exist_email'];
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div id="login_success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-default">Send</button>
                            </div>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<hr>

<?php
unset($_SESSION['err']);
unset($_SESSION['mess']);
//unset($_SESSION['input']);

?>

