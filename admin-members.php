<?php
session_start();
require_once './inc/header.php';
require_once './inc/functions.php';
$memberController = $controllers->members();

// Check for the delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['ID'])) {
    // Retrieve the id of the equipment to be deleted
    $memberId = $_GET['ID'];

    // Call a function to handle the deletion
    $memberController->delete_member($memberId);

    // Redirect back to the admin-equipments.php page to avoid duplicate form submissions
    header('Location: admin-members.php');
    exit;
}

// Check for the edit action
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['ID'])) {
    // Retrieve the id of the equipment to be edited
    $memberId = $_GET['ID'];

    // Redirect to the edit page with the equipment ID
    header("Location: admin-members.php?id=$memberId");
    exit;
}

// Check if the action is 'update'
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    // Process the submitted form data
    $id = intval($_POST['ID']);
    $firstname = InputProcessor::processString($_POST['firstname']);
    $email = InputProcessor::processString($_POST['email']);

    // Validate inputs
    $valid = $name['valid'] && $description['valid'] && $image['valid'];

    if ($valid) {
        // Update the equipment
        $memberData = [
            'ID' => $id,
            'firstname' => $name['value'],
            'email' => $description['value'],
        ];

        $success = $memberController->update_member($memberData);

        if ($success) {
            // Redirect or show success message
            redirect('./admin-equipments.php');
        } else {
            $message = "Failed to update equipment. Please try again.";
        }
    } else {
        $message = "Please fix the above errors:";
    }
}

?>

<div class="container mt-4">
    <h2>Admin Dashboard - Manage Users</h2>
    
    <a href="admin-equipments-add.php" class="btn btn-primary mb-3">Add New users</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $member = $memberController->get_all_members();
            foreach ($member as $member): ?>
                <tr>
                    <td><?= htmlspecialchars($member['firstname']) ?></td>
                    <td><?= htmlspecialchars($member['lastname']) ?></td>
                    <td><?= htmlspecialchars($member['email']) ?></td>
                    <td>
                        <a href="admin-equipments-edit.php?action=edit&id=<?= $member['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin-equipments.php?action=delete&id=<?= $member['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?>
