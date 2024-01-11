<?php

class SupplierController
{
    protected $db;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;
    }

    public function create_supplier(array $supplier_data)
    {
        // SQL query to insert new supplier data into the suppliers table
        $sql = "INSERT INTO suppliers (name, contact_email) VALUES (:name, :contact_email)";
    
        try {
            // Execute the SQL query with the provided supplier data
            $this->db->runSQL($sql, $supplier_data);
    
            // Return the ID of the last inserted supplier
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // Handle specific error codes or log the error
            if ($e->getCode() == 23000) {
                // Unique constraint violation (e.g., duplicate entry)
                return false;
            }
            throw $e; // Re-throw the exception for other cases
        }
    }

    public function get_supplier_by_id(int $supplier_id)
    {
        $sql = "SELECT * FROM suppliers WHERE id = :id";
        $args = ['id' => $supplier_id];
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_all_suppliers()
    {
        $sql = "SELECT * FROM suppliers";
        return $this->db->runSQL($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_supplier(array $supplier_data)
    {
        $sql = "UPDATE suppliers SET name = :name, contact_email = :contact_email WHERE id = :id";
        return $this->db->runSQL($sql, $supplier_data)->execute();
    }

    public function delete_supplier(int $supplier_id)
    {
        $sql = "DELETE FROM suppliers WHERE id = :id";
        $args = ['id' => $supplier_id];
        return $this->db->runSQL($sql, $args)->execute();
    }
}
