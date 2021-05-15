
## Our Technologies
- Laravel 8
- Log Viewer Library by ARCANEDEV 
- Static Authentication (Without Database) using pin in env 

## Configure 
- Run In Your Server
- Change Pin Value In .env LOG_VIEWER_PASSWORD 

Note*: If you Want to Run With ```php artisan serve``` Change index.php to server.php

## Requirements

| Name | Docs |
| ------ | ------ |
| PHP 8 | https://www.php.net/releases/8.0/en.php |
| Composer | https://getcomposer.org/ |

## How To Use It ?
- Input Your Own Pin Value
- Enjoy :)

## How To Show Debug Log Or Set Other Log ?
- You can see docs <a href="https://laravel.com/docs/5.4/errors">Here</a>
- Just Set In Your Code You Wanna Put It (Example Below) , after that open log-viewer and choose log you want to show
````php
<?php
use Log;
.............
/*
* Other Code
*/
Log::emergency($message);
Log::alert($message);
Log::critical($message);
Log::error($message);
Log::warning($message);
Log::notice($message);
Log::info($message);
Log::debug($message);
/*
* Other Code
*/
````

## Important !!!
- This Project Not Recomended Run In Public Servers !!!

## Screenshoot
<p align="center"><img src="https://raw.githubusercontent.com/DwiyanTech/log-management/main/screenshoot/ss_1.png" width="400"></p>
<p align="center"><img src="https://raw.githubusercontent.com/DwiyanTech/log-management/main/screenshoot/ss_2.png" width="400"></p>

**Support Or Any Questions ?**
- Visit My Site And Follow !
- Instagram : <a href="https://instagram.com/_nugrah.p" target="_blank">`_nugrah.p`</a>