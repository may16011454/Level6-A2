<?php
$message = '';

require_once './inc/functions.php';
$equipmentController = $controllers->equipment();
$supplierController = $controllers->suppliers();

// Check if the action is 'edit' and an equipment ID is provided
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $equipmentId = intval($_GET['id']);

    // Fetch the equipment details
    $equipmentDetails = $equipmentController->get_equipment_by_id($equipmentId);

    // Check if the equipment exists
    if ($equipmentDetails) {
        // Fetch all suppliers for the dropdown
        $suppliers = $supplierController->get_all_suppliers();

        // Render the edit form
?>
        <div class="container mt-4">
            <h2>Edit Equipment</h2>

            <!-- Display any error messages here -->
            <?php if ($message) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="post" action="admin-equipments.php?action=update">
                <input type="hidden" name="id" value="<?= $equipmentDetails['id'] ?>">

                <form method="post" action="admin-equipments.php?action=update">
                    <input type="hidden" name="id" value="<?= $equipmentDetails['id'] ?>">

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($equipmentDetails['name']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($equipmentDetails['description']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image URL:</label>
                        <input type="text" class="form-control" id="image" name="image" value="<?= htmlspecialchars($equipmentDetails['image']) ?>">
                    </div>

                    <!-- Supplier Selection Dropdown -->
                    <div class="form-group">
                        <label for="supplier">Supplier:</label>
                        <select class="form-control" id="supplier" name="supplier_id">
                            <?php foreach ($suppliers as $supplier) : ?>
                                <option value="<?= htmlspecialchars($supplier['id']) ?>" <?= ($equipmentDetails['supplier_id'] == $supplier['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($supplier['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Equipment</button>
                </form>
        </div>
<?php
        exit();
    } else {
        // Redirect to the equipment list with an error message
        redirect('./admin-equipments.php?error=Equipment not found.');
    }
}
?>