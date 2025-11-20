  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog CMS</title>
    <link rel="stylesheet" href="/blog-cms/assets/css/style.css">
</head>
<body>
<nav>
    <a href="/blog-cms/index.php">Home</a>
    <a href="/blog-cms/search.php">Search</a>
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="/blog-cms/admin/index.php">Dashboard</a>
        <a href="/blog-cms/logout.php">Logout</a>
    <?php else: ?>
        <a href="/blog-cms/admin/login.php">Admin Login</a>
        <a href="/blog-cms/login.php">User Login</a>
    <?php endif; ?>
</nav>
<hr>
