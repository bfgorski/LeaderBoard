<?php

require_once('defines.php');

function createHTMLReport($report) {
echo <<< _END
<html><title>Leader Board Report</title>
<table border=1>
<tr><td>Num Players:</td><td>
_END;
echo $report['totalPlayers'];
echo <<< _END
</td></tr>
<br>
<tr><td>Played Today:</td><td>
_END;

echo $report['playersToday'];

echo <<< _END
</td></tr>
<br>
</table>
<h3>Top Ten Scores</h3>
<table border=1>
<th>User Id</th>
<th>Score</th>
_END;

foreach($report['topTen'] as $userInfo) {
echo <<< _END
	<tr><td>
_END;
	echo $userInfo['userid'];
echo <<< _END
	</td><td>
_END;
	echo $userInfo['score'];
echo <<< _END
	</td></tr>
_END;
}

echo <<< _END
</table>
</html>
_END;
}

function getLeaderBoard() {
	$report = LeaderBoard::createReport(FB_APPID);
	$jsonFormat = json_encode($report);
	createHTMLReport($report);
}

getLeaderBoard();
