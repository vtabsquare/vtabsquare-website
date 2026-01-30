    <?= view('app/admin/common/head_top') ?>

    <title>Clients - <?= config('Config\App')->siteName ?></title>

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
                        Clients
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="admin/clients">
                    <small class="alert alert-info form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png.</small>

                    <div class="form-row j-items j-img-remove">
                        <?php for ($i = 0; $i < 100; $i++): ?>
                        <?php $image = $clients[$i] ?? ''; ?>

                        <div class="col-md-3 form-group j-img-item<?php if (!$image): ?> d-none<?php endif; ?>">
                            <?php if ($image): ?>
                            <a target="_blank" href="images/clients/<?php echo $image; ?>">
                                <img class="img-fluid d-block mx-auto mb-3" src="images/clients/<?php echo $image; ?>" alt width="150">
                            </a>
                            <?php endif; ?>

                            <label>Image <?php echo $i + 1; ?></label>
                            <div class="input-group">
                                <input class="form-control" data-index="<?= $i ?>" data-name="images" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                                <div class="input-group-append">
                                    <input type="checkbox" data-name="images.<?= $i ?>" class="d-none" value="<?= $i ?>">
                                    <button class="btn btn-danger" type="button" data-action="remove">
                                        <span class="fas fa-minus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <div class="row">
                        <div class="col-6 form-group">
                            <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                            <input class="btn btn-primary" type="submit" value="Update">
                        </div>
                        <div class="col-6 form-group text-right">
                            <button class="btn btn-success j-more" type="button">Add more</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>

    <script>
    (function ($) {
        "use strict";

        function initItems() {
            const itemsElm = $(".j-items").children();

            $(".j-more").on("click", () => {
                const items = itemsElm.filter((_, e) => $(e).hasClass("d-none"));
                items.first().removeClass("d-none");

                if (items.length <= 1) {
                    $(".j-more").parent().addClass("d-none");
                }
            });
        }

        function init() {
            $ = jQuery;
            initItems();
        }

        (window._jq = window._jq || []).push(init);
    }());
    </script>

    <?= view('app/admin/common/js/img_remove') ?>
    <?= view('app/admin/common/js/form_file') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
