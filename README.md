## Laravel API Backend Boilerplate


### Author 
- @JJRuizDeveloper

### Requirements
- Composer
- PHP 8.2+

### This boilerplate includes
- Auto API Docs generation following the SCRAMBLE annotation rules
- Basic endpoints for login, register, update user name and update user password
- Dockerization (to use it just if you want it)

### Localhost Deployment
```
composer install
php artisan migrate:fresh --seed
php artisan serve
```

### Docker Deployment
```
# Build images and run containers in the background:
docker-compose up -d --build

# Verify containers are working properly:
docker-compose ps

# Once containers are running, execute database migrations and seeders:
docker-compose exec app php artisan migrate --seed

```


### API Documentation
API Documentation is auto-generated following the SCRAMBLE annotation rules
```
# The API is available in the local environment when the server is up, at the following relative path:
/docs/api
```
