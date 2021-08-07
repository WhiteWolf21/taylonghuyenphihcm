<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $servername = "localhost";
  $username = "taylongh_user";
  $password = "taylongh_pwd";
  $dbname = "taylongh_db";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    if ($message === '')
      $message = 'null';
    $state = 'null';
    if (isset($_POST['state']))
      $state = $_POST['state'];
    $district = 'null';
    if (isset($_POST['district']))
      $district = $_POST['district'];
    $ward = 'null';
    if (isset($_POST['ward']))
      $ward = $_POST['ward'];
    $sql = "INSERT INTO customer_order (name, phone, address, message, state, district, ward)
    VALUES ('$name', '$phone', '$address', '$message', '$state', '$district', '$ward')";
    // use exec() because no results are returned
    $conn->exec($sql);
    // echo "New record created successfully";

  } catch(PDOException $e) {
    // echo $sql . "<br>" . $e->getMessage();
  }

  /////
  //EMAIL

  require '../Exception.php';
  require '../PHPMailer.php';
  require '../SMTP.php';

  $mail = new PHPMailer;
  $mail->CharSet = "UTF-8";
  $mail->isSMTP(); 
  $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
  $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
  $mail->Port = 587; // TLS only
  $mail->SMTPSecure = 'tls'; // ssl is depracated
  $mail->SMTPAuth = true;
  $smtpUsername = "your-gmail";
  $mail->Username = $smtpUsername;
  $smtpPassword = "your-password";
  $mail->Password = $smtpPassword;
  $emailFrom = "your-gmail";
  $emailFromName = mb_convert_encoding( "Kem tẩy lông Huyền Phi", "UTF-8", "UTF-8" );
  $mail->setFrom($emailFrom, $emailFromName);
  $emailTo = "phamhamy389@gmail.com";
  $emailToName = mb_convert_encoding("Admin", "UTF-8", "UTF-8");
  $mail->addAddress($emailTo, $emailToName);
  $mail->Subject = mb_convert_encoding($name . ' đã đặt hàng', "UTF-8", "UTF-8");
  $mail->msgHTML("Họ Tên: " . $name . "<br>Số Điện Thoại: " . $phone . "<br>Địa Chỉ: " . $address . "<br>Ghi Chú: " . $message . "<br>Tỉnh/Thành: " . $state . "<br>Quận/Huyện: " . $district . "<br>Phường/Xã: " . $ward); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
  $mail->AltBody = 'HTML messaging not supported';
  // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

  if(!$mail->send()){
      echo "Mailer Error: " . $mail->ErrorInfo;
  }else{
      echo "Message sent!";
  }

  ////
  
  $conn = null;

  header('Location: ' . 'order.php?name=' . $name . '&phone=' . $phone );
  exit;

}
?>
<!DOCTYPE html>
<!-- saved from url=(0030)https://taylong.myphamviet.co/ -->
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Kem tẩy lông Huyền Phi</title>
  <meta http-equiv="Cache-Control" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="keywords" content="">
  <meta name="description" content="Là một sản phẩm cao cấp của thương hiệu mỹ phẩm huyền phi. Được áp dụng công nghệ sản xuất hiện đại giúp tăng cường hoạt tính của các thảo dược và quy trình kiểm soát chât lượng ngặt nghèo mang lại sự hài lòng nhất cho quý khách.">
  <script type="text/javascript" async="" src="./index_files/config.js"></script>
  <script type="text/javascript" async="" src="./index_files/sdk.js"></script>
  <script src="./index_files/638139886819707.js" async=""></script>
  <script async="" src="./index_files/fbevents.js"></script>
  <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '934627287383401');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=934627287383401&ev=PageView&noscript=1"
    /></noscript>
  <!-- End Facebook Pixel Code -->
  <script id="script_viewport" type="text/javascript">
    window.ladi_viewport = function() {
      var width = window.outerWidth > 0 ? window.outerWidth : window.screen.width;
      var widthDevice = width;
      var is_desktop = width >= 768;
      var content = "";
      if (typeof window.ladi_is_desktop == "undefined" || window.ladi_is_desktop == undefined) {
        window.ladi_is_desktop = is_desktop;
      }
      if (!is_desktop) {
        widthDevice = 420;
      } else {
        widthDevice = 960;
      }
      content = "width=" + widthDevice + ", user-scalable=no";
      var scale = 1;
      if (!is_desktop && widthDevice != window.screen.width && window.screen.width > 0) {
        scale = window.screen.width / widthDevice;
      }
      if (scale != 1) {
        content += ", initial-scale=" + scale + ", minimum-scale=" + scale + ", maximum-scale=" + scale;
      }
      var docViewport = document.getElementById("viewport");
      if (!docViewport) {
        docViewport = document.createElement("meta");
        docViewport.setAttribute("id", "viewport");
        docViewport.setAttribute("name", "viewport");
        document.head.appendChild(docViewport);
      }
      docViewport.setAttribute("content", content);
    };
    window.ladi_viewport();
  </script>
  <meta id="viewport" name="viewport" content="width=960, user-scalable=no">
  <link rel="canonical" href="https://taylong.myphamviet.co/">
  <meta property="og:url" content="https://taylong.myphamviet.co">
  <meta property="og:title" content="Kem tẩy lông Huyền Phi">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://static.ladipage.net/5c7226c2c417ab07e5193eb0/_p4s2232-20200517012205.jpg">
  <meta property="og:description" content="Là một sản phẩm cao cấp của thương hiệu mỹ phẩm huyền phi. Được áp dụng công nghệ sản xuất hiện đại giúp tăng cường hoạt tính của các thảo dược và quy trình kiểm soát chât lượng ngặt nghèo mang lại sự hài lòng nhất cho quý khách.">
  <meta name="format-detection" content="telephone=no">
  <link rel="shortcut icon" type="image/png" href="https://static.ladipage.net/5c7226c2c417ab07e5193eb0/_p4s1834-20200517012204.jpg">
  <link rel="dns-prefetch">
  <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin="">
  <link rel="preconnect" href="https://w.ladicdn.com/" crossorigin="">
  <link rel="preconnect" href="https://s.ladicdn.com/" crossorigin="">
  <link rel="preconnect" href="https://api.forms.ladipage.com/" crossorigin="">
  <link rel="preconnect" href="https://la.ladipage.com/" crossorigin="">
  <link rel="preconnect" href="https://api.ladisales.com/" crossorigin="">
  <link rel="stylesheet" href="./index_files/css.css" as="style" onload="this.onload = null;this.rel = &#39;stylesheet&#39;;">
  <link rel="preload" href="./index_files/ladipage.min.js" as="script">
  <link rel="stylesheet" href="./index_files/custom.css" as="style">
  <style id="style_ladi" type="text/css">
    a,
    abbr,
    acronym,
    address,
    applet,
    article,
    aside,
    audio,
    b,
    big,
    blockquote,
    body,
    button,
    canvas,
    caption,
    center,
    cite,
    code,
    dd,
    del,
    details,
    dfn,
    div,
    dl,
    dt,
    em,
    embed,
    fieldset,
    figcaption,
    figure,
    footer,
    form,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    header,
    hgroup,
    html,
    i,
    iframe,
    img,
    input,
    ins,
    kbd,
    label,
    legend,
    li,
    mark,
    menu,
    nav,
    object,
    ol,
    output,
    p,
    pre,
    q,
    ruby,
    s,
    samp,
    section,
    select,
    small,
    span,
    strike,
    strong,
    sub,
    summary,
    sup,
    table,
    tbody,
    td,
    textarea,
    tfoot,
    th,
    thead,
    time,
    tr,
    tt,
    u,
    ul,
    var,
    video {
      margin: 0;
      padding: 0;
      border: 0;
      outline: 0;
      font-size: 100%;
      font: inherit;
      vertical-align: baseline;
      box-sizing: border-box;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale
    }

    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
      display: block
    }

    body {
      line-height: 1
    }

    a {
      text-decoration: none
    }

    ol,
    ul {
      list-style: none
    }

    blockquote,
    q {
      quotes: none
    }

    blockquote:after,
    blockquote:before,
    q:after,
    q:before {
      content: '';
      content: none
    }

    table {
      border-collapse: collapse;
      border-spacing: 0
    }

    body {
      font-size: 12px;
      -ms-text-size-adjust: none;
      -moz-text-size-adjust: none;
      -o-text-size-adjust: none;
      -webkit-text-size-adjust: none;
      background: #fff
    }

    .overflow-hidden {
      overflow: hidden
    }

    .ladi-transition {
      transition: all 150ms linear 0s
    }

    .opacity-0 {
      opacity: 0
    }

    .pointer-events-none {
      pointer-events: none
    }

    .ladipage-message {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 1000000000;
      background: rgba(0, 0, 0, .3)
    }

    .ladipage-message .ladipage-message-box {
      width: 400px;
      max-width: calc(100% - 50px);
      height: 160px;
      border: 1px solid rgba(0, 0, 0, .3);
      background-color: #fff;
      position: fixed;
      top: calc(50% - 155px);
      left: 0;
      right: 0;
      margin: auto;
      border-radius: 10px
    }

    .ladipage-message .ladipage-message-box h1 {
      background-color: rgba(6, 21, 40, .05);
      color: #000;
      padding: 12px 15px;
      font-weight: 600;
      font-size: 16px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px
    }

    .ladipage-message .ladipage-message-box .ladipage-message-text {
      font-size: 14px;
      padding: 0 20px;
      margin-top: 10px;
      line-height: 18px;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box
    }

    .ladipage-message .ladipage-message-box .ladipage-message-close {
      display: block;
      position: absolute;
      right: 15px;
      bottom: 10px;
      margin: 0 auto;
      padding: 10px 0;
      border: none;
      width: 80px;
      text-transform: uppercase;
      text-align: center;
      color: #000;
      background-color: #e6e6e6;
      border-radius: 5px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer
    }

    .ladi-wraper {
      width: 100%;
      height: 100%;
      overflow: hidden;
      background: #fff
    }

    .ladi-section {
      margin: 0 auto;
      position: relative
    }

    .ladi-section .ladi-section-arrow-down {
      position: absolute;
      width: 36px;
      height: 30px;
      bottom: 0;
      right: 0;
      left: 0;
      margin: auto;
      background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, .2) no-repeat;
      background-position: 4px;
      cursor: pointer;
      z-index: 90000040
    }

    .ladi-section.ladi-section-readmore {
      transition: height 350ms linear 0s
    }

    .ladi-section .ladi-section-background {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      pointer-events: none;
      overflow: hidden
    }

    .ladi-container {
      position: relative;
      margin: 0 auto;
      height: 100%
    }

    .ladi-element {
      position: absolute
    }

    .ladi-overlay {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      pointer-events: none
    }

    .ladi-carousel {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden
    }

    .ladi-carousel .ladi-carousel-content {
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      transition: left 350ms ease-in-out
    }

    .ladi-carousel .ladi-carousel-arrow {
      position: absolute;
      width: 30px;
      height: 36px;
      top: calc(50% - 18px);
      background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, .2) no-repeat;
      cursor: pointer;
      z-index: 90000040
    }

    .ladi-carousel .ladi-carousel-arrow-left {
      left: 5px;
      background-position: -28px
    }

    .ladi-carousel .ladi-carousel-arrow-right {
      right: 5px;
      background-position: -52px
    }

    .ladi-gallery {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-gallery .ladi-gallery-view {
      position: absolute;
      overflow: hidden
    }

    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item {
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      width: 100%;
      height: 100%;
      position: relative;
      display: none;
      transition: transform 350ms ease-in-out;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      -webkit-perspective: 1000px;
      perspective: 1000px
    }

    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.play-video {
      cursor: pointer
    }

    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.play-video:after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
      width: 60px;
      height: 60px;
      background: url(https://w.ladicdn.com/source/ladipage-play.svg) no-repeat center center;
      background-size: contain;
      pointer-events: none;
      cursor: pointer
    }

    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.next,
    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.selected.right {
      left: 0;
      transform: translate3d(100%, 0, 0)
    }

    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.prev,
    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.selected.left {
      left: 0;
      transform: translate3d(-100%, 0, 0)
    }

    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.next.left,
    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.prev.right,
    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item.selected {
      left: 0;
      transform: translate3d(0, 0, 0)
    }

    .ladi-gallery .ladi-gallery-view>.next,
    .ladi-gallery .ladi-gallery-view>.prev,
    .ladi-gallery .ladi-gallery-view>.selected {
      display: block
    }

    .ladi-gallery .ladi-gallery-view>.selected {
      left: 0
    }

    .ladi-gallery .ladi-gallery-view>.next,
    .ladi-gallery .ladi-gallery-view>.prev {
      position: absolute;
      top: 0;
      width: 100%
    }

    .ladi-gallery .ladi-gallery-view>.next {
      left: 100%
    }

    .ladi-gallery .ladi-gallery-view>.prev {
      left: -100%
    }

    .ladi-gallery .ladi-gallery-view>.next.left,
    .ladi-gallery .ladi-gallery-view>.prev.right {
      left: 0
    }

    .ladi-gallery .ladi-gallery-view>.selected.left {
      left: -100%
    }

    .ladi-gallery .ladi-gallery-view>.selected.right {
      left: 100%
    }

    .ladi-gallery .ladi-gallery-control {
      position: absolute;
      overflow: hidden
    }

    .ladi-gallery.ladi-gallery-top .ladi-gallery-view {
      width: 100%
    }

    .ladi-gallery.ladi-gallery-top .ladi-gallery-control {
      top: 0;
      width: 100%
    }

    .ladi-gallery.ladi-gallery-bottom .ladi-gallery-view {
      top: 0;
      width: 100%
    }

    .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control {
      width: 100%;
      bottom: 0
    }

    .ladi-gallery.ladi-gallery-left .ladi-gallery-view {
      height: 100%
    }

    .ladi-gallery.ladi-gallery-left .ladi-gallery-control {
      height: 100%
    }

    .ladi-gallery.ladi-gallery-right .ladi-gallery-view {
      height: 100%
    }

    .ladi-gallery.ladi-gallery-right .ladi-gallery-control {
      height: 100%;
      right: 0
    }

    .ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow {
      position: absolute;
      width: 30px;
      height: 36px;
      top: calc(50% - 18px);
      background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, .2) no-repeat;
      cursor: pointer;
      z-index: 90000040
    }

    .ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow-left {
      left: 5px;
      background-position: -28px
    }

    .ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow-right {
      right: 5px;
      background-position: -52px
    }

    .ladi-gallery .ladi-gallery-control .ladi-gallery-control-arrow {
      position: absolute;
      background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, .2) no-repeat;
      cursor: pointer;
      z-index: 90000040
    }

    .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow,
    .ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow {
      top: calc(50% - 18px);
      width: 30px;
      height: 36px
    }

    .ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow-left {
      left: 0;
      background-position: -28px;
      transform: scale(.6)
    }

    .ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow-right {
      right: 0;
      background-position: -52px;
      transform: scale(.6)
    }

    .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow-left {
      left: 0;
      background-position: -28px;
      transform: scale(.6)
    }

    .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow-right {
      right: 0;
      background-position: -52px;
      transform: scale(.6)
    }

    .ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow,
    .ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow {
      left: calc(50% - 18px);
      width: 36px;
      height: 30px
    }

    .ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow-left {
      top: 0;
      background-position: -77px;
      transform: scale(.6)
    }

    .ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow-right {
      bottom: 0;
      background-position: 3px;
      transform: scale(.6)
    }

    .ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow-left {
      top: 0;
      background-position: -77px;
      transform: scale(.6)
    }

    .ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow-right {
      bottom: 0;
      background-position: 3px;
      transform: scale(.6)
    }

    .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box {
      position: relative
    }

    .ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-box {
      display: inline-flex;
      left: 0;
      transition: left 150ms ease-in-out
    }

    .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-box {
      display: inline-flex;
      left: 0;
      transition: left 150ms ease-in-out
    }

    .ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-box {
      display: inline-grid;
      top: 0;
      transition: top 150ms ease-in-out
    }

    .ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-box {
      display: inline-grid;
      top: 0;
      transition: top 150ms ease-in-out
    }

    .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item {
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      float: left;
      position: relative;
      cursor: pointer;
      filter: invert(15%)
    }

    .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item.play-video:after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
      width: 30px;
      height: 30px;
      background: url(https://w.ladicdn.com/source/ladipage-play.svg) no-repeat center center;
      background-size: contain;
      pointer-events: none;
      cursor: pointer
    }

    .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item:hover {
      filter: none
    }

    .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item.selected {
      filter: none
    }

    .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item:last-child {
      margin-right: 0 !important;
      margin-bottom: 0 !important
    }

    .ladi-box {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden
    }

    .ladi-frame {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden
    }

    .ladi-frame .ladi-frame-background {
      height: 100%;
      width: 100%;
      pointer-events: none
    }

    .ladi-banner {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden
    }

    .ladi-banner .ladi-banner-background {
      height: 100%;
      width: 100%;
      pointer-events: none
    }

    #SECTION_POPUP .ladi-container {
      z-index: 90000070
    }

    #SECTION_POPUP .ladi-container>.ladi-element {
      z-index: 90000070;
      position: fixed;
      display: none
    }

    #SECTION_POPUP .ladi-container>.ladi-element.hide-visibility {
      display: block !important;
      visibility: hidden !important
    }

    #SECTION_POPUP .popup-close {
      width: 30px;
      height: 30px;
      position: absolute;
      right: 0;
      top: 0;
      transform: scale(.8);
      -webkit-transform: scale(.8);
      z-index: 9000000080;
      background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, .2) no-repeat;
      background-position: -108px;
      cursor: pointer;
      display: none
    }

    .ladi-popup {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-popup .ladi-popup-background {
      height: 100%;
      width: 100%;
      pointer-events: none
    }

    .ladi-countdown {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-countdown .ladi-countdown-background {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit;
      display: table;
      pointer-events: none
    }

    .ladi-countdown .ladi-countdown-text {
      position: absolute;
      width: 100%;
      height: 100%;
      text-decoration: inherit;
      display: table;
      pointer-events: none
    }

    .ladi-countdown .ladi-countdown-text span {
      display: table-cell;
      vertical-align: middle
    }

    .ladi-countdown>.ladi-element {
      text-decoration: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit;
      position: relative;
      display: inline-block
    }

    .ladi-countdown>.ladi-element:last-child {
      margin-right: 0 !important
    }

    .ladi-button {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden
    }

    .ladi-button:active {
      transform: translateY(2px)
    }

    .ladi-button .ladi-button-background {
      height: 100%;
      width: 100%;
      pointer-events: none
    }

    .ladi-button>.ladi-element {
      width: 100% !important;
      height: 100% !important;
      top: 0 !important;
      left: 0 !important;
      display: table;
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none
    }

    .ladi-button>.ladi-element .ladi-headline {
      display: table-cell;
      vertical-align: middle
    }

    .ladi-collection {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-collection.carousel {
      overflow: hidden
    }

    .ladi-collection .ladi-collection-content {
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      transition: left 350ms ease-in-out
    }

    .ladi-collection .ladi-collection-content .ladi-collection-item {
      display: block;
      position: relative;
      float: left;
      box-shadow: 0 0 0 1px #fff
    }

    .ladi-collection .ladi-collection-content .ladi-collection-page {
      float: left
    }

    .ladi-collection .ladi-collection-arrow {
      position: absolute;
      width: 30px;
      height: 36px;
      top: calc(50% - 18px);
      background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, .2) no-repeat;
      cursor: pointer;
      z-index: 90000040
    }

    .ladi-collection .ladi-collection-arrow-left {
      left: 5px;
      background-position: -28px
    }

    .ladi-collection .ladi-collection-arrow-right {
      right: 5px;
      background-position: -52px
    }

    .ladi-collection .ladi-collection-button-next {
      position: absolute;
      width: 36px;
      height: 30px;
      bottom: -40px;
      right: 0;
      left: 0;
      margin: auto;
      background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, .2) no-repeat;
      background-position: 4px;
      cursor: pointer;
      z-index: 90000040
    }

    .ladi-form-custom {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-form-custom>.ladi-element {
      text-transform: inherit;
      text-decoration: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit
    }

    .ladi-form-custom .ladi-element[id^=BUTTON_TEXT] {
      color: initial;
      font-size: initial;
      font-weight: initial;
      text-transform: initial;
      text-decoration: initial;
      font-style: initial;
      text-align: initial;
      letter-spacing: initial;
      line-height: initial
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container {
      text-transform: inherit;
      text-decoration: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item {
      text-transform: inherit;
      text-decoration: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item-background {
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-size: 9px 6px !important;
      background-position: right .5rem center;
      background-repeat: no-repeat
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select-3 {
      width: calc(100% / 3 - 5px);
      max-width: calc(100% / 3 - 5px);
      min-width: calc(100% / 3 - 5px)
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select-3:nth-child(3) {
      margin-left: 7.5px
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select-3:nth-child(4) {
      margin-left: 7.5px
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select option {
      color: initial
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control:not(.ladi-form-custom-control-select) {
      text-transform: inherit;
      text-decoration: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select:not([data-selected=""]) {
      text-transform: inherit;
      text-decoration: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select[data-selected=""] {
      text-transform: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-checkbox-item {
      text-transform: inherit;
      text-decoration: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit;
      vertical-align: middle
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-checkbox-item span {
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-checkbox-item span[data-checked=true] {
      text-transform: inherit;
      text-decoration: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit
    }

    .ladi-form-custom>.ladi-element .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-checkbox-item span[data-checked=false] {
      text-transform: inherit;
      text-align: inherit;
      letter-spacing: inherit;
      color: inherit;
      background-size: inherit;
      background-attachment: inherit;
      background-origin: inherit
    }

    .ladi-form-custom .ladi-form-custom-item-container {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-form-custom .ladi-form-custom-item {
      width: 100%;
      height: 100%;
      position: absolute
    }

    .ladi-form-custom .ladi-form-custom-item-background {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      pointer-events: none
    }

    .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox {
      height: auto
    }

    .ladi-form-custom .ladi-form-custom-item .ladi-form-custom-control {
      background-color: transparent;
      min-width: 100%;
      min-height: 100%;
      max-width: 100%;
      max-height: 100%;
      width: 100%;
      height: 100%;
      padding: 0 5px;
      color: inherit;
      font-size: inherit;
      border: none
    }

    .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox {
      padding: 10px 5px
    }

    .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox.ladi-form-custom-checkbox-vertical .ladi-form-custom-checkbox-item {
      margin-top: 0 !important;
      margin-left: 0 !important;
      margin-right: 0 !important;
      display: table;
      border: none
    }

    .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox.ladi-form-custom-checkbox-horizontal .ladi-form-custom-checkbox-item {
      margin-top: 0 !important;
      margin-left: 0 !important;
      margin-right: 10px !important;
      display: inline-block;
      border: none;
      position: relative
    }

    .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox .ladi-form-custom-checkbox-item input {
      vertical-align: middle;
      width: 13px;
      height: 13px;
      display: table-cell;
      margin-right: 5px
    }

    .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox .ladi-form-custom-checkbox-item span {
      display: table-cell;
      cursor: default;
      vertical-align: middle;
      word-break: break-word
    }

    .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox.ladi-form-custom-checkbox-horizontal .ladi-form-custom-checkbox-item input {
      position: absolute;
      top: 4px
    }

    .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox.ladi-form-custom-checkbox-horizontal .ladi-form-custom-checkbox-item span {
      padding-left: 18px
    }

    .ladi-form-custom .ladi-form-custom-item textarea.ladi-form-custom-control {
      resize: none;
      padding: 5px
    }

    .ladi-form-custom .ladi-button {
      cursor: pointer
    }

    .ladi-form-custom .ladi-button .ladi-headline {
      cursor: pointer;
      user-select: none
    }

    .ladi-cart {
      position: absolute;
      width: 100%;
      font-size: 12px
    }

    .ladi-cart .ladi-cart-row {
      position: relative;
      display: inline-table;
      width: 100%
    }

    .ladi-cart .ladi-cart-row:after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      height: 1px;
      width: 100%;
      background: #dcdcdc
    }

    .ladi-cart .ladi-cart-no-product {
      text-align: center;
      font-size: 16px;
      vertical-align: middle
    }

    .ladi-cart .ladi-cart-image {
      width: 16%;
      vertical-align: middle;
      position: relative;
      text-align: center
    }

    .ladi-cart .ladi-cart-image img {
      max-width: 100%
    }

    .ladi-cart .ladi-cart-title {
      vertical-align: middle;
      padding: 0 5px;
      word-break: break-all
    }

    .ladi-cart .ladi-cart-title .ladi-cart-title-name {
      display: block;
      margin-bottom: 5px
    }

    .ladi-cart .ladi-cart-title .ladi-cart-title-variant {
      font-weight: 700;
      display: block
    }

    .ladi-cart .ladi-cart-image .ladi-cart-image-quantity {
      position: absolute;
      top: -3px;
      right: -5px;
      background: rgba(150, 149, 149, .9);
      width: 20px;
      height: 20px;
      border-radius: 50%;
      text-align: center;
      color: #fff;
      line-height: 20px
    }

    .ladi-cart .ladi-cart-quantity {
      width: 70px;
      vertical-align: middle;
      text-align: center
    }

    .ladi-cart .ladi-cart-quantity-content {
      display: inline-flex
    }

    .ladi-cart .ladi-cart-quantity input {
      width: 24px;
      text-align: center;
      height: 22px;
      -moz-appearance: textfield;
      border-top: 1px solid #dcdcdc;
      border-bottom: 1px solid #dcdcdc
    }

    .ladi-cart .ladi-cart-quantity input::-webkit-inner-spin-button,
    .ladi-cart .ladi-cart-quantity input::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0
    }

    .ladi-cart .ladi-cart-quantity button {
      border: 1px solid #dcdcdc;
      cursor: pointer;
      text-align: center;
      width: 21px;
      height: 22px;
      position: relative;
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none
    }

    .ladi-cart .ladi-cart-quantity button:active {
      transform: translateY(2px)
    }

    .ladi-cart .ladi-cart-quantity button span {
      font-size: 18px;
      position: relative;
      left: .5px
    }

    .ladi-cart .ladi-cart-quantity button:first-child span {
      top: -1.2px
    }

    .ladi-cart .ladi-cart-price {
      width: 100px;
      vertical-align: middle;
      text-align: right;
      padding: 0 5px
    }

    .ladi-cart .ladi-cart-action {
      width: 28px;
      vertical-align: middle;
      text-align: center
    }

    .ladi-cart .ladi-cart-action button {
      border: 1px solid #dcdcdc;
      cursor: pointer;
      text-align: center;
      width: 25px;
      height: 22px;
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none
    }

    .ladi-cart .ladi-cart-action button:active {
      transform: translateY(2px)
    }

    .ladi-cart .ladi-cart-action button span {
      font-size: 13px;
      position: relative;
      top: .5px
    }

    .ladi-video {
      position: absolute;
      width: 100%;
      height: 100%;
      cursor: pointer;
      overflow: hidden
    }

    .ladi-video .ladi-video-background {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      pointer-events: none
    }

    .ladi-group {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-checkout {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-shape {
      position: absolute;
      width: 100%;
      height: 100%;
      pointer-events: none
    }

    .ladi-html-code {
      position: absolute;
      width: 100%;
      height: 100%
    }

    .ladi-image {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none
    }

    .ladi-image .ladi-image-background {
      background-repeat: no-repeat;
      background-position: left top;
      background-size: cover;
      background-attachment: scroll;
      background-origin: content-box;
      position: absolute;
      margin: 0 auto;
      width: 100%;
      height: 100%;
      pointer-events: none
    }

    .ladi-headline {
      width: 100%;
      display: inline-block;
      background-size: cover;
      background-position: center center
    }

    .ladi-headline a {
      text-decoration: underline
    }

    .ladi-paragraph {
      width: 100%;
      display: inline-block
    }

    .ladi-paragraph a {
      text-decoration: underline
    }

    .ladi-list-paragraph {
      width: 100%;
      display: inline-block
    }

    .ladi-list-paragraph a {
      text-decoration: underline
    }

    .ladi-list-paragraph ul li {
      position: relative;
      counter-increment: linum
    }

    .ladi-list-paragraph ul li:before {
      position: absolute;
      background-repeat: no-repeat;
      background-size: 100% 100%;
      left: 0
    }

    .ladi-list-paragraph ul li:last-child {
      padding-bottom: 0 !important
    }

    .ladi-line {
      position: relative
    }

    .ladi-line .ladi-line-container {
      border-bottom: 0 !important;
      border-right: 0 !important;
      width: 100%;
      height: 100%
    }

    a[data-action] {
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      cursor: pointer
    }

    a:visited {
      color: inherit
    }

    a:link {
      color: inherit
    }

    [data-opacity="0"] {
      opacity: 0
    }

    [data-hidden=true] {
      display: none
    }

    [data-action=true] {
      cursor: pointer
    }

    .ladi-hidden {
      display: none
    }

    .backdrop-popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 90000060
    }

    .lightbox-screen {
      display: none;
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      margin: auto;
      z-index: 9000000080;
      background: rgba(0, 0, 0, .5)
    }

    .lightbox-screen .lightbox-close {
      width: 30px;
      height: 30px;
      position: absolute;
      z-index: 9000000090;
      background: url(https://w.ladicdn.com/v2/source/ladi-icons.svg) rgba(255, 255, 255, .2) no-repeat;
      background-position: -108px;
      transform: scale(.7);
      -webkit-transform: scale(.7);
      cursor: pointer
    }

    .lightbox-screen .lightbox-hidden {
      display: none
    }

    .ladi-animation-hidden {
      visibility: hidden !important
    }

    .ladi-lazyload {
      background-image: none !important
    }

    .ladi-list-paragraph ul li.ladi-lazyload:before {
      background-image: none !important
    }

    .ladi-element.ladi-auto-scroll {
      overflow-x: scroll;
      overflow-y: hidden;
      width: 100% !important;
      left: 0 !important;
      -webkit-overflow-scrolling: touch
    }

    .ladi-section.ladi-auto-scroll {
      overflow-x: scroll;
      overflow-y: hidden;
      -webkit-overflow-scrolling: touch
    }

    .ladi-carousel .ladi-carousel-content {
      transition: left .3s ease-in-out
    }

    .ladi-gallery .ladi-gallery-view>.ladi-gallery-view-item {
      transition: transform .3s ease-in-out
    }

    .ladi-notify-transition {
      transition: top .5s ease-in-out, bottom .5s ease-in-out, opacity .5s ease-in-out
    }

    .ladi-notify {
      padding: 5px;
      box-shadow: 0 0 1px rgba(64, 64, 64, .3), 0 8px 50px rgba(64, 64, 64, .05);
      border-radius: 40px;
      color: rgba(64, 64, 64, 1);
      background: rgba(250, 250, 250, .9);
      line-height: 1.6;
      width: 100%;
      height: 100%;
      font-size: 13px
    }

    .ladi-notify .ladi-notify-image img {
      float: left;
      margin-right: 13px;
      border-radius: 50%;
      width: 53px;
      height: 53px;
      pointer-events: none
    }

    .ladi-notify .ladi-notify-title {
      font-size: 100%;
      height: 17px;
      overflow: hidden;
      font-weight: 700;
      overflow-wrap: break-word;
      text-overflow: ellipsis;
      white-space: nowrap;
      line-height: 1
    }

    .ladi-notify .ladi-notify-content {
      font-size: 92.308%;
      height: 17px;
      overflow: hidden;
      overflow-wrap: break-word;
      text-overflow: ellipsis;
      white-space: nowrap;
      line-height: 1;
      padding-top: 2px
    }

    .ladi-notify .ladi-notify-time {
      line-height: 1.6;
      font-size: 84.615%;
      display: inline-block;
      overflow-wrap: break-word;
      text-overflow: ellipsis;
      white-space: nowrap;
      max-width: calc(100% - 155px);
      overflow: hidden
    }

    .ladi-notify .ladi-notify-copyright {
      font-size: 76.9231%;
      margin-left: 2px;
      position: relative;
      padding: 0 5px;
      cursor: pointer;
      opacity: .6;
      display: inline-block;
      top: -4px
    }

    .ladi-notify .ladi-notify-copyright svg {
      vertical-align: middle
    }

    .ladi-notify .ladi-notify-copyright svg:not(:root) {
      overflow: hidden
    }

    .ladi-notify .ladi-notify-copyright div {
      text-decoration: none;
      color: rgba(64, 64, 64, 1);
      display: inline
    }

    .ladi-notify .ladi-notify-copyright strong {
      font-weight: 700
    }

    .builder-container .ladi-notify {
      transition: unset
    }

    .ladi-spin-lucky {
      width: 100%;
      height: 100%;
      border-radius: 100%;
      box-shadow: 0 0 7px 0 rgba(64, 64, 64, .6), 0 8px 50px rgba(64, 64, 64, .3);
      background-repeat: no-repeat;
      background-size: cover
    }

    .ladi-spin-lucky .ladi-spin-lucky-start {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
      width: 20%;
      height: 20%;
      cursor: pointer;
      background-size: contain;
      background-position: center center;
      background-repeat: no-repeat;
      transition: transform .3s ease-in-out;
      -webkit-transition: transform .3s ease-in-out
    }

    .ladi-spin-lucky .ladi-spin-lucky-start:hover {
      transform: scale(1.1)
    }

    .ladi-spin-lucky .ladi-spin-lucky-screen {
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
      border-radius: 100%;
      transition: transform 7s cubic-bezier(.25, .1, 0, 1);
      -webkit-transition: transform 7s cubic-bezier(.25, .1, 0, 1);
      text-decoration-line: inherit;
      text-transform: inherit;
      -webkit-text-decoration-line: inherit
    }

    .ladi-spin-lucky .ladi-spin-lucky-label {
      position: absolute;
      top: 50%;
      left: 50%;
      overflow: hidden;
      text-align: center;
      width: 42%;
      padding-left: 12%;
      transform-origin: 0 0;
      -webkit-transform-origin: 0 0;
      text-decoration-line: inherit;
      text-transform: inherit;
      -webkit-text-decoration-line: inherit;
      line-height: 1;
      text-shadow: rgba(0, 0, 0, .5) 1px 0 2px
    }
  </style>
  <style id="style_page" type="text/css">
    .ladi-wraper {
      margin: 0 auto;
      width: 420px;
    }

    body {
      font-family: Roboto, sans-serif
    }
  </style>
  <style id="style_element" type="text/css">
    #SECTION_POPUP {
      height: 0px;
    }

    #SECTION894 {
      height: 1061.3px;
    }

    #SECTION894>.ladi-section-background {
      background-color: rgb(248, 247, 247);
    }

    #POPUP1032 {
      width: 396px;
      height: 486px;
      top: 0px;
      left: 0px;
      bottom: 0px;
      right: 0px;
      margin: auto;
    }

    #POPUP1032>.ladi-popup>.ladi-popup-background {
      background-color: rgb(244, 241, 156);
    }

    #POPUP1032>.ladi-popup {
      border-style: solid;
      border-color: rgb(0, 64, 139);
      border-width: 2px;
    }

    #HEADLINE1044 {
      width: 420px;
      top: 16.731px;
      left: -12px;
    }

    #HEADLINE1044>.ladi-headline {
      font-family: "Arima Madurai", cursive;
      color: rgb(0, 64, 139);
      font-size: 26px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #SECTION1367 {
      height: 1305.02px;
    }

    #SECTION1367>.ladi-section-background {
      background-color: rgb(252, 252, 252);
    }

    #SECTION1412 {
      height: 603.78px;
    }

    #SECTION1412>.ladi-section-background {
      background-size: cover;
      background-attachment: scroll;
      background-origin: content-box;
      background-image: url("https://w.ladicdn.com/s768x603/5c7226c2c417ab07e5193eb0/shutterstock_114891403-20200110221324.jpg");
      background-position: center center;
      background-repeat: no-repeat;
    }

    #VIDEO1415 {
      width: 408.079px;
      height: 491.038px;
      top: 23.4px;
      left: 5.9605px;
    }

    #VIDEO1415>.ladi-video>.ladi-video-background {
      background-size: cover;
      background-attachment: scroll;
      background-origin: content-box;
      background-image: url("https://img.youtube.com/vi/62Dc6Lyf3m4/hqdefault.jpg");
      background-position: center center;
      background-repeat: no-repeat;
    }

    #SHAPE1415 {
      width: 60px;
      height: 60px;
      top: 215.519px;
      left: 174.04px;
    }

    #SHAPE1415 svg:last-child {
      fill: rgba(0, 0, 0, 0.5);
    }

    #SECTION1452 {
      height: 485.54px;
    }

    #SECTION1452>.ladi-section-background {
      background-color: rgb(255, 255, 255);
    }

    #HEADLINE1485 {
      width: 334px;
      top: 64.5px;
      left: 31px;
    }

    #HEADLINE1485>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      text-align: center;
      line-height: 1.6;
    }

    #FORM1486 {
      width: 363px;
      height: 351px;
      top: 101.5px;
      left: 16.5px;
    }

    #FORM1486>.ladi-form-custom {
      color: rgb(0, 0, 0);
      font-size: 12px;
      line-height: 1.6;
    }

    #FORM1486 .ladi-form-custom-item .ladi-form-custom-control::placeholder,
    #FORM1486 .ladi-form-custom .ladi-form-custom-item .ladi-form-custom-control-select[data-selected=""],
    #FORM1486 .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox .ladi-form-custom-checkbox-item span[data-checked="false"] {
      color: #000;
    }

    #FORM1486 .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select {
      background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20%23000%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
    }

    #FORM1486 .ladi-form-custom-item-container {
      border-style: solid;
      border-color: rgb(165, 165, 165);
      border-width: 1px;
    }

    #FORM1486 .ladi-form-custom-item-background {
      background-color: rgb(255, 255, 255);
    }

    #BUTTON1487 {
      width: 281.066px;
      height: 44.2826px;
      top: 306.717px;
      left: 40.967px;
    }

    #BUTTON1487>.ladi-button>.ladi-button-background {
      background-color: rgb(207, 28, 19);
    }

    #BUTTON1487>.ladi-button {
      border-radius: 54px;
    }

    #BUTTON_TEXT1487 {
      width: 271px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT1487>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 16px;
      text-align: center;
      line-height: 1.6;
    }

    #FORM_ITEM1488 {
      width: 363px;
      height: 36.9022px;
      top: 0px;
      left: 0px;
    }

    #FORM_ITEM1492 {
      width: 363px;
      height: 36.9022px;
      top: 47.4457px;
      left: 0px;
    }

    #FORM_ITEM1493 {
      width: 363px;
      height: 36.9022px;
      top: 133.891px;
      left: 0px;
    }

    #FORM_ITEM1494 {
      width: 363px;
      height: 36.9022px;
      top: 178.337px;
      left: 0px;
    }

    #HEADLINE1587 {
      width: 388px;
      top: 98.022px;
      left: 16px;
    }

    #HEADLINE1587>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      text-align: justify;
      line-height: 2;
    }

    #HEADLINE1589 {
      width: 360px;
      top: 300.022px;
      left: 34px;
    }

    #HEADLINE1589>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      font-weight: bold;
      font-style: italic;
      line-height: 2;
    }

    #LIST_PARAGRAPH1590 {
      width: 379px;
      top: 99.78px;
      left: 20.5px;
    }

    #LIST_PARAGRAPH1590>.ladi-list-paragraph {
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.8;
    }

    #LIST_PARAGRAPH1590 ul li {
      padding-bottom: 17px;
      padding-left: 32px;
    }

    #LIST_PARAGRAPH1590 ul li:before {
      content: "";
      background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22100%25%22%20height%3D%22100%25%22%20%20viewBox%3D%220%200%201792%201896.0833%22%20fill%3D%22rgba(0%2C%2063%2C%20139%2C%201)%22%3E%20%3Cpath%20d%3D%22M1671%20566q0%2040-28%2068l-724%20724-136%20136q-28%2028-68%2028t-68-28l-136-136-362-362q-28-28-28-68t28-68l136-136q28-28%2068-28t68%2028l294%20295%20656-657q28-28%2068-28t68%2028l136%20136q28%2028%2028%2068z%22%3E%3C%2Fpath%3E%20%3C%2Fsvg%3E");
      width: 22px;
      height: 22px;
      top: 4px;
    }

    #LIST_PARAGRAPH1592 {
      width: 336px;
      top: 381.022px;
      left: 34px;
    }

    #LIST_PARAGRAPH1592>.ladi-list-paragraph {
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.8;
    }

    #LIST_PARAGRAPH1592 ul li {
      padding-bottom: 11px;
      padding-left: 26px;
    }

    #LIST_PARAGRAPH1592 ul li:before {
      content: "";
      background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22100%25%22%20height%3D%22100%25%22%20%20viewBox%3D%220%200%201792%201896.0833%22%20class%3D%22%22%20fill%3D%22rgba(0%2C%2063%2C%20139%2C%201)%22%3E%20%3Cpath%20d%3D%22M1671%20566q0%2040-28%2068l-724%20724-136%20136q-28%2028-68%2028t-68-28l-136-136-362-362q-28-28-28-68t28-68l136-136q28-28%2068-28t68%2028l294%20295%20656-657q28-28%2068-28t68%2028l136%20136q28%2028%2028%2068z%22%3E%3C%2Fpath%3E%20%3C%2Fsvg%3E");
      width: 20px;
      height: 20px;
      top: 3px;
    }

    #VIDEO1607 {
      width: 417.717px;
      height: 395.556px;
      top: 909.46px;
      left: 1.1415px;
    }

    #VIDEO1607>.ladi-video>.ladi-video-background {
      background-size: cover;
      background-attachment: scroll;
      background-origin: content-box;
      background-image: url("https://w.ladicdn.com/s417x395/5c7226c2c417ab07e5193eb0/_p4s2232-20200517012205.jpg");
      background-position: center center;
      background-repeat: no-repeat;
    }

    #SHAPE1607 {
      width: 60px;
      height: 60px;
      top: 167.778px;
      left: 178.858px;
    }

    #SHAPE1607 svg:last-child {
      fill: rgba(0, 0, 0, 0.5);
    }

    #CAROUSEL1624 {
      width: 414.05px;
      height: 469.397px;
      top: 0px;
      left: 2.975px;
    }

    #IMAGE1625 {
      width: 239.394px;
      height: 468.106px;
      top: 0.9205px;
      left: 1481px;
    }

    #IMAGE1625>.ladi-image>.ladi-image-background {
      width: 239.394px;
      height: 505.346px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x850/5c7226c2c417ab07e5193eb0/f0cc583e4274b92ae065-20200414085717.jpg");
    }

    #IMAGE1627 {
      width: 228.031px;
      height: 469.265px;
      top: -0.44836px;
      left: 3210.2px;
    }

    #IMAGE1627>.ladi-image>.ladi-image-background {
      width: 228.031px;
      height: 469.265px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/96801f89f13d0a63532c-20200414085709.jpg");
    }

    #IMAGE1628 {
      width: 227.278px;
      height: 467.717px;
      top: 1.28114px;
      left: 2208.19px;
    }

    #IMAGE1628>.ladi-image>.ladi-image-background {
      width: 227.278px;
      height: 467.717px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/45f12b3fba8b41d5189a-20200414085709.jpg");
    }

    #IMAGE1629 {
      width: 252.957px;
      height: 470.078px;
      top: -0.44836px;
      left: 2697px;
    }

    #IMAGE1629>.ladi-image>.ladi-image-background {
      width: 252.957px;
      height: 470.078px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s600x800/5c7226c2c417ab07e5193eb0/0b5390487efc85a2dced-20200414085709.jpg");
    }

    #IMAGE1630 {
      width: 227.262px;
      height: 467.682px;
      top: 0.6685px;
      left: 1971px;
    }

    #IMAGE1630>.ladi-image>.ladi-image-background {
      width: 227.262px;
      height: 467.682px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/3c6b5d9747ddbc83e5cc-20200414085709.jpg");
    }

    #IMAGE1631 {
      width: 227.351px;
      height: 467.867px;
      top: 2.01164px;
      left: 2458px;
    }

    #IMAGE1631>.ladi-image>.ladi-image-background {
      width: 227.351px;
      height: 467.867px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/10829d967322887cd133-20200414085709.jpg");
    }

    #IMAGE1632 {
      width: 228.085px;
      height: 469.369px;
      top: -0.44836px;
      left: 2968px;
    }

    #IMAGE1632>.ladi-image>.ladi-image-background {
      width: 228.085px;
      height: 469.369px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/fbc396d47860833eda71-20200414085717.jpg");
    }

    #IMAGE1633 {
      width: 226.847px;
      height: 469.953px;
      top: 0.6685px;
      left: 1245.15px;
    }

    #IMAGE1633>.ladi-image>.ladi-image-background {
      width: 226.847px;
      height: 491.504px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/a34a9ebd84f77fa926e6-20200414085709.jpg");
    }

    #IMAGE1634 {
      width: 219.882px;
      height: 469.04px;
      top: 0px;
      left: 1017.72px;
    }

    #IMAGE1634>.ladi-image>.ladi-image-background {
      width: 219.882px;
      height: 476.412px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/1e05dae24b56b008e947-20200414085709.jpg");
    }

    #IMAGE1635 {
      width: 223.811px;
      height: 460.58px;
      top: -10.0295px;
      left: 1013px;
    }

    #IMAGE1635>.ladi-image>.ladi-image-background {
      width: 223.811px;
      height: 460.58px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/8852fe1162a599fbc0b4-20200414085709.jpg");
    }

    #IMAGE1636 {
      width: 228.058px;
      height: 469.04px;
      top: 0px;
      left: 1731px;
    }

    #IMAGE1636>.ladi-image>.ladi-image-background {
      width: 228.058px;
      height: 494.125px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/929f61717b3b8065d92a-20200414085709.jpg");
    }

    #SECTION1653 {
      height: 560.9px;
    }

    #IMAGE1654 {
      width: 419.824px;
      height: 559.765px;
      top: 0px;
      left: 1.4869px;
    }

    #IMAGE1654>.ladi-image>.ladi-image-background {
      width: 419.824px;
      height: 559.765px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s750x900/5c7226c2c417ab07e5193eb0/4aecc05c6ad89086c9c9-20200518113630.jpg");
    }

    #SECTION1656 {
      height: 404.9px;
    }

    #SECTION1656>.ladi-section-background {
      background-color: rgba(180, 180, 180, 0.1);
    }

    #HEADLINE1660 {
      width: 333px;
      top: 0px;
      left: 58.25px;
    }

    #HEADLINE1660>.ladi-headline {
      font-family: "Open Sans", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 15px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: left;
      line-height: 1.2;
    }

    #SHAPE1661 {
      width: 38.9665px;
      height: 38.9665px;
      top: 0px;
      left: 0px;
    }

    #SHAPE1661 svg:last-child {
      fill: rgba(179, 100, 17, 1.0);
    }

    #PARAGRAPH1662 {
      width: 314px;
      top: 28px;
      left: 58.25px;
    }

    #PARAGRAPH1662>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 13px;
      text-align: justify;
      line-height: 1.6;
    }

    #PARAGRAPH1663 {
      width: 314px;
      top: 140px;
      left: 59.25px;
    }

    #PARAGRAPH1663>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 13px;
      text-align: justify;
      line-height: 1.6;
    }

    #SHAPE1664 {
      width: 37px;
      height: 37px;
      top: 114px;
      left: 5px;
    }

    #SHAPE1664 svg:last-child {
      fill: rgba(179, 100, 17, 1.0);
    }

    #HEADLINE1665 {
      width: 319px;
      top: 110px;
      left: 58.25px;
    }

    #HEADLINE1665>.ladi-headline {
      font-family: "Open Sans", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 15px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: left;
      line-height: 1.2;
    }

    #HEADLINE1666 {
      width: 318px;
      top: 205.375px;
      left: 59.25px;
    }

    #HEADLINE1666>.ladi-headline {
      font-family: "Open Sans", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: left;
      line-height: 1.2;
    }

    #SHAPE1667 {
      width: 33.933px;
      height: 33.933px;
      top: 205.375px;
      left: 3px;
    }

    #SHAPE1667 svg:last-child {
      fill: rgba(179, 100, 17, 1.0);
    }

    #PARAGRAPH1668 {
      width: 318px;
      top: 230.375px;
      left: 57.25px;
    }

    #PARAGRAPH1668>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 13px;
      text-align: justify;
      line-height: 1.8;
    }

    #HEADLINE1669 {
      width: 343px;
      top: 17.78px;
      left: 38.5px;
    }

    #HEADLINE1669>.ladi-headline {
      font-family: "Arima Madurai", cursive;
      color: rgb(0, 0, 0);
      font-size: 25px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP1699 {
      width: 391.25px;
      height: 299.375px;
      top: 77.593px;
      left: 14.199px;
    }

    #BOX1917 {
      width: 408.5px;
      height: 555px;
      top: 4.167px;
      left: 5.75px;
    }

    #BOX1917>.ladi-box {
      box-shadow: 0px 15px 20px -20px #000;
      -webkit-box-shadow: 0px 15px 20px -20px #000;
      background-color: rgba(255, 255, 255, 0.8);
    }

    #HEADLINE1918 {
      width: 392px;
      top: 27.3473px;
      left: 15.5px;
    }

    #HEADLINE1918>.ladi-headline {
      font-family: "Montserrat", sans-serif;
      color: rgb(199, 31, 22);
      font-size: 23px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE1920 {
      width: 147px;
      top: 11px;
      left: 0px;
    }

    #HEADLINE1920>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #HEADLINE1921 {
      width: 150px;
      top: 0px;
      left: 130.5px;
    }

    #HEADLINE1921>.ladi-headline {
      color: rgb(202, 32, 24);
      font-size: 25px;
      font-weight: bold;
      text-transform: uppercase;
      line-height: 1.6;
    }

    #GROUP1919 {
      width: 280.5px;
      height: 40px;
      top: 122.528px;
      left: 52.75px;
    }

    #HEADLINE1922 {
      width: 253px;
      top: 212.167px;
      left: 100.25px;
    }

    #HEADLINE1922>.ladi-headline {
      color: rgb(0, 63, 139);
      font-size: 16px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: left;
      line-height: 1.6;
    }

    #HEADLINE1925 {
      width: 409px;
      top: 68.5275px;
      left: 3.375px;
    }

    #HEADLINE1925>.ladi-headline {
      font-family: "Montserrat", sans-serif;
      color: rgb(207, 28, 19);
      font-size: 19px;
      font-weight: bold;
      text-transform: uppercase;
      font-style: italic;
      text-align: center;
      line-height: 1.6;
    }

    #IMAGE1926 {
      width: 90.7772px;
      height: 52.3605px;
      top: 4.167px;
      left: 5.75px;
    }

    #IMAGE1926>.ladi-image>.ladi-image-background {
      width: 90.7772px;
      height: 52.3605px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5c7226c2c417ab07e5193eb0/pinpngcom-bow-png-3017353-20191210083705.png");
    }

    #HEADLINE1928 {
      width: 142px;
      top: 165.834px;
      left: 185.5px;
    }

    #HEADLINE1928>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 15px;
      font-style: italic;
      text-align: center;
      line-height: 1.6;
    }

    #IMAGE1929 {
      width: 59.5495px;
      height: 145.678px;
      top: 169.528px;
      left: 36.9777px;
    }

    #IMAGE1929>.ladi-image>.ladi-image-background {
      width: 59.5495px;
      height: 145.678px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x450/5c7226c2c417ab07e5193eb0/qua-tang-20200417132516.png");
    }

    #COUNTDOWN1932 {
      width: 237.755px;
      height: 46.3584px;
      top: 0px;
      left: 0px;
    }

    #COUNTDOWN1932>.ladi-countdown {
      color: rgb(234, 242, 254);
      font-size: 18px;
      font-weight: bold;
      text-align: center;
    }

    #COUNTDOWN1932>.ladi-countdown>.ladi-element {
      width: calc((100% - 16px * 3) / 4);
      margin-right: 11px;
      height: 100%;
    }

    #COUNTDOWN1932>.ladi-countdown .ladi-countdown-background {
      background-color: rgb(179, 100, 17);
      border-radius: 105px;
    }

    #HEADLINE1937 {
      width: 49px;
      top: 51.163px;
      left: 0px;
    }

    #HEADLINE1937>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 12px;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE1938 {
      width: 49px;
      top: 51.163px;
      left: 63.0227px;
    }

    #HEADLINE1938>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 12px;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE1939 {
      width: 49px;
      top: 51.163px;
      left: 126.045px;
    }

    #HEADLINE1939>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 12px;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE1940 {
      width: 49px;
      top: 51.163px;
      left: 189.068px;
    }

    #HEADLINE1940>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 12px;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP1931 {
      width: 237.885px;
      height: 70.163px;
      top: 28.837px;
      left: 0.729553px;
    }

    #HEADLINE1941 {
      width: 239px;
      top: 0px;
      left: 0px;
    }

    #HEADLINE1941>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 15px;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP1930 {
      width: 239px;
      height: 99px;
      top: 331.667px;
      left: 88.375px;
    }

    #SECTION1916 {
      height: 567.32px;
    }

    #SECTION1916>.ladi-section-background {
      background-color: rgb(244, 241, 156);
    }

    #IMAGE1998 {
      width: 420px;
      height: 617.647px;
      top: 0px;
      left: 0px;
    }

    #IMAGE1998>.ladi-image>.ladi-image-background {
      width: 420px;
      height: 617.647px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s750x950/5c7226c2c417ab07e5193eb0/1-20200517012203.jpg");
    }

    #SECTION2000 {
      height: 467.6px;
    }

    #LIST_PARAGRAPH2003 {
      width: 405px;
      top: 115.592px;
      left: 7.5px;
    }

    #LIST_PARAGRAPH2003>.ladi-list-paragraph {
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.8;
    }

    #LIST_PARAGRAPH2003 ul li {
      padding-bottom: 14px;
      padding-left: 27px;
    }

    #LIST_PARAGRAPH2003 ul li:before {
      content: "";
      background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22100%25%22%20height%3D%22100%25%22%20%20viewBox%3D%220%200%201536%201896.0833%22%20fill%3D%22rgba(207%2C%2028%2C%2019%2C%201.0)%22%3E%20%3Cpath%20d%3D%22M1149%201122q0-26-19-45L949%20896l181-181q19-19%2019-45%200-27-19-46l-90-90q-19-19-46-19-26%200-45%2019L768%20715%20587%20534q-19-19-45-19-27%200-46%2019l-90%2090q-19%2019-19%2046%200%2026%2019%2045l181%20181-181%20181q-19%2019-19%2045%200%2027%2019%2046l90%2090q19%2019%2046%2019%2026%200%2045-19l181-181%20181%20181q19%2019%2045%2019%2027%200%2046-19l90-90q19-19%2019-46zm387-226q0%20209-103%20385.5T1153.5%201561%20768%201664t-385.5-103T103%201281.5%200%20896t103-385.5T382.5%20231%20768%20128t385.5%20103T1433%20510.5%201536%20896z%22%3E%3C%2Fpath%3E%20%3C%2Fsvg%3E");
      width: 20px;
      height: 20px;
      top: 5px;
    }

    #SECTION2067 {
      height: 630.9px;
    }

    #IMAGE2068 {
      width: 420px;
      height: 617.647px;
      top: 0px;
      left: 0px;
    }

    #IMAGE2068>.ladi-image>.ladi-image-background {
      width: 420px;
      height: 617.647px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s750x950/5c7226c2c417ab07e5193eb0/e7acae4403c0f99ea0d1-20200518113342.jpg");
    }

    #HEADLINE2070 {
      width: 369px;
      top: 91.793px;
      left: 25.5px;
    }

    #HEADLINE2070>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      text-align: center;
      line-height: 2;
    }

    #BOX2114 {
      width: 387.858px;
      height: 55.509px;
      top: 0px;
      left: 0px;
    }

    #BOX2114>.ladi-box {
      border-style: solid;
      border-color: rgb(0, 63, 139);
      border-width: 2px;
    }

    #HEADLINE2115 {
      width: 388px;
      top: 11.7545px;
      left: 0.142594px;
    }

    #HEADLINE2115>.ladi-headline {
      font-family: "Arima Madurai", cursive;
      color: rgb(200, 111, 23);
      font-size: 20px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2113 {
      width: 388px;
      height: 55.509px;
      top: 23.7px;
      left: 16px;
    }

    #BOX2120 {
      width: 340px;
      height: 55.509px;
      top: 0px;
      left: 0px;
    }

    #BOX2120>.ladi-box {
      border-style: solid;
      border-color: rgb(0, 63, 139);
      border-width: 2px;
    }

    #HEADLINE2121 {
      width: 340px;
      top: 11.7545px;
      left: 0.6245px;
    }

    #HEADLINE2121>.ladi-headline {
      font-family: "Arima Madurai", cursive;
      color: rgb(200, 111, 23);
      font-size: 22px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2119 {
      width: 340.625px;
      height: 55.509px;
      top: 20.27px;
      left: 39.3755px;
    }

    #BOX2123 {
      width: 340px;
      height: 55.509px;
      top: 0px;
      left: 0px;
    }

    #BOX2123>.ladi-box {
      border-style: solid;
      border-color: rgb(0, 63, 139);
      border-width: 2px;
    }

    #HEADLINE2124 {
      width: 340px;
      top: 12.7545px;
      left: 0.25px;
    }

    #HEADLINE2124>.ladi-headline {
      font-family: "Arima Madurai", cursive;
      color: rgb(202, 111, 24);
      font-size: 20px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2122 {
      width: 340.25px;
      height: 55.509px;
      top: 15.27px;
      left: 39.875px;
    }

    #SECTION2128 {
      height: 620.4px;
    }

    #IMAGE2129 {
      width: 420.626px;
      height: 618.567px;
      top: 0px;
      left: 0px;
    }

    #IMAGE2129>.ladi-image>.ladi-image-background {
      width: 420.626px;
      height: 618.567px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s750x950/5c7226c2c417ab07e5193eb0/7c984866e6e21cbc45f3-20200518113342.jpg");
    }

    #SECTION2140 {
      height: 618.639px;
    }

    #BUTTON_TEXT2182 {
      width: 226px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2182>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 16px;
      text-align: center;
      line-height: 1.6;
    }

    #BUTTON2182 {
      width: 226.096px;
      height: 41.1305px;
      top: 265.87px;
      left: 77.452px;
    }

    #BUTTON2182>.ladi-button>.ladi-button-background {
      background-color: rgb(207, 28, 19);
    }

    #BUTTON2182>.ladi-button {
      border-radius: 12px;
    }

    #FORM_ITEM2184 {
      width: 363px;
      height: 42.6088px;
      top: 0px;
      left: 0px;
    }

    #FORM_ITEM2185 {
      width: 363px;
      height: 42.6088px;
      top: 46.7003px;
      left: 0px;
    }

    #FORM_ITEM2186 {
      width: 363px;
      height: 42.6088px;
      top: 144.555px;
      left: 0px;
    }

    #FORM2181 {
      width: 363px;
      height: 307px;
      top: 462.88px;
      left: 19.5px;
    }

    #FORM2181>.ladi-form-custom {
      color: rgb(0, 0, 0);
      font-size: 12px;
      line-height: 1.6;
    }

    #FORM2181 .ladi-form-custom-item .ladi-form-custom-control::placeholder,
    #FORM2181 .ladi-form-custom .ladi-form-custom-item .ladi-form-custom-control-select[data-selected=""],
    #FORM2181 .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox .ladi-form-custom-checkbox-item span[data-checked="false"] {
      color: #000;
    }

    #FORM2181 .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select {
      background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20%23000%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
    }

    #FORM2181 .ladi-form-custom-item-container {
      border-style: solid;
      border-color: rgb(165, 165, 165);
      border-width: 1px;
    }

    #FORM2181 .ladi-form-custom-item-background {
      background-color: rgb(255, 255, 255);
    }

    #SECTION2190 {
      height: 5px;
    }

    #BUTTON2196 {
      width: 298px;
      height: 48px;
      top: 563.6px;
      left: 65px;
    }

    #BUTTON2196>.ladi-button>.ladi-button-background {
      background-color: rgb(208, 11, 1);
    }

    #BUTTON2196>.ladi-button {
      border-radius: 13px;
    }

    #BUTTON2196.ladi-animation>.ladi-button {
      animation-name: pulse;
      -webkit-animation-name: pulse;
      animation-delay: 1s;
      -webkit-animation-delay: 1s;
      animation-duration: 3s;
      -webkit-animation-duration: 3s;
      animation-iteration-count: infinite;
      -webkit-animation-iteration-count: infinite;
    }

    #BUTTON_TEXT2196 {
      width: 262px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2196>.ladi-headline {
      font-family: "Tinos", serif;
      color: rgb(255, 255, 255);
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #BOX2197 {
      width: 384.5px;
      height: 67.5px;
      top: 0px;
      left: 0px;
    }

    #BOX2197>.ladi-box {
      background-color: rgb(201, 111, 23);
    }

    #HEADLINE2198 {
      width: 347px;
      top: 8.75px;
      left: 18.75px;
    }

    #HEADLINE2198>.ladi-headline {
      font-family: "Arima Madurai", cursive;
      color: rgb(255, 255, 255);
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #SECTION2200 {
      height: 798.4px;
    }

    #GROUP2201 {
      width: 384.5px;
      height: 67.5px;
      top: 15.7px;
      left: 17.75px;
    }

    #BOX2203 {
      width: 384.5px;
      height: 60.5px;
      top: 0px;
      left: 0px;
    }

    #BOX2203>.ladi-box {
      background-color: rgb(179, 101, 17);
    }

    #HEADLINE2204 {
      width: 347px;
      top: 17.7019px;
      left: 18.75px;
    }

    #HEADLINE2204>.ladi-headline {
      font-family: "Tinos", serif;
      color: rgb(255, 255, 255);
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2202 {
      width: 384.5px;
      height: 60.5px;
      top: 16.461px;
      left: 17.75px;
    }

    #HEADLINE2205 {
      width: 380px;
      top: 102.961px;
      left: 20px;
    }

    #HEADLINE2205>.ladi-headline {
      font-family: "Tinos", serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      text-align: center;
      line-height: 1.6;
    }

    #IMAGE2206 {
      width: 420px;
      height: 176.96px;
      top: 594.828px;
      left: 0px;
    }

    #IMAGE2206>.ladi-image>.ladi-image-background {
      width: 420px;
      height: 176.96px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s750x500/5c7226c2c417ab07e5193eb0/22-20200528120729.jpg");
    }

    #IMAGE2207 {
      width: 424px;
      height: 364.89px;
      top: 218.141px;
      left: 0px;
    }

    #IMAGE2207>.ladi-image>.ladi-image-background {
      width: 424px;
      height: 364.89px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s750x700/5c7226c2c417ab07e5193eb0/111-20200528120729.png");
    }

    #HEADLINE2208 {
      width: 173px;
      top: 359.961px;
      left: 13.5px;
    }

    #HEADLINE2208>.ladi-headline {
      color: rgb(0, 63, 139);
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #BOX2209 {
      width: 200px;
      height: 32px;
      top: 356.461px;
      left: 8px;
    }

    #BOX2209>.ladi-box {
      background-color: rgb(255, 255, 255);
    }

    #HEADLINE2210 {
      width: 173px;
      top: 0.9468px;
      left: 13.5px;
    }

    #HEADLINE2210>.ladi-headline {
      color: rgb(0, 63, 139);
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #BOX2211 {
      width: 200px;
      height: 26.8936px;
      top: 0px;
      left: 0px;
    }

    #BOX2211>.ladi-box {
      background-color: rgb(255, 255, 255);
    }

    #GROUP2212 {
      width: 200px;
      height: 26.8936px;
      top: 358.961px;
      left: 224px;
    }

    #BOX2214 {
      width: 200px;
      height: 26.8936px;
      top: 0px;
      left: 0px;
    }

    #BOX2214>.ladi-box {
      background-color: rgb(255, 255, 255);
    }

    #HEADLINE2215 {
      width: 195px;
      top: 0px;
      left: 0px;
    }

    #HEADLINE2215>.ladi-headline {
      color: rgb(0, 63, 139);
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2213 {
      width: 200px;
      height: 26.8936px;
      top: 541.961px;
      left: 0px;
    }

    #BOX2217 {
      width: 200px;
      height: 26.8936px;
      top: 0px;
      left: 0px;
    }

    #BOX2217>.ladi-box {
      background-color: rgb(255, 255, 255);
    }

    #HEADLINE2218 {
      width: 195px;
      top: 0px;
      left: 5px;
    }

    #HEADLINE2218>.ladi-headline {
      color: rgb(0, 63, 139);
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2216 {
      width: 200px;
      height: 26.8936px;
      top: 541.961px;
      left: 220px;
    }

    #BOX2220 {
      width: 200px;
      height: 26.8936px;
      top: 0px;
      left: 0px;
    }

    #BOX2220>.ladi-box {
      background-color: rgb(255, 255, 255);
    }

    #HEADLINE2221 {
      width: 195px;
      top: 0px;
      left: 5px;
    }

    #HEADLINE2221>.ladi-headline {
      color: rgb(0, 63, 139);
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2219 {
      width: 200px;
      height: 26.8936px;
      top: 733.961px;
      left: 112px;
    }

    #SECTION2222 {
      height: 119.337px;
    }

    #SECTION2230 {
      height: 519.4px;
    }

    #HEADLINE2231 {
      width: 130px;
      top: 269.167px;
      left: 100.25px;
    }

    #HEADLINE2231>.ladi-headline {
      text-decoration-line: underline;
      -webkit-text-decoration-line: underline;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2232 {
      width: 47px;
      top: 266.167px;
      left: 230.25px;
    }

    #HEADLINE2232>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 20px;
      line-height: 1.6;
    }

    #BUTTON_TEXT2235 {
      width: 262px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2235>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #BUTTON2235 {
      width: 262px;
      height: 45px;
      top: 463.081px;
      left: 79.313px;
    }

    #BUTTON2235>.ladi-button>.ladi-button-background {
      background-color: rgb(203, 33, 24);
    }

    #BUTTON2235>.ladi-button {
      border-radius: 13px;
    }

    #IMAGE2237 {
      width: 420px;
      height: 666.544px;
      top: 219.793px;
      left: 0px;
    }

    #IMAGE2237>.ladi-image>.ladi-image-background {
      width: 420px;
      height: 666.544px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s750x1000/5c7226c2c417ab07e5193eb0/huong-dan-dung-20200522074927.png");
    }

    #BOX2239 {
      width: 340px;
      height: 70.3772px;
      top: 0px;
      left: 0px;
    }

    #BOX2239>.ladi-box {
      border-style: solid;
      border-color: rgb(0, 63, 139);
      border-width: 2px;
    }

    #HEADLINE2240 {
      width: 340px;
      top: 6.37725px;
      left: 0.125px;
    }

    #HEADLINE2240>.ladi-headline {
      font-family: "Arima Madurai", cursive;
      color: rgb(202, 111, 24);
      font-size: 20px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2238 {
      width: 340.125px;
      height: 70.3773px;
      top: 24.02px;
      left: 39.875px;
    }

    #IMAGE2241 {
      width: 227.513px;
      height: 468.181px;
      top: 0px;
      left: 783.03px;
    }

    #IMAGE2241>.ladi-image>.ladi-image-background {
      width: 227.513px;
      height: 468.181px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/75b66b5b7ffe85a0dcef-20200528123349.jpg");
    }

    #IMAGE2242 {
      width: 264.955px;
      height: 470.65px;
      top: -0.38236px;
      left: 507.03px;
    }

    #IMAGE2242>.ladi-image>.ladi-image-background {
      width: 264.955px;
      height: 470.65px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s600x800/5c7226c2c417ab07e5193eb0/b8a7084d1ce8e6b6bff9-20200528123349.jpg");
    }

    #IMAGE2243 {
      width: 228.371px;
      height: 469.946px;
      top: -0.38236px;
      left: 271.681px;
    }

    #IMAGE2243>.ladi-image>.ladi-image-background {
      width: 228.371px;
      height: 469.946px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x800/5c7226c2c417ab07e5193eb0/b259dcb0c815324b6b04-20200528123349.jpg");
    }

    #IMAGE2244 {
      width: 265.651px;
      height: 471.886px;
      top: 0px;
      left: 0.03px;
    }

    #IMAGE2244>.ladi-image>.ladi-image-background {
      width: 265.651px;
      height: 471.886px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s600x800/5c7226c2c417ab07e5193eb0/08efa01ab4bf4ee117ae-20200528123349.jpg");
    }

    #BOX2246 {
      width: 408.5px;
      height: 831px;
      top: 4.167px;
      left: 5.75px;
    }

    #BOX2246>.ladi-box {
      box-shadow: 0px 15px 20px -20px #000;
      -webkit-box-shadow: 0px 15px 20px -20px #000;
      background-color: rgba(255, 255, 255, 0.8);
    }

    #HEADLINE2247 {
      width: 392px;
      top: 27.3473px;
      left: 15.5px;
    }

    #HEADLINE2247>.ladi-headline {
      font-family: "Montserrat", sans-serif;
      color: rgb(199, 31, 22);
      font-size: 23px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE2249 {
      width: 147px;
      top: 11px;
      left: 0px;
    }

    #HEADLINE2249>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #HEADLINE2250 {
      width: 150px;
      top: 0px;
      left: 130.5px;
    }

    #HEADLINE2250>.ladi-headline {
      color: rgb(202, 32, 24);
      font-size: 25px;
      font-weight: bold;
      text-transform: uppercase;
      line-height: 1.6;
    }

    #GROUP2248 {
      width: 280.5px;
      height: 40px;
      top: 122.528px;
      left: 52.75px;
    }

    #HEADLINE2251 {
      width: 253px;
      top: 212.167px;
      left: 100.25px;
    }

    #HEADLINE2251>.ladi-headline {
      color: rgb(0, 63, 139);
      font-size: 16px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: left;
      line-height: 1.6;
    }

    #HEADLINE2252 {
      width: 409px;
      top: 68.5275px;
      left: 3.375px;
    }

    #HEADLINE2252>.ladi-headline {
      font-family: "Montserrat", sans-serif;
      color: rgb(207, 28, 19);
      font-size: 19px;
      font-weight: bold;
      text-transform: uppercase;
      font-style: italic;
      text-align: center;
      line-height: 1.6;
    }

    #IMAGE2253 {
      width: 90.7772px;
      height: 52.3605px;
      top: 4.167px;
      left: 5.75px;
    }

    #IMAGE2253>.ladi-image>.ladi-image-background {
      width: 90.7772px;
      height: 52.3605px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5c7226c2c417ab07e5193eb0/pinpngcom-bow-png-3017353-20191210083705.png");
    }

    #HEADLINE2254 {
      width: 142px;
      top: 165.834px;
      left: 185.5px;
    }

    #HEADLINE2254>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 15px;
      font-style: italic;
      text-align: center;
      line-height: 1.6;
    }

    #IMAGE2255 {
      width: 59.5495px;
      height: 145.678px;
      top: 169.528px;
      left: 36.9777px;
    }

    #IMAGE2255>.ladi-image>.ladi-image-background {
      width: 59.5495px;
      height: 145.678px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x450/5c7226c2c417ab07e5193eb0/qua-tang-20200417132516.png");
    }

    #COUNTDOWN2258 {
      width: 237.755px;
      height: 46.3584px;
      top: 0px;
      left: 0px;
    }

    #COUNTDOWN2258>.ladi-countdown {
      color: rgb(234, 242, 254);
      font-size: 18px;
      font-weight: bold;
      text-align: center;
    }

    #COUNTDOWN2258>.ladi-countdown>.ladi-element {
      width: calc((100% - 16px * 3) / 4);
      margin-right: 11px;
      height: 100%;
    }

    #COUNTDOWN2258>.ladi-countdown .ladi-countdown-background {
      background-color: rgb(179, 100, 17);
      border-radius: 105px;
    }

    #HEADLINE2263 {
      width: 49px;
      top: 51.163px;
      left: 0px;
    }

    #HEADLINE2263>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 12px;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE2264 {
      width: 49px;
      top: 51.163px;
      left: 63.0227px;
    }

    #HEADLINE2264>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 12px;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE2265 {
      width: 49px;
      top: 51.163px;
      left: 126.045px;
    }

    #HEADLINE2265>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 12px;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE2266 {
      width: 49px;
      top: 51.163px;
      left: 189.068px;
    }

    #HEADLINE2266>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 12px;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2257 {
      width: 237.885px;
      height: 70.163px;
      top: 28.837px;
      left: 0.729553px;
    }

    #HEADLINE2267 {
      width: 239px;
      top: 0px;
      left: 0px;
    }

    #HEADLINE2267>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(36, 36, 36);
      font-size: 15px;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2256 {
      width: 239px;
      height: 99px;
      top: 331.667px;
      left: 88.375px;
    }

    #HEADLINE2268 {
      width: 130px;
      top: 269.167px;
      left: 100.25px;
    }

    #HEADLINE2268>.ladi-headline {
      text-decoration-line: underline;
      -webkit-text-decoration-line: underline;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2269 {
      width: 47px;
      top: 266.167px;
      left: 230.25px;
    }

    #HEADLINE2269>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 20px;
      line-height: 1.6;
    }

    #SECTION2245 {
      height: 896.32px;
    }

    #SECTION2245>.ladi-section-background {
      background-color: rgb(244, 241, 156);
    }

    #FORM_ITEM2272 {
      width: 363px;
      height: 62px;
      top: 199.164px;
      left: 0px;
    }

    #SHAPE2286 {
      width: 60px;
      height: 60px;
      top: 215.155px;
      left: 180px;
    }

    #SHAPE2286 svg:last-child {
      fill: rgba(0, 0, 0, 0.5);
    }

    #VIDEO2286 {
      width: 420px;
      height: 490.311px;
      top: 551px;
      left: 0px;
    }

    #VIDEO2286>.ladi-video>.ladi-video-background {
      background-size: cover;
      background-attachment: scroll;
      background-origin: content-box;
      background-image: url("https://img.youtube.com/vi/THAQqeTyJ24/hqdefault.jpg");
      background-position: center center;
      background-repeat: no-repeat;
    }

    #FORM_ITEM2288 {
      width: 363px;
      height: 35px;
      top: 98.164px;
      left: 0px;
    }

    #SECTION2289 {
      height: 2073.41px;
    }

    #HEADLINE2290 {
      width: 150px;
      top: 81.7634px;
      left: 10px;
    }

    #HEADLINE2290>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #HEADLINE2291 {
      width: 150px;
      top: 81.7634px;
      left: 182px;
    }

    #HEADLINE2291>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #BOX2292 {
      width: 121px;
      height: 29px;
      top: 79.7634px;
      left: 293px;
    }

    #BOX2292>.ladi-box {
      background-color: rgb(220, 220, 220);
    }

    #SHAPE2293 {
      width: 14.893px;
      height: 26.7634px;
      top: 80.8817px;
      left: 395.107px;
    }

    #SHAPE2293 svg:last-child {
      fill: #000;
    }

    #HEADLINE2294 {
      width: 107px;
      top: 81.41px;
      left: 307.5px;
    }

    #HEADLINE2294>.ladi-headline {
      color: rgb(0, 0, 0);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #LINE2295 {
      width: 400px;
      top: 120.763px;
      left: 10px;
    }

    #LINE2295>.ladi-line>.ladi-line-container {
      border-top: 1px solid rgb(0, 0, 0);
      border-right: 1px solid rgb(0, 0, 0);
      border-bottom: 1px solid rgb(0, 0, 0);
      border-left: 0px !important;
    }

    #LINE2295>.ladi-line {
      width: 100%;
      padding: 8px 0px;
    }

    #GROUP2296 {
      width: 408.653px;
      height: 912.647px;
      top: 147.763px;
      left: 10px;
    }

    #IMAGE2297 {
      width: 50px;
      height: 50px;
      top: 630.324px;
      left: 0px;
    }

    #IMAGE2297>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/20160515-105403-2-520x602-1463318106526-89-0-471-520-crop-1463318451040-20200315030544.jpg");
    }

    #IMAGE2297>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2298 {
      width: 141px;
      top: 638.324px;
      left: 58px;
    }

    #HEADLINE2298>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2299 {
      width: 342px;
      top: 663.324px;
      left: 58px;
    }

    #PARAGRAPH2299>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2300 {
      width: 82px;
      top: 772.324px;
      left: 58px;
    }

    #HEADLINE2300>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2301 {
      width: 82px;
      top: 887.647px;
      left: 159.653px;
    }

    #HEADLINE2301>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2302 {
      width: 20.2523px;
      height: 25px;
      top: 887.647px;
      left: 236.748px;
    }

    #SHAPE2302 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2303 {
      width: 82px;
      top: 769.647px;
      left: 219.745px;
    }

    #HEADLINE2303>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2304 {
      width: 142px;
      top: 769.647px;
      left: 245px;
    }

    #HEADLINE2304>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #IMAGE2305 {
      width: 50px;
      height: 50px;
      top: 820.324px;
      left: 58px;
    }

    #IMAGE2305>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/avatar-hp-20200315032633.jpg");
    }

    #IMAGE2305>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2306 {
      width: 162px;
      top: 826.324px;
      left: 119.653px;
    }

    #HEADLINE2306>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2307 {
      width: 278px;
      top: 851.324px;
      left: 119.653px;
    }

    #PARAGRAPH2307>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2308 {
      width: 18.2626px;
      height: 19.3233px;
      top: 854.167px;
      left: 372.869px;
    }

    #SHAPE2308 svg:last-child {
      fill: rgba(203, 33, 24, 1.0);
    }

    #HEADLINE2309 {
      width: 82px;
      top: 887.647px;
      left: 108px;
    }

    #HEADLINE2309>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2310 {
      width: 82px;
      top: 772.324px;
      left: 119.653px;
    }

    #HEADLINE2310>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2311 {
      width: 127px;
      top: 887.647px;
      left: 281.653px;
    }

    #HEADLINE2311>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2312 {
      width: 82px;
      top: 887.647px;
      left: 261.252px;
    }

    #HEADLINE2312>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #IMAGE2313 {
      width: 50px;
      height: 50px;
      top: 308.324px;
      left: 0px;
    }

    #IMAGE2313>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 55px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/media-thisinh-avatar-1563333378-20200315030544.png");
    }

    #IMAGE2313>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2314 {
      width: 164px;
      top: 315.324px;
      left: 58px;
    }

    #HEADLINE2314>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2315 {
      width: 342px;
      top: 346.243px;
      left: 58px;
    }

    #PARAGRAPH2315>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2316 {
      width: 134px;
      top: 429.209px;
      left: 250px;
    }

    #HEADLINE2316>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2317 {
      width: 184px;
      top: 474.217px;
      left: 119px;
    }

    #HEADLINE2317>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2318 {
      width: 282px;
      top: 504.7px;
      left: 119px;
    }

    #PARAGRAPH2318>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2319 {
      width: 35px;
      top: 593.358px;
      left: 119.653px;
    }

    #HEADLINE2319>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2320 {
      width: 70px;
      top: 593.358px;
      left: 175px;
    }

    #HEADLINE2320>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2321 {
      width: 100px;
      top: 593.358px;
      left: 284px;
    }

    #HEADLINE2321>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2322 {
      width: 16.0931px;
      height: 22.5734px;
      top: 593.358px;
      left: 250px;
    }

    #SHAPE2322 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2323 {
      width: 35px;
      top: 593.358px;
      left: 270.252px;
    }

    #HEADLINE2323>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2324 {
      width: 82px;
      top: 429.209px;
      left: 58px;
    }

    #HEADLINE2324>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2325 {
      width: 82px;
      top: 429.209px;
      left: 119.653px;
    }

    #HEADLINE2325>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2326 {
      width: 20.2523px;
      height: 25px;
      top: 429.209px;
      left: 197.493px;
    }

    #SHAPE2326 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2327 {
      width: 82px;
      top: 429.209px;
      left: 222px;
    }

    #HEADLINE2327>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #IMAGE2328 {
      width: 50px;
      height: 50px;
      top: 468px;
      left: 58px;
    }

    #IMAGE2328>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/avatar-hp-20200315032633.jpg");
    }

    #IMAGE2328>.ladi-image {
      border-radius: 25px;
    }

    #SHAPE2329 {
      width: 18.2626px;
      height: 19.3233px;
      top: 558.677px;
      left: 162px;
    }

    #SHAPE2329 svg:last-child {
      fill: rgba(203, 33, 24, 1.0);
    }

    #SHAPE2330 {
      width: 20.2523px;
      height: 25px;
      top: 769.647px;
      left: 191.874px;
    }

    #SHAPE2330 svg:last-child {
      fill: #4267b2;
    }

    #IMAGE2331 {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
    }

    #IMAGE2331>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/hinh-anh-girl-sinh-2000-4-20200315030544.jpg");
    }

    #IMAGE2331>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2332 {
      width: 82px;
      top: 0px;
      left: 58px;
    }

    #HEADLINE2332>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2333 {
      width: 342px;
      top: 25px;
      left: 58px;
    }

    #PARAGRAPH2333>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2334 {
      width: 82px;
      top: 125px;
      left: 58px;
    }

    #HEADLINE2334>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2335 {
      width: 82px;
      top: 261.324px;
      left: 175px;
    }

    #HEADLINE2335>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2336 {
      width: 20.2523px;
      height: 25px;
      top: 261.324px;
      left: 250px;
    }

    #SHAPE2336 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2337 {
      width: 82px;
      top: 125px;
      left: 218.5px;
    }

    #HEADLINE2337>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2338 {
      width: 142px;
      top: 125px;
      left: 250px;
    }

    #HEADLINE2338>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #IMAGE2339 {
      width: 50px;
      height: 50px;
      top: 169px;
      left: 58px;
    }

    #IMAGE2339>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/avatar-hp-20200315032633.jpg");
    }

    #IMAGE2339>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2340 {
      width: 162px;
      top: 174px;
      left: 119px;
    }

    #HEADLINE2340>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2341 {
      width: 281px;
      top: 199px;
      left: 119px;
    }

    #PARAGRAPH2341>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2342 {
      width: 18.2626px;
      height: 19.3233px;
      top: 227.677px;
      left: 175px;
    }

    #SHAPE2342 svg:last-child {
      fill: rgba(203, 33, 24, 1.0);
    }

    #HEADLINE2343 {
      width: 82px;
      top: 261.324px;
      left: 119px;
    }

    #HEADLINE2343>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2344 {
      width: 82px;
      top: 125px;
      left: 119px;
    }

    #HEADLINE2344>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2345 {
      width: 113px;
      top: 261.324px;
      left: 292px;
    }

    #HEADLINE2345>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2346 {
      width: 18.0069px;
      height: 22.2283px;
      top: 126.386px;
      left: 197.493px;
    }

    #SHAPE2346 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2347 {
      width: 82px;
      top: 261.324px;
      left: 275px;
    }

    #HEADLINE2347>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #GROUP2348 {
      width: 408.653px;
      height: 912.647px;
      top: 1083.76px;
      left: 11.347px;
    }

    #IMAGE2349 {
      width: 50px;
      height: 50px;
      top: 630.324px;
      left: 0px;
    }

    #IMAGE2349>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/oeibkcfr20200315023011.jpg");
    }

    #IMAGE2349>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2350 {
      width: 141px;
      top: 638.324px;
      left: 58px;
    }

    #HEADLINE2350>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2351 {
      width: 342px;
      top: 663.324px;
      left: 58px;
    }

    #PARAGRAPH2351>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2352 {
      width: 82px;
      top: 772.324px;
      left: 58px;
    }

    #HEADLINE2352>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2353 {
      width: 82px;
      top: 887.647px;
      left: 159.653px;
    }

    #HEADLINE2353>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2354 {
      width: 20.2523px;
      height: 25px;
      top: 887.647px;
      left: 236.748px;
    }

    #SHAPE2354 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2355 {
      width: 82px;
      top: 769.647px;
      left: 219.745px;
    }

    #HEADLINE2355>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2356 {
      width: 142px;
      top: 769.647px;
      left: 245px;
    }

    #HEADLINE2356>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #IMAGE2357 {
      width: 50px;
      height: 50px;
      top: 820.324px;
      left: 58px;
    }

    #IMAGE2357>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/avatar-hp-20200315032633.jpg");
    }

    #IMAGE2357>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2358 {
      width: 162px;
      top: 826.324px;
      left: 119.653px;
    }

    #HEADLINE2358>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2359 {
      width: 278px;
      top: 851.324px;
      left: 119.653px;
    }

    #PARAGRAPH2359>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2360 {
      width: 18.2626px;
      height: 19.3233px;
      top: 854.162px;
      left: 357px;
    }

    #SHAPE2360 svg:last-child {
      fill: rgba(203, 33, 24, 1.0);
    }

    #HEADLINE2361 {
      width: 82px;
      top: 887.647px;
      left: 108px;
    }

    #HEADLINE2361>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2362 {
      width: 82px;
      top: 772.324px;
      left: 119.653px;
    }

    #HEADLINE2362>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2363 {
      width: 127px;
      top: 887.647px;
      left: 281.653px;
    }

    #HEADLINE2363>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2364 {
      width: 82px;
      top: 887.647px;
      left: 261.252px;
    }

    #HEADLINE2364>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #IMAGE2365 {
      width: 50px;
      height: 50px;
      top: 308.324px;
      left: 0px;
    }

    #IMAGE2365>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 55px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/d5fd4a00-96d0-11e7-b3de-3365996a5764-20200315050137.jpg");
    }

    #IMAGE2365>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2366 {
      width: 164px;
      top: 315.324px;
      left: 58px;
    }

    #HEADLINE2366>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2367 {
      width: 342px;
      top: 346.243px;
      left: 58px;
    }

    #PARAGRAPH2367>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2368 {
      width: 134px;
      top: 429.209px;
      left: 250px;
    }

    #HEADLINE2368>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2369 {
      width: 184px;
      top: 474.217px;
      left: 119px;
    }

    #HEADLINE2369>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2370 {
      width: 282px;
      top: 504.7px;
      left: 119px;
    }

    #PARAGRAPH2370>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2371 {
      width: 35px;
      top: 593.358px;
      left: 119.653px;
    }

    #HEADLINE2371>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2372 {
      width: 70px;
      top: 593.358px;
      left: 175px;
    }

    #HEADLINE2372>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2373 {
      width: 100px;
      top: 593.358px;
      left: 284px;
    }

    #HEADLINE2373>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2374 {
      width: 16.0931px;
      height: 22.5734px;
      top: 593.358px;
      left: 250px;
    }

    #SHAPE2374 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2375 {
      width: 35px;
      top: 593.358px;
      left: 270.252px;
    }

    #HEADLINE2375>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2376 {
      width: 82px;
      top: 429.209px;
      left: 58px;
    }

    #HEADLINE2376>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2377 {
      width: 82px;
      top: 429.209px;
      left: 119.653px;
    }

    #HEADLINE2377>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2378 {
      width: 20.2523px;
      height: 25px;
      top: 429.209px;
      left: 197.493px;
    }

    #SHAPE2378 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2379 {
      width: 82px;
      top: 429.209px;
      left: 222px;
    }

    #HEADLINE2379>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #IMAGE2380 {
      width: 50px;
      height: 50px;
      top: 468px;
      left: 58px;
    }

    #IMAGE2380>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/avatar-hp-20200315032633.jpg");
    }

    #IMAGE2380>.ladi-image {
      border-radius: 25px;
    }

    #SHAPE2381 {
      width: 18.2626px;
      height: 19.3233px;
      top: 556.677px;
      left: 333px;
    }

    #SHAPE2381 svg:last-child {
      fill: rgba(203, 33, 24, 1.0);
    }

    #SHAPE2382 {
      width: 20.2523px;
      height: 25px;
      top: 769.647px;
      left: 191.874px;
    }

    #SHAPE2382 svg:last-child {
      fill: #4267b2;
    }

    #IMAGE2383 {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
    }

    #IMAGE2383>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/hinh-anh-con-gai-toc-ngan-ngang-vai_082838657-20200315030544.png");
    }

    #IMAGE2383>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2384 {
      width: 121px;
      top: 0px;
      left: 58px;
    }

    #HEADLINE2384>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2385 {
      width: 342px;
      top: 25px;
      left: 58px;
    }

    #PARAGRAPH2385>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2386 {
      width: 82px;
      top: 125px;
      left: 58px;
    }

    #HEADLINE2386>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2387 {
      width: 82px;
      top: 261.324px;
      left: 175px;
    }

    #HEADLINE2387>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2388 {
      width: 20.2523px;
      height: 25px;
      top: 261.324px;
      left: 250px;
    }

    #SHAPE2388 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2389 {
      width: 82px;
      top: 125px;
      left: 218.5px;
    }

    #HEADLINE2389>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2390 {
      width: 142px;
      top: 125px;
      left: 250px;
    }

    #HEADLINE2390>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #IMAGE2391 {
      width: 50px;
      height: 50px;
      top: 169px;
      left: 58px;
    }

    #IMAGE2391>.ladi-image>.ladi-image-background {
      width: 50px;
      height: 50px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s400x400/5e55d7bf19113a128ed0d61c/avatar-hp-20200315032633.jpg");
    }

    #IMAGE2391>.ladi-image {
      border-radius: 25px;
    }

    #HEADLINE2392 {
      width: 162px;
      top: 174px;
      left: 119px;
    }

    #HEADLINE2392>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2393 {
      width: 281px;
      top: 199px;
      left: 119px;
    }

    #PARAGRAPH2393>.ladi-paragraph {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2394 {
      width: 18.2626px;
      height: 19.3233px;
      top: 229.677px;
      left: 373.737px;
    }

    #SHAPE2394 svg:last-child {
      fill: rgba(203, 33, 24, 1.0);
    }

    #HEADLINE2395 {
      width: 82px;
      top: 261.324px;
      left: 119px;
    }

    #HEADLINE2395>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2396 {
      width: 82px;
      top: 125px;
      left: 119px;
    }

    #HEADLINE2396>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2397 {
      width: 113px;
      top: 261.324px;
      left: 292px;
    }

    #HEADLINE2397>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(66, 103, 178);
      font-size: 16px;
      line-height: 1.6;
    }

    #SHAPE2398 {
      width: 18.0069px;
      height: 22.2283px;
      top: 126.386px;
      left: 197.493px;
    }

    #SHAPE2398 svg:last-child {
      fill: #4267b2;
    }

    #HEADLINE2399 {
      width: 82px;
      top: 261.324px;
      left: 275px;
    }

    #HEADLINE2399>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 16px;
      line-height: 1.6;
    }

    #HEADLINE2400 {
      width: 180px;
      top: 23.25px;
      left: 144px;
    }

    #HEADLINE2400>.ladi-headline {
      font-family: "Roboto", sans-serif;
      color: rgb(0, 0, 0);
      font-size: 23px;
      font-weight: bold;
      line-height: 1.6;
    }

    #BUTTON2401 {
      width: 374px;
      height: 47px;
      top: 2006.41px;
      left: 23px;
    }

    #BUTTON2401>.ladi-button>.ladi-button-background {
      background-color: rgb(66, 103, 178);
    }

    #BUTTON_TEXT2401 {
      width: 374px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2401>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 16px;
      text-align: center;
      line-height: 1.6;
    }

    #SHAPE2403 {
      width: 64.2097px;
      height: 76.3575px;
      top: auto;
      left: 0px;
      bottom: 0px;
      right: auto;
      position: fixed;
      z-index: 90000050;
      margin-left: calc((100% - 420px) / 2);
    }

    #SHAPE2403 svg:last-child {
      fill: rgba(204, 33, 24, 1.0);
    }

    #SECTION2404 {
      height: 532.918px;
    }

    #SECTION2404>.ladi-section-background {
      background: #F6F2F2;
      background: -webkit-radial-gradient(circle, #F6F2F2, #D9D9D9);
      background: radial-gradient(circle, #F6F2F2, #D9D9D9);
    }

    #FRAME2406 {
      width: 235.062px;
      height: 48.3059px;
      top: 215px;
      left: 0px;
    }

    #FRAME2406>.ladi-frame>.ladi-frame-background {
      background-color: rgb(234, 242, 254);
    }

    #IMAGE2407 {
      width: 43.6907px;
      height: 27.8585px;
      top: 10.6795px;
      left: 70.3767px;
    }

    #IMAGE2407>.ladi-image>.ladi-image-background {
      width: 43.6907px;
      height: 27.8585px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/mastercard-20200311062250-20200312040745.svg");
    }

    #IMAGE2408 {
      width: 43.691px;
      height: 27.8585px;
      top: 10.6795px;
      left: 18.532px;
    }

    #IMAGE2408>.ladi-image>.ladi-image-background {
      width: 43.691px;
      height: 27.8585px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/visa-20200311062250-20200312040726.svg");
    }

    #IMAGE2409 {
      width: 97.7156px;
      height: 37.4573px;
      top: 6px;
      left: 118.987px;
    }

    #IMAGE2409>.ladi-image>.ladi-image-background {
      width: 97.7156px;
      height: 37.4573px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/5c7362c6c417ab07e5196b05/bo-cong-thuong-20200311062345-20200312040731.svg");
    }

    #HEADLINE2424 {
      width: 269px;
      top: 500.483px;
      left: 76.9212px;
    }

    #HEADLINE2424>.ladi-headline {
      color: rgb(5, 31, 77);
      font-size: 12px;
      text-align: left;
      line-height: 1.2;
    }

    #HEADLINE2425 {
      width: 317px;
      top: 331.483px;
      left: 19px;
    }

    #HEADLINE2425>.ladi-headline {
      color: rgb(5, 31, 77);
      font-size: 18px;
      font-weight: bold;
      text-align: left;
      line-height: 1.2;
    }

    #GROUP2426 {
      width: 379.525px;
      height: 90.6635px;
      top: 369.483px;
      left: 20px;
    }

    #IMAGE2427 {
      width: 121.392px;
      height: 90.6635px;
      top: 0px;
      left: 0px;
    }

    #IMAGE2427>.ladi-image>.ladi-image-background {
      width: 188.105px;
      height: 125.403px;
      top: -27px;
      left: -24.7125px;
      background-image: url("https://w.ladicdn.com/s500x450/5e55d7bf19113a128ed0d61c/u-tao-xoan-tuoi-alota-huyen-phi-1-20200412083651.png");
    }

    #IMAGE2427>.ladi-image {
      border-color: rgb(234, 242, 254);
      border-width: 2px;
    }

    #IMAGE2428 {
      width: 119.247px;
      height: 90.6635px;
      top: 0px;
      left: 130.575px;
    }

    #IMAGE2428>.ladi-image>.ladi-image-background {
      width: 130.041px;
      height: 86.694px;
      top: 3.9695px;
      left: -8.85301px;
      background-image: url("https://w.ladicdn.com/s450x400/5e55d7bf19113a128ed0d61c/img_26311-20200319085049.png");
    }

    #IMAGE2428>.ladi-image {
      border-color: rgb(234, 242, 254);
      border-width: 2px;
    }

    #IMAGE2429 {
      width: 119.247px;
      height: 90.6635px;
      top: 0px;
      left: 260.278px;
    }

    #IMAGE2429>.ladi-image>.ladi-image-background {
      width: 123.188px;
      height: 164.456px;
      top: -16px;
      left: -3.941px;
      background-image: url("https://w.ladicdn.com/s450x500/5e55d7bf19113a128ed0d61c/face-nano-412-20200613162752.jpg");
    }

    #IMAGE2429>.ladi-image {
      border-color: rgb(234, 242, 254);
      border-width: 2px;
    }

    #LINE2430 {
      width: 380px;
      top: 477.483px;
      left: 21.4212px;
    }

    #LINE2430>.ladi-line>.ladi-line-container {
      border-top: 1px solid rgba(5, 31, 78, 0.1);
      border-right: 1px solid rgba(5, 31, 78, 0.1);
      border-bottom: 1px solid rgba(5, 31, 78, 0.1);
      border-left: 0px !important;
    }

    #LINE2430>.ladi-line {
      width: 100%;
      padding: 8px 0px;
    }

    #SECTION2431 {
      height: 1200.29px;
    }

    #IMAGE2432 {
      width: 205.54px;
      height: 178px;
      top: 19px;
      left: 0px;
    }

    #IMAGE2432>.ladi-image>.ladi-image-background {
      width: 205.54px;
      height: 205.54px;
      top: -15.54px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x550/5e55d7bf19113a128ed0d61c/tay-long-hp-20200510065644.jpg");
    }

    #IMAGE2433 {
      width: 205.54px;
      height: 178px;
      top: 19px;
      left: 215.615px;
    }

    #IMAGE2433>.ladi-image>.ladi-image-background {
      width: 205.54px;
      height: 274.053px;
      top: -93px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x600/5e55d7bf19113a128ed0d61c/tay-long-chan-20200510065749.png");
    }

    #IMAGE2434 {
      width: 134.411px;
      height: 119px;
      top: 564.288px;
      left: 0px;
    }

    #IMAGE2434>.ladi-image>.ladi-image-background {
      width: 179.06px;
      height: 119px;
      top: 0px;
      left: -30.3574px;
      background-image: url("https://w.ladicdn.com/s500x450/5e55d7bf19113a128ed0d61c/6-20200510065822.jpg");
    }

    #IMAGE2436 {
      width: 133.411px;
      height: 119px;
      top: 564.288px;
      left: 143.294px;
    }

    #IMAGE2436>.ladi-image>.ladi-image-background {
      width: 211.555px;
      height: 119px;
      top: 0px;
      left: -51.1923px;
      background-image: url("https://w.ladicdn.com/s550x450/5e55d7bf19113a128ed0d61c/12-20200510065907.jpg");
    }

    #IMAGE2437 {
      width: 137.411px;
      height: 119px;
      top: 564.288px;
      left: 284.253px;
    }

    #IMAGE2437>.ladi-image>.ladi-image-background {
      width: 179.481px;
      height: 119px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s500x450/5e55d7bf19113a128ed0d61c/13-20200510065918.jpg");
    }

    #GROUP2438 {
      width: 334px;
      height: 58px;
      top: 456.288px;
      left: 43px;
    }

    #HEADLINE2439 {
      width: 266px;
      top: 0px;
      left: 52px;
    }

    #HEADLINE2439>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 18px;
      line-height: 1.6;
    }

    #HEADLINE2440 {
      width: 334px;
      top: 36px;
      left: 0px;
    }

    #HEADLINE2440>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 14px;
      font-weight: bold;
      line-height: 1.6;
    }

    #LINE2441 {
      width: 43px;
      top: 5.5px;
      left: 0px;
    }

    #LINE2441>.ladi-line>.ladi-line-container {
      border-top: 2px solid rgb(255, 255, 255);
      border-right: 2px solid rgb(255, 255, 255);
      border-bottom: 2px solid rgb(255, 255, 255);
      border-left: 0px !important;
    }

    #LINE2441>.ladi-line {
      width: 100%;
      padding: 8px 0px;
    }

    #IMAGE2442 {
      width: 200px;
      height: 266.667px;
      top: 691.076px;
      left: 5px;
    }

    #IMAGE2442>.ladi-image>.ladi-image-background {
      width: 200px;
      height: 266.667px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x600/5e55d7bf19113a128ed0d61c/long-nach-1-20200510070050.png");
    }

    #IMAGE2443 {
      width: 200px;
      height: 266.667px;
      top: 691.076px;
      left: 218.755px;
    }

    #IMAGE2443>.ladi-image>.ladi-image-background {
      width: 200px;
      height: 266.667px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s550x600/5e55d7bf19113a128ed0d61c/long-nach-20200510070050.png");
    }

    #IMAGE2444 {
      width: 135.504px;
      height: 180.671px;
      top: 986.076px;
      left: 145.503px;
    }

    #IMAGE2444>.ladi-image>.ladi-image-background {
      width: 135.504px;
      height: 180.671px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s450x500/5e55d7bf19113a128ed0d61c/fb-7-11-3-20200510070132.jpg");
    }

    #IMAGE2445 {
      width: 135.503px;
      height: 180.671px;
      top: 986.076px;
      left: 5px;
    }

    #IMAGE2445>.ladi-image>.ladi-image-background {
      width: 135.503px;
      height: 180.671px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s450x500/5e55d7bf19113a128ed0d61c/fb-711-20200510070132.jpg");
    }

    #IMAGE2446 {
      width: 135.503px;
      height: 180.671px;
      top: 986.076px;
      left: 284.497px;
    }

    #IMAGE2446>.ladi-image>.ladi-image-background {
      width: 135.503px;
      height: 180.671px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s450x500/5e55d7bf19113a128ed0d61c/fb-7-11-2-20200510070132.jpg");
    }

    #FORM_ITEM2448 {
      width: 363px;
      height: 35px;
      top: 90.6852px;
      left: 0px;
    }

    #FORM_ITEM2449 {
      width: 363px;
      height: 65px;
      top: 225.239px;
      left: 0px;
    }

    #SECTION2450 {
      height: 69.6909px;
      left: initial !important;
    }

    #SECTION2450>.ladi-section-background {
      background-color: rgb(200, 152, 23);
    }

    #BOX2451 {
      width: 210px;
      height: 69.6909px;
      top: 0px;
      left: 210px;
    }

    #BOX2451>.ladi-box {
      background-color: rgb(207, 28, 19);
      border-radius: 0px;
    }

    #IMAGE2452 {
      width: 188.536px;
      height: 62.8454px;
      top: 3.4228px;
      left: 8.403px;
    }

    #IMAGE2452>.ladi-image>.ladi-image-background {
      width: 188.536px;
      height: 62.8454px;
      top: 0px;
      left: 0px;
      background-image: url("https://w.ladicdn.com/s500x400/5e55d7bf19113a128ed0d61c/logo-20200510025000.png");
    }

    #SHAPE2453 {
      width: 40px;
      height: 40px;
      top: 14.8455px;
      left: 370px;
    }

    #SHAPE2453 svg:last-child {
      fill: rgba(255, 255, 255, 1.0);
    }

    #BUTTON2454 {
      width: 133.4px;
      height: 44px;
      top: 12.8455px;
      left: 226.418px;
    }

    #BUTTON2454>.ladi-button>.ladi-button-background {
      background-color: rgba(255, 255, 255, 0);
    }

    #BUTTON2454>.ladi-button {
      border-style: solid;
      border-color: rgb(255, 255, 255);
      border-width: 2px;
      border-radius: 100px;
    }

    #BUTTON2454.ladi-animation>.ladi-button {
      animation-name: pulse;
      -webkit-animation-name: pulse;
      animation-delay: 1s;
      -webkit-animation-delay: 1s;
      animation-duration: 3s;
      -webkit-animation-duration: 3s;
      animation-iteration-count: 1;
      -webkit-animation-iteration-count: 1;
    }

    #BUTTON_TEXT2454 {
      width: 122px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2454>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #GROUP2456 {
      width: 383.602px;
      height: 40.5px;
      top: 2.13163px;
      left: 660.199px;
      display: none !important;
    }

    #BUTTON2457 {
      width: 87.4252px;
      height: 40.3333px;
      top: 0.1667px;
      left: 0px;
    }

    #BUTTON2457>.ladi-button>.ladi-button-background {
      background-color: rgba(245, 65, 38, 0);
    }

    #BUTTON2457>.ladi-button {
      border-color: rgb(244, 64, 37);
      border-width: 1px;
      border-radius: 100px;
    }

    #BUTTON_TEXT2457 {
      width: 87px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2457>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #BUTTON2459 {
      width: 107.236px;
      height: 40.3333px;
      top: 0.1667px;
      left: 87.425px;
    }

    #BUTTON2459>.ladi-button>.ladi-button-background {
      background-color: rgba(245, 65, 38, 0);
    }

    #BUTTON2459>.ladi-button {
      border-color: rgb(244, 64, 37);
      border-width: 1px;
      border-radius: 100px;
    }

    #BUTTON_TEXT2459 {
      width: 107px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2459>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #BUTTON2461 {
      width: 98.0447px;
      height: 40.3333px;
      top: 0px;
      left: 194.662px;
    }

    #BUTTON2461>.ladi-button>.ladi-button-background {
      background-color: rgba(245, 65, 38, 0);
    }

    #BUTTON2461>.ladi-button {
      border-color: rgb(244, 64, 37);
      border-width: 1px;
      border-radius: 100px;
    }

    #BUTTON_TEXT2461 {
      width: 98px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2461>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #BUTTON2463 {
      width: 90.8956px;
      height: 40.3333px;
      top: 0px;
      left: 292.706px;
    }

    #BUTTON2463>.ladi-button>.ladi-button-background {
      background-color: rgba(245, 65, 38, 0);
    }

    #BUTTON2463>.ladi-button {
      border-color: rgb(244, 64, 37);
      border-width: 1px;
      border-radius: 100px;
    }

    #BUTTON_TEXT2463 {
      width: 90px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2463>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #IMAGE2435 {
      width: 420px;
      height: 346.288px;
      top: 209px;
      left: 0px;
    }

    #IMAGE2435>.ladi-image>.ladi-image-background {
      width: 545.872px;
      height: 348.857px;
      top: -2.569px;
      left: -54px;
      background-image: url("https://w.ladicdn.com/s850x650/5e55d7bf19113a128ed0d61c/tay-long-qc-1-20200614065123.jpg");
    }

    #SHAPE2466 {
      width: 98px;
      height: 98px;
      top: 415.77px;
      left: 273.5px;
    }

    #SHAPE2466 svg:last-child {
      fill: rgba(0, 64, 139, 1.0);
    }

    #GROUP2405 {
      width: 399.39px;
      height: 263.306px;
      top: 35.483px;
      left: 18px;
    }

    #GROUP2410 {
      width: 399.344px;
      height: 158.167px;
      top: 0px;
      left: 0.04555px;
    }

    #HEADLINE2411 {
      width: 288px;
      top: 0px;
      left: 0.95445px;
    }

    #HEADLINE2411>.ladi-headline {
      color: rgb(5, 31, 77);
      font-size: 21px;
      font-weight: bold;
      text-align: left;
      line-height: 1.4;
    }

    #GROUP2412 {
      width: 399.344px;
      height: 23px;
      top: 68.5px;
      left: 0px;
    }

    #SHAPE2413 {
      width: 22.3979px;
      height: 22.5469px;
      top: 0px;
      left: 0px;
    }

    #SHAPE2413 svg:last-child {
      fill: rgba(5, 31, 77, 1);
    }

    #HEADLINE2414 {
      width: 367px;
      top: 4px;
      left: 32.782px;
    }

    #HEADLINE2414>.ladi-headline {
      color: rgb(5, 31, 77);
      font-size: 12px;
      text-align: left;
      line-height: 1.4;
    }

    #GROUP2415 {
      width: 322.782px;
      height: 22.5469px;
      top: 102.286px;
      left: 0px;
    }

    #SHAPE2416 {
      width: 22.3979px;
      height: 22.5469px;
      top: 0px;
      left: 0px;
    }

    #SHAPE2416 svg:last-child {
      fill: rgba(5, 31, 77, 1);
    }

    #HEADLINE2417 {
      width: 290px;
      top: 2px;
      left: 32.7819px;
    }

    #HEADLINE2417>.ladi-headline {
      color: rgb(5, 31, 77);
      font-size: 14px;
      text-align: left;
      line-height: 1.4;
    }

    #GROUP2418 {
      width: 322.782px;
      height: 22.5469px;
      top: 135.62px;
      left: 0px;
    }

    #SHAPE2419 {
      width: 22.3979px;
      height: 22.5469px;
      top: 0px;
      left: 0px;
    }

    #SHAPE2419 svg:last-child {
      fill: rgba(5, 31, 77, 1);
    }

    #HEADLINE2420 {
      width: 290px;
      top: 2px;
      left: 32.7819px;
    }

    #HEADLINE2420>.ladi-headline {
      color: rgb(5, 31, 77);
      font-size: 14px;
      text-align: left;
      line-height: 1.4;
    }

    #BUTTON2467 {
      width: 160px;
      height: 40px;
      top: auto;
      left: auto;
      bottom: 10px;
      right: 0px;
      position: fixed;
      z-index: 90000050;
      margin-right: calc((100% - 420px) / 2);
    }

    #BUTTON2467>.ladi-button>.ladi-button-background {
      background: #ff6a00;
      background: -webkit-linear-gradient(180deg, #ff6a00, #ee0979);
      background: linear-gradient(180deg, #ff6a00, #ee0979);
    }

    #BUTTON2467.ladi-animation>.ladi-button {
      animation-name: shake;
      -webkit-animation-name: shake;
      animation-delay: 3s;
      -webkit-animation-delay: 3s;
      animation-duration: 3s;
      -webkit-animation-duration: 3s;
      animation-iteration-count: infinite;
      -webkit-animation-iteration-count: infinite;
    }

    #BUTTON_TEXT2467 {
      width: 160px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT2467>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 16px;
      text-align: center;
      line-height: 1.6;
    }

    #POPUP2468 {
      width: 420px;
      height: 400px;
      top: 0px;
      left: 0px;
      bottom: 0px;
      right: 0px;
      margin: auto;
    }

    #POPUP2468>.ladi-popup>.ladi-popup-background {
      background-color: rgb(255, 255, 255);
    }

    #SPINLUCKY2469 {
      width: 274px;
      height: 274px;
      top: 110px;
      left: 64px;
    }

    #SPINLUCKY2469>.ladi-spin-lucky {
      color: rgb(255, 255, 255);
      font-size: 15px;
      font-weight: bold;
    }

    #SPINLUCKY2469 .ladi-spin-lucky-screen {
      background-image: url("https://w.ladicdn.com/source/spin-bg6.svg");
    }

    #SPINLUCKY2469 .ladi-spin-lucky-start {
      background-image: url("https://w.ladicdn.com/source/spin-btn1.svg");
    }

    #HEADLINE2470 {
      width: 168px;
      top: 6px;
      left: 145.5px;
    }

    #HEADLINE2470>.ladi-headline {
      font-family: "Tinos", serif;
      color: rgb(204, 34, 25);
      font-size: 18px;
      font-weight: bold;
      line-height: 1.6;
    }

    #HEADLINE2471 {
      width: 386px;
      top: 34px;
      left: 24.5px;
    }

    #HEADLINE2471>.ladi-headline {
      font-family: "Tinos", serif;
      color: rgb(204, 34, 25);
      font-size: 18px;
      font-weight: bold;
      line-height: 1.6;
    }

    #PARAGRAPH2472 {
      width: 407px;
      top: 62px;
      left: 7.5px;
    }

    #PARAGRAPH2472>.ladi-paragraph {
      color: rgb(0, 0, 0);
      font-size: 13px;
      line-height: 1.6;
    }
  </style>
  <script type="text/javascript">
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
    fbq("init", "638139886819707");
    fbq("track", "PageView");
    fbq("track", "ViewContent");
  </script>
  <script>
    (function() {
      var ta = document.createElement('script');
      ta.type = 'text/javascript';
      ta.async = true;
      ta.src = 'https://meteor.tiktok.com/i18n/pixel/sdk.js?sdkid=BSBHJCMGK86GA76EED60';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ta, s);
    })();
  </script>
  <script type="text/javascript" async="" src="./index_files/location.vn.min.js"></script>
  <script charset="utf-8" src="./index_files/identify.js"></script>
</head>

<body><noscript><img height="1" width="1" style="display:none;" src="https://www.facebook.com/tr?id=638139886819707&ev=PageView&noscript=1" /></noscript>
  <div class="ladi-wraper">
    <div id="SECTION2450" class="ladi-section" data-top="0" data-left="926" data-sticky="true" style="">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="BOX2451" class="ladi-element">
          <div class="ladi-box"></div>
        </div>
        <div id="IMAGE2452" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="SHAPE2453" class="ladi-element">
          <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve" preserveAspectRatio="none" width="100%" height="100%" class="" fill="rgba(255, 255, 255, 1.0)">
              <path d="M876.5,662.5"></path>
              <g>
                <g>
                  <path d="M252.542,363.625h504.917c19.604,0,35.5-15.912,35.5-35.5c0-19.622-15.896-35.5-35.5-35.5H252.542    c-19.605,0-35.5,15.878-35.5,35.5C217.042,347.713,232.937,363.625,252.542,363.625z"></path>
                </g>
                <g>
                  <path d="M757.459,452.236H252.542c-19.605,0-35.5,15.913-35.5,35.5c0,19.622,15.895,35.5,35.5,35.5h504.917    c19.604,0,35.5-15.878,35.5-35.5C792.959,468.149,777.063,452.236,757.459,452.236z"></path>
                </g>
                <g>
                  <path d="M757.459,611.883H252.542c-19.605,0-35.5,15.878-35.5,35.5c0,19.587,15.895,35.5,35.5,35.5h504.917    c19.604,0,35.5-15.913,35.5-35.5C792.959,627.761,777.063,611.883,757.459,611.883z"></path>
                </g>
              </g>
            </svg></div>
        </div>
        <div data-action="true" id="BUTTON2454" class="ladi-element ladi-animation">
          <div class="ladi-button">
            <div class="ladi-button-background"></div>
            <div id="BUTTON_TEXT2454" class="ladi-element">
              <p class="ladi-headline">NHẬN ƯU ĐÃI</p>
            </div>
          </div>
        </div>
        <div id="GROUP2456" class="ladi-element">
          <div class="ladi-group">
            <div data-action="true" id="BUTTON2457" class="ladi-element">
              <div class="ladi-button">
                <div class="ladi-button-background"></div>
                <div id="BUTTON_TEXT2457" class="ladi-element">
                  <p class="ladi-headline">About</p>
                </div>
              </div>
            </div>
            <div data-action="true" id="BUTTON2459" class="ladi-element">
              <div class="ladi-button">
                <div class="ladi-button-background"></div>
                <div id="BUTTON_TEXT2459" class="ladi-element">
                  <p class="ladi-headline">Features</p>
                </div>
              </div>
            </div>
            <div data-action="true" id="BUTTON2461" class="ladi-element">
              <div class="ladi-button">
                <div class="ladi-button-background"></div>
                <div id="BUTTON_TEXT2461" class="ladi-element">
                  <p class="ladi-headline">Reviews</p>
                </div>
              </div>
            </div>
            <div data-action="true" id="BUTTON2463" class="ladi-element">
              <div class="ladi-button">
                <div class="ladi-button-background"></div>
                <div id="BUTTON_TEXT2463" class="ladi-element">
                  <p class="ladi-headline">Pricing</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2190" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container"></div>
    </div>
    <div id="SECTION2128" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="IMAGE2129" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div data-action="true" id="BUTTON2196" class="ladi-element ladi-animation">
          <div class="ladi-button">
            <div class="ladi-button-background"></div>
            <div id="BUTTON_TEXT2196" class="ladi-element">
              <p class="ladi-headline">NHẬN KHUYẾN MÃI MUA 1 TẶNG 1</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2000" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="LIST_PARAGRAPH2003" class="ladi-element">
          <div class="ladi-list-paragraph">
            <ul>
              <li><span style="font-weight: bold;">Sử dụng Dao cạo:</span> làm da đỏ rát và đau, sơ xuất có thể để lại vết thương và chân lông mọc lại sẽ cứng và đen hơn.<br></li>
              <li><span style="font-weight: bold;">Dùng nhíp nhổ:</span> khiến lỗ chân lông xùi lên, lông bị vo tròn và mọc ngược. Gây thâm và khó chịu.</li>
              <li><span style="font-weight: bold;">Dùng gel wax lông:</span> Không an toàn, gây đau đớn, tổn thương da và có thể gây viêm chân lông...Lông mọc lại chỉ sau 1 tuần.</li>
              <li><span style="font-weight: bold;">Triệt lông ở SPA:</span> Chi phí rất cao, tốn nhiều thời gian. Phụ thuộc vào SPA nếu lông mọc lại.</li>
            </ul>
          </div>
        </div>
        <div id="GROUP2201" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2197" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2198" class="ladi-element">
              <h3 class="ladi-headline">BẠN MUỐN TRIỆT LÔNG VĨNH VIỄN<br>NHƯNG<br></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2140" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="IMAGE1998" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2200" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="IMAGE2207" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="BOX2209" class="ladi-element">
          <div class="ladi-box"></div>
        </div>
        <div id="GROUP2202" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2203" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2204" class="ladi-element">
              <h3 class="ladi-headline">DỄ DÀNG SỬ DỤNG TẠI NHÀ<br></h3>
            </div>
          </div>
        </div>
        <div id="HEADLINE2205" class="ladi-element">
          <h3 class="ladi-headline">Với Kem Tẩy Lông Huyền Phi, bạn có thể dễ dàng sử dụng tại nhà, cho phép bạn loại bỏ đi những cọng lông đáng ghét trên cơ thể một cách nhẹ nhàng. <span style="font-weight: bold;">An toàn, hiệu quả, nhanh chóng, cực tiết kiệm</span></h3>
        </div>
        <div id="IMAGE2206" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="HEADLINE2208" class="ladi-element">
          <h3 class="ladi-headline">ĐÁNH BAY LÔNG TAY</h3>
        </div>
        <div id="GROUP2212" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2211" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2210" class="ladi-element">
              <h3 class="ladi-headline">THỔI BAY LÔNG NÁCH</h3>
            </div>
          </div>
        </div>
        <div id="GROUP2213" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2214" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2215" class="ladi-element">
              <h3 class="ladi-headline">SẠCH BÁCH LÔNG CHÂN</h3>
            </div>
          </div>
        </div>
        <div id="GROUP2216" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2217" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2218" class="ladi-element">
              <h3 class="ladi-headline">TẨY LÔNG VÙNG KÍN</h3>
            </div>
          </div>
        </div>
        <div id="GROUP2219" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2220" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2221" class="ladi-element">
              <h3 class="ladi-headline">TRIỆT SẠCH RÂU RIA</h3>
            </div>
          </div>
        </div>
        <div id="SHAPE2466" class="ladi-element">
          <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 29.77 29.77" class="" fill="#000">
              <circle cx="14.89" cy="14.89" r="14.89"></circle>
            </svg></div>
        </div>
      </div>
    </div>
    <div id="SECTION894" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="HEADLINE1587" class="ladi-element">
          <h3 class="ladi-headline">Là một sản phẩm cao cấp của thương hiệu mỹ phẩm huyền phi. Được áp dụng công nghệ sản xuất hiện đại giúp tăng cường hoạt tính của các thảo dược và quy trình kiểm soát chât lượng ngặt nghèo mang lại sự hài lòng nhất cho quý khách.</h3>
        </div>
        <div id="HEADLINE1589" class="ladi-element">
          <h3 class="ladi-headline">Kem tẩy lông huyền phi sản phẩm 2 trong 1 vừa giúp tẩy sạch lông vừa chăm sóc làn da của bạn:</h3>
        </div>
        <div id="LIST_PARAGRAPH1592" class="ladi-element">
          <div class="ladi-list-paragraph">
            <ul>
              <li>Tẩy sạch lông ngay từ lần đầu sử dụng</li>
              <li>Kết hợp với triệt lông Huyền Phi ngăn ngừa lông mọc trở lại</li>
              <li>Cung cấp dưỡng chất giúp da trắng sáng và mềm mịn hơn.</li>
            </ul>
          </div>
        </div>
        <div id="GROUP2113" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2114" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2115" class="ladi-element">
              <h3 class="ladi-headline"><span style="font-weight: bold;">KEM TẨY LÔNG CAO CẤP HUYỀN PHI</span></h3>
            </div>
          </div>
        </div>
        <div id="VIDEO2286" class="ladi-element">
          <div class="ladi-video">
            <div class="ladi-video-background"></div>
            <div id="SHAPE2286" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 408.7 408.7" fill="rgba(0, 0, 0, 0.5)">
                  <polygon fill="#fff" points="163.5 296.3 286.1 204.3 163.5 112.4 163.5 296.3"></polygon>
                  <path d="M204.3,0C91.5,0,0,91.5,0,204.3S91.5,408.7,204.3,408.7s204.3-91.5,204.3-204.3S316.7,0,204.3,0ZM163.5,296.3V112.4l122.6,91.9Z" transform="translate(0 0)"></path>
                </svg></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2230" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="VIDEO1415" class="ladi-element">
          <div class="ladi-video">
            <div class="ladi-video-background"></div>
            <div id="SHAPE1415" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 408.7 408.7" fill="rgba(0, 0, 0, 0.5)">
                  <polygon fill="#fff" points="163.5 296.3 286.1 204.3 163.5 112.4 163.5 296.3"></polygon>
                  <path d="M204.3,0C91.5,0,0,91.5,0,204.3S91.5,408.7,204.3,408.7s204.3-91.5,204.3-204.3S316.7,0,204.3,0ZM163.5,296.3V112.4l122.6,91.9Z" transform="translate(0 0)"></path>
                </svg></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION1412" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="LIST_PARAGRAPH1590" class="ladi-element">
          <div class="ladi-list-paragraph">
            <ul>
              <li>Thành phần hoàn toàn từ thiên nhiên, an toàn với mọi vùng da nhạy cảm</li>
              <li>Tẩy lông nhanh chóng, nhẹ nhàng.</li>
              <li>Không đau rát, Không mùi hôi khó chịu</li>
              <li>Tiết kiệm chi phí, thời gian…</li>
              <li>Xóa Bỏ Nỗi Lo Mất tự tin vì những vùng lông khó chịu.</li>
              <li>Xóa Tan Vết Thâm , lỗ chân lông to do nhổ cạo .</li>
              <li>Tránh xa nguy cơ mắc viêm nang lông, bệnh viêm nhiễm hay mùi hôi khó chịu.</li>
              <li>Tự tin khoe dáng vừa là để tránh cái nóng oi bức của mùa hè.</li>
            </ul>
          </div>
        </div>
        <div id="GROUP2119" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2120" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2121" class="ladi-element">
              <h3 class="ladi-headline">AN TOÀN VỚI MỌI VÙNG DA</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION1916" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="BOX1917" class="ladi-element">
          <div class="ladi-box"></div>
        </div>
        <div id="HEADLINE1918" class="ladi-element">
          <h3 class="ladi-headline">MUA 1 TẶNG 1</h3>
        </div>
        <div id="GROUP1919" class="ladi-element">
          <div class="ladi-group">
            <div id="HEADLINE1920" class="ladi-element">
              <h3 class="ladi-headline">Giá tiết kiệm 40%:</h3>
            </div>
            <div id="HEADLINE1921" class="ladi-element">
              <h3 class="ladi-headline"><span class="ladipage-animated-headline rotate-3 letters"><span class="ladipage-animated-words-wrapper" data-word="[&quot;280.000VND&quot;]" style="width: 144px;"><b class="is-visible" style="opacity: 1;"><i class="out">2</i><i class="out">8</i><i class="out">0</i><i class="out">.</i><i class="out">0</i><i class="out">0</i><i class="out">0</i><i class="out">v</i><i class="out">n</i><i class="out">d</i></b><b style="opacity: 1;"><i class="in">2</i><i class="in">8</i><i class="in">0</i><i class="in">.</i><i class="in">0</i><i class="in">0</i><i class="in">0</i><i class="in">V</i><i class="in">N</i><i class="in">D</i></b></span></span></h3>
            </div>
          </div>
        </div>
        <div id="HEADLINE1922" class="ladi-element">
          <h3 class="ladi-headline">Tặng Kèm Serum Triệt lông Huyền Phi Trị Giá 180.000 vnđ</h3>
        </div>
        <div id="HEADLINE1925" class="ladi-element">
          <h3 class="ladi-headline">Chỉ Áp Dụng cho 99 KH Đầu Tiên</h3>
        </div>
        <div id="IMAGE1926" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="HEADLINE1928" class="ladi-element">
          <h3 class="ladi-headline">Giá cũ <span style="text-decoration-line: line-through;">460.000đ</span></h3>
        </div>
        <div id="IMAGE1929" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="GROUP1930" class="ladi-element">
          <div class="ladi-group">
            <div id="GROUP1931" class="ladi-element">
              <div class="ladi-group">
                <div id="COUNTDOWN1932" class="ladi-element" data-type="countdown" data-minute="720" data-date-start="0" data-date-end="1624511865733">
                  <div class="ladi-countdown">
                    <div id="COUNTDOWN_ITEM1933" class="ladi-element" data-item-type="day">
                      <div class="ladi-countdown-background"></div>
                      <div class="ladi-countdown-text"><span>00</span></div>
                    </div>
                    <div id="COUNTDOWN_ITEM1934" class="ladi-element" data-item-type="hour">
                      <div class="ladi-countdown-background"></div>
                      <div class="ladi-countdown-text"><span>11</span></div>
                    </div>
                    <div id="COUNTDOWN_ITEM1935" class="ladi-element" data-item-type="minute">
                      <div class="ladi-countdown-background"></div>
                      <div class="ladi-countdown-text"><span>02</span></div>
                    </div>
                    <div id="COUNTDOWN_ITEM1936" class="ladi-element" data-item-type="seconds">
                      <div class="ladi-countdown-background"></div>
                      <div class="ladi-countdown-text"><span>19</span></div>
                    </div>
                  </div>
                </div>
                <div id="HEADLINE1937" class="ladi-element">
                  <h3 class="ladi-headline">Ngày</h3>
                </div>
                <div id="HEADLINE1938" class="ladi-element">
                  <h3 class="ladi-headline">Giờ</h3>
                </div>
                <div id="HEADLINE1939" class="ladi-element">
                  <h3 class="ladi-headline">Phút</h3>
                </div>
                <div id="HEADLINE1940" class="ladi-element">
                  <h3 class="ladi-headline">Giây</h3>
                </div>
              </div>
            </div>
            <div id="HEADLINE1941" class="ladi-element">
              <h3 class="ladi-headline">Ưu đãi sẽ kết thúc sau</h3>
            </div>
          </div>
        </div>
        <div id="HEADLINE2231" class="ladi-element">
          <h3 class="ladi-headline">Số lượng chỉ còn:</h3>
        </div>
        <div id="HEADLINE2232" class="ladi-element">
          <h3 class="ladi-headline">20</h3>
        </div>
        <div data-action="true" id="BUTTON2235" class="ladi-element">
          <div class="ladi-button">
            <div class="ladi-button-background"></div>
            <div id="BUTTON_TEXT2235" class="ladi-element">
              <p class="ladi-headline">NHẬN ƯU ĐÃI NGAY</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2067" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="IMAGE2068" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION1367" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="VIDEO1607" class="ladi-element">
          <div class="ladi-video">
            <div class="ladi-video-background"></div>
            <div id="SHAPE1607" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 408.7 408.7" fill="rgba(0, 0, 0, 0.5)">
                  <polygon fill="#fff" points="163.5 296.3 286.1 204.3 163.5 112.4 163.5 296.3"></polygon>
                  <path d="M204.3,0C91.5,0,0,91.5,0,204.3S91.5,408.7,204.3,408.7s204.3-91.5,204.3-204.3S316.7,0,204.3,0ZM163.5,296.3V112.4l122.6,91.9Z" transform="translate(0 0)"></path>
                </svg></div>
            </div>
          </div>
        </div>
        <div id="HEADLINE2070" class="ladi-element">
          <h3 class="ladi-headline">Là một mỹ phẩm với nhiều ưu điểm vượt trội nhưng sử dụng lại siêu đơn giản và tiết kiệt thời gian chỉ vỏn vọn 5 phút thôi là bạn đã hoàn thành quá trình tẩy - triệt lông vĩnh viễn nhé</h3>
        </div>
        <div id="GROUP2122" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2123" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2124" class="ladi-element">
              <h3 class="ladi-headline">05 bước sử dụng kem hiệu quả</h3>
            </div>
          </div>
        </div>
        <div id="IMAGE2237" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2222" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="GROUP2238" class="ladi-element">
          <div class="ladi-group">
            <div id="BOX2239" class="ladi-element">
              <div class="ladi-box"></div>
            </div>
            <div id="HEADLINE2240" class="ladi-element">
              <h3 class="ladi-headline">KHÁCH HÀNG ĐÃ SỬ DỤNG KEM TẨY LÔNG HUYỀN PHI</h3>
            </div>
          </div>
        </div>
        <div data-action="true" id="BUTTON2467" class="ladi-element ladi-animation">
          <div class="ladi-button">
            <div class="ladi-button-background"></div>
            <div id="BUTTON_TEXT2467" class="ladi-element">
              <p class="ladi-headline">MUA NGAY</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2431" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="IMAGE2432" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2433" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2434" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2435" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2436" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2437" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="GROUP2438" class="ladi-element">
          <div class="ladi-group">
            <div id="HEADLINE2439" class="ladi-element">
              <h3 class="ladi-headline"><span style="font-weight: 700;">TẨY LÔNG PERFECT CLEAN</span></h3>
            </div>
            <div id="HEADLINE2440" class="ladi-element">
              <h3 class="ladi-headline"><span style="font-weight: normal;">TRIỆT MỌI LOẠI LÔNG CẢ LÔNG NÁCH, BIKINl</span><br></h3>
            </div>
            <div id="LINE2441" class="ladi-element">
              <div class="ladi-line">
                <div class="ladi-line-container"></div>
              </div>
            </div>
          </div>
        </div>
        <div id="IMAGE2442" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2443" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2444" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2445" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="IMAGE2446" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION1452" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="CAROUSEL1624" class="ladi-element" data-scrolled="true" data-next-time="1624472131040" data-is-next="false" data-current="3">
          <div class="ladi-carousel">
            <div class="ladi-carousel-content" style="left: -1238.5px;">
              <div id="IMAGE1625" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1634" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1635" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1636" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1633" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1632" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1631" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1630" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1628" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1627" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE1629" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE2241" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE2242" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE2243" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
              <div id="IMAGE2244" class="ladi-element">
                <div class="ladi-image">
                  <div class="ladi-image-background"></div>
                </div>
              </div>
            </div>
            <div class="ladi-carousel-arrow ladi-carousel-arrow-left"></div>
            <div class="ladi-carousel-arrow ladi-carousel-arrow-right"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2245" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="BOX2246" class="ladi-element">
          <div class="ladi-box"></div>
        </div>
        <div id="HEADLINE2247" class="ladi-element">
          <h3 class="ladi-headline">MUA 1 TẶNG 1</h3>
        </div>
        <div id="GROUP2248" class="ladi-element">
          <div class="ladi-group">
            <div id="HEADLINE2249" class="ladi-element">
              <h3 class="ladi-headline">Giá tiết kiệm 40%:</h3>
            </div>
            <div id="HEADLINE2250" class="ladi-element">
              <h3 class="ladi-headline"><span class="ladipage-animated-headline rotate-3 letters"><span class="ladipage-animated-words-wrapper" data-word="[&quot;280.000VND&quot;]" style="width: 144px;"><b class="is-visible" style="opacity: 1;"><i class="out">2</i><i class="out">8</i><i class="out">0</i><i class="out">.</i><i class="out">0</i><i class="out">0</i><i class="out">0</i><i class="out">v</i><i class="out">n</i><i class="out">d</i></b><b style="opacity: 1;"><i class="in">2</i><i class="in">8</i><i class="in">0</i><i class="in">.</i><i class="in">0</i><i class="in">0</i><i class="in">0</i><i class="in">V</i><i class="in">N</i><i class="in">D</i></b></span></span></h3>
            </div>
          </div>
        </div>
        <div id="HEADLINE2251" class="ladi-element">
          <h3 class="ladi-headline">Tặng Kèm Serum Triệt lông Huyền Phi Trị Giá 180.000 vnđ</h3>
        </div>
        <div id="HEADLINE2252" class="ladi-element">
          <h3 class="ladi-headline">Chỉ Áp Dụng cho 99 KH Đầu Tiên</h3>
        </div>
        <div id="IMAGE2253" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="HEADLINE2254" class="ladi-element">
          <h3 class="ladi-headline">Giá cũ <span style="text-decoration-line: line-through;">460.000đ</span></h3>
        </div>
        <div id="IMAGE2255" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
        <div id="GROUP2256" class="ladi-element">
          <div class="ladi-group">
            <div id="GROUP2257" class="ladi-element">
              <div class="ladi-group">
                <div id="COUNTDOWN2258" class="ladi-element" data-type="countdown" data-minute="720" data-date-start="0" data-date-end="1624511865733">
                  <div class="ladi-countdown">
                    <div id="COUNTDOWN_ITEM2259" class="ladi-element" data-item-type="day">
                      <div class="ladi-countdown-background"></div>
                      <div class="ladi-countdown-text"><span>00</span></div>
                    </div>
                    <div id="COUNTDOWN_ITEM2260" class="ladi-element" data-item-type="hour">
                      <div class="ladi-countdown-background"></div>
                      <div class="ladi-countdown-text"><span>11</span></div>
                    </div>
                    <div id="COUNTDOWN_ITEM2261" class="ladi-element" data-item-type="minute">
                      <div class="ladi-countdown-background"></div>
                      <div class="ladi-countdown-text"><span>02</span></div>
                    </div>
                    <div id="COUNTDOWN_ITEM2262" class="ladi-element" data-item-type="seconds">
                      <div class="ladi-countdown-background"></div>
                      <div class="ladi-countdown-text"><span>19</span></div>
                    </div>
                  </div>
                </div>
                <div id="HEADLINE2263" class="ladi-element">
                  <h3 class="ladi-headline">Ngày</h3>
                </div>
                <div id="HEADLINE2264" class="ladi-element">
                  <h3 class="ladi-headline">Giờ</h3>
                </div>
                <div id="HEADLINE2265" class="ladi-element">
                  <h3 class="ladi-headline">Phút</h3>
                </div>
                <div id="HEADLINE2266" class="ladi-element">
                  <h3 class="ladi-headline">Giây</h3>
                </div>
              </div>
            </div>
            <div id="HEADLINE2267" class="ladi-element">
              <h3 class="ladi-headline">Ưu đãi sẽ kết thúc sau</h3>
            </div>
          </div>
        </div>
        <div id="HEADLINE2268" class="ladi-element">
          <h3 class="ladi-headline">Số lượng chỉ còn:</h3>
        </div>
        <div id="HEADLINE2269" class="ladi-element">
          <h3 class="ladi-headline">20</h3>
        </div>
        <div id="FORM2181" data-config-id="5f108abe59873679af1a6575" class="ladi-element">
          <form autocomplete="off" method="post" class="ladi-form-custom">
            <div id="BUTTON2182" class="ladi-element">
              <div class="ladi-button">
                <div class="ladi-button-background"></div>
                <div id="BUTTON_TEXT2182" class="ladi-element">
                  <p onclick="outsideForm($(this))" class="ladi-headline">MUA NGAY</p>
                </div>
              </div>
            </div>
            <div id="FORM_ITEM2184" class="ladi-element">
              <div class="ladi-form-custom-item-container">
                <div class="ladi-form-custom-item-background"></div>
                <div class="ladi-form-custom-item"><input autocomplete="off" tabindex="1" name="name" required class="ladi-form-custom-control" type="text" placeholder="Họ và tên" value=""></div>
              </div>
            </div>
            <div id="FORM_ITEM2185" class="ladi-element">
              <div class="ladi-form-custom-item-container">
                <div class="ladi-form-custom-item-background"></div>
                <div class="ladi-form-custom-item"><input id="outside-p-0" autocomplete="off" tabindex="2" name="phone" required class="ladi-form-custom-control" type="tel" placeholder="Số điện thoại" pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}" value=""></div>
              </div>
            </div>
            <div id="FORM_ITEM2186" class="ladi-element">
              <div class="ladi-form-custom-item-container">
                <div class="ladi-form-custom-item-background"></div>
                <div class="ladi-form-custom-item"><input autocomplete="off" tabindex="3" name="address" required class="ladi-form-custom-control" type="text" placeholder="Địa chỉ" value=""></div>
              </div>
            </div>
            <div id="FORM_ITEM2272" class="ladi-element">
              <div class="ladi-form-custom-item-container">
                <div class="ladi-form-custom-item-background"></div>
                <div class="ladi-form-custom-item"><textarea autocomplete="off" tabindex="4" name="message" class="ladi-form-custom-control" placeholder="Ghi chú (hoặc mã KM nếu có)"></textarea></div>
              </div>
            </div>
            <div id="FORM_ITEM2288" class="ladi-element">
              <div class="ladi-form-custom-item-container">
                <div class="ladi-form-custom-item-background"></div>
                <div class="ladi-form-custom-item"><input id="outside-p-1" autocomplete="off" tabindex="5" name="form_item2288" class="ladi-form-custom-control" type="tel" placeholder="Nhập lại số điện thoại" value=""></div>
              </div>
            </div><button type="submit" id="submit-outside" class="ladi-hidden"></button>
          </form>
        </div>
      </div>
    </div>
    <div id="SECTION1656" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="HEADLINE1669" class="ladi-element">
          <h3 class="ladi-headline">CHÍNH SÁCH GIAO HÀNG</h3>
        </div>
        <div id="GROUP1699" class="ladi-element">
          <div class="ladi-group">
            <div id="HEADLINE1660" class="ladi-element">
              <h6 class="ladi-headline">GIAO HÀNG TẠI NHÀ - ĐỔI TRẢ&nbsp;</h6>
            </div>
            <div id="SHAPE1661" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 24 24" fill="rgba(179, 100, 17, 1.0)">
                  <path d="M12,6V9L16,5L12,1V4A8,8 0 0,0 4,12C4,13.57 4.46,15.03 5.24,16.26L6.7,14.8C6.25,13.97 6,13 6,12A6,6 0 0,1 12,6M18.76,7.74L17.3,9.2C17.74,10.04 18,11 18,12A6,6 0 0,1 12,18V15L8,19L12,23V20A8,8 0 0,0 20,12C20,10.43 19.54,8.97 18.76,7.74Z"></path>
                </svg></div>
            </div>
            <div id="PARAGRAPH1662" class="ladi-element">
              <p class="ladi-paragraph">Giao hàng tại nhà . Nhận hàng kiểm tra hàng tại chỗ. Khách hàng có quyền đổi trả nếu không đúng với giới thiệu sản phẩm</p>
            </div>
            <div id="PARAGRAPH1663" class="ladi-element">
              <p class="ladi-paragraph">Chúng tôi hỗ trợ vận chuyển giao hàng tại nhà đến tận tay khách hàng dù bạn ở bất kỳ nơi đâu tại Việt Nam</p>
            </div>
            <div id="SHAPE1664" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 24 24" fill="rgba(179, 100, 17, 1.0)">
                  <path d="M16.36,4.27H18.55V2.13H16.36V1.07H18.22C17.89,0.43 17.13,0 16.36,0C15.16,0 14.18,0.96 14.18,2.13C14.18,3.31 15.16,4.27 16.36,4.27M10.04,9.39L13,6.93L17.45,9.6H10.25M19.53,12.05L21.05,10.56C21.93,9.71 21.93,8.43 21.05,7.57L19.2,9.39L13.96,4.27C13.64,3.73 13,3.41 12.33,3.41C11.78,3.41 11.35,3.63 11,3.95L7,7.89C6.65,8.21 6.44,8.64 6.44,9.17V9.71H5.13C4.04,9.71 3.16,10.67 3.16,11.84V12.27C3.5,12.16 3.93,12.16 4.25,12.16C7.09,12.16 9.5,14.4 9.5,17.28C9.5,17.6 9.5,18.03 9.38,18.35H14.5C14.4,18.03 14.4,17.6 14.4,17.28C14.4,14.29 16.69,12.05 19.53,12.05M4.36,19.73C2.84,19.73 1.64,18.56 1.64,17.07C1.64,15.57 2.84,14.4 4.36,14.4C5.89,14.4 7.09,15.57 7.09,17.07C7.09,18.56 5.89,19.73 4.36,19.73M4.36,12.8C1.96,12.8 0,14.72 0,17.07C0,19.41 1.96,21.33 4.36,21.33C6.76,21.33 8.73,19.41 8.73,17.07C8.73,14.72 6.76,12.8 4.36,12.8M19.64,19.73C18.11,19.73 16.91,18.56 16.91,17.07C16.91,15.57 18.11,14.4 19.64,14.4C21.16,14.4 22.36,15.57 22.36,17.07C22.36,18.56 21.16,19.73 19.64,19.73M19.64,12.8C17.24,12.8 15.27,14.72 15.27,17.07C15.27,19.41 17.24,21.33 19.64,21.33C22.04,21.33 24,19.41 24,17.07C24,14.72 22.04,12.8 19.64,12.8Z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE1665" class="ladi-element">
              <h6 class="ladi-headline">GIAO HÀNG TRÊN TOÀN QUỐC</h6>
            </div>
            <div id="HEADLINE1666" class="ladi-element">
              <h6 class="ladi-headline">XEM HÀNG TRƯỚC KHI THANH TOÁN</h6>
            </div>
            <div id="SHAPE1667" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 24 24" fill="rgba(179, 100, 17, 1.0)">
                  <path d="M20,11H4V8H20M20,13H13V12H20M20,15H13V14H20M20,17H13V16H20M20,19H13V18H20M12,19H4V12H12M20.33,4.67L18.67,3L17,4.67L15.33,3L13.67,4.67L12,3L10.33,4.67L8.67,3L7,4.67L5.33,3L3.67,4.67L2,3V19A2,2 0 0,0 4,21H20A2,2 0 0,0 22,19V3L20.33,4.67Z"></path>
                </svg></div>
            </div>
            <div id="PARAGRAPH1668" class="ladi-element">
              <p class="ladi-paragraph">Khách hàng được quyền kiểm tra hàng trước khi thanh toán để đảm bảo quyền lợi chính mình. Bạn có thể yêu cầu với nhân viên giao hàng khi cần thiết</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION1653" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="IMAGE1654" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION2289" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="HEADLINE2290" class="ladi-element">
          <h3 class="ladi-headline">3863 Bình Luận</h3>
        </div>
        <div id="HEADLINE2291" class="ladi-element">
          <h3 class="ladi-headline">Sắp xếp theo</h3>
        </div>
        <div id="BOX2292" class="ladi-element">
          <div class="ladi-box"></div>
        </div>
        <div id="SHAPE2293" class="ladi-element">
          <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1055.1139 1896.0833" fill="#000">
              <path d="M1024 1088q0 26-19 45l-448 448q-19 19-45 19t-45-19L19 1133q-19-19-19-45t19-45 45-19h896q26 0 45 19t19 45zm0-384q0 26-19 45t-45 19H64q-26 0-45-19T0 704t19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z"></path>
            </svg></div>
        </div>
        <div id="HEADLINE2294" class="ladi-element">
          <h3 class="ladi-headline">Hàng đầu</h3>
        </div>
        <div id="LINE2295" class="ladi-element">
          <div class="ladi-line">
            <div class="ladi-line-container"></div>
          </div>
        </div>
        <div id="GROUP2296" class="ladi-element">
          <div class="ladi-group">
            <div id="IMAGE2297" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2298" class="ladi-element">
              <p class="ladi-headline">Cô gái răng khểnh</p>
            </div>
            <div id="PARAGRAPH2299" class="ladi-element">
              <p class="ladi-paragraph">H ơi, cho mình hỏi cái serum triệt lông đó ngày nào cũng bôi hay sao nhỉ, mình tẩy được 1 lần và bôi 5 lần rồi thấy lông mọc ít hơn hẳn, sẽ giới thiệu cho H nhé &lt;3</p>
            </div>
            <div id="HEADLINE2300" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2301" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="SHAPE2302" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2303" class="ladi-element">
              <p class="ladi-headline">2</p>
            </div>
            <div id="HEADLINE2304" class="ladi-element">
              <p class="ladi-headline">3 ngày trước</p>
            </div>
            <div id="IMAGE2305" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2306" class="ladi-element">
              <p class="ladi-headline">Huyền Phi Cosmetics</p>
            </div>
            <div id="PARAGRAPH2307" class="ladi-element">
              <p class="ladi-paragraph">2-3 ngày bôi 1 lần cũng đc bạn nhé</p>
            </div>
            <div id="SHAPE2308" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1792 1896.0833" fill="rgba(203, 33, 24, 1.0)">
                  <path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2309" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2310" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="HEADLINE2311" class="ladi-element">
              <p class="ladi-headline">2 ngày trước</p>
            </div>
            <div id="HEADLINE2312" class="ladi-element">
              <p class="ladi-headline">1</p>
            </div>
            <div id="IMAGE2313" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2314" class="ladi-element">
              <p class="ladi-headline">Trần Thị Ngọc Bích</p>
            </div>
            <div id="PARAGRAPH2315" class="ladi-element">
              <p class="ladi-paragraph">Shop ơi giờ mình mua còn giá 280k tặng serum triệt lông vĩnh viễn và miễn phí ship ko? Mình có đứa bạn cũng mới mua bên shop</p>
            </div>
            <div id="HEADLINE2316" class="ladi-element">
              <p class="ladi-headline">2 ngày trước</p>
            </div>
            <div id="HEADLINE2317" class="ladi-element">
              <p class="ladi-headline">Huyền Phi Cosmetics</p>
            </div>
            <div id="PARAGRAPH2318" class="ladi-element">
              <p class="ladi-paragraph">Vẫn đang còn KM bạn nhé, bạn mua hàng cho shop thông tin shop gửi hàng nha b&nbsp;</p>
            </div>
            <div id="HEADLINE2319" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2320" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="HEADLINE2321" class="ladi-element">
              <p class="ladi-headline">2 ngày trước</p>
            </div>
            <div id="SHAPE2322" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2323" class="ladi-element">
              <p class="ladi-headline">1</p>
            </div>
            <div id="HEADLINE2324" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2325" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="SHAPE2326" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2327" class="ladi-element">
              <p class="ladi-headline">2</p>
            </div>
            <div id="IMAGE2328" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="SHAPE2329" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1792 1896.0833" fill="rgba(203, 33, 24, 1.0)">
                  <path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"></path>
                </svg></div>
            </div>
            <div id="SHAPE2330" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="IMAGE2331" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2332" class="ladi-element">
              <p class="ladi-headline">Thu Thảo</p>
            </div>
            <div id="PARAGRAPH2333" class="ladi-element">
              <p class="ladi-paragraph">Sản phẩm tẩy lông của shop tốt nè, e dùng nhiều loại lắm mà ko ưng, trước giờ toàn phải cạo mà cạo xong nhanh mọc lắm dùng xong combo của chị cả năm nay ko phải sợ lông nữa</p>
            </div>
            <div id="HEADLINE2334" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2335" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="SHAPE2336" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2337" class="ladi-element">
              <p class="ladi-headline">12</p>
            </div>
            <div id="HEADLINE2338" class="ladi-element">
              <p class="ladi-headline">3 ngày trước</p>
            </div>
            <div id="IMAGE2339" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2340" class="ladi-element">
              <p class="ladi-headline">Huyền Phi Cosmetics</p>
            </div>
            <div id="PARAGRAPH2341" class="ladi-element">
              <p class="ladi-paragraph">Cảm ơn em iu, giới thiệu sản phẩm giúp chị nhé&nbsp;</p>
            </div>
            <div id="SHAPE2342" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1792 1896.0833" fill="rgba(203, 33, 24, 1.0)">
                  <path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2343" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2344" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="HEADLINE2345" class="ladi-element">
              <p class="ladi-headline">2 ngày trước</p>
            </div>
            <div id="SHAPE2346" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2347" class="ladi-element">
              <p class="ladi-headline">1</p>
            </div>
          </div>
        </div>
        <div id="GROUP2348" class="ladi-element">
          <div class="ladi-group">
            <div id="IMAGE2349" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2350" class="ladi-element">
              <p class="ladi-headline">Yến Phùng</p>
            </div>
            <div id="PARAGRAPH2351" class="ladi-element">
              <p class="ladi-paragraph">Tẩy lông này dùng tốt chị ạ, e mua mà cả con bé e em cũng dùng nữa. Cái tẩy lông này tẩy xong rồi da có sáng hoặc mờ thâm không chị , e mua hộ bạn e 1 set thì có được giảm giá ko ạ ^^</p>
            </div>
            <div id="HEADLINE2352" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2353" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="SHAPE2354" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2355" class="ladi-element">
              <p class="ladi-headline">2</p>
            </div>
            <div id="HEADLINE2356" class="ladi-element">
              <p class="ladi-headline">3 ngày trước</p>
            </div>
            <div id="IMAGE2357" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2358" class="ladi-element">
              <p class="ladi-headline">Huyền Phi Cosmetics</p>
            </div>
            <div id="PARAGRAPH2359" class="ladi-element">
              <p class="ladi-paragraph">Cảm ơn em nè, e inb cho chị nhé&nbsp;</p>
            </div>
            <div id="SHAPE2360" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1792 1896.0833" fill="rgba(203, 33, 24, 1.0)">
                  <path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2361" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2362" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="HEADLINE2363" class="ladi-element">
              <p class="ladi-headline">2 ngày trước</p>
            </div>
            <div id="HEADLINE2364" class="ladi-element">
              <p class="ladi-headline">1</p>
            </div>
            <div id="IMAGE2365" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2366" class="ladi-element">
              <p class="ladi-headline">Lê Thị Hồng</p>
            </div>
            <div id="PARAGRAPH2367" class="ladi-element">
              <p class="ladi-paragraph">Shop ơi giờ lấy chị 1c, cho chị hỏi còn giá 280k và tặng serum ko? Chị ở Phú Yên thì mấy ngày nhận được hàng, gửi nhanh cho chị đc ko?</p>
            </div>
            <div id="HEADLINE2368" class="ladi-element">
              <p class="ladi-headline">1 ngày trước</p>
            </div>
            <div id="HEADLINE2369" class="ladi-element">
              <p class="ladi-headline">Huyền Phi Cosmetics</p>
            </div>
            <div id="PARAGRAPH2370" class="ladi-element">
              <p class="ladi-paragraph">Vẫn đang còn KM chị nhé,2-3 ngày chị nhận đc hàng, c mua hàng cho shop thông tin shop gửi hàng nha c&nbsp;</p>
            </div>
            <div id="HEADLINE2371" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2372" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="HEADLINE2373" class="ladi-element">
              <p class="ladi-headline">1 ngày trước</p>
            </div>
            <div id="SHAPE2374" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2375" class="ladi-element">
              <p class="ladi-headline">1</p>
            </div>
            <div id="HEADLINE2376" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2377" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="SHAPE2378" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2379" class="ladi-element">
              <p class="ladi-headline">2</p>
            </div>
            <div id="IMAGE2380" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="SHAPE2381" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1792 1896.0833" fill="rgba(203, 33, 24, 1.0)">
                  <path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"></path>
                </svg></div>
            </div>
            <div id="SHAPE2382" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="IMAGE2383" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2384" class="ladi-element">
              <p class="ladi-headline">HOÀNG PINK</p>
            </div>
            <div id="PARAGRAPH2385" class="ladi-element">
              <p class="ladi-paragraph">Chị ơi cái tẩy lông này có dùng được cho lông nách, vùng nhạy cảm ko ạ, thấy đứa bạn e dùng cho chân tay thì ok nhưng ko biết các vùng khác thì sao ạ</p>
            </div>
            <div id="HEADLINE2386" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2387" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="SHAPE2388" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2389" class="ladi-element">
              <p class="ladi-headline">5</p>
            </div>
            <div id="HEADLINE2390" class="ladi-element">
              <p class="ladi-headline">6 ngày trước</p>
            </div>
            <div id="IMAGE2391" class="ladi-element">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </div>
            <div id="HEADLINE2392" class="ladi-element">
              <p class="ladi-headline">Huyền Phi Cosmetics</p>
            </div>
            <div id="PARAGRAPH2393" class="ladi-element">
              <p class="ladi-paragraph">Vùng nhạy cảm và lông nách e để trên da 5-10 phút nha e do lông đó cứng</p>
            </div>
            <div id="SHAPE2394" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1792 1896.0833" fill="rgba(203, 33, 24, 1.0)">
                  <path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2395" class="ladi-element">
              <p class="ladi-headline">Thích</p>
            </div>
            <div id="HEADLINE2396" class="ladi-element">
              <p class="ladi-headline">Phản hồi</p>
            </div>
            <div id="HEADLINE2397" class="ladi-element">
              <p class="ladi-headline">6 ngày trước</p>
            </div>
            <div id="SHAPE2398" class="ladi-element">
              <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" fill="#4267b2">
                  <path d="M256 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm1152-576q0-51-39-89.5t-89-38.5H928q0-58 48-159.5t48-160.5q0-98-32-145t-128-47q-26 26-38 85t-30.5 125.5T736 448q-22 23-77 91-4 5-23 30t-31.5 41-34.5 42.5-40 44-38.5 35.5-40 27-35.5 9h-32v640h32q13 0 31.5 3t33 6.5 38 11 35 11.5 35.5 12.5 29 10.5q211 73 342 73h121q192 0 192-167 0-26-5-56 30-16 47.5-52.5t17.5-73.5-18-69q53-50 53-119 0-25-10-55.5t-25-47.5q32-1 53.5-47t21.5-81zm128-1q0 89-49 163 9 33 9 69 0 77-38 144 3 21 3 43 0 101-60 178 1 139-85 219.5t-227 80.5H960q-96 0-189.5-22.5T554 1576q-116-40-138-40H128q-53 0-90.5-37.5T0 1408V768q0-53 37.5-90.5T128 640h274q36-24 137-155 58-75 107-128 24-25 35.5-85.5T712 145t62-108q39-37 90-37 84 0 151 32.5T1117 134t35 186q0 93-48 192h176q104 0 180 76t76 179z"></path>
                </svg></div>
            </div>
            <div id="HEADLINE2399" class="ladi-element">
              <p class="ladi-headline">1</p>
            </div>
          </div>
        </div>
        <div id="HEADLINE2400" class="ladi-element">
          <h3 class="ladi-headline">BÌNH LUẬN</h3>
        </div><a href="http://m.me/Huy%E1%BB%81n-Phi-Cosmetics-816055575240190/" target="_blank" id="BUTTON2401" class="ladi-element" data-replace-href="http://m.me/Huy%E1%BB%81n-Phi-Cosmetics-816055575240190/">
          <div class="ladi-button">
            <div class="ladi-button-background"></div>
            <div id="BUTTON_TEXT2401" class="ladi-element">
              <p class="ladi-headline">TẢI THÊM BÌNH LUẬN</p>
            </div>
          </div>
        </a><a href="tel:0330299070" id="SHAPE2403" class="ladi-element">
          <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" class="" fill="rgba(66, 104, 178, 1.0)">
              <path d="M1280 1193q0-11-2-16-3-8-38.5-29.5T1151 1098l-53-29q-5-3-19-13t-25-15-21-5q-18 0-47 32.5t-57 65.5-44 33q-7 0-16.5-3.5T853 1157t-17-9.5-14-8.5q-99-55-170.5-126.5T525 842q-2-3-8.5-14t-9.5-17-6.5-15.5T497 779q0-13 20.5-33.5t45-38.5 45-39.5T628 631q0-10-5-21t-15-25-13-19q-3-6-15-28.5T555 492t-26.5-47.5-25-40.5-16.5-18-16-2q-48 0-101 22-46 21-80 94.5T256 631q0 16 2.5 34t5 30.5 9 33 10 29.5 12.5 33 11 30q60 164 216.5 320.5T843 1358q6 2 30 11t33 12.5 29.5 10 33 9 30.5 5 34 2.5q57 0 130.5-34t94.5-80q22-53 22-101zm256-777v960q0 119-84.5 203.5T1248 1664H288q-119 0-203.5-84.5T0 1376V416q0-119 84.5-203.5T288 128h960q119 0 203.5 84.5T1536 416z"></path>
            </svg></div>
        </a>
      </div>
    </div>
    <div id="SECTION2404" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="GROUP2405" class="ladi-element">
          <div class="ladi-group">
            <div id="FRAME2406" class="ladi-element">
              <div class="ladi-frame">
                <div class="ladi-frame-background"></div>
                <div id="IMAGE2407" class="ladi-element">
                  <div class="ladi-image">
                    <div class="ladi-image-background"></div>
                  </div>
                </div>
                <div id="IMAGE2408" class="ladi-element">
                  <div class="ladi-image">
                    <div class="ladi-image-background"></div>
                  </div>
                </div>
                <div id="IMAGE2409" class="ladi-element">
                  <div class="ladi-image">
                    <div class="ladi-image-background"></div>
                  </div>
                </div>
              </div>
            </div>
            <div id="GROUP2410" class="ladi-element">
              <div class="ladi-group">
                <div id="HEADLINE2411" class="ladi-element">
                  <h4 class="ladi-headline">MY PHẨM THIÊN NHIÊN HUYỀN PHI</h4>
                </div>
                <div id="GROUP2412" class="ladi-element">
                  <div class="ladi-group">
                    <div id="SHAPE2413" class="ladi-element">
                      <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 24 24" fill="rgba(5, 31, 77, 1)">
                          <path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z"></path>
                        </svg></div>
                    </div>
                    <div id="HEADLINE2414" class="ladi-element">
                      <p class="ladi-headline">Tầng 6, tòa nhà Sky City, 88 Láng Hạ, Láng Hạ, Đống Đa, Hà Nội<br></p>
                    </div>
                  </div>
                </div>
                <div id="GROUP2415" class="ladi-element">
                  <div class="ladi-group">
                    <div id="SHAPE2416" class="ladi-element">
                      <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 24 24" fill="rgba(5, 31, 77, 1)">
                          <path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"></path>
                        </svg></div>
                    </div>
                    <div id="HEADLINE2417" class="ladi-element">
                      <p class="ladi-headline">Hotline: 0947468921</p>
                    </div>
                  </div>
                </div>
                <div id="GROUP2418" class="ladi-element">
                  <div class="ladi-group">
                    <div id="SHAPE2419" class="ladi-element">
                      <div class="ladi-shape"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 24 24" fill="rgba(5, 31, 77, 1)">
                          <path d="M20,4H4A2,2 0 0,0 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6A2,2 0 0,0 20,4M20,18H4V8L12,13L20,8V18M20,6L12,11L4,6V6H20V6Z"></path>
                        </svg></div>
                    </div>
                    <div id="HEADLINE2420" class="ladi-element">
                      <p class="ladi-headline">Email: info@huyenphicosmetic.com</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="HEADLINE2424" class="ladi-element">
          <h1 class="ladi-headline">©2020 Allrights reserved Huyền Phi Cosmetics</h1>
        </div>
        <div id="HEADLINE2425" class="ladi-element">
          <h4 class="ladi-headline">CÁC SẢN PHẨM KHÁC HUYỀN PHI</h4>
        </div>
        <div id="GROUP2426" class="ladi-element">
          <div class="ladi-group"><a href="https://www.huyenphicos.com/u-tao-alota" target="_blank" id="IMAGE2427" class="ladi-element" data-replace-href="https://www.huyenphicos.com/u-tao-alota">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </a><a href="https://www.huyenphicos.com/tam-trang-tb" target="_blank" id="IMAGE2428" class="ladi-element" data-replace-href="https://www.huyenphicos.com/tam-trang-tb">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </a><a href="https://www.huyenphicos.com/kemfacenano" target="_blank" id="IMAGE2429" class="ladi-element" data-replace-href="https://www.huyenphicos.com/kemfacenano">
              <div class="ladi-image">
                <div class="ladi-image-background"></div>
              </div>
            </a></div>
        </div>
        <div id="LINE2430" class="ladi-element">
          <div class="ladi-line">
            <div class="ladi-line-container"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="SECTION_POPUP" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container">
        <div id="POPUP1032" class="ladi-element" data-popup-backdrop="true" style="">
          <div class="ladi-popup">
            <div class="ladi-popup-background"></div>
            <div id="HEADLINE1044" class="ladi-element">
              <h3 class="ladi-headline">ĐĂNG KÝ ĐẶT HÀNG</h3>
            </div>
            <div id="HEADLINE1485" class="ladi-element">
              <h3 class="ladi-headline">Vui lòng điền đầy đủ thông tin dưới đây</h3>
            </div>
            <div id="FORM1486" data-config-id="5f108abe59873679af1a6575" class="ladi-element">
              <form autocomplete="off" method="post" class="ladi-form-custom">
                <div id="BUTTON1487" class="ladi-element">
                  <div class="ladi-button">
                    <div class="ladi-button-background"></div>
                    <div id="BUTTON_TEXT1487" class="ladi-element">
                      <p onclick="insideForm($(this))" class="ladi-headline">MUA NGAY</p>
                    </div>
                  </div>
                </div>
                <div id="FORM_ITEM1488" class="ladi-element">
                  <div class="ladi-form-custom-item-container">
                    <div class="ladi-form-custom-item-background"></div>
                    <div class="ladi-form-custom-item"><input autocomplete="off" tabindex="6" name="name" required class="ladi-form-custom-control" type="text" placeholder="Họ và tên" value=""></div>
                  </div>
                </div>
                <div id="FORM_ITEM1492" class="ladi-element">
                  <div class="ladi-form-custom-item-container">
                    <div class="ladi-form-custom-item-background"></div>
                    <div class="ladi-form-custom-item"><input id="inside-p-0" autocomplete="off" tabindex="7" name="phone" required class="ladi-form-custom-control" type="tel" placeholder="Số điện thoại" pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}" value=""></div>
                  </div>
                </div>
                <div id="FORM_ITEM1493" class="ladi-element">
                  <div class="ladi-form-custom-item-container">
                    <div class="ladi-form-custom-item-background"></div>
                    <div class="ladi-form-custom-item"><input autocomplete="off" tabindex="8" name="address" required class="ladi-form-custom-control" type="text" placeholder="Địa chỉ" value=""></div>
                  </div>
                </div>
                <div id="FORM_ITEM1494" class="ladi-element">
                  <div class="ladi-form-custom-item-container">
                    <div class="ladi-form-custom-item-background"></div>
                    <div class="ladi-form-custom-item"><input data-is-select-country="true" tabindex="9" type="hidden" name="country" value="VN:Việt Nam"><select tabindex="9" name="state" class="ladi-form-custom-control ladi-form-custom-control-select ladi-form-custom-control-select-3" data-selected="204:Đồng Nai" data-is-select-country="true" data-country="VN">
                        <option value="">Tỉnh/thành</option>
                        <option value="201:Hà Nội">Hà Nội</option>
                        <option value="202:Hồ Chí Minh">Hồ Chí Minh</option>
                        <option value="203:Đà Nẵng">Đà Nẵng</option>
                        <option value="204:Đồng Nai">Đồng Nai</option>
                        <option value="205:Bình Dương">Bình Dương</option>
                        <option value="206:Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                        <option value="207:Gia Lai">Gia Lai</option>
                        <option value="208:Khánh Hòa">Khánh Hòa</option>
                        <option value="209:Lâm Đồng">Lâm Đồng</option>
                        <option value="210:Đắk Lắk">Đắk Lắk</option>
                        <option value="211:Long An">Long An</option>
                        <option value="212:Tiền Giang">Tiền Giang</option>
                        <option value="213:Bến Tre">Bến Tre</option>
                        <option value="214:Trà Vinh">Trà Vinh</option>
                        <option value="215:Vĩnh Long">Vĩnh Long</option>
                        <option value="216:Đồng Tháp">Đồng Tháp</option>
                        <option value="217:An Giang">An Giang</option>
                        <option value="218:Sóc Trăng">Sóc Trăng</option>
                        <option value="219:Kiên Giang">Kiên Giang</option>
                        <option value="220:Cần Thơ">Cần Thơ</option>
                        <option value="221:Vĩnh Phúc">Vĩnh Phúc</option>
                        <option value="223:Thừa Thiên - Huế">Thừa Thiên - Huế</option>
                        <option value="224:Hải Phòng">Hải Phòng</option>
                        <option value="225:Hải Dương">Hải Dương</option>
                        <option value="226:Thái Bình">Thái Bình</option>
                        <option value="227:Hà Giang">Hà Giang</option>
                        <option value="228:Tuyên Quang">Tuyên Quang</option>
                        <option value="229:Phú Thọ">Phú Thọ</option>
                        <option value="230:Quảng Ninh">Quảng Ninh</option>
                        <option value="231:Nam Định">Nam Định</option>
                        <option value="232:Hà Nam">Hà Nam</option>
                        <option value="233:Ninh Bình">Ninh Bình</option>
                        <option value="234:Thanh Hóa">Thanh Hóa</option>
                        <option value="235:Nghệ An">Nghệ An</option>
                        <option value="236:Hà Tĩnh">Hà Tĩnh</option>
                        <option value="237:Quảng Bình">Quảng Bình</option>
                        <option value="238:Quảng Trị">Quảng Trị</option>
                        <option value="239:Bình Phước">Bình Phước</option>
                        <option value="240:Tây Ninh">Tây Ninh</option>
                        <option value="241:Đắk Nông">Đắk Nông</option>
                        <option value="242:Quảng Ngãi">Quảng Ngãi</option>
                        <option value="243:Quảng Nam">Quảng Nam</option>
                        <option value="244:Thái Nguyên">Thái Nguyên</option>
                        <option value="245:Bắc Kạn">Bắc Kạn</option>
                        <option value="246:Cao Bằng">Cao Bằng</option>
                        <option value="247:Lạng Sơn">Lạng Sơn</option>
                        <option value="248:Bắc Giang">Bắc Giang</option>
                        <option value="249:Bắc Ninh">Bắc Ninh</option>
                        <option value="250:Hậu Giang">Hậu Giang</option>
                        <option value="252:Cà Mau">Cà Mau</option>
                        <option value="253:Bạc Liêu">Bạc Liêu</option>
                        <option value="257:Đồng Tháp">Đồng Tháp</option>
                        <option value="258:Bình Thuận">Bình Thuận</option>
                        <option value="259:Kon Tum">Kon Tum</option>
                        <option value="260:Phú Yên">Phú Yên</option>
                        <option value="261:Ninh Thuận">Ninh Thuận</option>
                        <option value="262:Bình Định">Bình Định</option>
                        <option value="263:Yên Bái">Yên Bái</option>
                        <option value="264:Lai Châu">Lai Châu</option>
                        <option value="265:Điện Biên">Điện Biên</option>
                        <option value="266:Sơn La">Sơn La</option>
                        <option value="267:Hòa Bình">Hòa Bình</option>
                        <option value="268:Hưng Yên">Hưng Yên</option>
                        <option value="269:Lào Cai">Lào Cai</option>
                      </select><select tabindex="9" name="district" class="ladi-form-custom-control ladi-form-custom-control-select ladi-form-custom-control-select-3" data-selected="1692:Thị xã Long Khánh" data-is-select-country="true">
                        <option value="">Quận/huyện</option>
                        <option value="1536:Thành phố Biên Hòa">Thành phố Biên Hòa</option>
                        <option value="1691:Huyện Trảng Bom">Huyện Trảng Bom</option>
                        <option value="1692:Thị xã Long Khánh">Thị xã Long Khánh</option>
                        <option value="1693:Huyện Tân Phú">Huyện Tân Phú</option>
                        <option value="1694:Huyện Long Thành">Huyện Long Thành</option>
                        <option value="1700:Huyện Định Quán">Huyện Định Quán</option>
                        <option value="1702:Huyện Cẩm Mỹ">Huyện Cẩm Mỹ</option>
                        <option value="1704:Huyện Xuân Lộc">Huyện Xuân Lộc</option>
                        <option value="1705:Huyện Thống Nhất">Huyện Thống Nhất</option>
                        <option value="1708:Huyện Nhơn Trạch">Huyện Nhơn Trạch</option>
                        <option value="2049:Huyện Vĩnh Cửu">Huyện Vĩnh Cửu</option>
                      </select><select tabindex="9" name="ward" class="ladi-form-custom-control ladi-form-custom-control-select ladi-form-custom-control-select-3" data-selected="6041:Phường Xuân An" data-is-select-country="true">
                        <option value="">Phường/xã</option>
                        <option value="6038:Phường Xuân Trung">Phường Xuân Trung</option>
                        <option value="6039:Phường Xuân Thanh">Phường Xuân Thanh</option>
                        <option value="6040:Phường Xuân Bình">Phường Xuân Bình</option>
                        <option value="6041:Phường Xuân An">Phường Xuân An</option>
                        <option value="6042:Phường Xuân Hoà">Phường Xuân Hoà</option>
                        <option value="6043:Phường Phú Bình">Phường Phú Bình</option>
                        <option value="6044:Xã Bình Lộc">Xã Bình Lộc</option>
                        <option value="6045:Xã Bảo Quang">Xã Bảo Quang</option>
                        <option value="6046:Xã Suối Tre">Xã Suối Tre</option>
                        <option value="6047:Xã Bảo Vinh">Xã Bảo Vinh</option>
                        <option value="6048:Xã Xuân Lập">Xã Xuân Lập</option>
                        <option value="6049:Xã Bàu Sen">Xã Bàu Sen</option>
                        <option value="6050:Xã Bàu Trâm">Xã Bàu Trâm</option>
                        <option value="6051:Xã Xuân Tân">Xã Xuân Tân</option>
                        <option value="6052:Xã Hàng Gòn">Xã Hàng Gòn</option>
                      </select></div>
                  </div>
                </div>
                <div id="FORM_ITEM2448" class="ladi-element">
                  <div class="ladi-form-custom-item-container">
                    <div class="ladi-form-custom-item-background"></div>
                    <div class="ladi-form-custom-item"><input id="inside-p-1" autocomplete="off" tabindex="11" name="form_item2448" class="ladi-form-custom-control" type="tel" placeholder="Nhập lại số điện thoại" value=""></div>
                  </div>
                </div>
                <div id="FORM_ITEM2449" class="ladi-element">
                  <div class="ladi-form-custom-item-container">
                    <div class="ladi-form-custom-item-background"></div>
                    <div class="ladi-form-custom-item"><input autocomplete="off" tabindex="11" name="message" class="ladi-form-custom-control" type="text" placeholder="Ghi chú, hoặc mã giảm giá nếu có" value=""></div>
                  </div>
                </div><button id="submit-inside" type="submit" class="ladi-hidden"></button>
              </form>
            </div>
          </div>
          <div class="popup-close" style="right: 945.5px; top: 344.5px; position: fixed;"></div>
        </div>
        <div id="POPUP2468" class="ladi-element" style="" data-popup-backdrop="true">
          <div class="ladi-popup">
            <div class="ladi-popup-background"></div>
            <div id="SPINLUCKY2469" class="ladi-element">
              <div class="ladi-spin-lucky">
                <div class="ladi-spin-lucky-screen">
                  <div class="ladi-spin-lucky-label" style="transform: rotate(-30deg) translateY(-50%); -webkit-transform: rotate(-30deg) translateY(-50%);">GIẢM 10k</div>
                  <div class="ladi-spin-lucky-label" style="transform: rotate(-90deg) translateY(-50%); -webkit-transform: rotate(-90deg) translateY(-50%);">GIẢM 15k</div>
                  <div class="ladi-spin-lucky-label" style="transform: rotate(-150deg) translateY(-50%); -webkit-transform: rotate(-150deg) translateY(-50%);">GIẢM 20K</div>
                  <div class="ladi-spin-lucky-label" style="transform: rotate(-210deg) translateY(-50%); -webkit-transform: rotate(-210deg) translateY(-50%);">THÊM 1 LƯỢT QUAY</div>
                  <div class="ladi-spin-lucky-label" style="transform: rotate(-270deg) translateY(-50%); -webkit-transform: rotate(-270deg) translateY(-50%);">CHÚC BẠN MAY MẮN</div>
                  <div class="ladi-spin-lucky-label" style="transform: rotate(-330deg) translateY(-50%); -webkit-transform: rotate(-330deg) translateY(-50%);">GIẢM 5K</div>
                </div>
                <div class="ladi-spin-lucky-start"></div>
              </div>
            </div>
            <div id="HEADLINE2470" class="ladi-element">
              <h3 class="ladi-headline">CHÚC MỪNG</h3>
            </div>
            <div id="HEADLINE2471" class="ladi-element">
              <h3 class="ladi-headline">BẠN NHẬN ĐƯỢC 1 LƯỢT QUAY MAY MẮN</h3>
            </div>
            <div id="PARAGRAPH2472" class="ladi-element">
              <p class="ladi-paragraph">Thể lệ : Mỗi khách hàng chỉ có 1 lượt quay. Cơ hội nhận mã giảm giá trực tiếp vào đơn hàng</p>
            </div>
          </div>
          <div class="popup-close" style="right: 933.5px; top: 387.5px; position: fixed;"></div>
        </div>
      </div>
    </div>
  </div>
  <div id="backdrop-popup" class="backdrop-popup"></div>
  <div id="lightbox-screen" class="lightbox-screen"></div>
  <!--[if lt IE 9]><script src="https://w.ladicdn.com/v2/source/html5shiv.min.js?v=1595232505699"></script><script src="https://w.ladicdn.com/v2/source/respond.min.js?v=1595232505699"></script><![endif]-->
  <link href="./index_files/css.css" rel="stylesheet" type="text/css">
  <link href="./index_files/ladipage.min.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./index_files/custom.js" type="text/javascript"></script>
  <script src="./index_files/ladipage.min.js" type="text/javascript"></script>
  <script id="script_event_data" type="text/javascript">
    (function() {
      var run = function() {
        if (typeof window.LadiPageScript == "undefined" || window.LadiPageScript == undefined || typeof window.ladi == "undefined" || window.ladi == undefined) {
          setTimeout(run, 100);
          return;
        }
        window.LadiPageApp = window.LadiPageApp || new window.LadiPageAppV2();
        window.LadiPageScript.runtime.ladipage_id = '5f1701621afd7730af49ec85';
        window.LadiPageScript.runtime.isMobileOnly = true;
        window.LadiPageScript.runtime.DOMAIN_SET_COOKIE = ["myphamviet.co"];
        window.LadiPageScript.runtime.DOMAIN_FREE = [];
        window.LadiPageScript.runtime.bodyFontSize = 12;
        window.LadiPageScript.runtime.time_zone = 7;
        window.LadiPageScript.runtime.currency = "VND";
        window.LadiPageScript.runtime.eventData = "%7B%22POPUP1032%22%3A%7B%22type%22%3A%22popup%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(0%2C%200%2C%200%2C%200.5)%3B%22%7D%2C%22VIDEO1415%22%3A%7B%22type%22%3A%22video%22%2C%22option.video_value%22%3A%22https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3D62Dc6Lyf3m4%22%2C%22option.video_type%22%3A%22youtube%22%2C%22option.video_control%22%3Atrue%7D%2C%22FORM1486%22%3A%7B%22type%22%3A%22form%22%2C%22option.form_config_id%22%3A%225f108abe59873679af1a6575%22%2C%22option.form_send_ladipage%22%3Atrue%2C%22option.thankyou_type%22%3A%22url%22%2C%22option.thankyou_value%22%3A%22https%3A%2F%2Ftaylong.myphamviet.co%2Fthanktaylong%22%2C%22option.form_auto_funnel%22%3Atrue%2C%22option.form_auto_complete%22%3Atrue%7D%2C%22FORM_ITEM1488%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22text%22%2C%22option.input_tabindex%22%3A1%7D%2C%22FORM_ITEM1492%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22tel%22%2C%22option.input_tabindex%22%3A2%7D%2C%22FORM_ITEM1493%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22text%22%2C%22option.input_tabindex%22%3A3%7D%2C%22FORM_ITEM1494%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22select_multiple%22%2C%22option.input_tabindex%22%3A4%2C%22option.input_country%22%3A%22VN%3AVi%E1%BB%87t%20Nam%22%7D%2C%22VIDEO1607%22%3A%7B%22type%22%3A%22video%22%2C%22option.video_value%22%3A%22https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3Dq_jm19ArC_c%22%2C%22option.video_type%22%3A%22youtube%22%2C%22option.video_control%22%3Atrue%7D%2C%22CAROUSEL1624%22%3A%7B%22type%22%3A%22carousel%22%2C%22mobile.option.carousel_setting.autoplay%22%3Atrue%2C%22mobile.option.carousel_setting.autoplay_time%22%3A5%2C%22mobile.option.carousel_crop.width%22%3A%223441px%22%2C%22mobile.option.carousel_crop.width_item%22%3A%22413px%22%7D%2C%22COUNTDOWN_ITEM1933%22%3A%7B%22type%22%3A%22countdown_item%22%2C%22option.countdown_item_type%22%3A%22day%22%7D%2C%22COUNTDOWN_ITEM1934%22%3A%7B%22type%22%3A%22countdown_item%22%2C%22option.countdown_item_type%22%3A%22hour%22%7D%2C%22COUNTDOWN_ITEM1935%22%3A%7B%22type%22%3A%22countdown_item%22%2C%22option.countdown_item_type%22%3A%22minute%22%7D%2C%22COUNTDOWN_ITEM1936%22%3A%7B%22type%22%3A%22countdown_item%22%2C%22option.countdown_item_type%22%3A%22seconds%22%7D%2C%22COUNTDOWN1932%22%3A%7B%22type%22%3A%22countdown%22%2C%22option.countdown_type%22%3A%22countdown%22%2C%22option.countdown_minute%22%3A720%7D%2C%22FORM_ITEM2184%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22text%22%2C%22option.input_tabindex%22%3A1%7D%2C%22FORM_ITEM2185%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22tel%22%2C%22option.input_tabindex%22%3A2%7D%2C%22FORM_ITEM2186%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22text%22%2C%22option.input_tabindex%22%3A3%7D%2C%22FORM2181%22%3A%7B%22type%22%3A%22form%22%2C%22option.form_config_id%22%3A%225f108abe59873679af1a6575%22%2C%22option.form_send_ladipage%22%3Atrue%2C%22option.thankyou_type%22%3A%22url%22%2C%22option.thankyou_value%22%3A%22https%3A%2F%2Ftaylong.myphamviet.co%2Fthanktaylong%22%2C%22option.form_auto_funnel%22%3Atrue%2C%22option.form_auto_complete%22%3Atrue%7D%2C%22BUTTON2196%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP1032%22%7D%2C%22mobile.style.animation-name%22%3A%22pulse%22%2C%22mobile.style.animation-delay%22%3A%221s%22%7D%2C%22BUTTON2235%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP1032%22%7D%7D%2C%22COUNTDOWN_ITEM2259%22%3A%7B%22type%22%3A%22countdown_item%22%2C%22option.countdown_item_type%22%3A%22day%22%7D%2C%22COUNTDOWN_ITEM2260%22%3A%7B%22type%22%3A%22countdown_item%22%2C%22option.countdown_item_type%22%3A%22hour%22%7D%2C%22COUNTDOWN_ITEM2261%22%3A%7B%22type%22%3A%22countdown_item%22%2C%22option.countdown_item_type%22%3A%22minute%22%7D%2C%22COUNTDOWN_ITEM2262%22%3A%7B%22type%22%3A%22countdown_item%22%2C%22option.countdown_item_type%22%3A%22seconds%22%7D%2C%22COUNTDOWN2258%22%3A%7B%22type%22%3A%22countdown%22%2C%22option.countdown_type%22%3A%22countdown%22%2C%22option.countdown_minute%22%3A720%7D%2C%22FORM_ITEM2272%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22textarea%22%2C%22option.input_tabindex%22%3A4%7D%2C%22VIDEO2286%22%3A%7B%22type%22%3A%22video%22%2C%22option.video_value%22%3A%22https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DTHAQqeTyJ24%22%2C%22option.video_type%22%3A%22youtube%22%2C%22option.video_control%22%3Atrue%7D%2C%22FORM_ITEM2288%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22tel%22%2C%22option.input_tabindex%22%3A5%7D%2C%22BUTTON2401%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22http%3A%2F%2Fm.me%2FHuy%E1%BB%81n-Phi-Cosmetics-816055575240190%2F%22%7D%7D%2C%22SHAPE2403%22%3A%7B%22type%22%3A%22shape%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22phone%22%2C%22action%22%3A%220330299070%22%7D%2C%22mobile.option.sticky%22%3Atrue%2C%22mobile.option.sticky_position%22%3A%22bottom_left%22%2C%22mobile.option.sticky_position_top%22%3A%220px%22%2C%22mobile.option.sticky_position_left%22%3A%220px%22%2C%22mobile.option.sticky_position_bottom%22%3A%220px%22%2C%22mobile.option.sticky_position_right%22%3A%220px%22%7D%2C%22IMAGE2427%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fwww.huyenphicos.com%2Fu-tao-alota%22%7D%7D%2C%22IMAGE2428%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fwww.huyenphicos.com%2Ftam-trang-tb%22%7D%7D%2C%22IMAGE2429%22%3A%7B%22type%22%3A%22image%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22https%3A%2F%2Fwww.huyenphicos.com%2Fkemfacenano%22%7D%7D%2C%22FORM_ITEM2448%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22tel%22%2C%22option.input_tabindex%22%3A6%7D%2C%22FORM_ITEM2449%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22text%22%2C%22option.input_tabindex%22%3A6%7D%2C%22SECTION2450%22%3A%7B%22type%22%3A%22section%22%2C%22mobile.option.sticky%22%3Atrue%2C%22mobile.option.sticky_position%22%3A%22top%22%2C%22mobile.option.sticky_position_top%22%3A%220px%22%2C%22mobile.option.sticky_position_bottom%22%3A%220px%22%7D%2C%22BUTTON2454%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22popup%22%2C%22action%22%3A%22POPUP1032%22%7D%2C%22mobile.style.animation-name%22%3A%22pulse%22%2C%22mobile.style.animation-delay%22%3A%221s%22%7D%2C%22BUTTON2457%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22section%22%2C%22action%22%3A%22SECTION621%22%7D%7D%2C%22BUTTON2459%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22section%22%2C%22action%22%3A%22SECTION621%22%7D%7D%2C%22BUTTON2461%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22section%22%2C%22action%22%3A%22SECTION621%22%7D%7D%2C%22BUTTON2463%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22section%22%2C%22action%22%3A%22SECTION621%22%7D%7D%2C%22BUTTON2467%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22section%22%2C%22action%22%3A%22SECTION2245%22%7D%2C%22mobile.option.sticky%22%3Atrue%2C%22mobile.option.sticky_position%22%3A%22bottom_right%22%2C%22mobile.option.sticky_position_top%22%3A%220px%22%2C%22mobile.option.sticky_position_left%22%3A%220px%22%2C%22mobile.option.sticky_position_bottom%22%3A%2210px%22%2C%22mobile.option.sticky_position_right%22%3A%220px%22%2C%22mobile.style.animation-name%22%3A%22shake%22%2C%22mobile.style.animation-delay%22%3A%223s%22%7D%2C%22POPUP2468%22%3A%7B%22type%22%3A%22popup%22%2C%22option.show_popup_welcome_page%22%3Atrue%2C%22option.delay_popup_welcome_page%22%3A30%2C%22option.popup_welcome_page_scroll_to%22%3A%22SECTION2245%22%2C%22mobile.option.popup_position%22%3A%22default%22%2C%22mobile.option.popup_backdrop%22%3A%22background-color%3A%20rgba(0%2C%200%2C%200%2C%200.5)%3B%22%7D%2C%22SPINLUCKY2469%22%3A%7B%22type%22%3A%22spinlucky%22%2C%22option.spinlucky_setting.list_value%22%3A%5B%22U0FMRTEwa3xHSeG6ok0gMTBrfDM1JQ%3D%3D%22%2C%22U0FMRTE1a3xHSeG6ok0gMTVrfDEwJQ%3D%3D%22%2C%22U0FMRSAyMGt8R0nhuqJNIDIwS3w1JQ%3D%3D%22%2C%22TkVYVF9UVVJOfFRIw4pNIDEgTMav4buiVCBRVUFZfDE1JQ%3D%3D%22%2C%22TFVDS1l8Q0jDmkMgQuG6oE4gTUFZIE3huq5OfDEwJQ%3D%3D%22%2C%22U0FMRTVLfEdJ4bqiTSA1S3wgMjUl%22%5D%2C%22option.spinlucky_setting.result_popup_id%22%3A%22default%22%2C%22option.spinlucky_setting.result_message%22%3A%22Ch%C3%BAc%20m%E1%BB%ABng%20b%E1%BA%A1n%20nh%E1%BA%ADn%20%C4%91%C6%B0%E1%BB%A3c%20%7B%7Bcoupon_text%7D%7D.%20Nh%E1%BA%ADp%20m%C3%A3%3A%20%7B%7Bcoupon_code%7D%7D%20%C4%91%E1%BB%83%20s%E1%BB%AD%20d%E1%BB%A5ng.%20B%E1%BA%A1n%20c%C3%B2n%20%7B%7Bspin_turn_left%7D%7D%20l%C6%B0%E1%BB%A3t%20quay.%22%2C%22option.spinlucky_setting.max_turn%22%3A1%7D%7D";
        window.LadiPageScript.run(true);
        window.LadiPageScript.runEventScroll();
        var countLoadLocation = 0;
        window.LadiPageScript.loadScript("https://w.ladicdn.com/v2/source/location.vn.min.js?v=1595232505699", true, function(ev) {
          countLoadLocation++;
          if (countLoadLocation < 1) {
            return;
          }
          window.LadiPageScript.runAfterLocation();
        });
      };
      run();
    })();
  </script>
  <script>
    window[window.TiktokAnalyticsObject].instance("BSBHJCMGK86GA76EED60").track("ViewForm", {
      "pixelMethod": "standard"
    });
  </script>
  <script async defer src="https://apis.google.com/js/api.js"
    onload="this.onload=function(){};handleClientLoad()"
    onreadystatechange="if (this.readyState === 'complete') this.onload()">
  </script>
</body>

</html>