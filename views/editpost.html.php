<h1>Want a change? Let's do it!</h1>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$post['post_id']?>">

    <label for="image">New thumbnail</label>
    <label class="dropimage" aria-label="Upload new thumbnail">
        <input type="file" name="image" id="image" accept="image/*" value="">
    </label>   

    <br>

    <label for="module_id">Module</label>
    <select name="module_id" id="module_id" aria-label="Select module" style="height: 40px; padding: 5px 10px;">
        <?php foreach ($modules as $module): ?>
            <option value="<?=$module['id']?>"><?=htmlspecialchars($module['name'], ENT_QUOTES, 'UTF-8')?></option>
        <?php endforeach; ?>
    </select>

    <br>

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?=htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8')?>" required placeholder="Enter post title">

    <br>

    <label for="content">Content</label>
    <textarea name="content" id="content" cols="30" rows="10" required placeholder="Enter post content"><?=htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')?></textarea>

    <br>
    
    <input type="submit" value="Submit" name="submit" class="submit-btn">
</form>

<script>
    document.querySelector('form select option[value="<?=$post['module_id']?>"]').selected = true;
    document.addEventListener("DOMContentLoaded", function() {
        [].forEach.call(document.querySelectorAll('.dropimage'), function(img){
            img.onchange = function(e){
                var inputfile = this, reader = new FileReader();
                reader.onloadend = function(){
                    inputfile.style['background-image'] = 'url('+reader.result+')';
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
</script>

<style>
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    input[type="text"], textarea, select {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input[type="text"]:focus, textarea:focus, select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .dropimage {
        display: block;
        width: 100%;
        height: 150px;
        border: 2px dashed #ccc;
        border-radius: 4px;
        background-size: cover;
        background-position: center;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }

    .dropimage:hover {
        border-color: #007bff;
    }

    .submit-btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .submit-btn:hover {
        background-color: #45a049;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        form {
            padding: 15px;
        }
    }

    select#module_id {
        height: 40px;
        padding: 5px 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: white;
        cursor: pointer;
    }

    select#module_id:focus {
        outline: none;
        border-color: #007bff;
    }
</style>
