<?php

class Utils {
	public static function createDBTables($dbName) {
		$mysqli = new mysqli(DB_ADDRESS, DB_USER, DB_PASSWORD, 'mysql', DB_PORT);
		
		if ($mysqli->connect_errno) {
    		echo ('Failed to connect to DB: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . "\n");
    		return false;
		} else {
			$createDB = 'create database ' . $dbName;
			$result = $mysqli->query($createDB);
			
			if ($result) {
				echo ("Created DB $dbName\n");
				$mysqli->close();
				$mysqli = new mysqli(DB_ADDRESS, DB_USER, DB_PASSWORD, $dbName, DB_PORT);
				$createTable = 'create table gamescores (userid BIGINT,appid BIGINT,score BIGINT,timestamp DATETIME);';
				$createTableResult = $mysqli->query($createTable);
				
				if (!empty($createTableResult)) {
					echo ("Created table gamescores\n");
				} else {
					echo ("Failed to create table gamescores\n");
				}
			} else {
				echo ("Failed to create DB $dbName \n");
			}

		}
	}
	
	public static function createFakeLeaderBoardData($count, $appId = FB_APPID) {
		// Use Pacific Time
		date_default_timezone_set('America/Los_Angeles');
		
		// 20K with 50 entries each
		$userIdStart = 100003291661909;
		$userIdEnd = 100003291681909;
		$currentTime = time();
		
		for ($userId = $userIdStart; $userId < $userIdEnd; $userId++) {
			$score = rand(1,1000000);
			
			$timeOffset = rand(1, 3*ONE_DAY_IN_SECONDS);
			$timeStampString = strftime('%Y-%m-%d %H:%M:%S', ($currentTime - $timeOffset));
			
			$updateParams = array(
				'userId' => $userId,
				'appId' => $appId,
				'score' => $score,
				'ts' => $timeStampString
			);

			LeaderBoard::update($updateParams);
			
			usleep(100);
			
			for ($i = 0; $i < 49; $i++) {
				$score = rand(1,1000000);
				$timeOffset = rand(ONE_DAY_IN_SECONDS, TWO_WEEKS_IN_SECONDS);
				$timeStampString = strftime('%Y-%m-%d %H:%M:%S', ($currentTime - $timeOffset));
				
				$updateParams = array(
					'userId' => $userId,
					'appId' => $appId,
					'score' => $score,
					'ts' => $timeStampString
				);
	
				LeaderBoard::update($updateParams);
				
				usleep(100);	
			}
			
			echo ('user ' . $userId . "\n");
		}
		
		/*for ($i = 0; $i < $count; $i++) {
			$userId = rand(100003291661909, 100003291671909);
			$appId = FB_APPID;
			$score = rand(1000000,100000000);
			$timeOffset = rand(0, TWO_WEEKS_IN_SECONDS);
			$timeStamp = time() - $timeOffset;
			$timeStampString = strftime('%Y-%m-%d %H:%M:%S', $timeStamp);
			
			$updateParams = array(
				'userId' => $userId,
				'appId' => $appId,
				'score' => $score,
				'ts' => $timeStampString
			);
			
			$result = LeaderBoard::update($updateParams);
		}*/
	}
}