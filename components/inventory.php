<?php
// Include the functions file for necessary functions and classes
require_once './inc/functions.php';

// Retrieve all equipment data using the equipment controller
$equipmentController = $controllers->equipment();

$equipments = $equipmentController->get_all_equipments_with_categories();
?>

<!-- HTML for displaying the equipment inventory -->
<div class="container mt-4">
    <h2>Equipment Inventory</h2>

    <div class="row">
        <?php foreach ($equipments as $equipment) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($equipment['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($equipment['name']) ?>" style="max-height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5> <?= htmlspecialchars($equipment['name']) ?></h5>
                        <p class="card-text">Description: <?= htmlspecialchars($equipment['description']) ?></p>
                        <p class="card-text">Category: <?= htmlspecialchars($equipment['category_name'] ?? 'N/A') ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>