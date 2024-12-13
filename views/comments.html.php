<div class="container">
    <div class="comment">
        <form action="addcomment.php" method="POST">
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id'], ENT_QUOTES, 'UTF-8') ?>">
            <textarea name="content" id="" cols="30" rows="3" placeholder="Put your comments here." required></textarea>
            <input type="submit" value="Add comment" name="submit">
        </form>
    </div>

    <?php foreach ($comments as $comment): ?>
        <div class="comment box">
            <div class="comment-header">
                <img src="<?= htmlspecialchars($comment['author_avatar'], ENT_QUOTES, 'UTF-8') ?>" alt="Author Avatar" width="50px">
                <div class="comment-author">
                    <strong><?= htmlspecialchars($comment['author_firstname'] . ' ' . $comment['author_lastname'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <span class="small-details">
                        <span class="creation-time"></span>
                    </span>
                </div>
            </div>

            <!-- Displaying comment content -->
            <div class="comment-content" id="comment-content-<?= htmlspecialchars($comment['comment_id'], ENT_QUOTES, 'UTF-8') ?>">
                <p><?= nl2br(htmlspecialchars($comment['content'], ENT_QUOTES, 'UTF-8')) ?></p>
            </div>

            <!-- Edit form (hidden initially) -->
            <div class="comment-edit-form" id="editcomment-form-<?= htmlspecialchars($comment['comment_id'], ENT_QUOTES, 'UTF-8') ?>" style="display: none;">
                <form action="editcomment.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($comment['comment_id'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id'], ENT_QUOTES, 'UTF-8') ?>">
                    <textarea name="content" id="" cols="30" rows="3"><?= htmlspecialchars($comment['content'], ENT_QUOTES, 'UTF-8') ?></textarea>
                    <input type="submit" value="Save" name="submit">
                    <button type="button" onclick="cancelCommentEditing(<?= htmlspecialchars($comment['comment_id'], ENT_QUOTES, 'UTF-8') ?>)">Cancel</button>
                </form>
            </div>

            <!-- Vote Section -->
            <div class="vote-section">
                <!-- Upvote Button -->
                <button id="upvote-btn-<?= $comment['comment_id'] ?>" class="vote-btn upvote-btn" onclick="vote('up', <?= $comment['comment_id'] ?>)">
                    <span class="vote-arrow">▲</span>
                </button>

                <!-- Vote Count -->
                <div class="vote-count" id="vote-count-<?= $comment['comment_id'] ?>">
                    <?= $comment['vote_count'] ?>
                </div>

                <!-- Downvote Button -->
                <button id="downvote-btn-<?= $comment['comment_id'] ?>" class="vote-btn downvote-btn" onclick="vote('down', <?= $comment['comment_id'] ?>)">
                    <span class="vote-arrow">▼</span>
                </button>
            </div>

            <?php if ($comment['author_id'] == $user['id']): ?>
                <div class="comment-actions">
                    <!-- Edit Button -->
                    <button class="btn edit-btn" id="edit-comment-btn-<?= htmlspecialchars($comment['comment_id'], ENT_QUOTES, 'UTF-8') ?>" onclick="enableCommentEditing(<?= htmlspecialchars($comment['comment_id'], ENT_QUOTES, 'UTF-8') ?>)">Edit</button>
                    <form action="deletecomment.php" method="POST" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($comment['comment_id'], ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button class="btn delete-btn" type="submit" name="submit">Delete</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <script>
            // Parse the timestamp in the Vietnam timezone
            var formattedTime = moment("<?= htmlspecialchars($comment['createdAt'], ENT_QUOTES, 'UTF-8') ?>").utc().fromNow();
            var creationTimeBoxes = document.getElementsByClassName('creation-time');
            creationTimeBoxes[creationTimeBoxes.length - 1].innerText = formattedTime;

            // Set initial vote state based on the user_vote from PHP
            var userVote = <?= $comment['user_vote'] ?>;
            var upvoteBtn = document.getElementById('upvote-btn-<?= $comment['comment_id'] ?>');
            var downvoteBtn = document.getElementById('downvote-btn-<?= $comment['comment_id'] ?>');

            if (userVote === 1) {
                upvoteBtn.style.color = 'green'; // Highlight upvote button
            } else if (userVote === 0) {
                downvoteBtn.style.color = 'red'; // Highlight downvote button
            }

            function vote(type, commentId) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../models/commentvote.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        try {
                            var response = JSON.parse(xhr.responseText);  // Try to parse JSON
                            console.log(response);  // Log the response to check

                            if (response.success) {
                                // Update vote count
                                document.getElementById("vote-count-" + commentId).innerText = response.vote_count;

                                // Update button styles based on the new vote
                                if (type === 'up') {
                                    document.getElementById('upvote-btn-' + commentId).style.color = 'green'; // Highlight upvote
                                    document.getElementById('downvote-btn-' + commentId).style.color = ''; // Remove highlight from downvote
                                } else {
                                    document.getElementById('upvote-btn-' + commentId).style.color = ''; // Remove highlight from upvote
                                    document.getElementById('downvote-btn-' + commentId).style.color = 'red'; // Highlight downvote
                                }
                            } else {
                                alert(response.message || "An error occurred while voting.");
                            }
                        } catch (e) {
                            console.error("Failed to parse JSON response:", e);
                            console.error("Response text:", xhr.responseText);  // Log the response if parsing fails
                        }
                    }
                };
                xhr.send("comment_id=" + commentId + "&is_upvote=" + (type === 'up' ? 1 : 0));
            }

            function enableCommentEditing(commentId) {
                // Show the edit form
                document.getElementById('comment-content-' + commentId).style.display = 'none';
                document.getElementById('editcomment-form-' + commentId).style.display = 'block';
            }

            function cancelCommentEditing(commentId) {
                // Hide the edit form
                document.getElementById('comment-content-' + commentId).style.display = 'block';
                document.getElementById('editcomment-form-' + commentId).style.display = 'none';
            }
        </script>
    <?php endforeach; ?>
</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }

    .comment {
        margin-bottom: 20px;
    }

    .comment.box {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }

    .comment img {
        border-radius: 50%;
        margin-right: 10px;
    }

    .small-details {
        font-size: 0.8em;
        color: #888;
    }

    .vote-section {
        display: flex;
        align-items: center;
    }

    .vote-btn {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        padding: 5px;
    }

    .upvote-btn {
        color: gray;
    }

    .downvote-btn {
        color: gray;
    }

    .vote-count {
        margin: 0 10px;
    }

    .btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 3px;
    }

    .btn:hover {
        background-color: #0056b3;
    }
    .comment-edit-form form {
        display: flex;
        flex-direction: column;
    }

    .comment-edit-form textarea {
        resize: none;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .comment-content p {
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
    }

</style>
