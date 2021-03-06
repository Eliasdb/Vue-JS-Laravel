<?php

// 1: contact list
Route::view('contacts', 'contacts');

// raw data contacts
Route::get('contactsdata', function() {
    return json_decode(file_get_contents(storage_path('contacts_2000.json')));
});

// 2: todo list
Route::view ('todo', 'todo');

// 3: parking table
Route::view('parking', 'parking');

// 4: travel list
Route::view('travel', 'travel');

/*Route::get('/contacts', 'ContactsController@show'); //*/
