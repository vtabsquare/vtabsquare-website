    <?= view('app/admin/common/head_top') ?>

    <title>Edit a photo - <?= config('Config\App')->siteName ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="noindex">

    <?= view('app/admin/common/css') ?>
    <?= view('app/admin/common/head_bottom') ?>
    <?= view('app/admin/common/menu') ?>

    <main class="container" id="j-ar" data-image-url="admin/photos/files">
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
                        <a href="admin/photos">Photos</a>
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

                <form method="put" data-url="admin/photos/<?= $photo['id'] ?>" data-timeout="3000">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input class="form-control" name="title" type="text" required value="<?= hentities($photo['title']) ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select class="form-control j-category" name="cid" data-value="<?= $photo['cid'] ?>" data-url="admin/photos/categories/all">
                                <option value="">Choose</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Meta description</label>
                            <textarea class="form-control" name="mdesc"><?= hentities($photo['mdesc']) ?></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Meta keywords</label>
                            <textarea class="form-control" name="mkeywords"><?= hentities($photo['mkeywords']) ?></textarea>
                        </div>
                    </div>

                    <div class="form-row align-items-end j-img-remove">
                        <?php if ($photo['images']): ?>
                        <div class="col-md-12">
                            <small class="alert alert-info form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png.</small>
                        </div>

                        <?php foreach ($photo['images'] as $k => $v): ?>
                        <div class="col-md-4 form-group j-img-item">
                            <div class="text-center mb-2">
                                <div class="img-overlay img-hoverlay cursor-pointer" data-lity data-lity-target="images/photos/<?= $v ?>">
                                    <img class="img-fluid" src="images/photos/thumb/<?= $v ?>" alt>
                                    <span class="fas fa-search-plus icon icon-sm"></span>
                                </div>
                            </div>

                            <label>Image <?= $k + 1 ?></label>
                            <div class="input-group">
                                <input class="form-control" data-index="<?= $k ?>" data-name="images" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                                <div class="input-group-append">
                                    <input type="checkbox" data-name="images.<?= $k ?>" class="d-none" value="<?= $k ?>">
                                    <button class="btn btn-danger" type="button" data-action="remove">
                                        <span class="fas fa-minus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <?php if (count($photo['images']) < 100): ?>
                        <div class="col-md-4 form-group j-img-item">
                            <div class="input-group cursor-pointer j-img-add" data-index="<?= count($photo['images']) ?>" data-limit="100">
                                <div class="input-group-prepend">
                                    <span class="btn btn-success">
                                        <span class="fas fa-plus"></span>
                                    </span>
                                </div>
                                <span class="input-group-text">
                                    Add more
                                </span>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php else: ?>
                        <div class="col-md-6 form-group">
                            <label>Images</label>
                            <input class="form-control-file" data-name="images" data-size="10MB" data-types="jpeg,jpg,png" type="file" multiple>
                            <small class="form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png. Maximum files count 100.</small>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group d-none">
                        <label>Description</label>
                        <textarea class="form-control j-editor" name="info" rows="10" data-image="photos" data-size="10MB" data-types="jpeg,jpg,png"><?= hentities($photo['info']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                        <input class="btn btn-primary" type="submit" value="Update">
                        <a class="btn btn-secondary" href="admin/photos">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/img_add') ?>
    <?= view('app/admin/common/js/img_remove') ?>
    <?= view('app/admin/common/js/editor') ?>
    <?= view('app/admin/common/js/category') ?>
    <?= view('app/admin/common/js/form_file_multiple') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
