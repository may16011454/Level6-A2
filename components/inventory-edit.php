<?php
$message = '';

require_once './inc/functions.php';
$equipmentController = $controllers->equipment();
$supplierController = $controllers->suppliers();
$categoryController = $controllers->categories(); // Add category controller

// Check if the action is 'edit' and an equipment ID is provided
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $equipmentId = intval($_GET['id']);

    // Fetch the equipment details
    $equipmentDetails = $equipmentController->get_equipment_by_id($equipmentId);

    // Check if the equipment exists
    if ($equipmentDetails) {
        // Fetch all suppliers for the dropdown
        $suppliers = $supplierController->get_all_suppliers();

        // Fetch all categories for the dropdown
        $categories = $categoryController->get_all_categories();

        // Check if the form is submitted via POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the submitted form data
            $equipmentData = [
                'id' => $equipmentDetails['id'],
                'name' => InputProcessor::processString($_POST['name'])['value'],
                'description' => InputProcessor::processString($_POST['description'])['value'],
                'image' => InputProcessor::processString($_POST['image'])['value'],
                'supplier_id' => intval($_POST['supplier_id']),
                'category_id' => intval($_POST['category_id']),
            ];

            // Validate the data if needed

            // Update the equipment
            $success = $equipmentController->update_equipment($equipmentData);

            if ($success) {
                // Redirect to the equipment list or show a success message
                redirect('./admin-equipments.php');
            } else {
                // Set error message if updating equipment fails
                $message = "Failed to update equipment. Please try again.";
            }
        }

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

            <form method="post" action="admin-equipments-edit.php?action=edit&id=<?= $equipmentDetails['id'] ?>">
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

                <!-- Category Selection Dropdown -->
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category_id">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= htmlspecialchars($category['id']) ?>" <?= ($equipmentDetails['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
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
