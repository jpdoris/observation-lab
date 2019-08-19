
## Observation Lab Concern Reporting
This is a demo app made for a scientific lab to report observations 
on its subjects, assign next steps to technicians via notifications, 
and view and manage report status. 

### Build Steps:
1. Pull latest master from Git
2. install composer and npm

#### Local/Dev Environment):
3. Run 'dev' build script via npm (npm run dev)
4. Run DB migrations with seeds:
 - php artisan migrate --seed

#### Production Environment):
5. Create and modify a .env.prod file to suit
6. Run DB migrations:
 - php artisan migrate
7. Modify seeders script to as desired, and skip report table:
 - comment this line in database/seeds/DatabaseSeeder.php: "$this->call(ReportTableSeeder::class);"
8. Seed tables:
 - php artisan db:seed
