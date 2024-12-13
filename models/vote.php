<?php
include '../utils/databaseConnection.php';

// Function to add or update a vote
function addVote($user_id, $post_id, $is_upvote) {
    try {
        // Check if the user has already voted on this post
        $sql = 'SELECT * FROM votes WHERE user_id = :user_id AND post_id = :post_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':post_id', $post_id);
        $stmt->execute();

        $existingVote = $stmt->fetch();

        if ($existingVote) {
            // // If the user has voted already, update the vote type
            // $sql = 'UPDATE votes SET is_upvote = :is_upvote WHERE user_id = :user_id AND post_id = :post_id AND is_deleted = 0';
            // $stmt = $GLOBALS['pdo']->prepare($sql);
            // $stmt->bindValue(':is_upvote', $is_upvote);
            // $stmt->bindValue(':user_id', $user_id);
            // $stmt->bindValue(':post_id', $post_id);
            // $stmt->execute();
            if($existingVote['is_deleted'] == 1){
                $sql = 'UPDATE votes SET is_deleted = 0 WHERE user_id = :user_id AND post_id = :post_id';
                $stmt = $GLOBALS['pdo']->prepare($sql);
                $stmt->bindValue(':user_id', $user_id);
                $stmt->bindValue(':post_id', $post_id);
                $stmt->execute();
            }
            // If the user has voted already, update the vote type
            $sql = 'UPDATE votes SET is_upvote = :is_upvote WHERE user_id = :user_id AND post_id = :post_id AND is_deleted = 0';
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->bindValue(':is_upvote', $is_upvote);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':post_id', $post_id);
            $stmt->execute();

        } else {
            // Otherwise, insert a new vote
            $sql = 'INSERT INTO votes (user_id, post_id, is_upvote, is_deleted) 
                    VALUES (:user_id, :post_id, :is_upvote, 0)';
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':post_id', $post_id);
            $stmt->bindValue(':is_upvote', $is_upvote);
            $stmt->execute();
        }

        // Update the vote count in the post table
        updateVoteCount($post_id);
        return true; // Successfully added/updated the vote
    } catch (Exception $e) {
        // Handle any errors and return false
        return false;
    }
}

// Function to delete a vote (soft delete by marking it as deleted)
function deleteVote($user_id, $post_id) {
    try {
        $sql = 'UPDATE votes SET is_deleted = 1 WHERE user_id = :user_id AND post_id = :post_id AND is_deleted = 0';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':post_id', $post_id);
        $stmt->execute();

        // Update the vote count after deletion
        updateVoteCount($post_id);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Function to update the vote count in the post table
function updateVoteCount($post_id) {
    try {
        $sql = 'SELECT 
                    SUM(CASE WHEN is_upvote = 1 AND is_deleted = 0 THEN 1 ELSE 0 END) AS upvotes,
                    SUM(CASE WHEN is_upvote = 0 AND is_deleted = 0 THEN 1 ELSE 0 END) AS downvotes
                FROM votes WHERE post_id = :post_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':post_id', $post_id);
        $stmt->execute();

        $result = $stmt->fetch();
        
        $upvotes = $result['upvotes'] ?? 0;
        $downvotes = $result['downvotes'] ?? 0;

        // Calculate the net votes
        $netVotes = $upvotes - $downvotes;

        // Update the vote_count column in the post table
        $sql = 'UPDATE post SET vote_count = :vote_count WHERE id = :post_id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':vote_count', $netVotes);
        $stmt->bindValue(':post_id', $post_id);
        $stmt->execute();
    } catch (Exception $e) {
        // Handle any errors (logging, etc.)
    }
}

// Function to get the current vote type (1 = upvote, 0 = downvote, 2 = no vote)
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

// Handling AJAX requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        session_start(); // Ensure session is started to use user_id
        if (!isset($_SESSION['user'])) {
            throw new Exception("User not logged in");
        }

        $user_id = $_SESSION['user']['id'];
        $post_id = $_POST['post_id'];
        $is_upvote = $_POST['is_upvote'] == '1' ? 1 : 0;
        
        // Check current vote type (if any)
        $voteType = getVoteType($user_id, $post_id);

        // If the user has already voted, delete their vote
        if ($voteType != 2) {
            deleteVote($user_id, $post_id);
        }

        // Add the new vote (upvote/downvote)
        if (addVote($user_id, $post_id, $is_upvote)) {
            // Get the updated vote count
            updateVoteCount($post_id);

            // Return the updated vote count and success message
            $sql = 'SELECT vote_count FROM post WHERE id = :post_id';
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->bindValue(':post_id', $post_id);
            $stmt->execute();

            $post = $stmt->fetch();
            echo json_encode(['success' => true, 'message' => 'Vote registered successfully', 'vote_count' => $post['vote_count']]);
            // echo json_encode([
            //     'success' => true,
            //     'message' => 'Vote registered successfully',
            //     'vote_count' => $newVoteCount,
            //     'user_vote' => $newUserVote
            // ]);
            exit;
            
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to register vote']);
        }
    } catch (Exception $e) {
        // Return error message if something goes wrong
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    // Return error if request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}


?>
