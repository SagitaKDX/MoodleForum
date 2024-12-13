<?php
    // Connect to database
    include '../utils/databaseConnection.php';

    function getAllPosts() {
        $sql = 'SELECT 
                    post.id as post_id,
                    post.*,
                    module.name as module_name,
                    user.firstname as author_firstname,
                    user.lastname as author_lastname,
                    COUNT(comment.id) as no_comments,
                    post.vote_count  -- Add vote_count column here
                FROM post
                INNER JOIN module ON post.module_id = module.id
                INNER JOIN user ON post.author_id = user.id
                LEFT JOIN comment ON post.id = comment.post_id AND comment.is_deleted = False
                WHERE post.is_deleted = False AND module.is_deleted = False
                GROUP BY post.id, module_name, author_firstname, author_lastname
                ORDER BY post.createdAt DESC;';
        $stmt = $GLOBALS['pdo']->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    function getPostsInModule($moduleId) {
        $sql = 'SELECT 
                    post.id as post_id, 
                    post.*, 
                    module.name as module_name, 
                    user.firstname as author_firstname, 
                    user.lastname as author_lastname,
                    COUNT(comment.id) as no_comments,
                    post.vote_count
                FROM post 
                INNER JOIN module ON post.module_id = module.id
                INNER JOIN user ON post.author_id = user.id
                LEFT JOIN comment ON post.id = comment.post_id AND comment.is_deleted = False
                WHERE module_id = :module_id AND post.is_deleted = False
                GROUP BY post.id, module_name, author_firstname, author_lastname
                ORDER BY post.createdAt DESC;';
    
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':module_id', $moduleId);
        $stmt->execute();  // Thực thi truy vấn
    
        // Fetch kết quả và trả về dữ liệu
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    function getPost() {
        $sql = "SELECT 
                    post.*,
                    module.name as module_name, 
                    post.id as post_id, 
                    module.id as module_id,
                    CONCAT(user.firstname, ' ', user.lastname) as author_fullname
                FROM post 
                INNER JOIN module ON post.module_id = module.id
                INNER JOIN user ON post.author_id = user.id
                WHERE post.id = :id AND post.is_deleted = False AND module.is_deleted = False";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        return $stmt->fetch();
    }

    function addPost($title, $content, $image, $moduleId, $authorId) {
        $sql = 'INSERT INTO post SET
            title = :title,
            content = :content,
            image = :image,
            module_id = :module_id,
            author_id = :author_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':module_id', $moduleId);
        $stmt->bindValue(':author_id', $authorId);
        $stmt->execute();
    }

    function deletePost($id, $authorId) {
        $sql = 'UPDATE post SET 
                is_deleted = True
                WHERE id = :id AND author_id = :author_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':author_id', $authorId);
        $stmt->execute();
    }

    function updatePost($id, $title, $content, $image, $moduleId, $authorId) {
        $sql = 'UPDATE post SET 
                title = :title,
                content = :content,
                image = CASE WHEN :image IS NOT NULL THEN :image ELSE image END, -- Only update image if there is value
                module_id = :module_id
                WHERE id = :id AND author_id = :author_id AND is_deleted = False';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':module_id', $moduleId);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':author_id', $authorId);
        $stmt->execute();
    }

    function getVoteType($user_id, $post_id) {
        try {
            $sql = 'SELECT is_upvote, is_deleted FROM votes WHERE user_id = :user_id AND post_id = :post_id';
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':post_id', $post_id);
            $stmt->execute();
    
            $vote = $stmt->fetch();
    
            if ($vote) {
                if ($vote['is_deleted'] == 1) {
                    // Vote has been deleted
                    return 2;  // Not voted anymore
                } elseif ($vote['is_upvote'] == 1) {
                    // Upvote
                    return 1;
                } else {
                    // Downvote
                    return 0;
                }
            } else {
                // User has not voted on this post
                return 2;
            }
        } catch (Exception $e) {
            // Handle errors (logging, etc.)
            return 2;
        }
    }
?>