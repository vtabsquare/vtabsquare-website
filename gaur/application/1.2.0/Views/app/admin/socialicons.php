    <?= view('app/admin/common/head_top') ?>

    <title>Social icons - <?= config('Config\App')->siteName ?></title>

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
                    <li class="breadcrumb-item active">
                        Social icons
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="admin/socialicons">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Whatsapp</label>
                            <input class="form-control" name="whatsapp" type="text" value="<?= hentities($socialicons['whatsapp']) ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input class="form-control" name="phone" type="text" value="<?= hentities($socialicons['phone']) ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mail</label>
                            <input class="form-control" name="mail" type="text" value="<?= hentities($socialicons['mail']) ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Facebook</label>
                            <input class="form-control" name="facebook" type="text" value="<?= hentities($socialicons['facebook']) ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Instagram</label>
                            <input class="form-control" name="instagram" type="text" value="<?= hentities($socialicons['instagram']) ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Youtube</label>
                            <input class="form-control" name="youtube" type="text" value="<?= hentities($socialicons['youtube']) ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>LinkedIn</label>
                            <input class="form-control" name="linkedin" type="text" value="<?= hentities($socialicons['linkedin']) ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                        <input class="btn btn-primary" type="submit" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/form') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
