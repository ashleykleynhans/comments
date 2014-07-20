<?= View::factory('template/header') ?>

<?php
    // Initialise the variables used to control the layout of the products on the page
    $product_item_count = 0;
    $product_row_count = 0;
?>

<?php // Loop through each product and display it on the page
    foreach ($products as $product): ?>
    <?php if ($product_item_count == 0): ?>
    <div class="categorySection">
    <?php endif; ?>
        <div class="productItem">
            <a href="<?= URL::site('product/'. $product->product_code, true) ?>">
                <img src="<?= URL::base(true) ?>/images/<?= $product->product_code ?>.jpg" height="399" width="310" alt="<?= $product->product_code ?>" title="<?= $product->product_code ?>" />
            </a>

            <?php if ($product_row_count == 0): ?>
            <div class="productItemBottomDivider"></div>
            <?php endif; ?>
        </div>

        <?php
            // Start a new row if there are already 3 items in the current row
            // Only the first row gets the dividers below each image
            // (This simple logic would change in a real world situation with more products)
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

<?php // Ensure that the div element is closed and that clearfix is applied
    if ($product_item_count > 0): ?>
    </div>
    <div class="clearfix"></div>
<?php endif; ?>

    <!-- Display the pagination placeholder image -->
    <div class="pager"></div>

<?= View::factory('template/footer') ?>