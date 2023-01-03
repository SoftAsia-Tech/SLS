<?php
include('../includes/database_conn.php');

if(isset($_POST['delete_class'])){
    
        $id = $_POST['delete_class'];
        
        $conn = $pdo->open();
        try{
        $stmt = $conn->prepare("DELETE FROM sls_classes WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        
        }catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }

        $pdo->close();
    }
header('location: classes.php');
?>