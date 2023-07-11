#!/bin/bash

# Execute this script like this in additional actions
# chmod 744 deploy.sh
# ./deploy.sh

MYLOG="deploy.log"

echo "############################################################" > $MYLOG
echo "# START GIT DEPLOY $(date --iso-8601='seconds')               #" >> $MYLOG
echo "############################################################" >> $MYLOG

export PATH="/opt/plesk/php/8.2/bin:/opt/plesk/node/19/bin:$PATH" &>> $MYLOG

echo "user: $(whoami)" >> $MYLOG
echo "php: $(php -r 'echo PHP_VERSION;')" >> $MYLOG
echo "npm: $(npm -v)" >> $MYLOG
echo "node: $(node -v)" >> $MYLOG

php /usr/lib/plesk-9.0/composer.phar install --optimize-autoloader &>> $MYLOG

php artisan optimize:clear &>> $MYLOG
php artisan config:cache &>> $MYLOG
php artisan route:cache &>> $MYLOG
php artisan view:cache &>> $MYLOG
php artisan migrate:refresh --seed --force &>> $MYLOG
php artisan key:generate &>> $MYLOG
php artisan storage:link &>> $MYLOG

npm install &>> $MYLOG
npm run build &>> $MYLOG

echo "############################################################" >> $MYLOG
echo "# END GIT DEPLOY $(date --iso-8601='seconds')                 #" >> $MYLOG
echo "############################################################" >> $MYLOG
