```bash
https://github.com/mprince2k18/publishing-platform.git
```
Clone Repository
```bash
composer install
```
Setup database
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=publishing-platform
DB_USERNAME=root
DB_PASSWORD=
```
Setup SMTP
```bash
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=b4c77bc26c60e0
MAIL_PASSWORD=1eb1739aabab69
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
Serve Application
```bash
php artisan serve
```

Create Admin
```bash
php artisan db:seed AdminSeeder
```
```bash
email: admin@mail.com
password: 12345678
```