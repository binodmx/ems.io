<?php
    include_once "../classes/student.php";
    include_once "../classes/module.php";
    session_start();
    $student = $_SESSION['user'];
    include_once "../dbconnect.php";
    
    $semester = $student->getSemester();
    $moduleids = $_POST["id"];
    $modules = array();
    
    foreach ($moduleids as $moduleid){
        array_push($modules, $moduleid);
    }

    $student->register($semester, $modules);
    $id = $student->getID();
    $val = serialize($student);
    $sql = "UPDATE students SET val='$val' WHERE id='$id'";
    $_SESSION['user'] = $student;
    if($conn->query($sql)===TRUE){header("Location:profile.php?msg=registersuccessful");}
?>