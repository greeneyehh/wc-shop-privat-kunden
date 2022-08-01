<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>

<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=iso-8859-1"><meta name=Generator content="Microsoft Word 15 (filtered medium)"><!--[if !mso]><style>v\:* {behavior:url(#default#VML);}
    o\:* {behavior:url(#default#VML);}
    w\:* {behavior:url(#default#VML);}
    .shape {behavior:url(#default#VML);}
    </style><![endif]--><style>
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
        </o:shapelayout></xml><![endif]--></head>
<body bgcolor="#022F4C" lang=DE link="#0563C1" vlink="#954F72" style="background-color: #022F4;">
<div class=WordSection1>
    <p class=MsoNormal align=center style='text-align:center'>
        <o:p>&nbsp;</o:p></p><p class=MsoNormal align=center style='text-align:center'>
        <span style='mso-fareast-language:DE'><img width=225 height=125 id="Grafik_x0020_2" src="<?=Url::home('https')?>/img/newsletter-logo.png"></span><o:p></o:p>
    </p><p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p><div align=center>
        <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 style='border-radius: 1rem 0 1rem 0;background:white;border-collapse:collapse;border:none'><tr style='height:160.2pt'><td width=647 valign=top style='width:485.45pt;padding:0cm 5.4pt 0cm 5.4pt;height:160.2pt'>
                    <p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p><p class=MsoNormal align=center style='text-align:center'>

                        <strong> Moin <?=($CustomerData['personal_salutation'] =="MR") ? "Herr" : "Frau"; ?> <?=$CustomerData['personal_firstname'];?> <?=$CustomerData['personal_lastname']; ?>,</strong>
                        <br><br>
                        wir haben Ihre Managed Nextcloud erstellt.<br>
                        Sie erreichen diese ab sofort unter Ihrer Wunschdomain:
                        <br><br>
                        <?=$domain; ?>
                        <br><br>
                        Mit den folgenden Zugangsdaten können Sie sich einloggen:
                        <br><br>
                        Ihr Benutzernamen: <?=$account; ?>
                        <br><br>
                        Ihr Initialpasswort: <?=$initialpasswort; ?>
                        <br><br>
                        Bitte ändern Sie das Passwort direkt nach dem ersten Login
                        <?php if($productname != 'Start'){?>
                            <br><br>
                            Sie können unter Verwendung des Benutzers „Admin“ beliebig viele weitere Benutzer mit oder ohne Adminrechte erstellen.
                        <?php }?>

                        <br><br>
                        Sync-Clients gibt es für den PC sowie MacOS, Android und iOS auf nextcloud.de bzw.<br>
                        in den jeweiligen App-Stores. Sollten Sie noch Fragen zur Einrichtung haben,<br>
                        kontaktieren Sie uns gerne über das Kundenportal oder per E-Mail unter<br> <a href="mailto:support@windcloud.de">support@windcloud.de.</a>
                        <br><br>
                        Als Nextcloud-Kunde stellen wir Ihnen zudem eine kostenlose Plattform für Videokonferenzen zur Verfügung.<br>
                        Unter <a href="https://meet.windcloud.de">https://meet.windcloud.de</a> können Sie Videokonferenzen (mit Screen Sharing-Funktion) ohne vorherige Registrierung einfach durchführen.
                        <br><br>
                        Mit freundlichen Grüßen aus dem hohen Norden,

                        <br><br>
                        <a href="<?=$domain; ?>">hier geht es zu ihrer Nextcloud</a>
                        <br><br>
        </table>
        <o:p>&nbsp;</o:p>
    </div><p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p><p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p><p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p><p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p><p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p><p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p></div>
</body></html>