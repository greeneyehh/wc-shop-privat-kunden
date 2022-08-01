<?php
namespace app\components;
use Yii;
use yii\base\Component;
use RocketChat\Client;
use RocketChat\User;
use RocketChat\Channel;
class RocketChatComponent extends Component
{

    public static function RocketChatTask($kundenid,$type,$message)
	{
		$RocketChatUse =\Yii::$app->params['RocketChatUse'];
		if($RocketChatUse == TRUE){
            define('REST_API_ROOT', '/api/v1/');
			define('ROCKET_CHAT_INSTANCE', \Yii::$app->params['RocketChatHost']);
			$admin = new User(\Yii::$app->params['RocketChatUser'], \Yii::$app->params['RocketChatPassword']);
			$admin->login();
			if( $admin->login() ) {
                $channel = new Channel( \Yii::$app->params['RocketChatChannel'], array($admin) );
                $channel->postMessage(':cold_sweat: '.$type.' : '.$kundenid. ' ```'.$message );
			};


			
		}
	}
}
?>