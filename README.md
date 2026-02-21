# Дневник артериального давления (Blood Pressure Diary)

Веб-приложение на базе Laravel для отслеживания и ведения дневника измерений артериального давления.

## Требования

- Docker
- Docker Compose

## Локальный запуск (Development)

Для локальной разработки используется конфигурация Nginx `docker/nginx/default-local.conf`, которая работает по HTTP на 80 порту.

1. **Клонирование репозитория:**
   ```bash
   git clone <url-репозитория>
   cd diary
   ```

2. **Настройка окружения:**
   Создайте файл `.env` из примера:
   ```bash
   cp .env.local .env
   ```
   Убедитесь, что настройки подключения к базе данных в `.env` соответствуют вашему `docker-compose.yml`.

3. **Запуск контейнеров:**
   ```bash
   docker-compose up -d --build
   ```

4. **Установка зависимостей:**
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   # Если используется фронтенд сборка:
   docker-compose exec app npm install && npm run dev
   ```

5. **Доступ:**
   Приложение доступно по адресу: http://localhost

## Запуск на продакшене (Production)

Для продакшена используется конфиг `docker/nginx/default-prod.conf`. Он настроен на HTTPS, использует HTTP/2 и требует наличия SSL сертификатов.

### Предварительная настройка

1. **Настройка домена:**
   В файле `docker/nginx/default-prod.conf` убедитесь, что директива `server_name` и пути к SSL сертификатам соответствуют вашему домену (текущая настройка указывает на `blood-pressure-diary.mtodzi.ru`).

2. **SSL Сертификаты (Let's Encrypt):**
   Конфигурация ожидает сертификаты по пути `/etc/letsencrypt/live/<ваш-домен>/`.
   Для получения сертификатов используйте Certbot. В конфиге Nginx предусмотрен location `/.well-known/acme-challenge/` для подтверждения домена.

### Развертывание

1. **Настройка окружения:**
   ```bash
   cp .env.prod .env
   ```
   Отредактируйте `.env`:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_URL=https://ваш-домен.ru`

2. **Запуск и оптимизация:**
   ```bash
   docker-compose -f docker-compose.prod.yml up -d --build
   
   docker-compose exec app composer install --no-dev --optimize-autoloader
   docker-compose exec app php artisan migrate --force
   docker-compose exec app php artisan config:cache
   docker-compose exec app php artisan route:cache
   docker-compose exec app php artisan view:cache
   ```
