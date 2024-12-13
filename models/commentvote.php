<?php
include '../utils/databaseConnection.php';

// Function to add or update a vote
function addVote($user_id, $comment_id, $is_upvote) {
    try {
        // Check if the user has already voted on this comment
        $sql = 'SELECT * FROM comment_votes WHERE user_id = :user_id AND comment_id = :comment_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':comment_id', $comment_id);
        $stmt->execute();

        $existingVote = $stmt->fetch();

        if ($existingVote) {
            // If the user has voted already, check if it's deleted and update the vote type
            if ($existingVote['is_deleted'] == 1) {
                // Restore the deleted vote if it was soft-deleted
                $sql = 'UPDATE comment_votes SET is_deleted = 0 WHERE user_id = :user_id AND comment_id = :comment_id';
                $stmt = $GLOBALS['pdo']->prepare($sql);
                $stmt->bindValue(':user_id', $user_id);
                $stmt->bindValue(':comment_id', $comment_id);
                $stmt->execute();
            }

            // Update the vote type (upvote or downvote)
            $sql = 'UPDATE comment_votes SET is_upvote = :is_upvote WHERE user_id = :user_id AND comment_id = :comment_id AND is_deleted = 0';
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->bindValue(':is_upvote', $is_upvote);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comment_id', $comment_id);
            $stmt->execute();
        } else {
            // If the user hasn't voted yet, insert a new vote
            $sql = 'INSERT INTO comment_votes (user_id, comment_id, is_upvote, is_deleted) 
                    VALUES (:user_id, :comment_id, :is_upvote, 0)';
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comment_id', $comment_id);
            $stmt->bindValue(':is_upvote', $is_upvote);
            $stmt->execute();
        }

        // Update the vote count in the comment table
        updateVoteCount($comment_id);
        return true; // Successfully added/updated the vote
    } catch (Exception $e) {
        // Handle any errors and return false
        return false;
    }
}

// Function to delete a vote (soft delete by marking it as deleted)
function deleteVote($user_id, $comment_id) {
    try {
        $sql = 'UPDATE comment_votes SET is_deleted = 1 WHERE user_id = :user_id AND comment_id = :comment_id AND is_deleted = 0';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':comment_id', $comment_id);
        $stmt->execute();

        // Update the vote count after deletion
        updateVoteCount($comment_id);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Function to update the vote count in the comment table
function updateVoteCount($comment_id) {
    try {
        $sql = 'SELECT 
                    SUM(CASE WHEN is_upvote = 1 AND is_deleted = 0 THEN 1 ELSE 0 END) AS upvotes,
                    SUM(CASE WHEN is_upvote = 0 AND is_deleted = 0 THEN 1 ELSE 0 END) AS downvotes
                FROM comment_votes WHERE comment_id = :comment_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':comment_id', $comment_id);
        $stmt->execute();

        $result = $stmt->fetch();
        
        $upvotes = $result['upvotes'] ?? 0;
        $downvotes = $result['downvotes'] ?? 0;

        // Calculate the net votes
        $netVotes = $upvotes - $downvotes;

        // Update the vote_count column in the comment table
        $sql = 'UPDATE comment SET vote_count = :vote_count WHERE id = :comment_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':vote_count', $netVotes);
        $stmt->bindValue(':comment_id', $comment_id);
        $stmt->execute();
    } catch (Exception $e) {
        // Handle any errors (logging, etc.)
    }
}

// Function to get the current vote type (1 = upvote, 0 = downvote, 2 = no vote)
function getCommentVoteType($user_id, $comment_id) {
    try {
        $sql = 'SELECT is_upvote, is_deleted FROM comment_votes WHERE user_id = :user_id AND comment_id = :comment_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':comment_id', $comment_id);
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
            // User has not voted on this comment
            return 2;
        }
    } catch (Exception $e) {
        // Handle errors (logging, etc.)
        return 2;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $comment_id = $_POST['comment_id'];
    $is_upvote = $_POST['is_upvote'];
    $user_id = $_SESSION['user']['id'];

    $success = addVote($user_id, $comment_id, $is_upvote);

    if ($success) {
        // Return updated vote count
        $sql = 'SELECT vote_count FROM comment WHERE id = :comment_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':comment_id', $comment_id);
        $stmt->execute();
        $vote_count = $stmt->fetchColumn();
        
        echo json_encode(['success' => true, 'vote_count' => $vote_count]);
    } else {
        echo json_encode(['success' => false, 'message' => 'An error occurred.']);
    }
}
?>
