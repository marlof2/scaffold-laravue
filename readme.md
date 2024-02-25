<h1 align="center">Scaffold Laravue</h1>

### Requisitos:

- PHP 8.1.13
- Laravel Framework 10.18.0
- Node v16.13.0
- NPM v9.2.0
- Vue 2.6.11
- @vue/cli 5.0.8
- DB: MySql

### Personalized Command
- php artisan crud:generator ClassName --fields=fields-name-1 --fields=fields-name-2 --fields=fields-name-etc It creates controller layer, model layer, service layer, migration, http request and a route all based on class name defined

### Front-end
- Instalar as dependências.

```bash
  npm install
```
- Para subir o server vue.

```bash
  npm run start
```
### Back-end
- Para subir o server do php.

```bash
  php artisan serve
```

- Criar as tabelas do banco de dados e as seeds.

```bash
  php artisan migrate --seed
```
