<?php

    $myArray = [
        [
          'name' => 'Paresh',
          'email' => 'paresh@gmail.com'
        ],
        [
          'name' => 'Rakesh',
          'email' => 'rakesh@gmail.com'
        ],
        [
          'name' => 'Naresh',
          'email' => 'naresh@gmail.com'
        ],

    ];
   
    $names = array_column($myArray, 'name');
    $emails = array_map(function ($ar) {return $ar['email'];}, $myArray);
    var_dump($names);

        var_dump($emails);
