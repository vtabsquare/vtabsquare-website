    <?= view('app/default/common/head_top') ?>

    <title><?= hentities($category['title']) ?> - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <?php if ($pagePrev): ?>
    <link rel="prev" href="<?= config('Config\App')->baseURL ?>blogs/category/<?= $category['id'] ?>?page=<?= $currentPage - 1 ?>">
    <?php endif; ?>

    <?php if ($pageNext): ?>
    <link rel="next" href="<?= config('Config\App')->baseURL ?>blogs/category/<?= $category['id'] ?>?page=<?= $currentPage + 1 ?>">
    <?php endif; ?>

    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => hentities($category['title'])]) ?>

    <section class="space-top space-extra-bottom" id="blog-sec">
        <div class="container">
            <div class="row gy-4">
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
    </section>

    <?php if ($pagePrev || $pageNext): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="j-pagination" data-url="blogs/category/<?= $category['id'] ?>/pagination?page=<?= $currentPage ?>">
                    <ul class="pagination justify-content-between">
                        <li class="page-item">
                            <?php if ($pagePrev): ?>
                            <a class="page-link" href="blogs/category/<?= $category['id'] ?>?page=<?= $currentPage - 1 ?>">
                                <span>&larr;</span> Newer
                            </a>
                            <?php endif; ?>
                        </li>

                        <li class="page-item">
                            <?php if ($pageNext): ?>
                            <a class="page-link" href="blogs/category/<?= $category['id'] ?>?page=<?= $currentPage + 1 ?>">
                                Older <span>&rarr;</span>
                            </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/default/common/js/pagination') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
