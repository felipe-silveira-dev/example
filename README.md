### Running project
```
cp .env.example .env
docker compose up
- wait for the containers to be created and run the following commands to give the necessary permissions and install the dependencies:
    chmod +x console.sh
    sudo chmod o+w ./storage/ -R
    or
    sudo chown -R $USER:www-data storage
    
    sudo chown -R $USER:www-data tests
    

./console.sh composer install
./console.sh artisan key:generate
./console.sh artisan migrate --seed
```

### Accessing the application
```
http://example.test

emails:
http://localhost:8025

usuario:
    user@email.com
password:
    password
```

### Accessing container
```
docker exec -it example-php-1 bash
OR
./console.sh bash
```

### When deploying to production, you can use the following command to optimize the application:
```
composer install --optimize-autoloader --no-dev

php artisan config:cache

php artisan event:cache

php artisan route:cache

php artisan view:cache
```
