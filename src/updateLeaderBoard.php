<?php

require_once('fb-php-sdk/facebook.php');
require_once('defines.php');

$config = array();
$config['appId'] = FB_APPID;
$config['secret'] = FB_APP_SECRET;

function updateLeaderBoard() {
	$fbRequest = null;
	
	if (isset($_POST['signed_request'])) {
		$fbRequest = $_POST['signed_request'];
	} else {
		$fbRequest = FB_REQUEST;
	}
	$requestInfo = FBWrapper::parseSignedRequest($fbRequest, FB_APP_SECRET);
	
	
	if (!isset($requestInfo['user_id'])) {
		return array('e' => 'Unable to parse signed request');
	}
	
	if (isset($_POST['score']) && is_numeric($_POST['score']) ) {
		$score = intval($_POST['score']);
		
		if ($score < 0) {
			return array('e' => ('Invalid score ' . $_POST['score']));
		}
	} else {
		return array('e' => ('No score given'));
	}
	
	$updateParams = array(
		'userId' => $requestInfo['user_id'],
		'appId' => FB_APPID,
		'score' => $score
	);
	
	$result = LeaderBoard::update($updateParams);
	return array('r' => $result);
}

$response = updateLeaderBoard();
echo (json_encode($response) . "\n");
