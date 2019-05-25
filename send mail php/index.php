<?php

    // Check if User Coming From A Request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Assign Variables
        $user = filter_var($_POST['username'],  FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['email'],     FILTER_SANITIZE_STRING);
        $cell = filter_var($_POST['cellphone'], FILTER_SANITIZE_STRING);
        $msg  = filter_var($_POST['message'],   FILTER_SANITIZE_STRING);
        
        // Creating Array of Errors
        $formErrors = array();
        if (strlen($user) <= 3) {
            $formErrors[] = 'Username Must Be Larger Than <strong>3</strong> Characters';
        }
        if (strlen($msg) < 1) {
            $formErrors[] = 'Message Can\'t Be Less Than <strong>10</strong> Characters'; 
        }
        
        // If No Errors Send The Email [ mail(To, Subject, Message, Headers, Parameters) ]
        
        $headers = 'From: ' . $cell . "\r\n" ;
        $myEmail = 'info@xezer.net';
        $subject = 'مركز ايزر';
        
        if (empty($formErrors)) {
            
            mail($myEmail, $subject, "عنوان:".$msg . "\r" ."الهاتف:". $mail .  "\r" . "الاسم:".$user. "\r" . "المحافظة:".$cell   , $headers);
            
            $user = '';
            $mail = '';
            $cell = '';
            $msg = '';
            
            $success = '<div class="alert alert-success">تم ارسال المعلومات بنجاح</div>';
            
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ايزر</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/contact.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700,900,900i">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <!-- Start Form -->
        
        <div class="container">
            <h1 class="text-center">اتصل بنا</h1>
            <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <?php if (! empty($formErrors)) { ?>
                <div class="alert alert-danger alert-dismissible" role="start">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php
                        foreach($formErrors as $error) {
                            echo $error . '<br/>';
                        }
                    ?>
                </div>
                <?php } ?>
                <?php if (isset($success)) { echo $success; } ?>
                <div class="form-group">
                    <input 
                           class="username form-control" 
                           type="text" 
                           name="username" 
                           placeholder="الاسم الرباعي واللقب"
                           value="<?php if (isset($user)) { echo $user; } ?>" />
                    <i class="fa fa-user fa-fw"></i>
                    <span class="asterisx">*</span>
                    <div class="alert alert-danger custom-alert">
                        رجاء اكتب الاسم الرباعي واللقب
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">اختار المحافظة</label>
                    <select class="form-control" id="exampleFormControlSelect1"   value="<?php if (isset($cell)) { echo $cell; } ?>"   name="cellphone" >
                    <option>البصرة</option>
                    <option>بغداد</option>
                    </select>
                </div>
                <div class="form-group">
                    <input 
                           class="email form-control" 
                           type="text" 
                           name="email" 
                           placeholder="رقم الهاتف" 
                           value="<?php if (isset($mail)) { echo $mail; } ?>" />
                    <i class="fa fa-envelope fa-fw"></i>
                    <span class="asterisx">*</span>
                    <div class="alert alert-danger custom-alert">
                    رجاء اكتب عنوان السكن
                    </div>
                </div>
            
                <div class="form-group">
                    <textarea 
                          class="message form-control" 
                          name="message"
                          placeholder="عنوان السكن"><?php if (isset($msg)) { echo $msg; } ?></textarea>
                    <span class="asterisx">*</span>
                    <div class="alert alert-danger custom-alert">
                        رجاء اكتب عنوان السكن
                    </div>
                </div>
                <input 
                       class="btn btn-success" 
                       type="submit" 
                       value="ارسال"/>
                <i class="fa fa-send fa-fw send-icon"></i>
            </form>
        </div>
        
        <!-- End Form -->
        
        <script src="js/jquery-1.12.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>