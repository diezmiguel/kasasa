<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About this project

Simple API service that will add a new loan  to the database and also retrieve  the list of loans in the ddatabse. The available endpoints are below:

 - GET /api/loan/list - return type JSON
 - POST /api/loan/add  - return type JSON.

I have implemented JWT  auth token  that checks for a  the Bearer token in the header.

## UNIT TESTING
I have created some unit testing as well as Feature tests. The tests are running in a different database specified in phpunit.xml. It is a clone one the real database. Below is the DDL to creaste the table in the testing database:

CREATE TABLE `loan` (  
  `id` bigint(20) unsigned NOT NULL,  
  `created_at` timestamp NULL DEFAULT NULL,  
  `updated_at` timestamp NULL DEFAULT NULL,  
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,  
  `ssn` int(11) NOT NULL,  
  `dob` date NOT NULL,  
  `loan_amount` double(8,2) NOT NULL,  
  `rate` double(8,2) NOT NULL,  
  `type` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,  
  `term` int(11) NOT NULL,  
  `apr` double(8,2) NOT NULL  
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;  


