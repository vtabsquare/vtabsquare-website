    <?= view('app/admin/common/head_top') ?>

    <title>Edit a team - <?= config('Config\App')->siteName ?></title>

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
                        Edit
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="admin/teams/<?= $team['id'] ?>" data-timeout="3000">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" type="text" value="<?= hentities($team['name']) ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Designation <span class="text-danger">*</span></label>
                            <input class="form-control" name="designation" type="text" value="<?= hentities($team['designation']) ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Facebook</label>
                            <input class="form-control" name="link-facebook" type="text" value="<?= hentities($team['links']['facebook']) ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Twitter</label>
                            <input class="form-control" name="link-twitter" type="text" value="<?= hentities($team['links']['twitter']) ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Instagram</label>
                            <input class="form-control" name="link-instagram" type="text" value="<?= hentities($team['links']['instagram']) ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Linkedin</label>
                            <input class="form-control" name="link-linkedin" type="text" value="<?= hentities($team['links']['linkedin']) ?>">
                        </div>
                    </div>

                    <div class="form-row align-items-end">
                        <div class="col-md-6 form-group j-img-item">
                            <?php if ($team['image']): ?>
                            <div class="text-center mb-2">
                                <div class="img-overlay img-hoverlay cursor-pointer" data-lity data-lity-target="images/teams/<?= $team['image'] ?>">
                                    <img class="img-fluid" src="images/teams/<?= $team['image'] ?>" alt>
                                    <span class="fas fa-search-plus icon icon-sm"></span>
                                </div>
                            </div>
                            <?php endif; ?>

                            <label>Image</label>
                            <div class="input-group j-img-remove">
                                <input class="form-control" data-name="image" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                                <div class="input-group-append">
                                    <input type="checkbox" data-name="image" class="d-none" value="1">
                                    <button class="btn btn-danger" type="button" data-action="remove">
                                        <span class="fas fa-minus"></span>
                                    </button>
                                </div>
                            </div>

                            <small class="form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                        <input class="btn btn-primary" type="submit" value="Update">
                        <a class="btn btn-secondary" href="admin/teams">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/img_remove') ?>
    <?= view('app/admin/common/js/form_file') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
