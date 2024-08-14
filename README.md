# laravel_small_shop
 
## setup Instruction

### Prerequisites
Ensure you have PHP installed. You can download it from [XAMPP](https://www.apachefriends.org/).

Ensure you have Visual Studio Code installed. You can download it from [vscode](https://code.visualstudio.com/).

Ensure you have Composer installed. You can download it from [composer](https://getcomposer.org/).

Laravel download link [Laravel](https://laravel.com/)

Filament code link [Filament](https://filamentphp.com/)

1. **Creating a Laravel Project**

```
composer create-project laravel/laravel laravel_small_shop
```

2. **navigate to project folder**

```
cd laravel_small_shop
```

3. **create category** 
```
php artisan make:model Category -m
```

4. **create brand** 
```
php artisan make:model Brand -m 
```


5. **create product**
```
php artisan make:model Product -m
```


6. **create user**
```
php artisan make:model User -m
```


7. **create cart**
```
php artisan make:model Cart -m
```

8. **create order** 
```
php artisan make:model Order -m
```


9. **create order item**
```
php artisan make:model OrderItem -m
```

10. **filament installation**
```
composer require filament/filament:"^3.2" -W
```

11. **filament panel installation**
```
php artisan filament:install --panels
```

12. **category resource**
```
php artisan make:filament-resource Category --generate
```

13. **brand resource**
```
php artisan make:filament-resource Brand --generate
```

14. **product resource**
```
php artisan make:filament-resource Product --generate
```

15. **user resource**
```
php artisan make:filament-resource User --generate
```

16. **order resource**
```
php artisan make:filament-resource Order --generate
```
17. **cart resource**
```
php artisan make:filament-resource Cart --generate
```
18. **order item resource**
```
php artisan make:filament-resource OrderItem --generate
```

