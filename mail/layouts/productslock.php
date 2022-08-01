<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Windcloud – Rechnen Sie mit Wind</title>
    <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        img {height: auto;}
        .content {width: 100%; max-width: 600px;}
        .header {padding: 40px 30px 20px 30px;}
        .innerpadding {padding: 30px 30px 30px 30px;}
        .borderbottom {border-bottom: 1px solid #ddd;}
        .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;}
        .h1, .h2, .bodycopy, .smallcopy {color: #153643; font-family: sans-serif;}
        .h1 {font-size: 33px; line-height: 38px; font-weight: bold;}
        .h2 {padding: 0 0 15px 0; font-size: 18px; line-height: 28px; color: #33aaaa; font-weight: bold;}
        .bodycopy {font-size: 16px; line-height: 22px;}
        .smallcopy {font-size: 11px; line-height: 22px;}
        .button {text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;}
        .button a {color: #ffffff; text-decoration: none;}
        .footer {padding: 40px 30px 40px 30px;}
        .footercopy {font-family: sans-serif; font-size: 12px; line-height: 18px; color: #ffffff;}
        .footercopy a {color: #ffffff; text-decoration: underline;}

        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
            body[yahoo] .hide {display: none!important;}
            body[yahoo] .buttonwrapper {background-color: transparent!important;}
            body[yahoo] .button {padding: 0px!important;}
            body[yahoo] .button a {background-color: #e05443; padding: 15px 15px 13px!important;}
            body[yahoo] .unsubscribe {border: 0.1875rem solid !important; padding: 0.5rem 1.5rem; font-weight: bold; color: #fff !important; border-color: #fff !important; text-decoration: none;}
        }

        /*@media only screen and (min-device-width: 601px) {
          .content {width: 600px !important;}
          .col425 {width: 425px!important;}
          .col380 {width: 380px!important;}
          }*/

    </style>
</head>

<body yahoo bgcolor="#f6f6f6">
<table width="100%" bgcolor="#f6f6f6" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" class="footercopy">
                        <br>

                        <br>
                        <br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <!--[if (gte mso 9)|(IE)]>
            <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
            <![endif]-->
            <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td bgcolor="#fff" class="header">
                        <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="70" style="padding: 0 0 20px 0; text-align: center;">
                                    <img class="fix" src="data:image/png;base64,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" height="70" border="0" alt="" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="innerpadding bodycopy borderbottom">
                        <p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p><p class=MsoNormal align=center style='text-align:center'>
                            <strong><span style='font-size:16.0pt;font-family:"Arial Black",sans-serif;color:#3B3838;mso-style-textfill-fill-color:#3B3838;mso-style-textfill-fill-alpha:100.0%'>Bestellung</span></strong><span style='color:#3B3838;mso-style-textfill-fill-color:#3B3838;mso-style-textfill-fill-alpha:100.0%'> </span>
                            <br><br>
                            Ihre Nextcloud steht nun für sie Bereit und ist unter den Folgen URL und den angegebenen Zugangsdaten für sie Erreichbar.
                            <br><br>
                            URL : <?=$domain; ?>
                            <br><br>
                            Ihr Benutzernamen: <?=$account; ?>
                            <br><br>
                            Ihr Initialpasswort: <?=$initialpasswort; ?>
                            <br><br>
                            unter dem Link Finden sie eine kurzen Leitfaden zu den wichtigsten Einstellungen um Ihre Nextcloud Erfolgreich einzurichten.

                            >> Nextcloud neu Einrichten

                            wenn sie Hilfe benötigen, sind wir für die über das (Kundenportal) oder die (Support@windcloud.de) erreichbar.
                            <br><br>
                            <a href="<?=$domain; ?>">hier geht es zu ihrer Nextcloud</a>
                            <br><br>
                    </td>
                </tr>
                <tr>
                    <td class="innerpadding">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="smallcopy">
                                    Diese Nachricht
                                    wurde von Windcloud 4.0 GmbH an <?= $mail;?> ver­sandt.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="footer" bgcolor="#022f4c">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" class="footercopy">
                                    Windcloud 4.0 GmbH | Lecker Straße 7<br>
                                    25917 Enge-Sande | Gebäude 1-C<br>
                                    <br>
                                    Registergericht Flensburg: HRB 12946 FL | Umsatzsteuer-ID-Nr.: DE318766653<br>
                                    Steuernummer: 15/291/33309 | Zertifizierung: ISO 27001:2013 - GM3016<br>
                                    Geschäftsführung: Wilfried Ritter, Stephan Sladek<br>
                                    <br>
                                    <br>
                                    <span class="h2">Nachhaltig und wirtschaftlich digitalisieren.</span><br>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>
</body>
</html>




























