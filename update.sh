echo "UPDATING FRONTEND..."

cd /home/sites/frontend
git pull
rm -Rf /home/sites/frontend/app/cache/*
php app/console assets:install --symlink web/
php app/console assetic:dump --env=prod --no-debug
php app/console cache:warmup --env=prod --no-debug
php app/console doctrine:migration:migrate
composer dump-autoload --optimize
cd /home/sites/frontend/web
s3cmd sync --recursive bundles s3://proofpilot/
s3cmd sync --recursive css s3://proofpilot/css/
s3cmd sync --recursive js s3://proofpilot/js/
s3cmd sync --recursive images s3://proofpilot/images/
