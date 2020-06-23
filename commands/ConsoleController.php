<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\httpclient\XmlParser;
use yii\httpclient\Client;
use app\models\Currency;

class ConsoleController extends Controller
{
    /**
     * yii console/update-currency
     *
     * @return int
     */
    public function actionUpdateCurrency()
    {
        $xmlParser = new XmlParser();
    
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://www.cbr.ru/scripts/XML_daily.asp')
            ->send();
        
        $data = $xmlParser->parse($response);

        foreach ($data['Valute'] as $item) {
    
            $currency = Currency::findOne(['id' => $item['@attributes']['ID']]);
            
            if($currency === null) {
                
                $currency = new Currency();
    
                $currency->id = $item['@attributes']['ID'];
                $currency->name = $item['Name'];
                $currency->rate = floatval(str_replace(',', '.', $item['Value']));
    
                if($currency->save()) {
                    echo $item['@attributes']['ID'] . " - Inserted!\n\r";
                }
                else {
                    print_r ($currency->getErrors());
                }
                
            }
            else {
                $currency->name = $item['Name'];
                $currency->rate = floatval(str_replace(',', '.', $item['Value']));
    
                if($currency->save()) {
                    echo $item['@attributes']['ID'] . " - Updated!\n\r";
                }
                else {
                    print_r ($currency->getErrors());
                }
            }
        }
        
        echo 'The "currency" table was updated successfully!';
        
        return ExitCode::OK;
    }
}