<?php

$status = [
    'fas fa-times text-danger',
    'fas fa-check text-success'
];

?>
    <?= view('app/admin/common/head_top') ?>

    <title>View a testimonial - <?= config('Config\App')->siteName ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="noindex">

    <?= view('app/admin/common/css') ?>
    <?= view('app/admin/common/head_bottom') ?>
    <?= view('app/admin/common/menu') ?>

    <main class="container mb-3">
        <div class="row align-items-center">
            <div class="col-md-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="admin">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="admin/testimonials">Testimonials</a>
                    </li>
                    <li class="breadcrumb-item active">
                        View
                    </li>
                </ol>
            </div>
            <div class="col-md-7 mb-2">
                <div class="form-row row-cols-2 row-cols-sm-3 row-cols-lg-4 justify-content-sm-end">
                    <div class="col mb-2">
                        <a href="admin/testimonials/edit/<?= $testimonial['id'] ?>" class="btn btn-block btn-primary">
                            <span class="fas fa-edit"></span>
                            Edit
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="admin/testimonials" class="btn btn-block btn-secondary">
                            <span class="fas fa-long-arrow-alt-left"></span>
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">Testimonial details</div>
                    <div class="card-body pb-0">
                        <div class="row mb-3">
                            <div class="col-4">ID</div>
                            <div class="col-8"><?= $testimonial['id'] ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Name</div>
                            <div class="col-8"><?= hentities($testimonial['name']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Rating</div>
                            <div class="col-8"><?= hentities($testimonial['rating']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Status</div>
                            <div class="col-8"><span class="<?= $status[$testimonial['status']] ?>"></span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Date added</div>
                            <div class="col-8"><?= date('d-m-Y h:i a', strtotime($testimonial['date_added'])) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php if ($testimonial['image']): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">Image</div>
                    <div class="card-body text-center">
                        <div class="img-overlay img-hoverlay cursor-pointer" data-lity data-lity-target="images/testimonials/<?= $testimonial['image'] ?>">
                            <img class="img-fluid" src="images/testimonials/<?= $testimonial['image'] ?>" alt>
                            <span class="fas fa-search-plus icon icon-sm"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($testimonial['message']): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">Message</div>
                    <div class="card-body">
                        <?= $testimonial['message'] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
