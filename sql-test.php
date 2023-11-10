<?php

require('vendor/autoload.php');

$faker = Faker\Factory::create();

$db = new PDO('mysql:host=localhost;dbname=mydatabase77', 'tfgi', 'azerty');

$db->query("DELETE FROM users
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
'{$faker->password}');
");


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
'{$faker->colorName}');
");

#e
// $db->query("INSERT INTO addresses (
//     Address_Address,
//     Address_CityName,
//     Address_PostalCode,
//     Address_State,
//     Address_Country
//     )
//     VALUES(
//     '{$faker->address}',
//     '{$faker->cityName}',
//     '{$faker->postcode}',
//     '{$faker->state}',
//     '{$faker->country}');
//     ");


}
?>