<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ótica vision</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link   rel="stylesheet" 
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" 
                integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" 
                crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php

if(session_status()=== PHP_SESSION_NONE){
    session_start();
}

function redirect ($page, $time=1500){
  echo"
  <script>
        setTimeout(() => window.location.href ='$page', $time);
    </script>";
}
 function actionMessage($success = "", $error = ""){
  if(!empty($success)){
    echo"<div class='alert alert-success' role='alert'></strong>$success</div>";
  }   
  if(!empty($error)){
    echo"<div class='alert alert-danger' role='alert'></strong>$error</div>";
  }
 }

 function showValidationError($errors=[]){
  if(!empty($errors)){
    echo "<strong>Erros nos campos:</strong>";
    foreach ($errors as $error){
      echo $error;
    }
    echo "</ul></div>";
  }
 }

function getFormValue($data,$field=''){
  return isset($data->$field) ? $data->$field: '';
}
?>



  <body>
    <div class="container">
        <div class="row">


  </body>

