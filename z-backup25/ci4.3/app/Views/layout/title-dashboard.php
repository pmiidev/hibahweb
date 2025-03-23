<div class="page-title">
    <h3><?= $title; ?></h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <?php if (count($breadcrumbs) == 1) : ?>
                <li class="active"><?= $breadcrumbs[0]; ?></li>
            <?php elseif (count($breadcrumbs) == 2) : ?>
                <li><a href="/<?= $breadcrumbs[0]; ?>"><?= $breadcrumbs[0]; ?></a></li>
                <li class="active"><?= $breadcrumbs[1]; ?></li>
            <?php elseif (count($breadcrumbs) == 3) : ?>
                <li><a href="/<?= $breadcrumbs[0]; ?>"><?= $breadcrumbs[0]; ?></a></li>
                <li><a href="/<?= $breadcrumbs[0]; ?>/<?= $breadcrumbs[1]; ?>"><?= $breadcrumbs[1]; ?></a></li>
                <li class="active"><?= $breadcrumbs[2]; ?></li>
            <?php else : ?>
                <li><a href="/<?= $breadcrumbs[0]; ?>"><?= $breadcrumbs[0]; ?></a></li>
                <li><a href="/<?= $breadcrumbs[0]; ?>/<?= $breadcrumbs[1]; ?>"><?= $breadcrumbs[1]; ?></a></li>
            <?php endif; ?>
        </ol>
    </div>
</div>