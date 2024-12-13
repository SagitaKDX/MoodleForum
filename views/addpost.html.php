<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sharing and Questioning</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-top: 20px;
            padding: 10px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 16px;
            color: #444;
        }

        .dropimage {
            border: 2px dashed #007bff;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dropimage:hover {
            background-color: #f0f8ff;
        }

        .dropimage input[type="file"] {
            display: none;
        }

        .dropimage span {
            color: #007bff;
            font-size: 16px;
        }

        .select {
            padding: 12px;
            font-size: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%; /* Ensures the select box fills the container */
            height: 90%; /* Ensures the select box is tall enough to display all options */
            box-sizing: border-box; /* Includes padding and border in the total width */
            overflow: hidden; /* Prevents text from overflowing */
        }

        .select option {
            font-size: 16px; /* Keeps the option text at a readable size */
            white-space: nowrap; /* Prevents text from wrapping */
            text-overflow: ellipsis; /* Adds ellipsis for overflowed text */
        }

        .select:focus {
            border-color: #007bff;
        }
        .input, .textarea {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s ease;
            width: 100%; /* Ensure the select box fits within the container */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .textarea {
            resize: vertical; /* Allow vertical resizing */
        }

        .input:focus, .textarea:focus {
            border-color: #007bff;
        }

        .button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .form {
                gap: 15px;
            }

            h1 {
                font-size: 24px;
            }
        }

    </style>
</head>
<body>

    <h1>Sharing and questioning are keys to success. Keep going!</h1>

    <div class="container">

        <form action="" method="post" enctype="multipart/form-data" class="form">
            <!-- Thumbnail -->
            <div>
                <label for="image">Thumbnail</label>
                <label class="dropimage">
                    <input type="file" name="image" id="image" accept="image/*" required>
                    <span>Click or drag image here</span>
                </label>
            </div>

            <!-- Module -->
            <div>
                <label for="module_id">Module</label>
                <select name="module_id" class="select" required style="font-size: 16px;">
                    <?php foreach ($modules as $module): ?>
                        <option value="<?=$module['id']?>"><?=htmlspecialchars($module['name'], ENT_QUOTES, 'UTF-8')?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Title -->
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" class="input" required>
            </div>

            <!-- Content -->
            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="textarea" required></textarea>
            </div>

            <!-- Submit -->
            <input type="submit" value="Submit" name="submit" class="button">
        </form>

    </div>

    <script>
        // Image upload UI processing
        document.addEventListener("DOMContentLoaded", function() {
            [].forEach.call(document.querySelectorAll('.dropimage'), function(img){
                img.onchange = function(e){
                    var inputfile = this, reader = new FileReader();
                    reader.onloadend = function(){
                        inputfile.style['background-image'] = 'url('+reader.result+')';
                        inputfile.querySelector('span').style.display = 'none';
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        });
    </script>

</body>
</html>
