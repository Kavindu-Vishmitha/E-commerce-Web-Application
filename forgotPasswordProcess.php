<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT* FROM `users` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        $code = uniqid();

        Database::iud("UPDATE `users` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '2003kavinduvishmitha@gmail.com';
        $mail->Password = 'yjpklqyrcpcsteui';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('2003kavinduvishmitha@gmail.com', 'Reset Password');
        $mail->addReplyTo('2003kavinduvishmitha@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'X-flax Forgot Password Verification Code ';
        $bodyContent = '
<div style="max-width: 600px; margin: auto; font-family: Arial, sans-serif; padding: 30px 20px; border-radius: 16px; background: #ffffff; border: 1px solid #e3e3e3; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);">

    <div style="text-align: center; margin-bottom: 25px;">
        <h1 style="margin: 0; font-size: 28px; color: #000;">🔐 X-flax Password Reset</h1>
        <p style="color: #555; font-size: 15px; margin-top: 8px;">
            Your security is our priority.
        </p>
    </div>

    <div style="text-align: center;">
        <p style="font-size: 16px; color: #333; line-height: 1.6; margin-bottom: 25px;">
            We received a request to reset your password.<br>Use the verification code below to proceed:
        </p>

        <div style="margin: 0 auto 15px; padding: 20px 35px; background: #fff4ef; color: #f26522; font-size: 28px; font-weight: bold; border-radius: 12px; border: 2px dashed #f26522; letter-spacing: 3px; display: inline-block; user-select: all;">
            ' . $code . '
        </div>

        <p style="font-size: 13px; color: #999; margin-top: 10px;">
            Please copy the code above to continue.
        </p>

        <p style="font-size: 13px; color: #777; margin-top: 25px;">
            If you didn\'t request this, you can safely ignore this email.
        </p>
    </div>

    <div style="margin-top: 40px; text-align: center; font-size: 13px; color: #aaa; border-top: 1px solid #ddd; padding-top: 15px;">
        &copy; ' . date("Y") . ' X-flax. All rights reserved.<br>
        Need help? <a href="mailto:support@xflax.com" style="color: #f26522; text-decoration: none;">support@xflax.com</a>
    </div>
</div>';

        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Varification Code Sending Failed");
        } else {
            echo ("Success");
        }
    } else {
        echo ("Invalid email address");
    }
} else {
    echo ("Please enter your email address first");
}
