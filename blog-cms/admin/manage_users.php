<link rel="stylesheet" href="/blog-cms/assets/css/style.css">
<?php
require_once '../includes/functions.php';
if(!isLoggedIn() || !isAdmin()) redirect('login.php');

// ===== Handle User Deletion =====
if(isset($_GET['delete_id'])){
    $delete_id = intval($_GET['delete_id']);
    if($delete_id != $_SESSION['user_id']){
        $conn->query("DELETE FROM users WHERE id=$delete_id");
        header("Location: manage_users.php");
        exit();
    } else {
        $error = "You cannot delete your own account!";
    }
}

// ===== Handle Role Change =====
if(isset($_POST['change_role'])){
    $user_id = intval($_POST['user_id']);
    $new_role = $_POST['role'] === 'admin' ? 'admin' : 'user';
    $conn->query("UPDATE users SET role='$new_role' WHERE id=$user_id");
    header("Location: manage_users.php");
    exit();
}

// ===== Search =====
$search = '';
if(isset($_GET['q'])) $search = $conn->real_escape_string($_GET['q']);

// ===== Pagination =====
$limit = 5; // users per page
$page  = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page-1)*$limit;

// ===== Fetch Users =====
$where = $search ? "WHERE username LIKE '%$search%' OR email LIKE '%$search%'" : "";
$total_users = $conn->query("SELECT COUNT(*) as total FROM users $where")->fetch_assoc()['total'];
$total_pages = ceil($total_users / $limit);

$result = $conn->query("SELECT * FROM users $where ORDER BY id DESC LIMIT $offset,$limit");
?>

<?php include '../includes/header.php'; ?>
<h2>Manage Users</h2>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<!-- Search Form -->
<form method="get" action="manage_users.php">
    <input type="text" name="q" placeholder="Search by username or email" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php while($user = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td data-label="ID"><?php echo $user['id']; ?></td>
<td data-label="Username"><?php echo $user['username']; ?></td>
<td data-label="Email"><?php echo $user['email']; ?></td>
<td data-label="Role"><?php echo $user['role']; ?></td>
<td data-label="Created At"><?php echo $user['created_at']; ?></td>
<td data-label="Actions">
    <?php if($user['id'] != $_SESSION['user_id']): ?>
        <a href="manage_users.php?delete_id=<?php echo $user['id']; ?>" class="button" onclick="return confirm('Delete this user?');">Delete</a>
    <?php else: ?>-<?php endif; ?>
</td>

        <td>
            <form method="post" style="display:inline;">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <select name="role" onchange="this.form.submit()" <?php echo $user['id']==$_SESSION['user_id'] ? 'disabled' : ''; ?>>
                    <option value="user" <?php if($user['role']=='user') echo 'selected'; ?>>User</option>
                    <option value="admin" <?php if($user['role']=='admin') echo 'selected'; ?>>Admin</option>
                </select>
            </form>
        </td>
        <td><?php echo $user['created_at']; ?></td>
        <td>
            <?php if($user['id'] != $_SESSION['user_id']): ?>
                <a href="manage_users.php?delete_id=<?php echo $user['id']; ?>" onclick="return confirm('Delete this user?');">Delete</a>
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- Pagination -->
<div>
    <?php for($i=1; $i<=$total_pages; $i++): ?>
        <a href="manage_users.php?page=<?php echo $i; ?>&q=<?php echo urlencode($search); ?>" 
           <?php if($i==$page) echo 'style="font-weight:bold;"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<?php include '../includes/footer.php'; ?>
