    <?= view('app/admin/common/head_top') ?>

    <title>Edit a category - <?= config('Config\App')->siteName ?></title>

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
                        <a href="admin/services">Services</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="admin/services/categories">Categories</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit
                    </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-7 col-lg-5">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-method="put" data-url="admin/services/categories/<?= $category['id'] ?>" data-timeout="3000">
                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input class="form-control" name="title" type="text" required value="<?= hentities($category['title']) ?>">
                    </div>

                    <div class="form-group">
                        <label>URL <span class="text-danger">*</span></label>
                        <input class="form-control" name="slug" type="text" value="<?= hentities($category['slug'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Parent</label>
                        <select class="form-control j-category" name="pid" data-value="<?= $category['pid'] ?: '' ?>" data-url="admin/services/categories/all">
                            <option value="">Choose</option>
                        </select>
                    </div>

                    <div class="form-row form-group">
                        <div class="col">
                            <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                            <input class="btn btn-block btn-primary" type="submit" value="Update">
                        </div>
                        <div class="col">
                            <a class="btn btn-block btn-secondary" href="admin/services/categories">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/slug') ?>
    <?= view('app/admin/common/js/category') ?>
    <?= view('app/admin/common/js/form') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
