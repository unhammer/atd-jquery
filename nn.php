<?
$_REQUEST = array_merge($_GET, $_POST);
require_once('/var/www-ssl/auth/basicauth.php');
?>
<html>
 <head>
 <title>Kaldera nynorsk grammatikkontroll</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 <!-- 0. do yourself a favor and make CSS that applies to both the textarea and div -->
 <style>

 .input
 {
    font-size: 100%;
    width: 700px;
    height: 550px;
    font-family: times;
    border: 1px solid black;
    padding: 2px;
    margin: 2px;
    float: left;
 }

 </style>

 <!-- there are six things you need to make AtD work for you, they are: -->

 <!-- 1. include jQuery ... naturally none of this works without jQuery -->
 <script src="scripts/jquery-1.4.2.js"></script>

 <!-- 2. load the atd.textarea.js -- this script makes it easy to attach AtD to a textarea -->
 <script src="scripts/jquery.atd.textarea.js"></script>

 <!-- 3. this script is a hack that allows cross-domain AJAX -->
 <script src="scripts/csshttprequest.js"></script>

 <!-- 4. this CSS file contains the style information for highlighted errors -->
 <link rel="stylesheet" type="text/css" media="screen" href="css/atd.css" />

 <!-- 6. a function to call when the button is clicked, this function calls into the AtD textarea code -->
 <script>
 function check()
 {
   AtD.checkTextAreaCrossAJAX('textInput', 'checkLink', 'Rediger');
   if (jQuery('#checkLink').html() == 'Rediger') {
     // User is now in checking mode, don't allow editing:
     jQuery('#textInput').attr('contenteditable', false);
    }
   if (jQuery('#checkLink').html() == 'Sjekk grammatikken') {
     // User is now in editing mode:
     jQuery('#textInput').attr('contenteditable', true);
    }
 }
 </script>

 <!-- We want nynorsk localisations: -->
 <script src="scripts/locale-nn_NO.js"></script>

 </head>
 <body>

<textarea id="textInput" class="input">Hun pleide alltid og kjøre i utkant strøk.
Vi nøyar oss ikkje med teiknsetjing

Den er lett å sei for deg og i den tilstand er ikkje ei gong din tvil nok.</textarea>

<p>Demo av Kaldera nynorsk grammatikkontroll.</p>

<p>Skriv noko, trykk «Sjekk grammatikken», klikk på grøne strekar for å sjå på feilen eller få rettingsforslag. Trykk «Rediger» igjen for å skriva meir.</p>

<p><img src="images/atdbuttontr.gif"><a href="javascript:check()" id="checkLink">Sjekk grammatikken</a></p>

 </body>
</html>
