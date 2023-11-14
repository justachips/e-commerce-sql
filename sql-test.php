<?php

require('vendor/autoload.php');

$faker = Faker\Factory::create();

$db = new PDO('mysql:host=localhost;dbname=mydatabase77', 'tfgi', 'azerty');

ini_set('max_execution_time', 300); // Définit le temps d'exécution maximal à 300 secondes (par exemple)

ini_set('memory_limit', '256M'); // Définit la limite mémoire à 256 Mo (par exemple)


$db->query("
    DELETE FROM commands;
    DELETE FROM carts;
    DELETE FROM shoplists;
    DELETE FROM photos;
    DELETE FROM rates;
    DELETE FROM payements;
    DELETE FROM addresses;
    DELETE FROM users;
    DELETE FROM products;
    ALTER TABLE users AUTO_INCREMENT = 1;
    ALTER TABLE products AUTO_INCREMENT = 1;
    ALTER TABLE rates AUTO_INCREMENT = 1;
    ALTER TABLE photos AUTO_INCREMENT = 1;
    ALTER TABLE shoplists AUTO_INCREMENT = 1;
    ALTER TABLE commands AUTO_INCREMENT = 1;
");

$counter=0;

for ($i = 0; $i = 20; $i++) {


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

    $counter+= 1;



    $user_id_rand = $faker->numberBetween(1, $counter);
    $product_id_rand = $faker->numberBetween(1, $counter);

    $db->query("INSERT INTO rates (
        User_Id,
        Product_Id,
        Rate_Rate
        )
        VALUES(
        '{$user_id_rand}',
        '{$product_id_rand}',
        '{$faker->numberBetween(0, 5)}'
        );
    ");


    $randbool = $faker->numberBetween(1, 2);

    echo $randbool;

    $blob = $faker->city . '.jpeg';

    if ($randbool > 1) {
        $db->query("INSERT INTO photos (
            User_Id,
            Photo_photo
            )
            VALUES(
            '{$user_id_rand}',
            '{$blob}'
            );
        ");
    } else {
        $db->query("INSERT INTO photos (
            Product_Id,
            Photo_photo
            )
            VALUES(
            '{$product_id_rand}',
            '{$blob}'
            );
        ");
    }
    
    $db->query("INSERT INTO shoplists (
        User_Id
        )
        VALUES(
        '{$user_id}'
        );
    ");

    $shoplist_id = $db->lastInsertId(); //recupere le shoplist id

    $shoplist_id_rand = $faker->numberBetween(1, $counter);

    $mydate = $faker->date($format = 'Y-m-d', $max = 'now');


    $db->query("INSERT INTO carts (
        Shoplist_Id,
        Product_Id
        )
        VALUES(
        '{$shoplist_id_rand}',
        '{$product_id_rand}'
        );

        INSERT INTO commands (
        Shoplist_Id,
        Command_OrderDate
        )
        VALUES(
       '{$shoplist_id_rand}',
       '{$mydate}'
       );

    ");

}

?>