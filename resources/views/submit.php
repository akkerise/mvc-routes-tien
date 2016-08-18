
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
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">


            <form name="sPost" action=" <?php echo BASE_PATH ?>/submit" method="post">
<!--                USER -->
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="sName" required
                               data-validation-required-message="Please enter your username."
                               value="<?php if (isset($_SESSION['old']['sess_sName'])) echo  $_SESSION['old']['sess_sName'];?>">
                        <p class="help-block text-danger"> 
                        <?php if (isset($_SESSION['err']['wrong_existData'])) echo $_SESSION['err']['wrong_existData'];?>
                        </p>
                    </div>
                </div>
<!--                TITLE-->
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Tiêu Đề</label>
                        <input type="tel" class="form-control" placeholder="Tiêu Đề" required
                               name="sTitle" data-validation-required-message="Điền ngày tiêu đề vào">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
<!--                        CKEDITOR-->
                <textarea name="sContent"></textarea>

<!--                    CATEGORIES-->
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <div style="line-height: 65px;margin-bottom: -16px;font-size:1.5em;color: #9999A5;">
                            <span>Categories</span>
                            <select name="sCategories" style="margin-left:30px;height: 40px;width:80%;"
                                    class="btn">
                                <?php foreach($result as $row):?>
                                <option value="<?php echo $row['id']?>"><?php echo $row['category_name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <br>
                <div id="success"></div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-default">Send</button>
                    </div>
                </div>
            </form>
            <script>
                CKEDITOR.replace('sContent');
            </script>

        </div>
    </div>
</div>

<hr>

