# MVCS

- Controller: Trung tâm xử lý
- Model: Khai báo bảng trong database, thao tác với database
- Service: Logic nghiệp vụ

Controller gọi Service
Service gọi Model
Model gọi database
Controller tiếp nhận request từ client (frontend), trả về response cho client

## Lệnh

Tạo controller: php artisan make:controller TenController

Request -> router laravel -> controller -> view (blade) -> vuejs

Ví dụ:

`/san-pham --> route laravel
    load vuejs
        button order --> gọi api laravel`

Tạo file migration

php artisan make:migration
