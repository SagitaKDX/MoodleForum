<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
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
            max-width: 900px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            color: #007bff;
            margin-bottom: 20px;
        }

        .small-details {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .small-details b {
            font-weight: bold;
            color: #333;
        }

        .picnic {
            max-width: 100%;
            border-radius: 8px;
            margin: 20px 0;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            margin-top: 20px;
        }

        .creation-time-post {
            font-size: 14px;
            color: grey;
            font-style: italic;
        }

        /* For mobile responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }

            .container {
                padding: 20px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><?=htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8')?></h1>

        <p class="small-details">
            <b>Module:</b> <?=htmlspecialchars($post['module_name'], ENT_QUOTES, 'UTF-8')?>
            <br>
            <b><?=htmlspecialchars($post['author_fullname'], ENT_QUOTES, 'UTF-8')?></b>
            <span class="creation-time-post"></span>
        </p>

        <img class="picnic" src="<?=$post['image']?>" alt="Thumbnail">

        <p><?=htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')?></p>

        <?=$commentSection?>
    </div>

    <script>
        // Parse the timestamp in the Vietnam timezone
        var formattedTime = moment("<?=$post['createdAt']?>").utc().fromNow();
        document.getElementsByClassName('creation-time-post')[0].innerText = '-- ' + formattedTime;
    </script>

</body>
</html>
