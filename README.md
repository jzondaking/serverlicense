# Server License - Quản lý giấy phép phần mềm, khách hàng

Có đầy đủ tài liệu API tích hợp, quản lý giấy phép, khách hàng linh hoạt. Có cấu hình thời hạn giấy phép theo thời gian.

> 🚫 Cấm thương mại mã nguồn miễn phí dưới mọi hình thức!
> 🤩 Có sẵn trang cấu hình database khi phát hiện DB_DATABASE và DB_USERNAME chưa cấu hình.

## Installation

Clone the repo locally:

```sh
git clone https://github.com/ducthanh-jtech/serverlicense.git
cd serverlicense
```

Install PHP dependencies:

```sh
composer install
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an MySQL database & Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Run artisan server (***unnecessary***):

```sh
php artisan serve
```

You're ready to go! [Server License](http://127.0.0.1:8000/) in your browser, and login with:

- **Email Address:** admin@jzontech.asia
- **Password:** admin

## Bug report & Contribute

- Facebook *(Online 24/24)*: **https://www.facebook.com/jzondev**
- Telegram *(Online 24/24)*: **https://t.me/cuteboiz999**
- Zalo: **0966142061** *(Không khuyến khích)*

## Credits

- *Fully coded by **Jzon Dev / Pham Duc Thanh.***
- *Product of Jzon Tech.*

**CẢM ƠN BẠN ĐÃ SỬ DỤNG SẢN PHẨM CỦA JZON TECH 😍**