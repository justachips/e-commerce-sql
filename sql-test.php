<?php

require('vendor/autoload.php');

$faker = Faker\Factory::create();

$db = new PDO('mysql:host=localhost;dbname=mydatabase77', 'tfgi', 'azerty');


$db->query("
    DELETE FROM addresses;
    DELETE FROM users;
    DELETE FROM products;
    ALTER TABLE users AUTO_INCREMENT = 1;
    ALTER TABLE products AUTO_INCREMENT = 1;
");

foreach(range(1,20) as $x) {


    $db->query("INSERT INTO users (
        User_FirstName,
        User_LastName,
        User_Phone,
        User_Email,
        User_Password
        )
        VALUES(
        '{$faker->firstName()}',
        '{$faker->lastName()}',
        '{$faker->phoneNumber}',
        '{$faker->email}',
        '{$faker->password}'
        );
    ");

    $user_id = $db->lastInsertId(); //recupere le user_id 


    $db->query("INSERT INTO products (
        Product_Name, 
        Product_Description,
        Product_Type,
        Product_Price,
        Product_NumberLeft,
        Product_Available
        )
        VALUES(
        '{$faker->domainWord}',
        '{$faker->text()}',
        '{$faker->colorName}',
        '{$faker->randomNumber()}',
        '{$faker->randomNumber()}',
        '{$faker->colorName}'
        );
    ");

    $product_id = $db->lastInsertId(); //recupere le product id


    $db->query("INSERT INTO addresses (
        User_Id,
        Address_Address,
        Address_CityName,
        Address_PostalCode,
        Address_State,
        Address_Country
        )
        VALUES(
        '{$user_id}',
        '{$faker->address}',
        '{$faker->city}',
        '{$faker->postcode}',
        '{$faker->state}',
        '{$faker->country}'
        );
    ");

    $db->query("
        INSERT INTO payements (
            User_Id,
            Payement_CartNumber,
            Payement_ExpirationDate,
            Payement_Name,
            Payement_SafeCode
            )
        VALUES(
        '{$user_id}',
        '{$faker->randomNumber()}',
        '{$faker->date($format = 'Y-m-d', $max = 'now')}',
        '{$faker->lastName()}',
        '{$faker->randomNumber()}'
        );
    ");

    
    // $db->query("
    //     INSERT INTO payements (
    //         User_Id
    //         Payement_CartNumber
    //         Payement_ExpirationDate
    //         Payement_Name
    //         Payement_SafeCode
    //         )
    //     VALUES(
    //     '{$user_id}',
    //     '{$faker->randomNumber()}',
    //     '{$faker->date($format = 'Y-m-d', $max = 'now')}',
    //     '{$faker->lastName()}',
    //     '{$faker->randomNumber()}'
    //     );
    // ");



}

?>