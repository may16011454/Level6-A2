<?php
$message = '';

require_once './inc/functions.php';
$equipmentController = $controllers->equipment();

// Check if the action is 'edit' and an equipment ID is provided
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $equipmentId = intval($_GET['id']);

    // Fetch the equipment details
    $equipmentDetails = $equipmentController->get_equipment_by_id($equipmentId);

    // Check if the equipment exists
    if ($equipmentDetails) {
        // Render the edit form
        ?>
        <div class="container mt-4">
            <h2>Edit Equipment</h2>

            <!-- Display any error messages here -->
            <?php if ($message): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="post" action="admin-equipments.php?action=update">
                <input type="hidden" name="id" value="<?= $equipmentDetails['id'] ?>">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?= htmlspecialchars($equipmentDetails['name']) ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description"
                        name="description"><?= htmlspecialchars($equipmentDetails['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image URL:</label>
                    <input type="text" class="form-control" id="image" name="image"
                        value="<?= htmlspecialchars($equipmentDetails['image']) ?>">
                </div>

                <button type="submit" class="btn btn-primary">Update Equipment</button>
            </form>


        </div>
        <?php
        exit(); // Stop further execution to avoid rendering the equipment list
    } else {
        // Redirect to the equipment list with an error message
        redirect('./admin-equipments.php?error=Equipment not found.');
    }
} ?>