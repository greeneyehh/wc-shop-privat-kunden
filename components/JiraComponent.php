<?php
namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use JiraRestApi\Configuration\ArrayConfiguration;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\JiraException;


class JiraComponent extends Component{
	
	public function JiraTask($AssigneeName)
	{
		$jiraUse =\Yii::$app->params['jiraUse'];
		if($jiraUse == TRUE){
		try {
		    $issueField = new IssueField();
		    $issueField->setProjectKey(\Yii::$app->params['jiraProject'])
		                ->setSummary("something's wrong")
		                ->setAssigneeName($AssigneeName)
		                ->setPriorityName("Highest")
		                ->setIssueType("Aufgabe")
		                ->setDescription("
		                * Full description for issue
		                * Full description for issue
		                * Full description for issue
		                * Full description for issue
		                * Full description for issue
		                * Full description for issue
		                * Full description for issue
		                * Full description for issue
		                ");
			$issueService = new IssueService(new ArrayConfiguration(
	          array(
	               'jiraHost' => \Yii::$app->params['jiraHost'],
	               'jiraUser' => \Yii::$app->params['jiraUser'],
	               'jiraPassword' => \Yii::$app->params['jiraPassword'],
	               'cookieAuthEnabled' => \Yii::$app->params['jiraCookieAuthEnabled'],
	               'cookieFile' => \Yii::$app->params['jiraCookieFile'],
	          )
	   		));
		
		    $ret = $issueService->create($issueField);
		} catch (JiraException $e) {
			echo "<pre>";
			print_r("Error Occured! " . $e->getMessage());
		}
	}
}

}
?>