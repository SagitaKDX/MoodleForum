<?php
    // Include the database connection file
    include '../utils/databaseConnection.php';

    // Function to add a message to the database
    function addMessage($emailFrom, $subject, $content) {
        // SQL query to insert a new message
        $sql = 'INSERT INTO message SET
            email_from = :email_from,
            subject = :subject,
            content = :content';
        // Prepare the SQL statement
        $stmt = $GLOBALS['pdo']->prepare($sql);
        // Bind the email_from parameter to the provided emailFrom value
        $stmt->bindValue(':email_from', $emailFrom);
        // Bind the subject parameter to the provided subject value
        $stmt->bindValue(':subject', $subject);
        // Bind the content parameter to the provided content value
        $stmt->bindValue(':content', $content);
        // Execute the prepared statement
        $stmt->execute();
    }

    // Function to retrieve all messages from the database
    function getAllMessages() {
        // SQL query to select all messages ordered by creation date in descending order
        $sql = 'SELECT * FROM message
                ORDER BY createdAt DESC';
        // Execute the query and return the result
        return $GLOBALS['pdo']->query($sql);
    }

    // Function to retrieve a specific message by its ID
    function getMessage($id) {
        // SQL query to select a message and join with the user table to get sender details
        $sql = "SELECT message.*, user.avatar AS sender_avatar, CONCAT(user.firstname, ' ', user.lastname) AS sender_fullname
                FROM message
                INNER JOIN user ON message.email_from = user.email
                WHERE message.id = :id";
        // Prepare the SQL statement
        $stmt = $GLOBALS['pdo']->prepare($sql);
        // Bind the id parameter to the provided id value
        $stmt->bindValue(':id', $id);
        // Execute the prepared statement
        $stmt->execute();
        // Fetch and return the result
        return $stmt->fetch();
    }
?>