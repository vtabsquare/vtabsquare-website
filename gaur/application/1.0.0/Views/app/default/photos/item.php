    <?php $dateAdded = strtotime($photo['date_added']); ?>

    <?= view('app/default/common/head_top') ?>

    <title><?= hentities($photo['title']) ?> - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <link rel="canonical" href="<?= config('Config\App')->baseURL ?>photos/item/<?= $photo['id'] ?>">
    <meta name="robots" content="follow, index">

    <?php if ($photo['mdesc']): ?>
    <meta name="description" content="<?= hentities($photo['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($photo['mkeywords']): ?>
    <meta name="keywords" content="<?= hentities($photo['mkeywords']) ?>">
    <?php endif; ?>

    <?= view('app/default/photos/social_metadata') ?>
    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => hentities($category['title'])]) ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h3 mb-3"><?= hentities($photo['title']) ?></h2>
            </div>
            <?php foreach ($photo['images'] as $image): ?>
            <div class="col-lg-4 col-sm-6 mb-3">
                <a data-lity href="images/photos/<?= $image ?>">
                    <img class="img-fluid" src="images/photos/thumb/<?= $image ?>" alt="" />
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
