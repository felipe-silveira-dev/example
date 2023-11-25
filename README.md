### Running project
```
make build
```

### Accessing the application
```
http://example.test
```

### Accessing container
```
docker exec -it example-php-1 bash
```

### When deploying to production, you can use the following command to optimize the application:
```
composer install --optimize-autoloader --no-dev

php artisan config:cache

php artisan event:cache

php artisan route:cache

php artisan view:cache
```
