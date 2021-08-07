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

    $name = $_GET['name'];
    $old_phone = $_GET['phone'];
    $new_phone = $_POST['phone'];
    $sql = "UPDATE customer_order SET phone = '$new_phone' WHERE name = '$name' AND phone = '$old_phone'";
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
  $mail->CharSet = 'UTF-8';
  $mail->isSMTP(); 
  $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
  $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
  $mail->Port = 587; // TLS only
  $mail->SMTPSecure = 'tls'; // ssl is depracated
  $mail->SMTPAuth = true;
  $smtpUsername = "your-email";
  $mail->Username = $smtpUsername;
  $smtpPassword = "WolfWolfWolfWolf";
  $mail->Password = $smtpPassword;
  $emailFrom = "your-email";
  $emailFromName = mb_convert_encoding( "Kem tẩy lông Huyền Phi", "UTF-8", "UTF-8" );
  $mail->setFrom($emailFrom, $emailFromName);
  $emailTo = "phamhamy389@gmail.com";
  $emailToName = mb_convert_encoding("Admin", "UTF-8", "UTF-8");
  $mail->addAddress($emailTo, $emailToName);
  $mail->Subject = mb_convert_encoding($name . ' đã đổi số điện thoại', "UTF-8", "UTF-8");
  $mail->msgHTML("Số cũ: " . $old_phone . "<br>Số mới: " . $new_phone); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
  $mail->AltBody = 'HTML messaging not supported';
  // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

  if(!$mail->send()){
      echo "Mailer Error: " . $mail->ErrorInfo;
  }else{
      echo "Message sent!";
  }

  ////
  
  $conn = null;

  header('Location: ' . 'order.php?name=' . $name . '&phone=' . $new_phone );
  exit;

}
?>
<!DOCTYPE html>
<!-- saved from url=(0140)https://taylong.myphamviet.co/thanktaylong?name=test&phone=0865489455&address=103%20M%C3%A3%20Cao&message=asdasdasd&form_item2288=0865489455 -->
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>ĐẶT HÀNG THÀNH CÔNG</title>
  <meta http-equiv="Cache-Control" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="keywords" content="">
  <meta name="description" content="THANK YOU taylong - taylong.myphamviet.co Kimberley">

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
  
	<script>
		!function (w, d, t) {
		  w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};
		
		  ttq.load('C3CBHDD63S9QR2BCKQSG');
		  ttq.page();
		}(window, document, 'ttq');
	</script>
	
  <script type="text/javascript" async="" src="./order_files/config.js"></script>
  <script type="text/javascript" async="" src="./order_files/sdk.js"></script>
  <script src="./order_files/638139886819707" async=""></script>
  <script async="" src="./order_files/fbevents.js"></script>
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
  <link rel="canonical" href="https://taylong.myphamviet.co/thanktaylong">
  <meta property="og:url" content="https://taylong.myphamviet.co/thanktaylong">
  <meta property="og:title" content="ĐẶT HÀNG THÀNH CÔNG">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://static.ladipage.net/5e55d7bf19113a128ed0d61c/71113586_2512404298873442_970404593030660096_n-20200530170023.jpg">
  <meta property="og:description" content="THANK YOU taylong - taylong.myphamviet.co Kimberley">
  <meta name="format-detection" content="telephone=no">
  <link rel="dns-prefetch">
  <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin="">
  <link rel="preconnect" href="https://w.ladicdn.com/" crossorigin="">
  <link rel="preconnect" href="https://s.ladicdn.com/" crossorigin="">
  <link rel="preconnect" href="https://api.forms.ladipage.com/" crossorigin="">
  <link rel="preconnect" href="https://la.ladipage.com/" crossorigin="">
  <link rel="preconnect" href="https://api.ladisales.com/" crossorigin="">
  <link rel="stylesheet" href="./order_files/css" as="style" onload="this.onload = null;this.rel = &#39;stylesheet&#39;;">
  <link rel="preload" href="./order_files/ladipage.min.js" as="script">
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
      font-family: "Open Sans", sans-serif
    }
  </style>
  <style id="style_element" type="text/css">
    #SECTION_POPUP {
      height: 0px;
    }

    #SECTION2 {
      height: 764px;
    }

    #SECTION2>.ladi-overlay {
      background-color: rgba(0, 122, 209, 0.7);
    }

    #SECTION2>.ladi-section-background {
      background-size: cover;
      background-attachment: scroll;
      background-origin: content-box;
      background-image: url("https://w.ladicdn.com/s768x764/57b167c9ca57d39c18a1c57c/image-1-079361.jpg");
      background-position: left top;
      background-repeat: no-repeat;
    }

    #HEADLINE5 {
      width: 380px;
      top: 319px;
      left: 12.5px;
    }

    #HEADLINE5>.ladi-headline {
      font-family: "Tinos", serif;
      background: #ffe259;
      background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
      background: linear-gradient(180deg, #ffe259, #ffa751);
      color: rgb(255, 255, 255);
      font-size: 30px;
      font-weight: bold;
      font-style: italic;
      text-align: center;
      line-height: 1.2;
    }

    #HEADLINE5 .ladi-headline {
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    #IMAGE6 {
      width: 220.344px;
      height: 335px;
      top: -16px;
      left: 99.828px;
    }

    #IMAGE6>.ladi-image>.ladi-image-background {
      width: 220.344px;
      height: 335px;
      top: 0px;
      left: -5.48651px;
      background-image: url("https://w.ladicdn.com/s550x650/5e55d7bf19113a128ed0d61c/123-removebg-20200312022642.png");
    }

    #BUTTON59 {
      width: 306px;
      height: 40px;
      top: 662px;
      left: 57px;
    }

    #BUTTON59>.ladi-button>.ladi-button-background {
      background: #ff6a00;
      background: -webkit-linear-gradient(180deg, #ff6a00, #ee0979);
      background: linear-gradient(180deg, #ff6a00, #ee0979);
    }

    #BUTTON_TEXT59 {
      width: 401px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT59>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      line-height: 1.6;
    }

    #HEADLINE60 {
      width: 355px;
      top: 367px;
      left: 30px;
    }

    #HEADLINE60>.ladi-headline {
      font-family: "Tinos", serif;
      color: rgb(255, 255, 255);
      font-size: 19px;
      font-weight: bold;
      text-align: center;
      line-height: 1.4;
    }

    #FORM61 {
      width: 350px;
      height: 91px;
      top: 542px;
      left: 35px;
    }

    #FORM61>.ladi-form-custom {
      color: rgb(0, 0, 0);
      font-size: 12px;
      line-height: 1.6;
    }

    #FORM61 .ladi-form-custom-item .ladi-form-custom-control::placeholder,
    #FORM61 .ladi-form-custom .ladi-form-custom-item .ladi-form-custom-control-select[data-selected=""],
    #FORM61 .ladi-form-custom .ladi-form-custom-item.ladi-form-custom-checkbox .ladi-form-custom-checkbox-item span[data-checked="false"] {
      color: #000;
    }

    #FORM61 .ladi-form-custom-item-container .ladi-form-custom-item .ladi-form-custom-control-select {
      background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20%23000%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
    }

    #FORM61 .ladi-form-custom-item-container {
      border-style: solid;
      border-color: rgb(238, 238, 238);
      border-width: 1px;
    }

    #FORM61 .ladi-form-custom-item-background {
      background-color: rgb(232, 227, 48);
    }

    #BUTTON62 {
      width: 130px;
      height: 35px;
      top: 56px;
      left: 101px;
    }

    #BUTTON62>.ladi-button>.ladi-button-background {
      background-color: rgb(232, 59, 48);
    }

    #BUTTON_TEXT62 {
      width: 130px;
      top: 9px;
      left: 0px;
    }

    #BUTTON_TEXT62>.ladi-headline {
      color: rgb(255, 255, 255);
      font-size: 16px;
      text-align: center;
      line-height: 1.6;
    }

    #FORM_ITEM65 {
      width: 350px;
      height: 44px;
      top: 0px;
      left: 0px;
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
  <script charset="utf-8" src="./order_files/identify.js"></script>
</head>

<body><noscript><img height="1" width="1" style="display:none;" src="https://www.facebook.com/tr?id=638139886819707&ev=PageView&noscript=1" /></noscript>
  <div class="ladi-wraper">
    <div id="SECTION2" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-overlay"></div>
      <div class="ladi-container">
        <div id="HEADLINE5" class="ladi-element">
          <h1 class="ladi-headline">ĐẶT HÀNG THÀNH CÔNG</h1>
        </div>
        <div id="IMAGE6" class="ladi-element">
          <div class="ladi-image">
            <div class="ladi-image-background"></div>
          </div>
        </div><a href="http://huyenphicosmetics.com/" target="_blank" id="BUTTON59" class="ladi-element" data-replace-href="http://huyenphicosmetics.com/">
          <div class="ladi-button">
            <div class="ladi-button-background"></div>
            <div id="BUTTON_TEXT59" class="ladi-element">
              <p class="ladi-headline">QUAY LẠI TRANG CHỦ</p>
            </div>
          </div>
        </a>
        <div id="HEADLINE60" class="ladi-element">
          <h2 class="ladi-headline">Cảm ơn bạn <span><?php echo $_GET['name'] ?></span> đã đặt hàng , shop sẽ gọi xác nhận đơn theo sdt : <span><?php echo $_GET['phone'] ?></span><br>Nếu sdt sai vui lòng gửi lại thông tin vào form bên dưới giúp shop. Cảm ơn bạn<br></h2>
        </div>
        <div id="FORM61" data-config-id="5f108abe59873679af1a6575" class="ladi-element">
          <form id="the_form" autocomplete="off" method="post" class="ladi-form-custom">
            <div id="BUTTON62" class="ladi-element">
              <div class="ladi-button">
                <div class="ladi-button-background"></div>
                <div id="BUTTON_TEXT62" class="ladi-element">
                  <p onclick="$('#the_form').submit()" class="ladi-headline">XÁC NHẬN</p>
                </div>
              </div>
            </div>
            <div id="FORM_ITEM65" class="ladi-element">
              <div class="ladi-form-custom-item-container">
                <div class="ladi-form-custom-item-background"></div>
                <div class="ladi-form-custom-item"><input autocomplete="off" tabindex="3" name="phone" required="" class="ladi-form-custom-control" type="tel" placeholder="Sửa số điện thoại" pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}" value="<?php echo $_GET['phone'] ?>"></div>
              </div>
            </div><button type="submit" class="ladi-hidden"></button>
          </form>
        </div>
      </div>
    </div>
    <div id="SECTION_POPUP" class="ladi-section">
      <div class="ladi-section-background"></div>
      <div class="ladi-container"></div>
    </div>
  </div>
  <div id="backdrop-popup" class="backdrop-popup"></div>
  <div id="lightbox-screen" class="lightbox-screen"></div>
  <script id="script_lazyload" type="text/javascript">
    (function() {
      var list_element_lazyload = document.querySelectorAll('.ladi-section-background, .ladi-image-background, .ladi-button-background, .ladi-headline, .ladi-video-background, .ladi-countdown-background, .ladi-box, .ladi-frame-background, .ladi-banner, .ladi-form-custom-item-background, .ladi-gallery-view-item, .ladi-gallery-control-item, .ladi-spin-lucky-screen, .ladi-spin-lucky-start, .ladi-list-paragraph ul li');
      var style_lazyload = document.getElementById('style_lazyload');
      for (var i = 0; i < list_element_lazyload.length; i++) {
        var rect = list_element_lazyload[i].getBoundingClientRect();
        if (rect.x == "undefined" || rect.x == undefined || rect.y == "undefined" || rect.y == undefined) {
          rect.x = rect.left;
          rect.y = rect.top;
        }
        var offset_top = rect.y + window.scrollY;
        if (offset_top >= window.scrollY + window.innerHeight || window.scrollY >= offset_top + list_element_lazyload[i].offsetHeight) {
          list_element_lazyload[i].classList.add('ladi-lazyload');
        }
      }
      style_lazyload.parentElement.removeChild(style_lazyload);
      var currentScrollY = window.scrollY;
      var stopLazyload = function(event) {
        if (event.type == "scroll" && window.scrollY == currentScrollY) {
          currentScrollY = -1;
          return;
        }
        window.removeEventListener('scroll', stopLazyload);
        list_element_lazyload = document.getElementsByClassName('ladi-lazyload');
        while (list_element_lazyload.length > 0) {
          list_element_lazyload[0].classList.remove('ladi-lazyload');
        }
      };
      window.addEventListener('scroll', stopLazyload);
    })();
  </script>
  <!--[if lt IE 9]><script src="https://w.ladicdn.com/v2/source/html5shiv.min.js?v=1595232505699"></script><script src="https://w.ladicdn.com/v2/source/respond.min.js?v=1595232505699"></script><![endif]-->
  <link href="./order_files/css" rel="stylesheet" type="text/css">
  <link href="./order_files/ladipage.min.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./order_files/ladipage.min.js" type="text/javascript"></script>
  <script id="script_event_data" type="text/javascript">
    (function() {
      var run = function() {
        if (typeof window.LadiPageScript == "undefined" || window.LadiPageScript == undefined || typeof window.ladi == "undefined" || window.ladi == undefined) {
          setTimeout(run, 100);
          return;
        }
        window.LadiPageApp = window.LadiPageApp || new window.LadiPageAppV2();
        window.LadiPageScript.runtime.ladipage_id = '5f1701c2dcc68730c88e864e';
        window.LadiPageScript.runtime.isMobileOnly = true;
        window.LadiPageScript.runtime.DOMAIN_SET_COOKIE = ["myphamviet.co"];
        window.LadiPageScript.runtime.DOMAIN_FREE = [];
        window.LadiPageScript.runtime.bodyFontSize = 12;
        window.LadiPageScript.runtime.time_zone = 7;
        window.LadiPageScript.runtime.currency = "VND";
        window.LadiPageScript.runtime.eventData = "%7B%22BUTTON59%22%3A%7B%22type%22%3A%22button%22%2C%22option.data_action%22%3A%7B%22type%22%3A%22link%22%2C%22action%22%3A%22http%3A%2F%2Fhuyenphicosmetics.com%2F%22%7D%7D%2C%22FORM61%22%3A%7B%22type%22%3A%22form%22%2C%22option.form_config_id%22%3A%225f108abe59873679af1a6575%22%2C%22option.form_send_ladipage%22%3Atrue%2C%22option.thankyou_type%22%3A%22default%22%2C%22option.thankyou_value%22%3A%22%C4%90%C3%A3%20c%E1%BA%ADp%20nh%E1%BA%ADt%20sdt%20th%C3%A0nh%20c%C3%B4ng!%22%2C%22option.form_auto_funnel%22%3Atrue%2C%22option.form_auto_complete%22%3Atrue%7D%2C%22FORM_ITEM65%22%3A%7B%22type%22%3A%22form_item%22%2C%22option.input_type%22%3A%22tel%22%2C%22option.input_tabindex%22%3A3%7D%7D";
        window.LadiPageScript.run(true);
        window.LadiPageScript.runEventScroll();
      };
      run();
    })();
  </script>
  <script>
    window[window.TiktokAnalyticsObject].instance("BSBHJCMGK86GA76EED60").track("ViewForm", {
      "pixelMethod": "standard"
    });
  </script>

  <script>
    window[window.TiktokAnalyticsObject].instance("BSBHJCMGK86GA76EED60").track("SubmitForm", {
      "pixelMethod": "standard"
    });
  </script>
</body>

</html>