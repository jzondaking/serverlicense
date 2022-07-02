
# Server License - Quản lý giấy phép phần mềm, khách hàng



Có đầy đủ tài liệu API tích hợp, quản lý giấy phép, khách hàng linh hoạt. Có cấu hình thời hạn giấy phép theo thời gian.

  

```
🚫 Cấm thương mại mã nguồn miễn phí dưới mọi hình thức!
🤩 Có sẵn trang cấu hình database khi phát hiện DB_DATABASE và DB_USERNAME chưa cấu hình.
```

   - [Installation](#installation)
   - [Api Documentation](#api-documentation)
   - [FAQ](#faq)
   - [Bug report & Contribute](#bug-report--contribute)
   - [Credits](#credits)
  

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

Create public storage symbol link:

  

```sh

php artisan storage:link

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

  

-  **Email Address:** admin@jzontech.asia

-  **Password:** admin

  
## API Documentation

- **Kiểm tra, thông tin giấy phép:** 
- -  **GET** {{base_url}}/api/license?key=*{{license_key}}*
- **Thông tin sản phẩm (bao gồm version log):** 
- - **GET** {{base_url}}/api/product?id=*{{product_id}}*

## FAQ

**1. Làm sao để phần mềm của tôi biết phiên bản hiện tại là gì?** 
- Request api `Thông tin sản phẩm`, nó sẽ trả về kết quả bao gồm cả nhật kí phiên bản. Phiên bản mới nhất sẽ được đẩy lên đầu tiên, ngoài ra còn có key (`lastest_version`) riêng để nhận biết phiên bản mới nhất.

**2. Làm sao để cập nhật phần mềm theo phiên bản?** 
- Request api `Thông tin sản phẩm`, `versions` sẽ hiển thị tất cả phiên bản và đường dẫn tải bản cập nhật.

## Bug report & Contribute

- Facebook *(Online 24/24)*: **https://www.facebook.com/jzondev**

- Telegram *(Online 24/24)*: **https://t.me/cuteboiz999**

- Zalo: **0966142061**  *(Không khuyến khích)*

  

## Credits

  

-  *Fully coded by **Jzon Dev / Pham Duc Thanh.***

-  *Product of Jzon Tech.*

  

**CẢM ƠN BẠN ĐÃ SỬ DỤNG SẢN PHẨM CỦA JZON TECH 😍**
