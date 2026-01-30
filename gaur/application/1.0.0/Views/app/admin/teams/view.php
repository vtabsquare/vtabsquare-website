<?php

$status = [
    'fas fa-times text-danger',
    'fas fa-check text-success'
];

?>
    <?= view('app/admin/common/head_top') ?>

    <title>View a team - <?= config('Config\App')->siteName ?></title>

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
                        <a href="admin/teams">Teams</a>
                    </li>
                    <li class="breadcrumb-item active">
                        View
                    </li>
                </ol>
            </div>
            <div class="col-md-7 mb-2">
                <div class="form-row row-cols-2 row-cols-sm-3 row-cols-lg-4 justify-content-sm-end">
                    <div class="col mb-2">
                        <a href="admin/teams/edit/<?= $team['id'] ?>" class="btn btn-block btn-primary">
                            <span class="fas fa-edit"></span>
                            Edit
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="admin/teams" class="btn btn-block btn-secondary">
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
                    <div class="card-header">Team details</div>
                    <div class="card-body pb-0">
                        <div class="row mb-3">
                            <div class="col-4">ID</div>
                            <div class="col-8"><?= $team['id'] ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Name</div>
                            <div class="col-8"><?= hentities($team['name']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Designation</div>
                            <div class="col-8"><?= hentities($team['designation']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Facebook</div>
                            <div class="col-8"><?= hentities($team['links']['facebook']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Twitter</div>
                            <div class="col-8"><?= hentities($team['links']['twitter']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Instagram</div>
                            <div class="col-8"><?= hentities($team['links']['instagram']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Linkedin</div>
                            <div class="col-8"><?= hentities($team['links']['linkedin']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Status</div>
                            <div class="col-8"><span class="<?= $status[$team['status']] ?>"></span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">Date added</div>
                            <div class="col-8"><?= date('d-m-Y h:i a', strtotime($team['date_added'])) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php if ($team['image']): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">Image</div>
                    <div class="card-body text-center">
                        <div class="img-overlay img-hoverlay cursor-pointer" data-lity data-lity-target="images/teams/<?= $team['image'] ?>">
                            <img class="img-fluid" src="images/teams/<?= $team['image'] ?>" alt>
                            <span class="fas fa-search-plus icon icon-sm"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
