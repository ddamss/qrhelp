<?php

use BaconQrCode\Encoder\QrCode;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('qrcode', function () {

$name='adam';
$age=11871;

$imgFull='<img src="data:image/png;base64,'.base64_encode(\QrCode::format('png')->size(300)->generate(
'name : '.$name.'
'.
'age : '.$age)).' ">';

//(1) Creation de l'image QR code encodée en base64
$imgB64 =base64_encode(\QrCode::format('png')->size(300)->generate(
'name : '.$name.'
'.
'age : '.$age)).' ">';

// (2) Décodage de l'image QR code pour sauvegarde au format PNG
$image = $imgB64; // image base64 encoded
$image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
$image = str_replace(' ', '+', $image);
$imageName = 'image_' . time() . '.' . '.png'; //generating unique file name;

// (3) Sauvegarde de l'image QR code
return Storage::disk('public')->put($imageName,base64_decode($image));

});

// solution : https://stackoverflow.com/questions/48153166/how-to-convert-base64-to-image-in-laravel-5-4


Route::get('/register',function(){

    return view('create_member');
});

Route::resource('members','MemberController');

