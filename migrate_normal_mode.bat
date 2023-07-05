php artisan migrate:fresh --path=/database/migrations/2014_10_12_000000_create_users_table.php
php artisan migrate --path=/database/migrations/2014_10_12_100000_create_password_resets_table.php
php artisan migrate --path=/database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php
php artisan migrate --path=/database/migrations/2014_10_12_200000_add_two_factor_columns_to_users_table.php
php artisan migrate --path=/database/migrations/2019_08_19_000000_create_failed_jobs_table.php
php artisan migrate --path=/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php
php artisan migrate --path=/database/migrations/2023_05_14_212324_create_sessions_table.php


php artisan migrate --path=/database/migrations/2023_05_29_160137_create_orders.php
php artisan migrate --path=/database/migrations/2023_05_29_155643_create_calendar_events.php
php artisan migrate --path=/database/migrations/2023_05_29_155741_create_categories.php
php artisan migrate --path=/database/migrations/2023_05_29_191804_create_subcategories.php
php artisan migrate --path=/database/migrations/2023_05_29_160308_create_products.php
php artisan migrate --path=/database/migrations/2023_05_29_155801_create_commands.php
php artisan migrate --path=/database/migrations/2023_05_29_155834_create_special_commands.php
php artisan migrate --path=/database/migrations/2023_05_29_155927_create_cancelled_commands.php
php artisan migrate --path=/database/migrations/2023_05_29_155950_create_temporary_commands.php
php artisan migrate --path=/database/migrations/2023_05_29_160008_create_user_discount.php
php artisan migrate --path=/database/migrations/2023_05_29_160036_create_statuses.php
php artisan migrate --path=/database/migrations/2023_05_29_160105_create_schedules.php
php artisan migrate --path=/database/migrations/2023_05_29_160115_create_tables.php
php artisan migrate --path=/database/migrations/2023_05_29_160206_create_canceled_orders.php
php artisan migrate --path=/database/migrations/2023_05_29_160241_create_payment_methods.php
php artisan migrate --path=/database/migrations/2023_05_29_160319_create_restaurants.php


php artisan db:seed --class=UserSeeder
php artisan db:seed --class=FullSeeder
