<?php include('../includes/session.php'); ?>

<?php
if (isset($_SESSION['error'])) {
  echo "
          <div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-warning'></i> Error!</h4>
            " . $_SESSION['error'] . "
          </div>
        ";
  unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
  echo "
          <div class='alert alert-success alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-check'></i> Success!</h4>
            " . $_SESSION['success'] . "
          </div>
        ";
  unset($_SESSION['success']);
}
?>

<?php
if (isset($_POST['submit_answers'])) {
  $quastions_ids = $_POST['submit_answers'];
  $quastions_ids_array = explode(' ', $quastions_ids);
  array_shift($quastions_ids_array);

  // $quesionid = $_POST['questionid'];
  $studentID = $_SESSION['current_student'];
  $current_std_question = $_SESSION['current_std_question'];
  $chapterID = $current_std_question;
  $time = date('d-m-y h:i:s');
  // $studentAnswer = $_POST['answer'];
  // date_default_timezone_set('Pakistan/Islamabad');
  // $time = getdate();
  $conn = $pdo->open();
  $stmt = $conn->prepare("INSERT INTO sls_exams (student_id, chapter_id, exam_time	) VALUES (:student_id, :chapter_id, :exam_time)");
  $stmt->execute(['student_id' => $studentID, 'chapter_id' => $chapterID, 'exam_time'=>$time]);
  $last_id = $conn->lastInsertId();
  // $last_id = $_SESSION['current_examid'];
  // $conn->lastInsertId();
  try {
    foreach ($quastions_ids_array as $quastion_id) {
      $current_ans = 'answer_' . $quastion_id;
      $answer = $_POST[$current_ans];

      $stmt = $conn->prepare("INSERT INTO sls_results (question_id, exam_id, student_answer) VALUES (:question_id, :exam_id, :student_answer)");
      $stmt->execute(['question_id' => $quastion_id, 'exam_id' => $last_id, 'student_answer' => $answer]);
    }
    /*echo '<form action="student_result.php" method="post">
            <a type="submit" value="'.$last_id.'" name="current_examid">Click here to see result</a>
          </form>
    ';*/
  } catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
  }

  $pdo->close();
}

header('location: student_result.php')

?>