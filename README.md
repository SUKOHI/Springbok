# Springbok
A PHP package mainly developed for Laravel to manage specific accessors and mutators for Json and Date(Carbon).  
(So you can skip to add accessors and mutators for date and json.)

Usage
====

**Simple Way**  

In your model, set SpringbokTrait and add a member variable named "convert_attributes".

    <?php
    
    use \Sukohi\Springbok\SpringbokTrait;
    class Appointment extends Eloquent {
    
        use SpringbokTrait;
    
        protected $convert_attributes = [
            'started_at' => 'date',             // You can get or set the value as date
            'member_ids' => 'json'             // You can get or set the value as json
        ];
    
    }

Now you also can get/set DB values simply like the below.

    // Get

    $appointment = \Appointment::first();
    print_r($appointment->started_at);

    /* Output

        Carbon\Carbon Object
        (
            [date] => 2015-06-22 00:00:00.000000
            [timezone_type] => 3
            [timezone] => Asia/Tokyo
        )

    */

    print_r($appointment->member_ids);

    /* Output

        Array
        (
            [0] => 1
            [1] => 2
            [2] => 3
        )

    */


    // Set

    $appointment->started_at = '2015-06-25';    // You also can set Carbon instance.
    $appointment->member_ids = [2, 3, 5];       // You can directly set array values.
    $appointment->save();
    
        
License
====
This package is licensed under the MIT License.

Copyright 2015 Sukohi Kuhoh
