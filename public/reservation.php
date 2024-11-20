<?php

    require __DIR__ . '/../vendor/autoload.php';

    use App\Reservation\Manager;
    use App\Reservation\ReservationManager;
    use App\Reservation\RoomManager;
    use App\Reservation\UserManager;


    $manager = new Manager();

//        var_dump($manager->create([
//            'first_name'=> 'Hervé',
//            'last_name'=> 'BouyO',
//            'photo'=> null,
//            'user_role'=> 'admin',
//            'phone'=> '0690123456',
//            'email'=> 'mgaloyddder@uneak.fr',
//            'password'=> 'password',
//            'status'=> 'active',
//        ]));
//    var_dump($manager->update(1, [
//        'first_name' => 'Marc',
//        'last_name'  => 'Galoyer',
//        'photo'      => null,
//        'user_role'  => 'admin',
//        'phone'      => '0690684020',
//        'email'      => 'mgaloyer@uneak.fr',
//        'password'   => '1234',
//        'status'     => 'active',
//    ]));



$manager->findAll();

