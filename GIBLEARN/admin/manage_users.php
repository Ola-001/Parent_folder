<?php
session_start();
$BASE_URL = "/Parent_folder/GIBLEARN";

// Protect admin route
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: $BASE_URL/login.php");
    exit;
}

require "../includes/db.php";
 // database connection

// Fetch all users
$query = "SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users • GibLearn Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/admin.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/assets/admin_manage_users.css">
</head>
<body>

<!-- ADMIN HEADER -->
        <?php include "../includes/header.php"; ?>

<div class="admin-wrapper">

    <h1 class="manage-title">
        <i class="fa-solid fa-users"></i> Manage Users
    </h1>

    <!-- SEARCH BAR -->
    <div class="manage-search">
        <input type="text" id="searchInput" placeholder="Search users...">
    </div>

    <!-- USERS TABLE -->
    <div class="manage-table-wrapper">
        <table class="manage-table" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= ucfirst($row['role']) ?></td>
                        <td><?= date("M d, Y", strtotime($row['created_at'])) ?></td>

                        <td>
                            <button class="action-btn btn-promote">
                                <i class="fa-solid fa-arrow-up"></i> Promote
                            </button>

                            <button class="action-btn btn-ban">
                                <i class="fa-solid fa-user-slash"></i> Ban
                            </button>

                            <button class="action-btn btn-delete">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
    </div>

</div>

<?php include "../includes/footer.php"; ?>

<script src="<?= $BASE_URL ?>/assets/style.js"></script>

<!-- SEARCH FILTER SCRIPT -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll("#usersTable tbody tr");

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>
<script src="<?= $BASE_URL ?>/assets/style.js"></script>

</body>
</html>
