<?php

class equipmentController
{

    protected $db; // Property to store the database controller object

    // Constructor to initialize the equipmentController with a database controller object
    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    // Function to create a new equipment entry in the database
    public function create_equipment(array $equipment_data)
    {
        // SQL query to insert equipment data into the equipments table
        $sql = "INSERT INTO equipments (name, description, image, supplier_id) VALUES (:name, :description, :image, :supplier_id)";

        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':name', $equipment_data['name']);
            $stmt->bindParam(':description', $equipment_data['description']);
            $stmt->bindParam(':image', $equipment_data['image']);
            $stmt->bindParam(':supplier_id', $equipment_data['supplier_id']);

            // Execute the statement
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle any exceptions
            // You might want to log the error for debugging
            // For simplicity, rethrowing the exception here
            throw $e;
        }
    }

    // Function to retrieve a specific equipment by its ID
    public function get_equipment_by_id(int $id)
    {
        // SQL query to select equipment data by ID
        $sql = "SELECT * FROM equipments WHERE id = :id";
        $args = ['id' => $id];

        // Execute the query and return the result
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Function to retrieve all equipment entries from the database
    public function get_all_equipments()
    {
        // SQL query to select all equipment data
        $sql = "SELECT * FROM equipments";

        // Execute the query and return all results
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Function to update an existing equipment entry in the database
    public function update_equipment(array $equipment)
    {
        // SQL query to update equipment data in the equipments table
        $sql = "UPDATE equipments SET name = :name, description = :description, image = :image, supplier_id = :supplier_id WHERE id = :id";

        // Execute the SQL query with the provided equipment data
        return $this->db->runSQL($sql, $equipment)->execute();
    }


    // Function to delete a specific equipment entry by its ID
    public function delete_equipment(int $id)
    {
        // SQL query to delete equipment data by ID
        $sql = "DELETE FROM equipments WHERE id = :id";
        $args = ['id' => $id];

        // Execute the delete query
        return $this->db->runSQL($sql, $args)->execute();
    }

    public function get_all_equipments_with_suppliers()
    {
        $sql = "SELECT e.*, s.name as supplier_name
            FROM equipments e
            LEFT JOIN suppliers s ON e.supplier_id = s.id";
        return $this->db->runSQL($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
