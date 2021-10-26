# frontend

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).

# backend

## Project setup
```
composer install
```

## Generate .env file by copying .env.example
```
copy .env.example .env
```

## Generate application key, create database name with DB_DATABASE in .env, and migrate database
```
php artisan key:generate
php artisan migrate
```

### Run server for development in Local (http://localhost:8000)
```
php artisan serve
```