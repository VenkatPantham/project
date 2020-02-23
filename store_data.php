<?php

# Connect to PostgreSQL database
$conn = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=leaflet;", "postgres", "postgresql");
// $conn = new PDO("pgsql:host=ec2-184-72-236-3.compute-1.amazonaws.com;port=5432;dbname=d1f6ahsj5b8ids", "omhmsgdadziael", "40852ceb183c08bf075e59f067158f485c1e4f1fc1162b0a9ff9bf16e4710c8f");

# Checking Connection
if (!$conn) {
    echo 'No connection';
    exit;
}

$city = $_POST['city'];
$area = $_POST['area'];
$family_size = $_POST['family_size'];
$male = $_POST['male'];
$female = $_POST['female'];
$age_lt15 = $_POST['age_lt15'];
$age_15btw25 = $_POST['age_15btw25'];
$age_25btw45 = $_POST['age_25btw45'];
$age_gt45 = $_POST['age_gt45'];
$marital_status = $_POST['marital_status'];
$no_of_children = $_POST['no_of_children'];
$education = $_POST['education'];
$no_of_working_members = $_POST['no_of_working_members'];
$child_working_below_15 = $_POST['child_working_below_15'];
$occupation = $_POST['occupation'];
$type_of_ration_card = $_POST['type_of_ration_card'];
$health_card = $_POST['health_card'];
$no_of_deceased_people = $_POST['no_of_deceased_people'];
$no_of_handicapped_people = $_POST['no_of_handicapped_people'];
$car = $_POST['car'];
$bike = $_POST['bike'];
$tractor = $_POST['tractor'];
$house = $_POST['house'];
$land = $_POST['land'];
$television = $_POST['television'];
$refrigerator = $_POST['refrigerator'];
$air_conditioner = $_POST['air_conditioner'];
$heater = $_POST['heater'];
$fan = $_POST['fan'];
$computer = $_POST['computer'];
$gold = $_POST['gold'];
$monthly_income = $_POST['monthly_income'];
$government_income = $_POST['government_income'];
$private_income = $_POST['private_income'];
$pension_income = $_POST['pension_income'];
$bank_savings = $_POST['bank_savings'];
$postal_savings = $_POST['postal_savings'];
$chit_savings = $_POST['chit_savings'];
$other_savings = $_POST['other_savings'];
$caste = $_POST['caste'];
$nearest_hospital = $_POST['nearest_hospital'];
$nearest_primary_school = $_POST['nearest_primary_school'];
$nearest_high_school = $_POST['nearest_high_school'];
$nearest_college = $_POST['nearest_college'];
$nearest_university = $_POST['nearest_university'];
$agricultural_status = $_POST['agricultural_status'];
$income_status = $_POST['income_status'];
$poverty_status = $_POST['poverty_status'];
$type_of_building = $_POST['type_of_building'];
$type_of_water_source = $_POST['type_of_water_source'];
$source_of_drinking_water = $_POST['source_of_drinking_water'];
$presence_of_toilet_facility = $_POST['presence_of_toilet_facility'];
$electricity_connection = $_POST['electricity_connection'];
$gas_connection = $_POST['gas_connection'];
$cable_connection = $_POST['cable_connection'];
$internet_connection = $_POST['internet_connection'];
$electricity_bill = $_POST['electricity_bill'];
$no_of_lic_policies = $_POST['no_of_lic_policies'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

# However the User's Query will be passed to the DB:
$sql = "INSERT INTO project (city,area,family_size,male,female,age_lt15,age_15btw25,age_25btw45,age_gt45,marital_status,no_of_children,education,no_of_working_members,child_working_below_15,occupation,type_of_ration_card,health_card,no_of_deceased_people,no_of_handicapped_people,car,bike,tractor,house,land,television,refrigerator,air_conditioner,heater,fan,computer,gold,monthly_income,government_income,private_income,pension_income,bank_savings,postal_savings,chit_savings,other_savings,caste,nearest_hospital,nearest_primary_school,nearest_high_school,nearest_college,nearest_university,agricultural_status,income_status,poverty_status,type_of_building,type_of_water_source,source_of_drinking_water,presence_of_toilet_facility,electricity_connection,gas_connection,cable_connection,internet_connection,electricity_bill,no_of_lic_policies,latitude,longitude) VALUES ('$city','$area','$family_size','$male','$female','$age_lt15','$age_15btw25','$age_25btw45','$age_gt45','$marital_status','$no_of_children','$education','$no_of_working_members','$child_working_below_15','$occupation','$type_of_ration_card','$health_card','$no_of_deceased_people','$no_of_handicapped_people','$car','$bike','$tractor','$house','$land','$television','$refrigerator','$air_conditioner','$heater','$fan','$computer','$gold','$monthly_income','$government_income','$private_income','$pension_income','$bank_savings','$postal_savings','$chit_savings','$other_savings','$caste','$nearest_hospital','$nearest_primary_school','$nearest_high_school','$nearest_college','$nearest_university','$agricultural_status','$income_status','$poverty_status','$type_of_building','$type_of_water_source','$source_of_drinking_water','$presence_of_toilet_facility','$electricity_connection','$gas_connection','$cable_connection','$internet_connection','$electricity_bill','$no_of_lic_policies','$latitude','$longitude')";

# Try query or error
$db = $conn->query($sql);
if (!$db) {
    echo 'An SQL error occured';
    exit;
}
// else {
//     echo "<script> location.href='index.html'; </script>";
//     header("refresh:2;url:index.html");
//     exit;
// }

$conn = NULL;
