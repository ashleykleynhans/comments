<?= View::factory('template/header') ?>

<?php
    $product_item_count = 0;
    $product_row_count = 0;
?>

<?php foreach ($products as $product): ?>
    <?php if ($product_item_count == 0): ?>
    <div class="categorySection">
    <?php endif; ?>
        <div class="productItem">
            <a href="">
                <img src="/images/<?= $product->product_code ?>.jpg" height="399" width="310" alt="<?= $product->product_code ?>" title="<?= $product->product_code ?>" />
            </a>
            
            <?php if ($product_row_count == 0): ?>
            <div class="productItemBottomDivider"></div>
            <?php endif; ?>
        </div>

        <?php
            $product_item_count++;

            if ($product_item_count == 3)
            {
                $product_item_count = 0;
                $product_row_count++;
                echo "    </div>\n";
                echo "    <div class=\"clearfix\"></div>\n";
            }
        ?>
<?php endforeach; ?>

<?php if ($product_item_count > 0): ?>
    </div>
    <div class="clearfix"></div>
<?php endif; ?>

    <div class="pager"></div>

<?= View::factory('template/footer') ?>