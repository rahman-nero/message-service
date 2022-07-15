### Запуск приложения

Инфраструктура на докере, поэтому запуск не сложен.

Выполняем команды:

```
make docker-up
make prod-install || make dev-install
make key-generate
make laravel-migrate
make laravel-cache
make chown
```
