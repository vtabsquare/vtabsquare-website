    <?= view('app/admin/common/head_top') ?>

    <title>Statistics - <?= config('Config\App')->siteName ?></title>

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
                        Statistics
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="admin/statistics">
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label>Years Of Industry Experience</label>
                            <input class="form-control" name="experience" type="text" value="<?= hentities($statistics['experience']) ?>">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Completed Projects</label>
                            <input class="form-control" name="projects" type="text" value="<?= hentities($statistics['projects']) ?>">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Skilled Experts</label>
                            <input class="form-control" name="experts" type="text" value="<?= hentities($statistics['experts']) ?>">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Happy Clients</label>
                            <input class="form-control" name="clients" type="text" value="<?= hentities($statistics['clients']) ?>">
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
