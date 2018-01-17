Very simple URL shortener - installation
========================

- Clone repository
```
git clone https://github.com/kranon/monkeysdevs.git
```
- Go to project directory
```
cd /project/dir
``` 
- Install project 
```
sh reinstall.sh
```

- Start server
```
php bin/console server:start
```

If you want determine user country by IP, 
download GeoLite2 City DB from 
https://dev.maxmind.com/geoip/geoip2/geolite2/

Upload DB to 
```
/src/Monkeydevs/ShortenerBundle/Resources/public/GeoLite2-City.mmdb
```

and uncomment lines from 93 to 95 in 
```
/src/Monkeydevs/ShortenerBundle/Controller/DefaultController.php
```
