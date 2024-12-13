
<?php
    session_start();
    include '../utils/checkUserLogin.php';
    // Include PHPMailer classes
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $title = 'Contact Us';
    if (isset($_POST['content'])) {
        // POST method
        try {
            include '../models/message.php';
            include '../models/user.php';
            addMessage($_POST['email_from'], $_POST['subject'], $_POST['content']);
            $admins = getAllAdmins();
            require '../vendor/autoload.php';

            foreach ($admins as $admin) {
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'moodleforum1412@gmail.com';
                    $mail->Password = 'slcq iosr jbcz nrvv';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('moodleforum1412@gmail.com', 'Moodle Forum');
                    $mail->addAddress($admin['email'], $admin['firstname'] . ' ' . $admin['lastname']);

                    $mail->isHTML(true);
                    $mail->Subject = 'New Contact Message';
                    $mail->Body    = "You have received a new message from {$_POST['email_from']}<br><br>Subject: {$_POST['subject']}<br>Message: {$_POST['content']}";
                    $mail->AltBody = "You have received a new message from {$_POST['email_from']}\n\nSubject: {$_POST['subject']}\nMessage: {$_POST['content']}";

                    $mail->send();
                } catch (Exception $e) {
                    $error = "Mailer Error: {$mail->ErrorInfo}";
                }
            }
            $output = '<p style="text-align: center;">Thank you for your message we will get back to you shortly</p>';
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    } 
    else {
        // GET method
        ob_start();
        include '../views/mailform.html.php';
        $output = ob_get_clean();
    }

    include '../views/layout.html.php';
?>