<?php
include('../includes/database_conn.php');

if(isset($_POST['delete_teacher'])){
    
        $id = $_POST['delete_teacher'];
        
        $conn = $pdo->open();
        try{
        $stmt = $conn->prepare("DELETE FROM sls_teachers WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        
        }catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }

        $pdo->close();
    }
header('location: teachers.php');
?>