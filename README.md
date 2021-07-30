##  Installation

##### Following steps need to follow to run this project:

- Download repository from Git
- Switch to git folder that download from git
- branch name "master"
- then run following command on current directory
- Copy ".env.example" to ".env"
- need to create new db for (Authentication and Admin) and set db name to env

####### COMMAND

```
composer update

php artisan migrate

php artisan jwt:secret -(optional)
```

####### For test data run the command below
```
php artisan db:seed

```

####### Test Access
```
'email' : superuser@gmail.com
'password' : 123456

```

####### Api List



| Name |  METHOD | API | Authentication |
| --- | --- | --- | --- |
| Registration | POST | api/registration  | NO |
| Login | POST | api/login  |NO |
| User Logout | POST | api/auth/logout  | YES |
| User Information| POST | api/auth/details  | YES |
| Refresh Auth token| POST | api/auth/refresh  | YES |
| Categories | GET | api/categories  | NO |
| Products | GET | api/products  | NO |
| Product Details | GET | api/products/product_id  | NO |
| Admin category add | POST | api/auth/categories  | YES |
| Admin category list | GET | api/auth/categories  | YES |
| Admin category update | PUT | api/auth/categories/category_id  | YES |
| Admin category delete | DELETE | api/auth/categories/category_id  | YES |
| Admin product add | POST | api/auth/products  | YES |
| Admin product list | GET | api/auth/products  | YES |
| Admin product update | PUT | api/auth/products/product_id  | YES |
| Admin product delete | DELETE | api/auth/products/product_id  | YES |
