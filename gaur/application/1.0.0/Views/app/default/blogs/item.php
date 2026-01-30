    <?php $dateAdded = strtotime($blog['date_added']); ?>

    <?= view('app/default/common/head_top') ?>

    <title><?= hentities($blog['title']) ?> - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <link rel="canonical" href="<?= config('Config\App')->baseURL ?>blogs/item/<?= $blog['id'] ?>">
    <meta name="robots" content="follow, index">

    <?php if ($blog['mdesc']): ?>
    <meta name="description" content="<?= hentities($blog['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($blog['mkeywords']): ?>
    <meta name="keywords" content="<?= hentities($blog['mkeywords']) ?>">
    <?php endif; ?>

    <?= view('app/default/blogs/social_metadata') ?>
    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => hentities($category['title'])]) ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <?php if ($blog['image']): ?>
                <a data-lity href="images/blogs/<?= $blog['image'] ?>">
                    <img class="img-fluid d-block mx-auto mb-3" src="images/blogs/<?= $blog['image'] ?>" alt="" style="max-width: 600px" />
                </a>
                <?php endif; ?>

                <?php if ($blog['video']): ?>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= $blog['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <br>
                <?php endif; ?>

                <div><?= $blog['info'] ?></div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-md-12">
                <h2 class="h4">Related <?= hentities($category['title']) ?></h2>
            </div>

            <?php foreach ($blogs as $item): ?>
            <div class="col-xl-4 col-md-6">
                <div class="blog-card">
                    <?php if ($item['image']): ?>
                    <div class="blog-img"><img src="images/blogs/thumb/<?= $item['image'] ?>" alt /></div>
                    <?php endif; ?>
                    <h3 class="box-title"><a href="blogs/item/<?= $item['id'] ?>"><?= hentities($item['title']) ?></a></h3>
                    <p class="box-text" style="height: 4.5em; overflow: hidden"><?= implode(' ', array_slice(explode(' ', strip_tags($item['info'])), 0, 100)) ?></p>
                    <a href="blogs/item/<?= $item['id'] ?>" class="link-btn">Read Details<i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
