    <?= view('app/default/common/head_top') ?>

    <title>Create your password - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="noindex">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => 'Create password']) ?>

    <main class="container" id="j-ar">
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-7 col-lg-5">
                <h1 class="text-center">Create password</h1>

                <p class="alert alert-info j-info">Congratulations! your account has been successfully created. Please enter your password below.</p>

                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="account/password/create" data-timeout="5000">
                    <div class="mb-3">
                        <label>Password <span class="text-danger">*</span></label>
                        <input class="form-control" name="password" type="password" required>
                    </div>

                    <div class="mb-3">
                        <label>Password confirmation <span class="text-danger">*</span></label>
                        <input class="form-control" name="password-confirm" type="password" required>
                    </div>

                    <div class="mb-3">
                        <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                        <input class="btn btn-primary" type="submit" value="Create password">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/default/common/foot_top') ?>

    <script>
    (() => {
        "use strict";

        let $, jar;

        function init() {
            $ = jQuery;
            jar = document.querySelector("#j-ar");

            setTimeout(() => {
                $(".j-info", jar).addClass("d-none");
            }, 5000);
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>

    <?= view('app/default/common/js/form') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
