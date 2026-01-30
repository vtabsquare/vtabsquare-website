    <?= view('app/admin/common/head_top') ?>

    <title>Slides - <?= config('Config\App')->siteName ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="noindex">

    <?= view('app/admin/common/css') ?>
    <?= view('app/admin/common/head_bottom') ?>
    <?= view('app/admin/common/menu') ?>

    <main class="container" id="j-ar">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled j-error d-none"></ul>
                <p class="alert alert-success j-success d-none"></p>

                <form method="post" data-url="admin/slides" data-timeout="3000">
                    <div class="j-items row">
                        <?php foreach ($slides as $i => $item): ?>
                        <div class="col-md-6 mb-3">
                            <div class="border shadow-sm p-3">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" class="form-control" type="text" value="<?= hentities($item['title'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label>Heading 1</label>
                                    <input name="heading1" class="form-control" type="text" value="<?= hentities($item['heading1'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label>Heading 2</label>
                                    <input name="heading2" class="form-control" type="text" value="<?= hentities($item['heading2'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <input name="desc" class="form-control" type="text" value="<?= hentities($item['desc'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label>Discover More (link)</label>
                                    <input name="link1" class="form-control" type="text" value="<?= hentities($item['link1'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label>Watch Video (link)</label>
                                    <input name="link2" class="form-control" type="text" value="<?= hentities($item['link2'] ?? '') ?>">
                                </div>
                    
                                <div class="form-group j-img-item">
                                    <?php if ($item['image']): ?>
                                    <a data-lity href="images/home/slides/<?= $item['image'] ?>">
                                        <img class="img-fluid d-block mx-auto mb-2" src="images/home/slides/<?= $item['image'] ?>" alt>
                                    </a>
                                    <?php endif; ?>

                                    <label>Photo</label>

                                    <div class="input-group j-img-remove">
                                        <input class="form-control" data-name="image" data-index="<?= $i ?>" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                                        <div class="input-group-append">
                                            <input type="checkbox" data-name="image.<?= $i ?>" class="d-none" value="<?= $i ?>">
                                            <button class="btn btn-danger" type="button" data-action="remove">
                                                <span class="fas fa-minus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png, pdf.</small>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="row">
                        <div class="col-6 form-group">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-success j-amore d-none">Add More</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <div class="j-frg d-none">
        <div class="col-md-12 mb-3">
            <div class="border shadow-sm p-3">
                <div class="form-group">
                    <label>Title</label>
                    <input name="title" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label>Heading 1</label>
                    <input name="heading1" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label>Heading 2</label>
                    <input name="heading2" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input name="desc" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label>Discover More (link)</label>
                    <input name="link1" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label>Watch Video (link)</label>
                    <input name="link2" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label>Photo</label>
                    <input class="form-control-file" data-name="image" data-size="10MB" data-types="jpeg,jpg,png,pdf" type="file">
                    <small class="form-text text-muted">Maximum upload file size 10MB. Allowed file types jpeg, jpg, png, pdf.</small>
                </div>
            </div>
        </div>
    </div>

    <?= view('app/admin/common/foot_top') ?>

    <script>
    (() => {
        "use strict";

        let $;

        function reindex() {
            const fields = ["title", "heading1", "heading2", "desc", "link1", "link2"];

            fields.forEach((name) => {
                let i = 0;

                for (const elm of $(".j-items [name^=" + name + "]").toArray()) {
                    $(elm).attr(
                        "name",
                        $(elm).attr("name").split(".")[0] + "." + i
                    );

                    i += 1;
                }
            });

            const afields = ["image"];

            afields.forEach((name) => {
                let i = 0;

                for (const elm of $("[type=file][data-name^=" + name + "]").toArray()) {
                    $(elm).attr("data-index", i);
                    i += 1;
                }
            });
        }

        function addmore() {
            const frg = $(".j-frg").children().clone(),
            itemsElm = $(".j-items");

            $(".j-amore").on("click", () => {
                if (itemsElm.children().length < 3) {
                    itemsElm.append(frg.clone());
                    reindex();
                } else {
                    $(".j-amore").addClass("d-none");
                }
            });

            if (itemsElm.children().length < 3) {
                itemsElm.append(frg.clone());
                reindex();
            }
        }

        function init() {
            $ = jQuery;
            reindex();
            addmore();
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>

    <?= view('app/admin/common/js/form_file') ?>
    <?= view('app/admin/common/js/img_remove') ?>
    <?= view('app/admin/common/js/lity') ?>
    <?= view('app/admin/common/js') ?>
    <?= view('app/admin/common/foot_bottom') ?>
