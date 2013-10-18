
createTestData.php
 - creates DB tables and test data
 
getLeaderBoard.php
 - get HTML doc that shows num of players, players that played today and top 10 players.
 - I couldn't get the query for top 10 week over week to run efficiently
 - tested with curl http://localhost:8888/getLeaderBoard.php
 
 updateLeaderBoard.php
  - add a new score to the DB
  - tested with curl --data "score=123456&signed_request=cjv1NZlSRCthYq9rAyWEidD7QE98p0PKZvVwpQ7gPwg.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImV4cGlyZXMiOjEzMjI4NTYwMDAsImlzc3VlZF9hdCI6MTMyMjg1MDc1NCwib2F1dGhfdG9rZW4iOiJBQUFCelMwYVhTMDBCQUlob0I1bmhrYnZJU0xLSGpNb3ZIN2ZTTmMzWkFxbnVNT2NvYmpJUHoxNGFmWXV1dzBkbkZzeVpBV2JHU2MycXZBakdjRzZUQ1RWZzBLOUVGUWJ5WkJwNTU0ZXE5M2FTWkFXZXpVeEYiLCJ1c2VyIjp7ImNvdW50cnkiOiJ1cyIsImxvY2FsZSI6ImVuX1VTIiwiYWdlIjp7Im1pbiI6MjF9fSwidXNlcl9pZCI6IjEwMDAwMzI5MTY2MTkwOSJ9" http://localhost:8888/updateLeaderBoard.php 
  
class.LeaderBoard.php
 - methods for writing updates to the DB and creating the report
 
 class.Utils.php
  - utility methods for creating db tables and test data
  
 bestWeekOverWeek.txt
  - SQL query to calculate users with the best week over week improvement
  - I think the query is correct but it runs too slow.
   