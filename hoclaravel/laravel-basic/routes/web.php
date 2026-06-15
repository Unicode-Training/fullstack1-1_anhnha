<?php

use App\Jobs\WriteFileLarge;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    // dd([1,2,3]);
    // dd(collect([1,2,3]));
    //stdClass
    
    // foreach (collect([1,2,3]) as $item) {
    //     echo $item;
    // }
    // $user = new stdClass();
    // $user->name = 'An';
    // dd($user);

//    $data = (collect([1,2,3]));
//    for ($i = 0; $i < $data->count(); $i++) {
//     print_r($data[$i]);
//    }
    // $user = [
    //     'name' => 'An',
    //     'email' => 'an@gmail.com'
    // ];
    // $userObj = (object)$user;
    // dd($userObj->name);
    // class Custom {

    //     private $data = []; //bag
    //     public function __get($name) {
    //         echo $name;
    //         //Xử lý
    //     }

    //     public function __set($name, $value) {
    //         echo $name.'<br/>';
    //         echo $value.'<br/>';
    //     }

    //     private function where() {
    //         return 'abc';
    //     }

    //     public static $message = 'An';

    //     public static function __callStatic($name, $params = []) {
    //         // $context = new self();
    //         // return $context->$name($params);
    //         return self::$message;
    //     }

    //     public function __call($name, $params = []) {
    //         return $this->$name($params);
    //     }

    // }
    // $custom = new Custom();
    // // dd($custom->abc);
    // // $custom->abc = 'ahihi';

    // // dd(Custom::where());
    // dd($custom->where());
    WriteFileLarge::dispatch();
});

//User::where()->orderBy()->get();
//User::orderBy()->where()->get();