<?php
include('../includes/database_conn.php');

if(isset($_POST['delete_question'])){
    
        $id = $_POST['delete_question'];
        
        $conn = $pdo->open();
        try{
        $stmt = $conn->prepare("DELETE FROM sls_questions WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        
        }catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
        }

        $pdo->close();
    }
header('location: questions.php');
?>