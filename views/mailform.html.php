<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What can we help you?</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            font-size: 18px;
        }

        .container {
            width: 100%;
            max-width: 700px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
            font-size: 32px;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 18px;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fafafa;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 14px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>What can we help you?</h1>

    <div class="container">
        <form action="" method="POST">
            <input type="hidden" name="email_from" value="<?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?>">
            
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" required>
            </div>

            <div class="form-group">
                <label for="content">Message</label>
                <textarea name="content" required></textarea>
            </div>

            <input type="submit" value="Send email">
        </form>
    </div>

</body>
</html>
