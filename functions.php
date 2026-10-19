<?php
require_once __DIR__ . '/config.php';
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function logged_in(): bool { return isset($_SESSION['user']); }
function require_login(): void { if (!logged_in()) { header('Location: login.php'); exit; } }
function is_admin(): bool { return logged_in() && ($_SESSION['user']['role'] ?? '') === 'admin'; }
function flash(string $message, string $type = 'success'): void { $_SESSION['flash'] = ['message'=>$message, 'type'=>$type]; }
function show_flash(): void {
    if (!empty($_SESSION['flash'])) { $f=$_SESSION['flash']; echo '<div class="alert '.e($f['type']).'">'.e($f['message']).'</div>'; unset($_SESSION['flash']); }
}
function page_header(string $title): void { ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?=e($title)?> | Lost &amp; Found</title><link rel="stylesheet" href="assets/style.css"></head><body>
<header class="topbar"><a class="brand" href="index.php">Find<span>It</span> <small>Lost &amp; Found</small></a><nav><a href="index.php">Browse</a><?php if(logged_in()): ?><a href="report.php">Report item</a><a href="my_reports.php">My reports</a><?php if(is_admin()): ?><a href="admin.php">Admin</a><?php endif; ?><span class="nav-user">Hi, <?=e($_SESSION['user']['full_name'])?></span><a class="nav-cta" href="logout.php">Log out</a><?php else: ?><a href="login.php">Log in</a><a class="nav-cta" href="register.php">Create account</a><?php endif; ?></nav></header>
<main class="container"><?php show_flash(); ?>
<?php }
function page_footer(): void { ?></main><footer class="footer">Lost &amp; Found System · Help belongings find their way home.</footer></body></html><?php }
