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
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $equipments = $equipmentController->get_all_equipments_with_suppliers();
        foreach ($equipments as $equipment): ?>
            <tr>
                <td>
                    <img src="<?= htmlspecialchars($equipment['image']) ?>" 
                        alt="Image of <?= htmlspecialchars($equipment['description']) ?>" 
                        style="width: 100px; height: auto;">
                </td>
                <td><?= htmlspecialchars($equipment['name']) ?></td>
                <td><?= htmlspecialchars($equipment['description']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>