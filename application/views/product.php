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
                    <?php
                        $comments_list = array();

                        foreach ($comments as $comment)
                        {
                            $comments_list[$comment->comment_id] = $comment->as_array();
                        }

                        $comments_list = array_reverse($comments_list);

                        // Each time a child is found, push it to its parent
                        foreach ($comments_list as $k => $v)
                        {
                            if ($v['parent_id'] != 0)
                            {
                                $comments_list[$v['parent_id']]['childs'][] = $v;
                            }
                        }

                        // Remove the childs comments from the top level
                        foreach ($comments_list as $k => $v)
                        {
                            if ($v['parent_id'] != 0)
                            {
                                unset($comments_list[$k]);
                            }
                        }

                    print_r($comments_list); exit;

                        function displayComments(array $comments_list, $level = 0)
                        {
                            foreach ($comments_list as $comment)
                            {
                                echo '<div class="comment" style="margin-left:' . $level * 30 . 'px">' . "\n";
                                echo '    <div class="commentText">' . "\n";
                                echo '    ' . $comment['comment_text'] . "\n";
                                echo '    </div>' . "\n\n";
                                echo '    <div class="commentDetail">' . "\n";
                                echo '    ' . $comment['name'] . '&nbsp;&nbsp; - &nbsp;&nbsp;';
                                echo '    ' . $comment['created'] . "\n";
                                echo '    </div>' . "\n\n";
                                echo '    <div class="commentReply">' . "\n";
                                echo '        <a href="#addComment" class="btn btn-sm btn-success fancybox" data-comment-id="'. $comment['comment_id'] .'">Reply</a>' . "\n";
                                echo '    </div>' . "\n";
                                echo '</div>' . "\n";

                                //echo str_repeat('-', $level + 1).' comment '.$info['id']."\n";

                                if (!empty($comment['childs']))
                                {
                                    displayComments($comment['childs'], $level + 1);
                                }
                            }
                        }

                        displayComments($comments_list);
                    ?>
                <?php else: ?>
                    <p>There aren't any comments yet.</p>
                <?php endif; ?>
            </div>

            <div class="commentButton">
                <a href="#addComment" class="btn btn-primary fancybox" data-comment-id="0">New comment</a>
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