<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::view('vue', 'vue');

//main file, where contacts.blade.php is being put out
Route::get('/', function() {  // the url whatever.test/contacts shows the contacts.blade.php file in the folder view, this is a route
    return view('contacts');// you can return strings or JSON in here too
});



// raw data I gave a separate route contacts
Route::get('contacts', function() {  // the url whatever.test/contacts shows the contacts.blade.php file in the folder view, this is a route
    return json_decode(file_get_contents(storage_path('contacts_2000.json'))); //
});


Route::view ('todo', 'todo');


// main file, where parking.blade.php is being put out
Route::get('parkingtable', function () {
    return view('parking');
});

// separate route parkingdata with raw data
Route::get ('parkingdata', function() {
    return json_decode(file_get_contents(storage_path('bezettingparkingsrealtime.json')));
});





/*Route::get('/contacts', 'ContactsController@show'); //*/
