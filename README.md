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
