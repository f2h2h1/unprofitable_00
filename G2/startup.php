<?php
system("echo %cd%\public");
system("php -S 127.0.0.1:9001 -t %cd%\public");