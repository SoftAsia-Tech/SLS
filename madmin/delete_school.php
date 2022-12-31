<?php
include('../includes/database_conn.php');

if(isset($_POST['delete_school'])){
    
        $id = $_POST['delete_school'];
        
        $conn = $pdo->open();
        try{
        $stmt = $conn->prepare("DELETE FROM sls_users WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        
        }catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }

        $pdo->close();
    }
header('location: schools.php');
?>