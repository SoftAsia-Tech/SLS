<?php
include('../includes/database_conn.php');

if(isset($_POST['delete_chapter'])){
    
        $id = $_POST['delete_chapter'];
        
        $conn = $pdo->open();
        try{
        $stmt = $conn->prepare("DELETE FROM sls_chapters WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        
        }catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }

        $pdo->close();
    }
header('location: chapters.php');
?>