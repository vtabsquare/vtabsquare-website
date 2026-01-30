    <?php $dateAdded = strtotime($service['date_added']); ?>

    <?= view('app/default/common/head_top') ?>

    <title><?= hentities($service['title']) ?> - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <link rel="canonical" href="<?= config('Config\App')->baseURL ?>services/item/<?= $service['id'] ?>">
    <meta name="robots" content="follow, index">

    <?php if ($service['mdesc']): ?>
    <meta name="description" content="<?= hentities($service['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($service['mkeywords']): ?>
    <meta name="keywords" content="<?= hentities($service['mkeywords']) ?>">
    <?php endif; ?>

    <?= view('app/default/services/social_metadata') ?>
    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => hentities($category['title'])]) ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <?php if ($service['image']): ?>
                <a data-lity href="images/services/<?= $service['image'] ?>">
                    <img class="img-fluid d-block mx-auto mb-3" src="images/services/<?= $service['image'] ?>" alt="" style="max-width: 600px" />
                </a>
                <?php endif; ?>

                <?php if ($service['video']): ?>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= $service['video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <br>
                <?php endif; ?>

                <div><?= $service['info'] ?></div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-lg-12">
                <div class="contact-form1" data-bg-src="assets/img/bg/contact_bg_2.png" id="j-ar">
                    <h3 class="box-title mb-4">I'm interested</h3>

                    <ul class="list-unstyled j-error d-none"></ul>
                    <p class="alert alert-success j-success d-none"></p>

                    <form method="POST" class="input-label" data-url="contact">
                        <div class="row">
                            <div class="form-group line-input col-sm-6"><input type="text" class="form-control" name="name" id="name" /> <label for="name">Your Name*</label></div>
                            <div class="form-group line-input col-sm-6"><input type="email" class="form-control" name="email" id="email" /> <label for="email">Your Email*</label></div>
                            <div class="form-group line-input col-sm-6"><input type="tel" class="form-control" name="phone" id="number" /> <label for="number">Phone Number*</label></div>
                            <div class="form-group line-input col-sm-6"><input type="text" class="form-control" name="subject" id="subject" /> <label for="subject">Subject...</label></div>
                            <div class="form-group line-input col-12"><textarea name="message" id="message" cols="30" rows="3" class="form-control"></textarea> <label for="message">Your Message*</label></div>
                            <div class="form-btn col-12 mt-10"><button class="ot-btn style3">Get a Quote</button></div>
                        </div>
                        <p class="form-messages mb-0 mt-3"></p>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="h4 pb-4">Related <?= hentities($category['title']) ?></h2>
            </div>

            <?php foreach ($services as $item): ?>
            <div class="col-xl-4 col-md-6">
                <div class="service-card p-0">
                    <?php if ($item['image']): ?>
                    <div class="box-icon mb-0 w-auto h-auto"><img src="images/services/thumb/<?= $item['image'] ?>" alt /></div>
                    <?php endif; ?>
                    <div class="p-4">
                        <h3 class="box-title"><a href="services/item/<?= $item['id'] ?>"><?= hentities($item['title']) ?></a></h3>
                        <p class="box-text" style="height: 4.5em; overflow: hidden"><?= implode(' ', array_slice(explode(' ', strip_tags($item['info'])), 0, 100)) ?></p>
                        <a href="services/item/<?= $item['id'] ?>" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/default/common/js/form') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
