<?php $title = 'Moodle OverFlow' ?>

<h1>Have a nice day, <?=htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8')?>!</h1>
<div class="browse-btns">
    <button id="feed-btn">Feeds</button>
    <button id="module-btn">My Modules</button>
</div>
<div id="browse-content">
    
</div>

<style>
    body {
        background-color: #e6f7ff; /* Light cyan color that complements blue and white */
    }
    .browse-btns {
        margin-top: 20px;
    }
    .browse-btns button {
        background-color: royalblue;
        color: white;
        border: none;
        padding: 10px 20px;
        margin-right: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .browse-btns button:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
</style>

<script type="text/javascript">
    // Switching between the Feeds and the My Modules tabs
    document.getElementById('feed-btn').addEventListener('click', (e) => {
        $('#browse-content').load('../controllers/feeds.php')
    })
    document.getElementById('module-btn').addEventListener('click', (e) => {
        $('#browse-content').load('../controllers/modules.php')
    })
    // Display Feeds when page is first load
    $('#feed-btn').click()
</script>