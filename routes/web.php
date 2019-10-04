<?php

// 1: contact list
Route::view('contacts', 'contacts');

// raw data contacts
Route::get('contactdata', function() {
    return json_decode(file_get_contents(storage_path('contacts_2000.json')));
});

// 2: Todo
Route::view ('todo', 'todo');

// 3: parking table
Route::view('parking', 'parking');


/*Route::get('/contacts', 'ContactsController@show'); //*/
