    <?= view('app/default/common/head_top') ?>

    <title><?= hentities($category['title']) ?> - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <?php if ($pagePrev): ?>
    <link rel="prev" href="<?= config('Config\App')->baseURL ?>photos/<?= hentities($category['slug']) ?>?page=<?= $currentPage - 1 ?>">
    <?php endif; ?>

    <?php if ($pageNext): ?>
    <link rel="next" href="<?= config('Config\App')->baseURL ?>photos/<?= hentities($category['slug']) ?>?page=<?= $currentPage + 1 ?>">
    <?php endif; ?>

    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => hentities($category['title'])]) ?>

    <div class="overflow-hidden space">
        <div class="container">
            <div class="row gy-30 gallery-row filter-active">
                <?php foreach ($photos as $item): ?>
                <div class="col-md-6 col-xl-4 filter-item">
                    <div class="gallery-card style2">
                        <?php if ($item['images']): ?>
                        <div class="box-img">
                            <img src="images/photos/thumb/<?= $item['images'][0] ?>" alt />
                            <a href="photo/<?= hentities($item['slug']) ?>" class="icon-btn"><i class="far fa-link"></i></a>
                        </div>
                        <?php endif; ?>
                        <div class="box-content">
                            <h3 class="box-title"><a href="photo/<?= hentities($item['slug']) ?>"><?= hentities($item['title']) ?></a></h3>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if ($pagePrev || $pageNext): ?>
    <div class="container pb-4">
        <div class="row">
            <div class="col-md-12">
                <nav class="j-pagination" data-url="photos/<?= hentities($category['slug']) ?>/pagination?page=<?= $currentPage ?>">
                    <ul class="pagination justify-content-between">
                        <li class="page-item">
                            <?php if ($pagePrev): ?>
                            <a class="page-link" href="photos/<?= hentities($category['slug']) ?>?page=<?= $currentPage - 1 ?>">
                                <span>&larr;</span> Newer
                            </a>
                            <?php endif; ?>
                        </li>

                        <li class="page-item">
                            <?php if ($pageNext): ?>
                            <a class="page-link" href="photos/<?= hentities($category['slug']) ?>?page=<?= $currentPage + 1 ?>">
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
