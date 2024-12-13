<?php foreach ($modules as $module): ?>
    <div class="module-container">
        <a class="module-card" href="../controllers/module.php?id=<?=$module['id']?>" >
            <div class="module-content">
                <h3 class="module-title"><?= htmlspecialchars($module['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p class="module-posts"><?=$module['no_posts']?> Post(s) or Question(s)</p>
                <p class="module-teacher">Teacher: <?=htmlspecialchars($module['teacher'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        </a>
    </div>
<?php endforeach; ?>

<style>
    /* Container for each module */
    .module-container {
        margin-bottom: 20px;
        max-width: 300px;
        margin-right: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        overflow: hidden;
    }

    /* Hover effect on module container */
    .module-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Module card styling */
    .module-card {
        display: block;
        text-decoration: none;
        color: inherit;
        padding: 20px;
    }

    .module-content {
        padding: 15px;
    }

    .module-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        transition: color 0.3s ease;
    }

    .module-title:hover {
        color: #007bff;
    }

    .module-posts {
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
    }

    .module-teacher {
        font-size: 14px;
        color: #777;
    }

    /* Ensure responsiveness - adapt the layout for smaller screens */
    @media (max-width: 768px) {
        .module-container {
            max-width: 100%;
            margin-right: 0;
        }
    }
</style>
