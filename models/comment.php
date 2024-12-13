<?php
    include '../utils/databaseConnection.php';

    function getComments($postId) {
        $sql = 'SELECT *, comment.id AS comment_id, firstname AS author_firstname, lastname AS author_lastname, avatar AS author_avatar
                FROM comment INNER JOIN user
                ON author_id = user.id
                WHERE post_id = :post_id AND comment.is_deleted = False
                ORDER BY createdAt DESC';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function addComment($postId, $content, $authorId) {
        $sql = 'INSERT INTO comment SET
                post_id = :post_id,
                content = :content,
                author_id = :author_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':post_id', $postId);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':author_id', $authorId);
        $stmt->execute();
    }

    function deleteComment($id, $authorId) {
        $sql = 'UPDATE comment SET 
                is_deleted = True
                WHERE id = :id AND author_id = :author_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':author_id', $authorId);
        $stmt->execute();
    }

    function updateComment($id, $content, $authorId) {
        $sql = 'UPDATE comment SET 
                content = :content
                WHERE id = :id AND author_id = :author_id AND is_deleted = False';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':author_id', $authorId);
        $stmt->execute();
    }
?>