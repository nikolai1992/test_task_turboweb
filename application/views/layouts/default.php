<?php
//@session_start();
//$LangArray = array("ru", "en");
//$DefaultLang = "ru";
//if(@$_SESSION['NowLang']) {
//    if(!in_array($_SESSION['NowLang'], $LangArray)) {
//        $_SESSION['NowLang'] = $DefaultLang;
//    }
//}
//else {
//    $_SESSION['NowLang'] = $DefaultLang;
//}
//$language = addslashes($_GET['lang']);
//if($language) {
//    if(!in_array($language, $LangArray)) {
//        $_SESSION['NowLang'] = $DefaultLang;
//    }
//    else {
//        $_SESSION['NowLang'] = $language;
//    }
//}
//$CurentLang = addslashes($_SESSION['NowLang']);
//include_once ("lang/lang.".$CurentLang.".php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/public/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/public/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/public/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/public/img/favicon/apple-touch-icon-114x114.png">
    <!--Stylesheets-->
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div class="wrapper">

<?php require 'application/views/_partials/_header.php'; ?>
            <?php echo $content; ?>
    <?php require 'application/views/_partials/_footer.php'; ?>


            <!--Scripts-->
    </div>
</body>
</html>
