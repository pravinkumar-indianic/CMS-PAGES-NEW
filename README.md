Step 1: composer config repositories.cms-pages vcs https://gitlab.indianic.com/packages/nova/cms-pages.git

Step: 2: run this command
sail composer require indianic/cms-pages

Step 3: run this command to migrate
php artisan import:cms-pages
