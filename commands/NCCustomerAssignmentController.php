<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use app\extensions\greendev\weclapp\article;
use app\models\shop\CustomerOrder;
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class NCCustomerAssignmentController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        $CustomerOrder = CustomerOrder::find()->all();
        $article = new article();
        //$articlepaycycle= $article->getArticle();
        $phpExcel = new Spreadsheet();
        $phpExcel->getProperties()->setCreator('Bastian Grote')
            ->setTitle('Exoprt NC Kunden')
            ->setSubject('Exoprt NC Kunden')
            ->setDescription('NC Kunden Kumuliert für Wilfried und Christian');
        $phpExcel->getActiveSheet()->setTitle("NC Kunden Kumuliert");
        $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Datum der Aktivirung')
            ->setCellValue('B1', 'Kundennummer')
            ->setCellValue('C1', 'Domain')
            ->setCellValue('D1', 'Bezahlzyklus')
            ->setCellValue('E1', 'Bezahlsystem')
            ->setCellValue('F1', 'bezahldatum')
            ->setCellValue('G1', 'Stornierung')
            ->setCellValue('H1', 'Stornierungsdatum')
            ->setCellValue('I1', 'Produkt Name')
            ->setCellValue('J1', 'Bestellt Durch')
            ->setCellValue('K1', 'Bestellungs ID')
            ->setCellValue('L1', 'Active');

        $col = 2;
        foreach ($CustomerOrder as $player) {
            $articlepaycycle= $article->getByIdArticle($player["productid"]);
            $articlepaycycle = json_decode($articlepaycycle,true);
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow( 1 , $col , $player["datetime"])
                ->setCellValueByColumnAndRow( 2 , $col , $player["accountid"])
                ->setCellValueByColumnAndRow( 3 , $col , $player["domain"])
                ->setCellValueByColumnAndRow( 4 , $col , $player["paycycle"])
                ->setCellValueByColumnAndRow( 5 , $col , $player["lastpaybrand"])
                ->setCellValueByColumnAndRow( 6 , $col , $player["lastpaydate"])
                ->setCellValueByColumnAndRow( 7 , $col , $player["cancellation"])
                ->setCellValueByColumnAndRow( 8 , $col , $player["cancellationdate"])
                ->setCellValueByColumnAndRow( 9 , $col , $articlepaycycle['name'].' | '. $player["productid"])
                ->setCellValueByColumnAndRow( 10 , $col , $player["username"])
                ->setCellValueByColumnAndRow( 11 , $col , $player["id"])
                ->setCellValueByColumnAndRow( 12 , $col , $player["active"]);

            $col++;
        }


        $writer = new Xlsx($phpExcel);
        $writer->save('/var/www/html/windcloud.de/shop-wc/documents/NCCustomerAssignment.xlsx');

        $mail =\Yii::$app->mailer->compose()
            ->setFrom(\Yii::$app->params['senderEmail'])
            ->setTo(\Yii::$app->params['NCCustomerAssignmentEmail'])
            ->setSubject("Exoprt NC Kunden")
            ->setTextBody('NC Kunden Kumuliert')
            ->setHtmlBody('<b>NC Kunden Kumuliert</b>')
            ->attach('/var/www/html/windcloud.de/shop-wc/documents/NCCustomerAssignment.xlsx');
        $mail->send();

        return ExitCode::OK;
    }
}
