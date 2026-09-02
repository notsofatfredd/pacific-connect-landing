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
$tag = '<style>.axiel-credit-row{display:flex;justify-content:flex-end;margin-top:20px;padding-top:14px;border-top:1px solid rgba(255,255,255,.12)}.axiel-credit{display:inline-flex;align-items:center;gap:10px;color:rgba(255,255,255,.58);text-decoration:none}.axiel-credit-mark{display:grid;place-items:center;width:28px;height:28px;border:1px solid rgba(255,255,255,.38);border-radius:50%;color:#fff;font-size:9px;font-weight:900;letter-spacing:-.08em}.axiel-credit-copy{display:grid;gap:3px}.axiel-credit-label{color:rgba(255,255,255,.42);font-size:9px;font-weight:650;letter-spacing:.13em;line-height:1;text-transform:uppercase}.axiel-credit-brand{color:#fff;font-size:12px;font-weight:800;letter-spacing:.14em;line-height:1.2}.axiel-credit-brand b{color:rgba(255,255,255,.56);font-size:9px;font-weight:700;letter-spacing:.1em}.axiel-credit:hover .axiel-credit-mark,.axiel-credit:focus-visible .axiel-credit-mark{border-color:#e51b23;color:#ff5960}@media(max-width:600px){.axiel-credit-row{justify-content:flex-start}}</style><div class="axiel-credit-row"><a class="axiel-credit" href="https://axiel.co.za/" target="_blank" rel="noopener noreferrer" aria-label="Website system by Axiel, built on Atlas OS"><span class="axiel-credit-mark" aria-hidden="true">AX</span><span class="axiel-credit-copy"><span class="axiel-credit-label">Website system by</span><span class="axiel-credit-brand">AXIEL <b>/ ATLAS OS</b></span></span></a></div>';
$page = str_replace('</section></main>', '</section>' . $tag . '</main>', $page);
header('Content-Type: text/html; charset=UTF-8');
echo $page;
