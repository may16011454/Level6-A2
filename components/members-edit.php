<?php
$message = '';

require_once './inc/functions.php';
$memberController = $controllers->members();
$roles = $memberController->get_all_roles();


// Check if the action is 'edit' and a member ID is provided
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['ID'])) {
    $memberId = intval($_GET['ID']);

    // Fetch the member details
    $memberDetails = $memberController->get_member_by_id($memberId);

    // Check if the member exists
    if ($memberDetails) {
        // Render the edit form
        ?>
        <div class="container mt-4">
            <h2>Edit User</h2>

            <!-- Display any error messages here -->
            <?php if ($message): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="post" action="admin-members.php?action=update">
                <input type="hidden" name="ID" value="<?= $memberDetails['ID'] ?>">

                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                        value="<?= htmlspecialchars($memberDetails['firstname']) ?>">
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname"
                        value="<?= htmlspecialchars($memberDetails['lastname']) ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= htmlspecialchars($memberDetails['email']) ?>">
                </div>
                <!-- Role Selection Dropdown -->
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role_id">
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= htmlspecialchars($role['id']) ?>">
                                <?= htmlspecialchars($role['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
        <?php
        exit(); // Stop further execution to avoid rendering the member list
    } else {
        // Redirect to the member list with an error message
        redirect('./admin-members.php?error=Member not found.');
    }
}
?>