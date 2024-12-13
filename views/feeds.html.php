<?php foreach ($posts as $post): ?>
    <div class="post-container">
        <div class="post-card-container">
            <div class="vote-section">
                <button id="upvote-btn-<?= $post['post_id'] ?>" 
                        class="vote-btn upvote-btn" 
                        aria-label="Upvote post"
                        onclick="vote('up', <?= $post['post_id'] ?>)">
                    <span class="vote-arrow">▲</span>
                </button>
                <div class="vote-count" id="vote-count-<?= $post['post_id'] ?>">
                    <?= $post['vote_count'] ?>
                </div>
                <button id="downvote-btn-<?= $post['post_id'] ?>" 
                        class="vote-btn downvote-btn" 
                        aria-label="Downvote post"
                        onclick="vote('down', <?= $post['post_id'] ?>)">
                    <span class="vote-arrow">▼</span>
                </button>
            </div>
            <a class="post-card" href="../controllers/readpost.php?id=<?= $post['post_id']?>">
                <div class="post-header">
                    <h3 class="post-title"><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p class="post-comments"><?= $post['no_comments'] ?> Comment(s)</p>
                </div>
                <div class="post-body">
                    <p><b>Module: </b><?= htmlspecialchars($post['module_name'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><b>By </b><?= htmlspecialchars($post['author_firstname'] . ' ' . $post['author_lastname'], ENT_QUOTES, 'UTF-8') ?></p>
                    <span class="post-time" id="creation-time-<?=$post['post_id']?>"></span>
                </div>
                <?php if ($post['author_id'] == $user['id']): ?>
                    <div class="post-actions">
                        <form action="editpost.php">
                            <input type="hidden" name="id" value="<?=$post['post_id']?>">
                            <input class="action-btn edit-btn" type="submit" value="Edit" />
                        </form>
                        <form action="deletepost.php" method="POST">
                            <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                            <button class="action-btn delete-btn" type="submit">Delete</button>
                        </form>
                    </div>
                <?php endif; ?>
            </a>
        </div>
    </div>

    <script>
        var formattedTime = moment("<?=$post['createdAt']?>").utc().fromNow();
        var creationTimeBox = document.getElementById('creation-time-<?=$post['post_id']?>');
        if (creationTimeBox) {
            creationTimeBox.innerText = formattedTime;
        }

        var userVote = <?= $post['user_vote'] ?>;
        var upvoteBtn = document.getElementById('upvote-btn-<?= $post['post_id'] ?>');
        var downvoteBtn = document.getElementById('downvote-btn-<?= $post['post_id'] ?>');

        if (userVote === 1) {
            upvoteBtn.style.color = 'green';
        } else if (userVote === 0) {
            downvoteBtn.style.color = 'red';
        }

        function vote(type, postId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../models/vote.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById("vote-count-" + postId).innerText = response.vote_count;
                        if (type === 'up') {
                            document.getElementById('upvote-btn-' + postId).style.color = 'green';
                            document.getElementById('downvote-btn-' + postId).style.color = '';
                        } else {
                            document.getElementById('upvote-btn-' + postId).style.color = '';
                            document.getElementById('downvote-btn-' + postId).style.color = 'red';
                        }
                    } else {
                        alert(response.message || "An error occurred while voting.");
                    }
                }
            };
            xhr.send("post_id=" + postId + "&is_upvote=" + (type === 'up' ? 1 : 0));
        }
    </script>
<?php endforeach; ?>

<style>
    .post-container {
        display: flex;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .post-container:hover {
        transform: translateY(-5px);
    }

    .post-card-container {
        display: flex;
        width: 100%;
    }

    .vote-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background-color: #f1f1f1;
        border-right: 2px solid #ddd;
        width: 60px;
    }

    .vote-btn {
        background: none;
        border: none;
        color: #555;
        font-size: 24px;
        cursor: pointer;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .vote-btn:hover {
        color: #007bff;
        transform: scale(1.1);
    }

    .vote-count {
        font-size: 18px;
        font-weight: bold;
        margin: 10px 0;
    }

    .vote-arrow {
        display: block;
    }

    .post-card {
        display: block;
        color: #333;
        text-decoration: none;
        padding: 15px;
        width: calc(100% - 80px);
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .post-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        transition: color 0.3s ease;
    }

    .post-title:hover {
        color: #007bff;
    }

    .post-comments {
        font-size: 14px;
        color: #777;
    }

    .post-body {
        font-size: 16px;
        color: #555;
    }

    .post-time {
        color: grey;
        font-size: 14px;
        font-style: italic;
    }

    .post-actions {
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
    }

    .action-btn {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .edit-btn {
        background-color: #4CAF50;
        color: white;
    }

    .edit-btn:hover {
        background-color: #45a049;
    }

    .delete-btn {
        background-color: #f44336;
        color: white;
    }

    .delete-btn:hover {
        background-color: #e53935;
    }

    .post-time {
        font-size: 12px;
        transition: color 0.3s ease;
    }

    .post-time:hover {
        color: #007bff;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .post-card {
            width: calc(100% - 60px);
        }
    }
</style>
