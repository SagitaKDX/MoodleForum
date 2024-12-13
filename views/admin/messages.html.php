<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            font-size: 18px;  /* Increased base font size */
        }

        h1 {
            text-align: center;
            margin: 40px 0;  /* Increased margin */
            font-size: 32px;  /* Larger heading size */
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;  /* Increased container width */
            margin: 30px auto;  /* Increased margin */
            background-color: white;
            padding: 25px 20px;  /* More padding */
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);  /* Slightly larger shadow */
        }

        .message {
            display: block;
            color: inherit;
            text-decoration: none;
            padding: 20px 15px;  /* More padding */
            border-bottom: 2px solid #eee;  /* Thicker border */
            transition: background-color 0.3s, transform 0.3s;
            font-size: 20px;  /* Larger font size for message content */
        }

        .message:hover {
            background-color: #f1f1f1;
            transform: scale(1.05);  /* Slightly more scale on hover */
        }

        .message h3 {
            font-size: 22px;  /* Larger title font */
            margin-bottom: 12px;  /* Increased margin */
            color: #007bff;
        }

        .message p {
            font-size: 16px;  /* Larger font size for message preview */
            color: #555;
        }

        .small-details {
            font-size: 14px;  /* Slightly larger small details */
            color: #888;
        }

        /* Focus effect for clickable message */
        .message:focus {
            outline: none;
            border: 3px solid #007bff;  /* Thicker border on focus */
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .message:focus h3 {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Contact Us Messages</h1>

    <?php foreach ($messages as $message): ?>
        <div class="container">
            <a class="message" href="message.php?id=<?=$message['id']?>" tabindex="0">
                <div id='<?=$message['id']?>'>
                    <h3><?=htmlspecialchars($message['subject'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p>
                        From: <?=htmlspecialchars($message['email_from'], ENT_QUOTES, 'UTF-8') ?>
                        -
                        <span class="small-details">
                            <span class="creation-time"></span>
                        </span>
                    </p>
                </div>
            </a>
        </div>

        <script>
            // Parse the timestamp in the Vietnam timezone
            var formattedTime = moment("<?=$message['createdAt']?>").utc().fromNow();
            var creationTimeBoxes = document.getElementsByClassName('creation-time');
            creationTimeBoxes[creationTimeBoxes.length - 1].innerText = formattedTime;
        </script>    
    <?php endforeach; ?>

</body>
</html>
