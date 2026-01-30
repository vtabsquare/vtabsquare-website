    <?= view('app/default/common/head_top') ?>

    <title>Change or reset your password - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="noindex">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => 'Forgot password']) ?>

    <main class="container" id="j-ar">
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-7 col-lg-5">
                <h1 class="text-center">Forgot password</h1>

                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="account/password/forgot">
                    <div class="mb-3">
                        <label>Username / Email address <span class="text-danger">*</span></label>
                        <input class="form-control" name="identity" type="text" required>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-5">
                            <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                            <input class="btn btn-block btn-primary" type="submit" value="Reset">
                        </div>
                        <div class="col-7 text-end">
                            <span class="fas fa-sign-in-alt"></span>
                            <a href="account/login">Sign in</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/default/common/js/form') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
