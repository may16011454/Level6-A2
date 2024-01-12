<?php
session_start();
require_once './inc/header.php';
require_once './inc/functions.php';
$equipmentController = $controllers->equipment();

// Check for the delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $equipmentId = $_GET['id'];

    $equipmentController->delete_equipment($equipmentId);

    header('Location: admin-equipments.php');
    exit;
}

// Check if the action is 'update'
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    // Process the submitted form data
    $id = intval($_POST['id']);
    $name = InputProcessor::processString($_POST['name']);
    $description = InputProcessor::processString($_POST['description']);
    $image = InputProcessor::processString($_POST['image']);
    $supplier_id = intval($_POST['supplier_id']);
    $category_id = intval($_POST['category_id']); 

    // Validate inputs
    $valid = $name['valid'] && $description['valid'] && $image['valid'];

    if ($valid) {
        // Update the equipment
        $equipmentData = [
            'id' => $id,
            'name' => $name['value'],
            'description' => $description['value'],
            'image' => $image['value'],
            'supplier_id' => $supplier_id,
            'category_id' => $category_id, 
        ];

        $success = $equipmentController->update_equipment($equipmentData);

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
    <h2>Admin Dashboard - Inventory</h2>
    <a href="admin-equipments-add.php" class="btn btn-primary mb-3">Add New Product</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Equipment Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $equipments = $equipmentController->get_all_equipments_with_categories();
            foreach ($equipments as $equipment) : ?>
                <tr>
                    <td><?= htmlspecialchars($equipment['name']) ?></td>
                    <td><?= htmlspecialchars($equipment['description']) ?></td>
                    <td><img src="<?= htmlspecialchars($equipment['image']) ?>" alt="<?= htmlspecialchars($equipment['name']) ?>" style="max-width: 100px;"></td>
                    <td><?= htmlspecialchars($equipment['category_name'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($equipment['supplier_name'] ?? 'N/A') ?></td>
                    <td>
                        <a href="admin-equipments-edit.php?action=edit&id=<?= $equipment['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin-equipments.php?action=delete&id=<?= $equipment['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


</div>

<?php require __DIR__ . "/inc/footer.php"; ?>