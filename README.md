# wind
Take the wind Challenge

##


## Installation

```bash

cp .env.example .env

//Edit ".env" as follows.
DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=laraveldb
DB_USERNAME=userdb
DB_PASSWORD=passworddb

composer install

php artisan migrate
php artisan db:seed

php artisan l5-swagger:generate
// avaiable at /api/documentation

npm install
npm run dev

## Endpoints
- POST /api/register
- POST /api/login
- GET /api/teams
- POST /api/teams
- POST /api/teams/add-member
- POST /api/teams/remove-member
- GET /api/teams/{id}
- GET /api/teams/{id}/members
- PUT /api/teams/{id}

