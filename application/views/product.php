<?= View::factory('template/header') ?>

    <div class="categorySection">
        <div class="productItem">
            <a href="/product/<?= $product->product_code ?>">
                <img src="/images/<?= $product->product_code ?>.jpg" height="399" width="310" alt="<?= $product->product_code ?>" title="<?= $product->product_code ?>" />
            </a>
        </div>

        <div class="comments">
            <h4 class="commentsHeading">Comments</h4>

            <?php if (count($comments)): ?>
            <?php else: ?>
                <p>There aren't any comments yet.</p>
                <a href="#addComment" class="btn btn-primary fancybox">Add a comment</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="sectionDivider"></div>

    <div id="addComment" style="display:none;">
        <div id="parentId" style="display:none;">0</div>
        <h4>Add a comment</h4>
        <form id="commentForm" action="javascript:void();" method="post">
            <fieldset>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" />
            </fieldset>

            <fieldset>
                <label for="email">Email Address</label>
                <input type="text" name="email" id="email" />
            </fieldset>

            <fieldset>
                <label for="comment">Comment</label>
                <textarea name="email" id="comment"></textarea>
            </fieldset>

            <button type="button" id="saveComment" class="btn btn-success btn-large">Save</button>
        </form>
    </div>

<?= View::factory('template/footer') ?>