<?php
// Include the functions file for necessary functions and classes
require_once './inc/functions.php';

// Retrieve all equipment data using the equipment controller
$equipmentController = $controllers->equipment();

$equipment = $controllers->equipment()->get_all_equipments();
?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Products</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Category</th>

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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
