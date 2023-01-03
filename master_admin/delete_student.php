<?php
include('../includes/database_conn.php');

if(isset($_POST['delete_student'])){
    
        $id = $_POST['delete_student'];
        
        $conn = $pdo->open();
        try{
        $stmt = $conn->prepare("DELETE FROM sls_students WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        
        }catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }

        $pdo->close();
    }
header('location: students.php');
?>