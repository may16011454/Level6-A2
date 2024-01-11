<?php
session_start();
require_once './inc/header.php';
require_once './inc/functions.php';

// Retrieve the SupplierController instance
$supplierController = $controllers->suppliers();

// Check for the delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    // Retrieve the id of the supplier to be deleted
    $supplierId = $_GET['id'];

    // Call a function to handle the deletion
    $supplierController->delete_supplier($supplierId);

    // Redirect back to the admin-supplier.php page to avoid duplicate form submissions
    header('Location: admin-suppliers.php');
    exit;
}

// Check for the edit action
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    // Retrieve the id of the supplier to be edited
    $supplierId = $_GET['id'];

    // Redirect to the edit page with the supplier ID
    header("Location: admin-suppliers-edit.php?id=$supplierId");
    exit;
}

// Check if the action is 'update'
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    // Process the submitted form data
    $id = intval($_POST['id']);
    $name = InputProcessor::processString($_POST['name']);
    $contactEmail = InputProcessor::processString($_POST['contact_email']);

    // Validate inputs
    $valid = $name['valid'] && $contactEmail['valid'];

    if ($valid) {
        // Update the supplier
        $supplierData = [
            'id' => $id,
            'name' => $name['value'],
            'contact_email' => $contactEmail['value'],
        ];

        $success = $supplierController->update_supplier($supplierData);

        if ($success) {
            // Redirect or show success message
            redirect('./admin-suppliers.php');
        } else {
            $message = "Failed to update supplier. Please try again.";
        }
    } else {
        $message = "Please fix the above errors:";
    }
}

?>

<div class="container mt-4">
    <h2>Admin Dashboard - Manage Suppliers</h2>

    <a href="admin-suppliers-add.php" class="btn btn-primary mb-3">Add New Suppliers</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Contact Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $suppliers = $supplierController->get_all_suppliers();
            foreach ($suppliers as $supplier) : ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($supplier['name']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($supplier['contact_email']) ?>
                    </td>
                    <td>
                        <a href="admin-suppliers-edit.php?action=edit&id=<?= $supplier['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin-suppliers.php?action=delete&id=<?= $supplier['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this supplier?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php require __DIR__ . "/inc/footer.php"; ?>
