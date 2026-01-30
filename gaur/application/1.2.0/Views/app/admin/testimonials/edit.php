    <?= view('app/admin/common/head_top') ?>

    <title>Edit a testimonial - <?= config('Config\App')->siteName ?></title>

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
                        <a href="admin/testimonials">Testimonials</a>
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

                <form method="post" data-url="admin/testimonials/<?= $testimonial['id'] ?>" data-timeout="3000">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" type="text" required value="<?= hentities($testimonial['name']) ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Rating <span class="text-danger">*</span></label>
                            <select class="form-control" name="rating">
                                <option value="">Choose</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <option<?php if ($testimonial['rating'] === $i): ?> selected<?php endif; ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row align-items-end">
                        <div class="col-md-6 form-group j-img-item">
                            <?php if ($testimonial['image']): ?>
                            <div class="text-center mb-2">
                                <div class="img-overlay img-hoverlay cursor-pointer" data-lity data-lity-target="images/testimonials/<?= $testimonial['image'] ?>">
                                    <img class="img-fluid" src="images/testimonials/<?= $testimonial['image'] ?>" alt>
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
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message" rows="10"><?= hentities($testimonial['message']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                        <input class="btn btn-primary" type="submit" value="Update">
                        <a class="btn btn-secondary" href="admin/testimonials">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/img_remove') ?>
    <?= view('app/admin/common/js/form_file') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
