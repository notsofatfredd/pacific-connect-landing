<?php
declare(strict_types=1);

$recipient = 'Info@pacificconnect.co.za';
$fromDomain = $_SERVER['HTTP_HOST'] ?? 'pacificconnect.co.za';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

function respond(string $title, string $message, int $status = 200): never {
    http_response_code($status);
    $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
    echo "<!doctype html><html lang=\"en\"><head><meta charset=\"utf-8\"><meta name=\"viewport\" content=\"width=device-width,initial-scale=1\"><title>{$safeTitle} | Pacific Connect</title><style>body{margin:0;background:#081c3a;color:#fff;font:16px Arial,sans-serif;display:grid;place-items:center;min-height:100vh;padding:24px}.box{max-width:560px}.eyebrow{color:#ff5960;font-size:11px;font-weight:900;letter-spacing:.16em}.box h1{font:400 56px Georgia,serif;line-height:.95}.box p{color:#c7d2e1;line-height:1.6}.box a{display:inline-block;margin-top:18px;padding:16px 20px;background:#e51b23;color:#fff;text-decoration:none;font-weight:900;font-size:12px}</style></head><body><main class=\"box\"><p class=\"eyebrow\">PACIFIC CONNECT / PRIVATE INTAKE</p><h1>{$safeTitle}</h1><p>{$safeMessage}</p><a href=\"index.html\">Return to Pacific Connect</a></main></body></html>";
    exit;
}

if ($method !== 'POST') {
    echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Start an enquiry | Pacific Connect</title><style>body{margin:0;background:#081c3a;color:#fff;font:16px Arial,sans-serif;padding:32px}.box{max-width:620px;margin:0 auto}.eyebrow{color:#ff5960;font-size:11px;font-weight:900;letter-spacing:.16em}.box h1{font:400 58px Georgia,serif;line-height:.95}.box p{color:#c7d2e1;line-height:1.6}.lead-form{display:grid;gap:10px}.lead-form label{font-size:10px;font-weight:900;letter-spacing:.08em;text-transform:uppercase;margin-top:10px}.lead-form input,.lead-form textarea{width:100%;padding:14px;border:1px solid #ffffff35;background:#ffffff0d;color:#fff;font:inherit;resize:vertical}.lead-form textarea{min-height:130px}.lead-form button{margin-top:12px;padding:16px;border:0;background:#e51b23;color:#fff;font-weight:900;cursor:pointer}.back{display:inline-block;margin-top:22px;color:#fff}</style></head><body><main class="box"><p class="eyebrow">PACIFIC CONNECT / PRIVATE INTAKE</p><h1>Begin with an email.</h1><p>Tell us the broad outline of your matter. Every matter is assessed individually.</p><form class="lead-form" method="post" action="contact.php"><label for="name">Your name</label><input id="name" name="name" required maxlength="120"><label for="email">Your email address</label><input id="email" name="email" type="email" required><label for="message">How can we help?</label><textarea id="message" name="message" required minlength="10" maxlength="5000"></textarea><label style="display:none" aria-hidden="true">Website<input name="website" tabindex="-1" autocomplete="off"></label><button type="submit">Send enquiry</button></form><a class="back" href="index.html">Return to Pacific Connect</a></main></body></html>';
    exit;
}

if (!empty($_POST['website'] ?? '')) {
    respond('Thank you', 'Your enquiry has been received.', 200);
}

$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

if ($name === '' || mb_strlen($name) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($message) < 10 || mb_strlen($message) > 5000) {
    respond('Please check your details', 'Enter your name, a valid email address, and a short description of your matter.', 422);
}

$cleanName = preg_replace('/[\r\n]+/', ' ', $name) ?? $name;
$cleanEmail = preg_replace('/[\r\n]+/', '', $email) ?? $email;
$cleanMessage = preg_replace('/\r\n|\r|\n/', "\n", $message) ?? $message;
$timestamp = gmdate('c');
$subject = 'New Pacific Connect enquiry';
$body = "A new enquiry was submitted on {$timestamp}.\n\nName: {$cleanName}\nEmail: {$cleanEmail}\n\nMessage:\n{$cleanMessage}\n\nSource: {$fromDomain}\n";
$headers = "From: website@{$fromDomain}\r\nReply-To: {$cleanEmail}\r\nContent-Type: text/plain; charset=UTF-8\r\n";

$mailSent = @mail($recipient, $subject, $body, $headers);

$storageDir = __DIR__ . DIRECTORY_SEPARATOR . 'private-leads';
if (!is_dir($storageDir)) {
    @mkdir($storageDir, 0750, true);
}
$leadFile = $storageDir . DIRECTORY_SEPARATOR . 'leads.csv';
$handle = @fopen($leadFile, 'ab');
if ($handle !== false) {
    if (flock($handle, LOCK_EX)) {
        fputcsv($handle, [$timestamp, $cleanName, $cleanEmail, $cleanMessage, $mailSent ? 'emailed' : 'stored-only']);
        flock($handle, LOCK_UN);
    }
    fclose($handle);
}

if (!$mailSent && !file_exists($leadFile)) {
    respond('We could not receive that', 'Please email us directly so your enquiry is not lost.', 500);
}

respond('Thank you', 'Your enquiry has been received. Pacific Connect will review the outline and advise on the next step.', 200);
