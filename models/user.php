<?php
    include '../utils/databaseConnection.php';

    function getAllUsers() {
        $sql = 'SELECT * FROM user WHERE is_deleted = False';
        return $GLOBALS['pdo']->query($sql);
    }

    function getUser($email) {
        $sql = 'SELECT * FROM user WHERE email = :email AND is_deleted = False';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    function updateUser($id, $isAdmin=null, $firstname, $lastname, $email, $newPassword=null, $avatar=null, $activationCode=null) {
        $sql = 'UPDATE user SET
                is_admin = CASE WHEN :is_admin IS NOT NULL THEN :is_admin ELSE is_admin END,
                firstname = :firstname,
                lastname = :lastname,
                email = :email,
                password = CASE WHEN :password IS NOT NULL THEN :password ELSE password END,
                avatar = CASE WHEN :avatar IS NOT NULL THEN :avatar ELSE avatar END,
                activation_code = :activation_code,
                activate_status = FALSE
                WHERE id = :id AND is_deleted = False';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':is_admin', $isAdmin);
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $newPassword);
        $stmt->bindValue(':avatar', $avatar);
        $stmt->bindValue(':activation_code', $activationCode);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    function createUser($isAdmin, $firstname, $lastname, $email, $password, $activationCode) {
        $sql = 'INSERT INTO user (is_admin, firstname, lastname, email, password, activation_code, activate_status)
                VALUES (:is_admin, :firstname, :lastname, :email, :password, :activation_code, FALSE)';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':is_admin', $isAdmin);
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':activation_code', $activationCode);
        $stmt->execute();
    }

    function activateUser($email, $activationCode) {
        $sql = 'UPDATE user SET activate_status = TRUE WHERE email = :email AND activation_code = :activation_code';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':activation_code', $activationCode);
        $stmt->execute();
    }

    function deleteUser($id) {
        $sql = 'UPDATE user SET
                is_deleted = True
                WHERE id = :id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
    
    
    function updateUserPassword($email, $newPassword) {
        $sql = 'UPDATE user SET password = :password, activation_code = NULL WHERE email = :email AND is_deleted = False';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':password', $newPassword);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }

    function updateUserActivationCode($email, $newActivationCode) {
        $sql = 'UPDATE user SET activation_code = :activation_code WHERE email = :email AND is_deleted = False';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':activation_code', $newActivationCode);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }
    function getAllAdmins() {
        $sql = 'SELECT * FROM user WHERE is_admin = True AND is_deleted = False';
        return $GLOBALS['pdo']->query($sql);
    }
?>