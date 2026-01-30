    <?= view('app/admin/common/head_top') ?>

    <title>Add a technology - <?= config('Config\App')->siteName ?></title>

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
                        <a href="admin/technologies">Technologies</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Add
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="admin/technologies" data-timeout="3000">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input class="form-control" name="title" type="text" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select class="form-control j-category" name="cid" data-url="admin/technologies/categories/all">
                                <option value="">Choose</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Image</label>
                            <input class="form-control-file" data-name="image" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                            <small class="form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png.</small>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Video</label>
                            <input class="form-control" name="video" type="text">
                            <small class="form-text text-muted">Video URL (YouTube only) ex: https://www.youtube.com/watch?v=xxxxxxxxxxx</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label>Meta description</label>
                            <textarea class="form-control" name="mdesc"></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Meta keywords</label>
                            <textarea class="form-control" name="mkeywords"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control j-editor" name="info" rows="10" data-image="technologies" data-size="10MB" data-types="jpeg,jpg,png"></textarea>
                    </div>

                    <div class="form-group">
                        <input name="<?= $csrf['name'] ?>" type="hidden" value="<?= $csrf['hash'] ?>">
                        <input class="btn btn-primary" type="submit" value="Create">
                        <a class="btn btn-secondary" href="admin/technologies">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('app/admin/common/foot_top') ?>
    <?= view('app/admin/common/js/editor') ?>
    <?= view('app/admin/common/js/category') ?>
    <?= view('app/admin/common/js/form_file') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
