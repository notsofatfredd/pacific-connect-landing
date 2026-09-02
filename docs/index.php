<?php
declare(strict_types=1);

$page = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'index.html');
if ($page === false) {
    http_response_code(500);
    exit('Pacific Connect is temporarily unavailable.');
}

// The cPanel version upgrades the existing email CTAs to the captured form.
// GitHub Pages continues to serve index.html as the static placeholder.
$page = str_replace('mailto:Info@pacificconnect.co.za', 'contact.php', $page);
header('Content-Type: text/html; charset=UTF-8');
echo $page;
