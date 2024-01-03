<?php
session_start();
require_once './inc/header.php';
require_once './inc/functions.php';
$memberController = new MemberController($controllers->database()); // Assuming $controllers is an instance of your controllers

// Check for the delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    // Retrieve the id of the member to be deleted
    $memberId = $_GET['id'];

    // Call a function to handle the deletion
    $memberController->delete_member($memberId);

    // Redirect back to the admin-members.php page to avoid duplicate form submissions
    header('Location: admin-members.php');
    exit;
}

// Check for the edit action
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    // Retrieve the id of the member to be edited
    $memberId = $_GET['id'];

    // Redirect to the edit page with the member ID
    header("Location: admin-members-edit.php?id=$memberId");
    exit;
}

// Check if the action is 'update'
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    // Process the submitted form data
    $id = intval($_POST['id']);
    $firstname = InputProcessor::processString($_POST['firstname']);
    $lastname = InputProcessor::processString($_POST['lastname']);
    $email = InputProcessor::processString($_POST['email']);
    // Add more fields as needed

    // Validate inputs
    $valid = $firstname['valid'] && $lastname['valid'] && $email['valid']; // Add more validation as needed

    if ($valid) {
        // Update the member
        $memberData = [
            'id' => $id,
            'firstname' => $firstname['value'],
            'lastname' => $lastname['value'],
            'email' => $email['value'],
            // Add more fields as needed
        ];

        $success = $memberController->update_member($memberData);

        if ($success) {
            // Redirect or show success message
            redirect('./admin-members.php');
        } else {
            $message = "Failed to update member. Please try again.";
        }
    } else {
        $message = "Please fix the above errors:";
    }
}

?>

<div class="container mt-4">
    <h2>Admin Dashboard - Member Management</h2>
    
    <a href="admin-members-add.php" class="btn btn-primary mb-3">Add New Member</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <!-- Add more table headers as needed -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $members = $memberController->get_all_members(); // Adjust the method name as needed
            foreach ($members as $member): ?>
                <tr>
                    <td><?= htmlspecialchars($member['firstname']) ?></td>
                    <td><?= htmlspecialchars($member['lastname']) ?></td>
                    <td><?= htmlspecialchars($member['email']) ?></td>
                    <!-- Add more table cells as needed -->
                    <td>
                        <a href="admin-members-edit.php?action=edit&id=<?= $member['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin-members.php?action=delete&id=<?= $member['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?>
