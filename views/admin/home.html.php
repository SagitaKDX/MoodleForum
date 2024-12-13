<h1>Admin Panel</h1>
<div>
    <h2>List of Users</h2>
    <table id="users-list">
        <tr>
            <td ><b>Admin</b></td>
            <td ><b>First name</b></td>
            <td ><b>Last name</b></td>
            <td ><b>Email</b></td>
            <td ><b>New password</b></td>            
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <form id="user-<?=$user['id']?>" action="" method="POST" onsubmit="sendUserForm(event, 'user-<?=$user['id']?>')">
                    <input type="hidden" name="id" value="<?=$user['id']?>">
                    <input type="hidden" name="firstname" value="<?=htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8')?>">
                    <input type="hidden" name="lastname" value="<?=htmlspecialchars($user['lastname'], ENT_QUOTES, 'UTF-8')?>">

                    <td>
                        <label>
                            <input type="checkbox" name="is_admin" id="checkbox-<?=$user['id']?>" value="1">
                            <span class="checkable"></span>
                        </label>                        
                    </td>
                    <td ><?=htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8')?></td>
                    <td ><?=htmlspecialchars($user['lastname'], ENT_QUOTES, 'UTF-8')?></td>
                    <td ><input type="email" name="email" id="" value="<?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?>" size="30" required></td>
                    <td ><input type="password" name="new-password" minlength="8"></td>
                    <td ><input type="submit" value="Save" name="submit"></td>
                    <td >   
                        <input type="submit" value="Delete" name="submit" class="delete-btn">
                    </td>
                </form>  
                
                <script>
                    // Display if the user is an admin
                    document.getElementById('checkbox-<?=$user['id']?>').checked = <?=$user['is_admin']?>
                </script>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div>
    <h2>List of Modules</h2>
    <table id="modules-list">
        <tr>
            <td ><b>Name</b></td>
            <td ><b>Teacher</b></td>          
        </tr>
        <?php foreach ($modules as $module): ?>
            <tr>
                <form id="module-<?=$module['id']?>" action="" method="POST" onsubmit="sendModuleForm(event, 'module-<?=$module['id']?>')">
                    <input type="hidden" name="id" value="<?=$module['id']?>">

                    <td ><input type="text" name="name" id="" value="<?=htmlspecialchars($module['name'], ENT_QUOTES, 'UTF-8')?>" required></td>
                    <td ><input type="text" name="teacher" id="" value="<?=htmlspecialchars($module['teacher'], ENT_QUOTES, 'UTF-8')?>" required></td>
                    <td ><input type="submit" value="Save" name="submit"></td>
                    <td ><input type="submit" value="Delete" name="submit" class="delete-btn"></td>
                </form>            
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<script>
    function sendUserForm(e, formId) {
        // e.preventDefault()
        form = document.getElementById(formId)

        // Get the submit button that was clicked
        const clickedButton = e.submitter;
        // Access the value of the clicked submit button
        const buttonValue = clickedButton.value; // Save or Delete

        // Determine the new action URL based on the button value
        if (buttonValue === "Save") {
            form.action = "edituser.php"; // Change the action for "Save"
        } else if (buttonValue === "Delete") {
            form.action = "deleteuser.php"; // Change the action for "Delete"
        }

        // Now, you can submit the form with the updated action URL
        form.submit()
    }

    function sendModuleForm(e, formId) {
        // e.preventDefault()
        form = document.getElementById(formId)

        // Get the submit button that was clicked
        const clickedButton = e.submitter;
        // Access the value of the clicked submit button
        const buttonValue = clickedButton.value; // Save or Delete

        // Determine the new action URL based on the button value
        if (buttonValue === "Save") {
            form.action = "editmodule.php"; // Change the action for "Save"
        } else if (buttonValue === "Delete") {
            form.action = "deletemodule.php"; // Change the action for "Delete"
        }

        // Now, you can submit the form with the updated action URL
        form.submit()
    }
</script>

<style>
    .delete-btn {
        background-color: #dc3545;
        color: white;
        border: 1px solid #dc3545;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .delete-btn:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
</style>