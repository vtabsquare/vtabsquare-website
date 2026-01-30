    <?= view('app/default/common/head_top') ?>

    <title>Services - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <?php if ($pagePrev): ?>
    <link rel="prev" href="<?= config('Config\App')->baseURL ?>services?page=<?= $currentPage - 1 ?>">
    <?php endif; ?>

    <?php if ($pageNext): ?>
    <link rel="next" href="<?= config('Config\App')->baseURL ?>services?page=<?= $currentPage + 1 ?>">
    <?php endif; ?>

    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => 'Services']) ?>

    <section class="space" id="service-sec">
        <div class="container">
            <div class="row gy-4">
                <?php foreach ($services as $item): ?>
                <div class="col-xl-4 col-md-6">
                    <div class="service-card p-0">
                        <?php if ($item['image']): ?>
                        <div class="box-icon mb-0 w-auto h-auto"><img src="images/services/thumb/<?= $item['image'] ?>" alt /></div>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="box-title"><a href="service/<?= hentities($item['slug']) ?>"><?= hentities($item['title']) ?></a></h3>
                            <p class="box-text" style="height: 4.5em; overflow: hidden"><?= implode(' ', array_slice(explode(' ', strip_tags($item['info'])), 0, 100)) ?></p>
                            <a href="service/<?= hentities($item['slug']) ?>" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ($pagePrev || $pageNext): ?>
    <div class="container pb-4">
        <div class="row">
            <div class="col-md-12">
                <nav class="j-pagination" data-url="services/pagination?page=<?= $currentPage ?>">
                    <ul class="pagination justify-content-between">
                        <li class="page-item">
                            <?php if ($pagePrev): ?>
                            <a class="page-link" href="services?page=<?= $currentPage - 1 ?>">
                                <span>&larr;</span> Newer
                            </a>
                            <?php endif; ?>
                        </li>

                        <li class="page-item">
                            <?php if ($pageNext): ?>
                            <a class="page-link" href="services?page=<?= $currentPage + 1 ?>">
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
