    <?= view('app/default/common/head_top') ?>

    <title>Terms and Conditions - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => 'Terms and Conditions']) ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Terms and Conditions</p>
            </div>
        </div>
    </div>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>