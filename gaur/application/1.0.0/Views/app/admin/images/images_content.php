<?php $imagesList = array_fill(0, 5, []); ?>
<?php foreach ($items as $i => $image): ?>
<?php $imagesList[$i % 5][] = $image; ?>
<?php endforeach; ?>

<div class="form-row row-cols-2 row-cols-lg-5">
    <?php foreach ($imagesList as $images): ?>
    <div class="col">
        <?php foreach ($images as $image): ?>
        <div class="browse-image mb-3">
            <img class="img-fluid" src="<?= $image ?>" alt>

            <div class="browse-image-btn">
                <button data-action="insert" type="button" class="btn btn-outline-success g-fw-900 fas fa-plus mr-2"></button>

                <button data-action="delete" type="button" class="btn btn-outline-danger g-fw-900 fas fa-trash"></button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>
