<?php

    /**
     * Include the database connection file
     */
    include '../utils/databaseConnection.php';

    /**
     * Retrieve all modules with the count of non-deleted posts associated with each module
     * 
     * @return PDOStatement The result set of the query
     */
    function getAllModules() {
        $sql = 'SELECT module.*, COUNT(post.id) as no_posts 
                FROM module
                LEFT JOIN post ON module.id = post.module_id AND post.is_deleted = False
                WHERE module.is_deleted = False
                GROUP BY module.id';
        return $GLOBALS['pdo']->query($sql);
    }

    /**
     * Retrieve a specific module by its ID
     * 
     * @param int $id The ID of the module
     * @return array The module data
     */
    function getModule($id) {
        $sql = 'SELECT * FROM module
                WHERE id = :id AND is_deleted = False';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Update a module's name and teacher by its ID
     * 
     * @param int $id The ID of the module
     * @param string $name The new name of the module
     * @param string $teacher The new teacher of the module
     */
    function updateModule($id, $name, $teacher) {
        $sql = 'UPDATE module SET 
                name = :name,
                teacher = :teacher
                WHERE id = :id AND is_deleted = False';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':teacher', $teacher);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    /**
     * Soft delete a module by its ID
     * 
     * @param int $id The ID of the module
     */
    function deleteModule($id) {
        $sql = 'UPDATE module SET 
                is_deleted = True
                WHERE id = :id';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    /**
     * Create a new module with a name and teacher
     * 
     * @param string $name The name of the module
     * @param string $teacher The teacher of the module
     */
    function createModule($name, $teacher) {
        $sql = 'INSERT INTO module SET
            name = :name,
            teacher = :teacher';
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':teacher', $teacher);
        $stmt->execute();
    }
?>
