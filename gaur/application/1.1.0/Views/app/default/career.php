    <?= view('app/default/common/head_top') ?>

    <title>Career - <?= config('Config\App')->siteName ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', [ 'pageName' => 'Career' ]) ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12" id="j-ar">
                <h2 class="text-center text-uppercase">Get an Opportunity!</h2>
                <p class="text-center mb-4">
                    We are always looking for new and fresh talent.
                    If you are interested in being a part of our team. Fill it up!
                </p>

                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form class="row" method="post" data-url="career">
                    <div class="form-group col-md-4">
                        <input class="form-control" type="text" name="name" placeholder="Your Name (*)">
                    </div>
                    <div class="form-group col-md-4">
                        <input class="form-control" type="email" name="email" placeholder="Email Address (*)">
                    </div>
                    <div class="form-group col-md-4">
                        <input class="form-control" type="text" name="phone" placeholder="Phone Number (*)">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="d-block">Resume <span class="text-danger">*</span></label>
                        <input class="form-control-file" data-name="resume" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                        <small class="text-muted d-block">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="d-block">Photo <span class="text-danger">*</span></label>
                        <input class="form-control-file" data-name="photo" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                        <small class="text-muted d-block">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png.</small>
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/default/common/js/form_file') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
