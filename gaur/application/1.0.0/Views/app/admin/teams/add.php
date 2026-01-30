    <?= view('app/admin/common/head_top') ?>

    <title>Add a team - <?= config('Config\App')->siteName ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="noindex">

    <?= view('app/admin/common/css') ?>
    <?= view('app/admin/common/head_bottom') ?>
    <?= view('app/admin/common/menu') ?>

    <main class="container" id="j-ar">
        <div class="row">
            <div class="col-md-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="admin">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="admin/teams">Teams</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Add
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="admin/teams" data-timeout="3000">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" type="text">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Designation <span class="text-danger">*</span></label>
                            <input class="form-control" name="designation" type="text">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Facebook</label>
                            <input class="form-control" name="link-facebook" type="text">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Twitter</label>
                            <input class="form-control" name="link-twitter" type="text">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Instagram</label>
                            <input class="form-control" name="link-instagram" type="text">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Linkedin</label>
                            <input class="form-control" name="link-linkedin" type="text">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Image</label>
                            <input class="form-control-file" data-name="image" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                            <small class="form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                        <input class="btn btn-primary" type="submit" value="Create">
                        <a class="btn btn-secondary" href="admin/teams">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/form_file') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
