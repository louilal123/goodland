<?php
session_start();
require_once "classes/Main_class.php";
require __DIR__ . "/../vendor/autoload.php";

$mainClass = new Main_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $admin_id = $_POST['admin_id'];
    $phone = $_POST['phone'];

    try {
        $otp = $mainClass->sendSmsOtp($admin_id, $phone); 

    //     $base_url = "d93l2l.api.infobip.com";
    // $api_key = "35273298bb174bb2aea41f0bda642825-08b3a3ab-60cc-46a4-b1a8-3413be5b8686";

        $base_url = "lqmz12.api.infobip.com";
        $api_key = "218288d849c80dc72065ca23ebc855fa-4915e41c-9210-4c9d-8404-c2b89d922418";

        $configuration = new \Infobip\Configuration(host: $base_url, apiKey: $api_key);
        $api = new \Infobip\Api\SmsApi(config: $configuration);

        $destination = new \Infobip\Model\SmsDestination(to: $phone);

        $message = new \Infobip\Model\SmsTextualMessage(
            destinations: [$destination],
            text: "Your OTP code is: $otp. This is valid for 24 hours. Take care. -- GOODLAND.PH Team.",
            from: "" 
        );

        $request = new \Infobip\Model\SmsAdvancedTextualRequest(messages: [$message]);

        // Send SMS
        $api->sendSmsMessage($request);

        // Success response
        $_SESSION['status'] = "OTP sent successfully!";
        $_SESSION['status_icon'] = "success";
        header("Location: verify_sms.php");
        exit;
    } catch (Exception $e) {
        // Log error and show failure response
        error_log("Error sending SMS OTP: " . $e->getMessage());
        $_SESSION['status'] = "Failed to send OTP. Please try again.";
        $_SESSION['status_icon'] = "error";
        header("Location: verify_sms.php");
        exit;
    }
}
