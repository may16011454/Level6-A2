<?php
$message = '';

require_once './inc/functions.php';
$categoryController = $controllers->categories();

// Check if the action is 'edit' and a category ID is provided
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $categoryId = intval($_GET['id']);

    // Fetch the category details
    $categoryDetails = $categoryController->get_category_by_id($categoryId);

    // Check if the category exists
    if ($categoryDetails) {
        // Render the edit form
        ?>
        <div class="container mt-4">
            <h2>Edit Category</h2>

            <!-- Display any error messages here -->
            <?php if ($message): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="post" action="admin-category.php?action=update">
                <input type="hidden" name="id" value="<?= $categoryDetails['id'] ?>">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?= htmlspecialchars($categoryDetails['name']) ?>">
                </div>


                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>

        </div>
        <?php
        exit();
    } else {
        redirect('./admin-category.php?error=Category not found.');
    }
}
?>
