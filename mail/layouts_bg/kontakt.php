<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<html>
<head>
    <title>Passwort Zurücksetzen Windcloud 4.0 GmbH</title>
    <link rel="important stylesheet" href="chrome://messagebody/skin/messageBody.css">
</head>
<body>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; ">
</head>
<body vlink="#551A8B" text="#000000" link="#0B6CDA" bgcolor="#ffffff"
      alink="#EE0000">
<br>
<div class="moz-forward-container"><br>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style type="text/css">
        body {background-color: #022F4C}

    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Generator" content="Microsoft Word 15 (filtered
        medium)">
    <!--[if !mso]><style>v\:* {behavior:url(#default#VML);}
    o\:* {behavior:url(#default#VML);}
    w\:* {behavior:url(#default#VML);}
    .shape {behavior:url(#default#VML);}

    </style><![endif]-->
    <style>
        <!--
        /* Font Definitions */
        @font-face
        {font-family:"Cambria Math";
            panose-1:2 4 5 3 5 4 6 3 2 4;}
        @font-face
        {font-family:Calibri;
            panose-1:2 15 5 2 2 2 4 3 2 4;}
        @font-face
        {font-family:"Arial Black";
            panose-1:2 11 10 4 2 1 2 2 2 4;}
        /* Style Definitions */
        p.MsoNormal, li.MsoNormal, div.MsoNormal
        {margin:0cm;
            margin-bottom:.0001pt;
            font-size:11.0pt;
            font-family:"Calibri",sans-serif;
            mso-fareast-language:EN-US;}
        a:link, span.MsoHyperlink
        {mso-style-priority:99;
            color:#0563C1;
            text-decoration:underline;}
        a:visited, span.MsoHyperlinkFollowed
        {mso-style-priority:99;
            color:#954F72;
            text-decoration:underline;}
        span.E-MailFormatvorlage17
        {mso-style-type:personal-compose;
            font-family:"Calibri",sans-serif;
            color:windowtext;}
        .MsoChpDefault
        {mso-style-type:export-only;
            font-family:"Calibri",sans-serif;
            mso-fareast-language:EN-US;}
        @page WordSection1
        {size:612.0pt 792.0pt;
            margin:70.85pt 70.85pt 2.0cm 70.85pt;}
        div.WordSection1
        {page:WordSection1;}
        --></style><!--[if gte mso 9]><xml>
        <o:shapedefaults v:ext="edit" spidmax="1026">
            <o:colormru v:ext="edit" colors="#3aa,#022f4c" />
        </o:shapedefaults></xml><![endif]--><!--[if gte mso 9]><xml>
        <o:shapelayout v:ext="edit">
            <o:idmap v:ext="edit" data="1" />
        </o:shapelayout></xml><![endif]-->
    <div class="WordSection1">
        <p class="MsoNormal" style="text-align:center" align="center"> <o:p> </o:p></p>
        <p class="MsoNormal" style="text-align:center" align="center"><span
                    style="mso-fareast-language:DE"><img id="Grafik_x0020_2"
                                                         src="https://development.windcloud.de//img/newsletter-logo.png"
                                                         moz-do-not-send="true" width="225" height="125"></span><o:p></o:p></p>
        <p class="MsoNormal" style="text-align:center" align="center"><o:p> </o:p></p>
        <div align="center">
            <table class="MsoTableGrid" style="border-radius: 1rem 0 1rem
            0;background:white;border-collapse:collapse;border:none"
                   cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <tr style="height:160.2pt">
                    <td style="width:485.45pt;padding:0cm 5.4pt 0cm
                  5.4pt;height:160.2pt" width="647" valign="top">
                        <p>Name :<?= $name;?></p>
                        <p><?php if($callback == 1)
                            {
                                echo "um rückruf gebeten ";
                                echo $phonenumber;
                            }
                            ?></p>
                        Nachricht:
                        <p><?= $message;?></p>
                    </td>
                </tr>
                </tbody>
            </table>
            <o:p> </o:p>
            <p class="MsoNormal" style="text-align:center" align="center">
                <font color="#ffffff">Windcloud 4.0 GmbH. Lecker Straße 7 ,
                    25917 Enge-Sande, Deutschland</font><br>
            </p>
        </div>
    </div>
</div>
</body>
</html>

</body>
</html>
