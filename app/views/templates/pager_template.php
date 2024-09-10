<?php if ($record_count > 0): ?>
    <br class="clearfix">
    <div>
        <nav class="<?= $nav_class ?>">
            <ul class="<?= $ul_class ?>">
                <li class="<?= $li_class ?>"><a class="<?= $a_class ?>" href="<?= $links['first'] ?>">First</a></li>

                <?php for ($x = $start; $x <= $end; $x++): ?>
                    <li class="<?= $li_class ?> <?= ($x == $page_number) ? ' active ' : ''; ?>"><a class="<?= $a_class ?>" href="<?= preg_replace('/page=[0-9]+/', "page=" . $x, $links['current']) ?>"><?= $x ?></a></li>
                <?php endfor; ?>

                <li class="<?= $li_class ?>"><a class="<?= $a_class ?>" href="<?= $links['next'] ?>">Next</a></li>
            </ul>
        </nav>
    </div>
<?php endif; ?>