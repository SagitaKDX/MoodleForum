<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            font-size: 18px;  /* Increased font size for better readability */
        }

        .container {
            width: 100%;
            max-width: 900px;  /* Increased width for more spacious content */
            margin: 40px auto;  /* More margin at top */
            background-color: white;
            padding: 30px;  /* Increased padding */
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);  /* Larger shadow */
        }

        .message {
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);  /* Soft shadow for message box */
        }

        .message h1 {
            font-size: 28px;  /* Larger heading */
            color: #007bff;
            margin-bottom: 20px;
        }

        #sender {
            display: flex;
            align-items: center;
            margin-bottom: 20px;  /* Increased margin */
            font-size: 18px;  /* Slightly larger font size */
        }

        #sender img {
            border-radius: 50%;
            margin-right: 15px;  /* Increased space between image and text */
        }

        #sender b {
            font-weight: bold;
            color: #333;
        }

        .small-details {
            font-size: 16px;  /* Larger small details */
            color: #888;
        }

        .message-content p {
            font-size: 18px;  /* Larger content font */
            color: #555;
            line-height: 1.8;  /* Increased line height for better readability */
            margin-top: 15px;  /* More space between content and previous section */
        }

        /* Focus effect for interactive elements */
        .message:focus {
            outline: none;
            border: 3px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="message" tabindex="0">
            <h1><?=htmlspecialchars($message['subject'], ENT_QUOTES, 'UTF-8')?></h1>

            <div id="sender">
                <?php 
                    if ($message['sender_avatar'][0] == '.') 
                        $imgUrl = '../' . $message['sender_avatar'];
                    else $imgUrl = $message['sender_avatar'];
                ?>
                <img src="<?=$imgUrl?>" alt="Sender avatar" width="60">  <!-- Slightly larger avatar -->
                <b><?=htmlspecialchars($message['sender_fullname'], ENT_QUOTES, 'UTF-8')?></b> - <?=htmlspecialchars($message['email_from'], ENT_QUOTES, 'UTF-8')?>
                <span class="small-details">
                    <span class="creation-time"></span>
                </span>
            </div>

            <div class="message-content">
                <p><?=htmlspecialchars($message['content'], ENT_QUOTES, 'UTF-8')?></p>
            </div>
        </div>
    </div>

    <script>
        // Parse the timestamp in the Vietnam timezone
        var formattedTime = moment("<?=$message['createdAt']?>").utc().fromNow();
        var creationTimeBoxes = document.getElementsByClassName('creation-time');
        creationTimeBoxes[creationTimeBoxes.length - 1].innerText = formattedTime;
    </script>

</body>
</html>
