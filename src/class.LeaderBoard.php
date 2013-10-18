<?php

/*
 LeaderBoard DB Schema:
 Database: gameinfo
 Table: gamescores
 
+-----------+------------+------+-----+---------+-------+
| Field     | Type       | Null | Key | Default | Extra |
+-----------+------------+------+-----+---------+-------+
| userid    | bigint(20) | YES  |     | NULL    |       |
| appid     | bigint(20) | YES  |     | NULL    |       |
| score     | bigint(20) | YES  |     | NULL    |       |
| timestamp | datetime   | YES  |     | NULL    |       |
+-----------+------------+------+-----+---------+-------+

 */
require_once('defines.php');

define('GAME_INFO_DB', 'gameinfo');
define('GAME_SCORES_TABLE', 'gamescores');
define('COUNT_KEY', 'count(distinct userid)');

class LeaderBoard {
	
	public static function update(array $updateParams) {
		$mysqli = new mysqli(DB_ADDRESS, DB_USER, DB_PASSWORD, GAME_INFO_DB, DB_PORT);
		
		if ($mysqli->connect_errno) {
    		echo ('Failed to connect to DB: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . "\n");
    		return false;
		} else {
			if (isset($updateParams['ts'])) {
				$ts = $updateParams['ts'];
			} else {
				$ts = strftime('%Y-%m-%d %H:%M:%S');
			}
		
			$insertQuery = 'insert into ' . GAME_SCORES_TABLE . ' values(' . 
				$updateParams['userId'] . ',' . $updateParams['appId'] . ',' . $updateParams['score'] . ',\'' . $ts . '\');';
			$result = $mysqli->query($insertQuery);
			
			return true;
		}
	}
	
	public static function createReport($appId) {
		if (empty($appId)) {
			return ('Invalid App Id for Leader Board report');
		}
		
		$mysqli = new mysqli(DB_ADDRESS, DB_USER, DB_PASSWORD, GAME_INFO_DB, DB_PORT);
		
		if ($mysqli->connect_errno) {
    		echo ('Failed to connect to DB: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . "\n");
    		return false;
		} else {
			$report = array();
			
			// number of distinct users
			$query = ('select count(distinct userid) from gamescores where appid = ' . $appId . ';');		
			$result = $mysqli->query($query);
			$numPlayers = 0;
			
			if (isset($result) && is_a($result, 'mysqli_result')) {	
				$data = $result->data_seek(0);
				$row = $result->fetch_assoc();
				$numPlayers = isset($row[COUNT_KEY]) ? $row[COUNT_KEY] : 0;
			}

			$report['totalPlayers'] = $numPlayers;
			
			// Number of players today
			$numPlayersToday = 0;
			$query = ('select count(distinct userid) from gamescores where timestamp > CURRENT_DATE and appid = ' . $appId . ';');
			$result = $mysqli->query($query);
			
			if (isset($result) && is_a($result, 'mysqli_result')) {
				$data = $result->data_seek(0);
				$row = $result->fetch_assoc();
				$numPlayersToday = isset($row[COUNT_KEY]) ? $row[COUNT_KEY] : 0;
			}
			
			$report['playersToday'] = $numPlayersToday;
			
			// top 10 players by score
			$topTenQuery = ('select userid,score from gamescores where appid = ' . $appId . ' order by score desc limit 10;');
			$topTenResult = $mysqli->query($topTenQuery);
			$topTen = array();
			
			if (isset($topTenResult) && is_a($topTenResult, 'mysqli_result')) {
				for ($i = 0; $i < $topTenResult->num_rows; $i++) {
					$data = $topTenResult->data_seek($i);
					$row = $topTenResult->fetch_assoc();
					$topTen[] = $row;
				}
			}
			
			$report['topTen'] = $topTen;
			
			// top 10 players that improved
			
			$mysqli->close();
			return $report;
		}
	
	}

}