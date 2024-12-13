<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="checkbox"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        /* Focus effect for text inputs */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        input[type="checkbox"]:focus + .checkable {
            outline: 2px solid #007bff;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .checkable {
            display: inline-block;
            width: 18px;
            height: 18px;
            background-color: #eee;
            border-radius: 3px;
            margin-left: 10px;
        }

        .checkable:before {
            content: '';
            display: block;
            width: 100%;
            height: 100%;
            background-color: #007bff;
            border-radius: 3px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        input[type="checkbox"]:checked + .checkable:before {
            opacity: 1;
        }

        /* Focus effect for checkbox */
        input[type="checkbox"]:focus + .checkable:before {
            opacity: 0.5;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Create a New User</h1>

        <form action="" method="POST">
            <label for="is_admin">Admin:</label>
            <label>
                <input type="checkbox" name="is_admin">
                <span class="checkable"></span>
            </label>
            
            <label for="firstname">First name:</label>
            <input type="text" name="firstname" required>
            
            <label for="lastname">Last name:</label>
            <input type="text" name="lastname" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" minlength="8" required>
            
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>

</body>
</html>
