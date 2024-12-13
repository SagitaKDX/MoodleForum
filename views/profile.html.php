<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            color: #333;
            margin: 10px 0;
        }

        h1 {
            font-size: 28px;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-img {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #007bff;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
            color: #444;
        }

        input, textarea {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #007bff;
        }

        input[readonly] {
            background-color: #f9f9f9;
            cursor: not-allowed;
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

        .dropimage:before {
            content: "Click or drag an image here to upload";
            color: #007bff;
            font-size: 16px;
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

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <h1>Here you are, <?=htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8')?>!</h1>
    <h2>You wanna change your profile? Fill in the form and click 'Save'</h2>

    <div class="container">
        <img class="profile-img" src="<?=$user['avatar']?>" alt="User avatar">

        <form id="edit-profile-form" action="editprofile.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?=$user['id']?>">

            <!-- Avatar -->
            <label for="image">New avatar</label>
            <label class="dropimage">
                <input type="file" name="image" accept="image/*">
            </label>

            <!-- First Name -->
            <label for="firstname">First name:</label>
            <input type="text" name="firstname" value="<?=htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8')?>" required>

            <!-- Last Name -->
            <label for="lastname">Last name:</label>
            <input type="text" name="lastname" value="<?=htmlspecialchars($user['lastname'], ENT_QUOTES, 'UTF-8')?>" required>

            <!-- Email -->
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?>" readonly>

            <!-- Passwords -->
            <label for="old-password">Old password:</label>
            <input type="password" name="old-password">

            <label for="new-password">New password:</label>
            <input type="password" name="new-password">

            <label for="new-password-confirm">Confirm new password:</label>
            <input type="password" name="new-password-confirm">

            <!-- Submit -->
            <input type="submit" value="Submit" class="button">
        </form>
    </div>

    <script>
        document.getElementById('edit-profile-form').addEventListener('submit', (e) => {
            const newPassword = document.querySelector("input[name='new-password']");
            const newPasswordConfirm = document.querySelector("input[name='new-password-confirm']");

            if (newPassword.value !== newPasswordConfirm.value) {
                alert('Your new password is not identical with the confirmation');
                e.preventDefault(); // Stop submitting the form
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const dropImages = document.querySelectorAll('.dropimage input[type="file"]');
            dropImages.forEach((input) => {
                input.addEventListener('change', (e) => {
                    const reader = new FileReader();
                    reader.onload = () => {
                        input.parentElement.style['background-image'] = `url(${reader.result})`;
                    };
                    reader.readAsDataURL(e.target.files[0]);
                });
            });
        });
    </script>
</body>
</html>
