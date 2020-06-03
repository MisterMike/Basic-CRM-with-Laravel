<?php

use Illuminate\Http\Request;
use App\Membership;
use App\Member;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * API Routes for memberships
 */

//show all memberships
Route::middleware('auth:api')->get('memberships', function() {
    return Membership::all();
});
//show one company
Route::middleware('auth:api')->get('/memberships/{id}', function($id) {
    return Membership::find($id);
});
//insert a company
Route::middleware('auth:api')->post('/memberships', function(Request $request) {
    return Membership::create($request->all());
});
//update a company
Route::middleware('auth:api')->put('/memberships/{id}', function(Request $request, $id) {
    $article = Membership::findOrFail($id);
    $article->update($request->all());
    return $article;
});
//delete a company
Route::middleware('auth:api')->delete('/memberships/{id}', function($id) {
    Membership::find($id)->delete();
    return 204;
});

/**
 * API Routes for Employees
 */

//show all employees
Route::middleware('auth:api')->get('members', function() {
    return Member::all();
});
//show one employee
Route::middleware('auth:api')->get('/members/{id}', function($id) {
    return Member::find($id);
});
//insert a employee
Route::middleware('auth:api')->post('/members', function(Request $request) {
    return Member::create($request->all());
});
//update a employee
Route::middleware('auth:api')->put('/members/{id}', function(Request $request, $id) {
    $employee = Member::findOrFail($id);
    $employee->update($request->all());
    return $employee;
});
//delete a employee
Route::middleware('auth:api')->delete('/members/{id}', function($id) {
    Member::find($id)->delete();
    return 204;
});
