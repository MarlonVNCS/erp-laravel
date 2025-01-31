Sistema ERP utilizando Laravel 11.
Apenas para estudos.

# Setup Docker Laravel 11 com PHP 8.3
Repositório base: https://github.com/especializati/setup-docker-laravel.git

### Passo a passo
Clone Repositório
```sh
git clone -b main https://github.com/MarlonVNCS/erp-laravel erp-laravel
```
```sh
cd erp-laravel
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Crie o Arquivo .env
```sh
cp .env.example .env
```

Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

OPCIONAL: Gere o banco SQLite (caso não use o banco MySQL)
```sh
touch database/database.sqlite
```

Rodar as migrations
```sh
php artisan migrate
```

Adicionar breeze ao composer.json 
```sh
composer require laravel/breeze --dev
```

Instalar o breeze 
```sh
php artisan breeze:install
```
Selecionar 
Blade with Alpine
Dark mode: Yes
Pest 

Instalar o npm 
```sh
npm install
```

Build assets 
```sh
npm run build
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)
