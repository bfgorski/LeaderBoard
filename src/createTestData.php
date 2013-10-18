<?php

include_once 'defines.php';

function createTestData() {
	//Utils::createDBTables('gameinfo');
	
	if (isset($argv[1])) {
		$count = intval($argv[1]);
	} else {
		$count = 1;
	}
	
	Utils::createFakeLeaderBoardData($count);
}

createTestData();
//createDBTables();