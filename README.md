## Laravel API Backend Boilerplate


### Author 
- @JJRuizDeveloper

### Requirements
- Composer
- PHP 8.2+
- NodeJS

### This boilerplate includes
- NEW!! - Admin Panel using FilamentPHP
- NEW!! - Roles and Permissions managed by Admin Panel
- NEW!! - Users Management by Admin Panel
- Coming Soon - Admin Panel translation
- Auto API Docs generation following the SCRAMBLE annotation rules
- Basic endpoints for login, register, recover password, email verification, update user name and update user password
- Dockerization (to use it just if you want it)
- Dynamic Language: You can setup the available lenguages to response in config/app locales variable. Then, Frontends can request using Accept Language to specify the answer language
- English and Spanish translations added

### Before to begin...
- Copy/Paste .env.example file and rename the copy as .env
- Adjust .env variables as needed

```
composer install
php artisan migrate --seed
```

### Localhost Deployment
```
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

### Admin Panel
Create admin user (php artisan migrate needs to be done before):
```
php artisan hexa:account --create
```

Before go to production:
```
php artisan filament:optimize
php artisan icon:cache
npm run build
```

### Coming Soon: Admin Panel Translation
TODO


### Extra Docs
Admin Panel:
https://filamentphp.com/

Roles and Permissions:
https://filamentphp.com/plugins/hexters-hexa

Api Doc generator:
https://scramble.dedoc.co/