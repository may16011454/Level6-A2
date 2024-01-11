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

    // Redirect back to the admin-members.php page to avoid duplicate form submissions
    header('Location: admin-members.php');
    exit;
}

// Check for the user action
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['ID'])) {
    // Retrieve the id of the user to be edited
    $memberId = $_GET['ID'];

    // Redirect to the edit page with the user ID
    header("Location: admin-members.php?id=$memberId");
    exit;
}

// Check if the action is 'update'
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    // Process the submitted form data
    $id = intval($_POST['ID']);
    $firstname = InputProcessor::processString($_POST['firstname']);
    $lastname = InputProcessor::processString($_POST['lastname']);
    $email = InputProcessor::processString($_POST['email']);
    $role_id = intval($_POST['role_id']);  

    // Validate inputs
    $valid = $firstname['valid'] && $lastname['valid'] && $email['valid'];

    if ($valid) {
        // Update the user
        $memberData = [
            'id' => $id,
            'firstname' => $firstname['value'],
            'lastname' => $lastname['value'],
            'email' => $email['value'],
            'role_id' => $role_id, 
        ];

        $success = $memberController->update_member($memberData);

        if ($success) {
            // Update the user role in user_roles table
            $memberController->updateUserRole($id, $role_id);

            // Redirect or show success message
            redirect('./admin-members.php');
        } else {
            $message = "Failed to update user. Please try again.";
        }
    } else {
        $message = "Please fix the above errors:";
    }
}




?>

<div class="container mt-4">
    <h2>Admin Dashboard - Manage Users</h2>

    <a href="admin-members-add.php" class="btn btn-primary mb-3">Add New users</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $members = $memberController->get_all_members();
            foreach ($members as $member) : ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($member['firstname']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($member['lastname']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($member['email']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($member['role'] ?? '') ?>
                    </td>
                    <td>
                        <a href="admin-members-edit.php?action=edit&ID=<?= $member['ID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin-members.php?action=delete&ID=<?= $member['ID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?>