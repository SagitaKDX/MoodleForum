<h1><?= htmlspecialchars($module['name'], ENT_QUOTES, 'UTF-8') ?></h1>
<p style="text-align: center;">Teacher <?= htmlspecialchars($module['teacher'], ENT_QUOTES, 'UTF-8') ?></p>

<?=$feeds?>

<!-- Back Button -->
<div style="text-align: center; margin-top: 20px;">
    <a href="home.php">
        <button style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;">
            Back to Home
        </button>
    </a>
</div>
