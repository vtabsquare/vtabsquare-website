    <?= view('app/admin/common/head_top') ?>

    <title>Edit a case study - <?= config('Config\App')->siteName ?></title>

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
                    <li class="breadcrumb-item">
                        <a href="admin/casestudies">Case Studies</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="admin/casestudy/<?= $casestudy['id'] ?>" data-timeout="3000">
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input class="form-control" name="title" type="text" required value="<?= hentities($casestudy['title']) ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label>URL <span class="text-danger">*</span></label>
                            <input class="form-control" name="slug" type="text" value="<?= hentities($casestudy['slug'] ?? '') ?>">
                        </div>

                        <!-- <div class="col-md-4 form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select class="form-control j-category" name="cid" data-value="<?php // $casestudy['cid'] ?>" data-url="admin/casestudy/categories/all">
                                <option value="">Choose</option>
                            </select>
                        </div> -->
                    </div>

                    <div class="form-row align-items-end">
                        <div class="col-md-6 form-group j-img-item">
                            <?php if ($casestudy['image']): ?>
                            <div class="text-center mb-2">
                                <div class="img-overlay img-hoverlay cursor-pointer" data-lity data-lity-target="images/casestudies/<?= $casestudy['image'] ?>">
                                    <img class="img-fluid" src="images/casestudies/thumb/<?= $casestudy['image'] ?>" alt>
                                    <span class="fas fa-search-plus icon icon-sm"></span>
                                </div>
                            </div>
                            <?php endif; ?>

                            <label>Image</label>
                            <div class="input-group j-img-remove">
                                <input class="form-control" data-name="image" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                                <div class="input-group-append">
                                    <input type="checkbox" data-name="image" class="d-none" value="1">
                                    <button class="btn btn-danger" type="button" data-action="remove">
                                        <span class="fas fa-minus"></span>
                                    </button>
                                </div>
                            </div>

                            <small class="form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png.</small>
                        </div>

                        <div class="col-md-6 form-group">
                            <?php if ($casestudy['video']): ?>
                            <div class="text-center mb-2">
                                <div class="img-overlay img-hoverlay cursor-pointer" data-lity data-lity-target="https://www.youtube.com/watch?v=<?= hentities($casestudy['video']) ?>">
                                    <img class="img-fluid" src="https://i.ytimg.com/vi/<?= hentities($casestudy['video']) ?>/mqdefault.jpg" alt>
                                    <span class="fab fa-youtube icon"></span>
                                </div>
                            </div>
                            <?php endif; ?>

                            <label>Video</label>
                            <input class="form-control" name="video" type="text"<?php if ($casestudy['video']): ?> value="https://www.youtube.com/watch?v=<?= hentities($casestudy['video']) ?>"<?php endif; ?>>
                            <small class="form-text text-muted">Video URL (YouTube only) ex: https://www.youtube.com/watch?v=xxxxxxxxxxx</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Meta description</label>
                            <textarea class="form-control" name="mdesc"><?= hentities($casestudy['mdesc']) ?></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Meta keywords</label>
                            <textarea class="form-control" name="mkeywords"><?= hentities($casestudy['mkeywords']) ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control j-editor" name="info" rows="10" data-image="casestudy" data-size="10MB" data-types="jpeg,jpg,png"><?= hentities($casestudy['info']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                        <input class="btn btn-primary" type="submit" value="Update">
                        <a class="btn btn-secondary" href="admin/casestudies">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/slug') ?>
    <?= view('app/admin/common/js/editor') ?>
    <?= view('app/admin/common/js/img_remove') ?>
    <!-- <?php // view('app/admin/common/js/category') ?> -->
    <?= view('app/admin/common/js/form_file') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
