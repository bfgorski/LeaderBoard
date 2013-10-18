<?php

include_once 'defines.php';

function createTestData() {
	Utils::createDBTables(GAME_INFO_DB);
	Utils::createFakeLeaderBoardData();
}

createTestData();