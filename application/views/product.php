<?= View::factory('template/header') ?>

    <div class="categorySection">
        <div class="productItem">
            <a href="/product/<?= $product->product_code ?>">
                <img src="/images/<?= $product->product_code ?>.jpg" height="399" width="310" alt="<?= $product->product_code ?>" title="<?= $product->product_code ?>" />
            </a>
        </div>

        <div id="commentsContainer">
            <h4 class="commentsHeading">Comments</h4>
            <div id="comments">
                <?php if (count($comments)): ?>
                    <?php foreach($comments as $comment): ?>
                        <div class="comment">
                            <div class="commentText">
                                <?= $comment->comment_text ?>
                            </div>

                            <div class="commentDetail">
                                <?= $comment->name ?>&nbsp;&nbsp; - &nbsp;&nbsp;
                                <?= $comment->created ?>
                            </div>

                            <div class="commentReply">
                                <button class="btn btn-sm btn-success">Reply</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>There aren't any comments yet.</p>
                <?php endif; ?>
            </div>

            <div class="commentButton">
                <a href="#addComment" class="btn btn-primary fancybox"> New comment</a>
            </div>
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

            <div id="buttons">
                <button type="button" id="saveComment" class="btn btn-success btn-large">Save</button>
                <button type="button" id="cancelComment" class="btn btn-warning btn-large">Cancel</button>
            </div>
        </form>
    </div>

<?= View::factory('template/footer') ?>