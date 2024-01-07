<?php

// Class for handling member-related operations
class MemberController
{

    // Protected property to store the database controller instance
    protected $db;

    // Constructor to initialize the MemberController with a DatabaseController instance
    public function __construct(DatabaseController $db)
    {
        // Assign the provided DatabaseController instance to the db property
        $this->db = $db;
    }

    // Method to retrieve a member record by its ID
    public function get_member_by_id(int $id)
    {
        // SQL query to select a member by its ID
        $sql = "SELECT * FROM users WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve a member record by email
    public function get_member_by_email(string $email)
    {
        // SQL query to select a member by email
        $sql = "SELECT * FROM users WHERE email = :email";
        $args = ['email' => $email];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all member records
    public function get_all_members()
    {
        // SQL query to select all members with their roles
        $sql = "SELECT users.ID, users.firstname, users.lastname, users.email, GROUP_CONCAT(roles.name) AS roles
                FROM users
                LEFT JOIN user_roles ON users.ID = user_roles.user_id
                LEFT JOIN roles ON user_roles.role_id = roles.id
                GROUP BY users.ID";

        // Execute the query and return all fetched records
        $result = $this->db->runSQL($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as &$row) {
            $row['role'] = $row['roles'];
            unset($row['roles']);
        }

        return $result;
    }
    // Method to update an existing member record
    public function update_member(array $member)
    {
        // SQL query to update a member's information
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, role_id = :role_id WHERE id = :id";
        // Execute the query with the provided updated data
        return $this->db->runSQL($sql, $member)->execute();
    }

    // Method to delete a member record by its ID
    public function delete_member(int $id)
    {
        try {
            // Delete user roles 
            $deleteUserRoleSql = "DELETE FROM user_roles WHERE user_id = :id";
            $this->db->runSQL($deleteUserRoleSql, ['id' => $id])->execute();

            // delete the user
            $deleteUserSql = "DELETE FROM users WHERE ID = :id";
            $this->db->runSQL($deleteUserSql, ['id' => $id])->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Method to register a new member
    public function register_member(array $member)
    {
        try {
            // Check if a role is provided, otherwise set a default role
            if (!isset($member['role_id'])) {
                // Default role 
                $member['role_id'] = 2; // Set default role_id to User
            }
    
            $sql = "INSERT INTO users(firstname, lastname, email, password, role_id) 
                    VALUES (:firstname, :lastname, :email, :password, :role_id)"; 
    
            $this->db->runSQL($sql, $member);
    
            // Get the ID of the user
            $userId = $this->db->lastInsertId();
    
            // Add the user and role association to the user_roles table
            $this->updateUserRole($userId, $member['role_id']);
    
            return true;
    
        } catch (PDOException $e) {
            // Handle specific error codes
            if ($e->getCode() == 23000) { 
                return false;
            }
            throw $e;
        }
    }

    // Method to validate member login
    public function login_member(string $email, string $password)
    {
        // Retrieve the member by email
        $member = $this->get_member_by_email($email);

        // If member exists, verify the password
        if ($member) {
            $auth = password_verify($password,  $member['password']);
            // Return member data if authentication is successful, otherwise return false
            return $auth ? $member : false;
        }
        return false;
    }


    public function getUserRoles($userId)
    {
        // Retrieve user roles from the database based on the user ID
        $stmt = $this->db->prepare("SELECT roles.name FROM roles INNER JOIN user_roles ON roles.id = user_roles.role_id WHERE user_roles.user_id = :userId");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $roles;
    }

    public function get_all_roles()
    {
        // SQL query to select all roles
        $sql = "SELECT * FROM roles";

        // Execute the query and return all fetched roles
        return $this->db->runSQL($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    // Members controller method to update user role in user_roles table using PDO
    public function updateUserRole($userId, $roleId)
    {
        try {
            // Your PDO connection
            $pdo = new PDO("mysql:host=localhost;dbname=shopa2", "root", "");

            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the user already has a role in the user_roles table
            $stmt = $pdo->prepare("SELECT * FROM user_roles WHERE user_id = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // User already exists in user_roles, update the role
                $updateStmt = $pdo->prepare("UPDATE user_roles SET role_id = :roleId WHERE user_id = :userId");
                $updateStmt->bindParam(':roleId', $roleId, PDO::PARAM_INT);
                $updateStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $updateStmt->execute();
            } else {
                // User doesn't exist in user_roles, insert a new record
                $insertStmt = $pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (:userId, :roleId)");
                $insertStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $insertStmt->bindParam(':roleId', $roleId, PDO::PARAM_INT);
                $insertStmt->execute();
            }
        } catch (PDOException $e) {
            // Handle the exception as needed (e.g., log, display an error message)
            echo "Error updating user role: " . $e->getMessage();
        }
    }
}
