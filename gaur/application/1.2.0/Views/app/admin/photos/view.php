<?php

$status = [
    'fas fa-times text-danger',
    'fas fa-check text-success'
];

?>
    <?= view('app/admin/common/head_top') ?>

    <title>View a photo - <?= config('Config\App')->siteName ?></title>

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
                        <a href="admin/photos">Photos</a>
                    </li>
                    <li class="breadcrumb-item active">
                        View
                    </li>
                </ol>
            </div>
            <div class="col-md-7 mb-2">
                <div class="form-row row-cols-2 row-cols-sm-3 row-cols-lg-4 justify-content-sm-end">
                    <div class="col mb-2">
                        <a href="admin/photos/edit/<?= $photo['id'] ?>" class="btn btn-block btn-primary">
                            <span class="fas fa-edit"></span>
                            Edit
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="admin/photos" class="btn btn-block btn-secondary">
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
                    <div class="card-header">Photo details</div>
                    <div class="card-body pb-0">
                        <div class="row mb-3">
                            <div class="col-4">ID</div>
                            <div class="col-8"><?= $photo['id'] ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Title</div>
                            <div class="col-8"><?= hentities($photo['title']) ?></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">Category</div>
                            <div class="col-8"><?= hentities(implode(' > ', $categories)) ?></div>
                        </div>

                        <?php if ($photo['mdesc']): ?>
                        <div class="row mb-3">
                            <div class="col-4">Meta description</div>
                            <div class="col-8"><?= hentities($photo['mdesc']) ?></div>
                        </div>
                        <?php endif; ?>

                        <?php if ($photo['mkeywords']): ?>
                        <div class="row mb-3">
                            <div class="col-4">Meta keywords</div>
                            <div class="col-8"><?= hentities($photo['mkeywords']) ?></div>
                        </div>
                        <?php endif; ?>

                        <div class="row mb-3">
                            <div class="col-4">Status</div>
                            <div class="col-8"><span class="<?= $status[$photo['status']] ?>"></span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Date added</div>
                            <div class="col-8"><?= date('d-m-Y h:i a', strtotime($photo['date_added'])) ?></div>
                        </div>

                        <?php if ($photo['date_modified']): ?>
                        <div class="row mb-3">
                            <div class="col-4">Date modified</div>
                            <div class="col-8"><?= date('d-m-Y h:i a', strtotime($photo['date_modified'])) ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($photo['images']): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">Images</div>
                    <div class="card-body text-center">
                        <div class="row">

                            <?php $imagesList = array_fill(0, 4, []); ?>
                            <?php foreach ($photo['images'] as $i => $image): ?>
                            <?php $imagesList[$i % 4][] = $image; ?>
                            <?php endforeach; ?>

                            <?php foreach ($imagesList as $images): ?>
                            <div class="col-md-3">
                                <?php foreach ($images as $image): ?>
                                <div class="img-overlay img-hoverlay mb-3 cursor-pointer" data-lity data-lity-target="images/photos/<?= $image ?>">
                                    <img class="img-fluid" src="images/photos/thumb/<?= $image ?>" alt>
                                    <span class="fas fa-search-plus icon icon-sm"></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($photo['info']): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">Description</div>
                    <div class="card-body">
                        <?= $photo['info'] ?>
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
