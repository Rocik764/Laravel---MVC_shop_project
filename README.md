# Laravel MVC - Online shop

## Table of contents
* [About project](#about-project)
* [Technologies](#technologies)
* [Database structure](#database-structure)
* [Example screenshots](#example-screenshots)

## About project
This is exactly the same project as [this](https://github.com/Rocik764/Spring-Boot---MVC_shop_project) one, but made in Laravel.
My first bigger project using Laravel for university. The application is basicaly an online shop where users can register, 
search for products, add them to cart, remove if needed, order products and check their orders. Admins can
add new products/categories etc, manage users and shop. Authentication is session based,
frontend made with Blade templates and bootstrap.

## Technologies
* Laravel 8
* Bootstrap 4
* PHP 8
* JavaScript
* PostgreSQL
* HTML & CSS

## Database structure
##### cart_items
| id  | product_id | user_id | amount |
| --- |:----------:| -------:|-------:|
|serial|integer|integer|integer|
##### category
| id  | name |
| --- |:----:|
|serial|varchar(50)|
##### subcategory
| id  | name |
| --- |:----:|
|serial|varchar(50)|
##### orders
| id  | user_id | purchase_date | is_completed | address | invoice | phone | comment | delivery | payment | total_price |
| --- |:-------:| ------------- |:------------:| ------- |:-------:| ----- |:-------:| -------- |:-------:|-------------|
|serial|integer|date|boolean|varchar(100)|boolean|varchar(17)|text|varchar(30)|varchar(30)|double precision|
##### orders_details
| id  | product_id | user_id | amount | purchase |
| --- |:----------:| ------- |:------:| ---------|
|serial|integer|integer|integer|date|
##### producent
| id  | name | characteristics | phone |
| --- |:----:|-----------------|-------|
|serial|varchar(50)|text|varchar(17)|
##### product
| id  | name | description | quantity | price | category_id | subcategory_id | producent_id | image |
| --- |:----:| ----------- |:--------:| ----- |:-----------:| -------------- |:------------:| ----- |
|serial|varchar(100)|text|integer|double precision|integer|integer|integer|bytea|
##### roles
| role_id  | name |
| -------- |:----:|
|integer|varchar(45)|
##### user
| id  | name | email | email_verified_at | password | remember_token | created_at | updated_at |
| --- |:----:|:-----:|:-----------------:|:--------:|----------------|------------|------------|
|bigserial|varchar(255)|varchar(255)|timestamp|varchar(255)|varchar(100)|timestamp|timestamp|
##### users_roles
| user_id  | role_id |
| -------- |:-------:|
|integer|integer|

[products_list]: ./readme_images/products_list.JPG "products list"
[product_add_to_cart]: ./readme_images/product_add_to_cart.JPG "add to cart"
[cart]: ./readme_images/cart.JPG "cart"
[order]: ./readme_images/order.JPG "order"
[checking_order]: ./readme_images/checking_order.gif "checking order"
[checking_all_orders]: ./readme_images/checking_all_orders.gif "checking all orders"
[edit_products_and_users]: ./readme_images/edit_products_and_users.gif "editing products and users"

## Example screenshots
(in case anyone wants to see it without downloading)
##### Products list
![alt text][products_list]
##### Adding product to cart (need to be logged in and cannot add more than there's available or less than 1)
![alt text][product_add_to_cart]
##### User's cart
![alt text][cart]
##### User ordering products in his cart
![alt text][order]
##### User checking his order
![alt text][checking_order]
##### Admin checking all orders (can finish them or un-finish)
![alt text][checking_all_orders]
##### Admin managing products and users (editing/removing products and users etc)
![alt text][edit_products_and_users]
