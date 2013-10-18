<?php

define('FB_APPID', '126767144061773');
define('FB_APP_SECRET', '21db65a65e204cca7b5afcbad91fea59');
define('FB_REQUEST', 'cjv1NZlSRCthYq9rAyWEidD7QE98p0PKZvVwpQ7gPwg.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImV4cGlyZXMiOjEzMjI4NTYwMDAsImlzc3VlZF9hdCI6MTMyMjg1MDc1NCwib2F1dGhfdG9rZW4iOiJBQUFCelMwYVhTMDBCQUlob0I1bmhrYnZJU0xLSGpNb3ZIN2ZTTmMzWkFxbnVNT2NvYmpJUHoxNGFmWXV1dzBkbkZzeVpBV2JHU2MycXZBakdjRzZUQ1RWZzBLOUVGUWJ5WkJwNTU0ZXE5M2FTWkFXZXpVeEYiLCJ1c2VyIjp7ImNvdW50cnkiOiJ1cyIsImxvY2FsZSI6ImVuX1VTIiwiYWdlIjp7Im1pbiI6MjF9fSwidXNlcl9pZCI6IjEwMDAwMzI5MTY2MTkwOSJ9');
define('DB_ADDRESS', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_PORT', '8889');

define('GAME_INFO_DB', 'gameinfo');

define('ONE_HOUR_IN_SECONDS', 3600);
define('ONE_DAY_IN_SECONDS', 86400);
define('ONE_WEEK_IN_SECONDS', 604800);
define('TWO_WEEKS_IN_SECONDS', 1209600);

require_once 'FBWrapper.php';
require_once 'class.LeaderBoard.php';
require_once 'class.Utils.php';