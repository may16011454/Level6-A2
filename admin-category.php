<?php
session_start();
require_once './inc/header.php';
require_once './inc/functions.php';

// Retrieve the CategoryController instance
$categoryController = $controllers->categories();

// Check for the delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    // Retrieve the id of the category to be deleted
    $categoryId = $_GET['id'];

    // Call a function to handle the deletion
    $categoryController->delete_category($categoryId);

    // Redirect back to the admin-categories.php page to avoid duplicate form submissions
    header('Location: admin-category.php');
    exit;
}

// Check for the edit action
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    // Retrieve the id of the category to be edited
    $categoryId = $_GET['id'];

    // Redirect to the edit page with the category ID
    header("Location: admin-category-edit.php?id=$categoryId");
    exit;
}

// Check if the action is 'update'
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    // Process the submitted form data
    $id = intval($_POST['id']);
    $name = InputProcessor::processString($_POST['name']);

    // Validate inputs
    $valid = $name['valid'];

    if ($valid) {
        // Update the category
        $categoryData = [
            'id' => $id,
            'name' => $name['value'],
        ];

        $success = $categoryController->update_category($categoryData);

        if ($success) {
            // Redirect or show success message
            redirect('./admin-category.php');
        } else {
            $message = "Failed to update category. Please try again.";
        }
    } else {
        $message = "Please fix the above errors:";
    }
}

?>

<div class="container mt-4">
    <h2>Admin Dashboard - Manage Categories</h2>

    <a href="admin-category-add.php" class="btn btn-primary mb-3">Add New Categories</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categories = $categoryController->get_all_categories();
            foreach ($categories as $category) : ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($category['name']) ?>
                    </td>
                    <td>
                        <a href="admin-category-edit.php?action=edit&id=<?= $category['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin-category.php?action=delete&id=<?= $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?>
