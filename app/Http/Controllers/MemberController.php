<?php

namespace App\Http\Controllers;

use App\Member;
use League\Flysystem\File;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Support\Facades\Storage;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members=Member::all();
        return view ('index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('create_member');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imgFull='<img src="data:image/png;base64,'.base64_encode(\QrCode::format('png')->size(300)->generate(
            'First name : '.$request->input('first_name').'
            '.'Last name : '.$request->input('last_name').' 
            '.'Address : '.$request->input('address').'
            '.'Mobile number : '.$request->input('mobile_number'))).' ">';
            
            //(1) Creation de l'image QR code encodée en base64
            $imgB64 =base64_encode(\QrCode::format('png')->size(300)->generate(
                'First name : '.$request->input('first_name').'
                '.
                'Last name : '.$request->input('last_name').' 
                '.
                'Address : '.$request->input('address').'
                '.
                'Mobile number : '.$request->input('mobile_number'))).' ">';
            
                // return $imgFull;

            // (2) Décodage de l'image QR code pour sauvegarde au format PNG
            $image = $imgB64; // image base64 encoded
            $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
            $image = str_replace(' ', '+', $image);
            $imageName = 'image_' . time() . '.' . '.png'; //generating unique file name;
            
            // (3) Sauvegarde de l'image QR code
            Storage::disk('s3')->put($imageName,base64_decode($image));
            $url = Storage::disk('s3')->url($imageName);

            // dd($url);
            
            Member::create([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'address'=>$request->input('address'),
                'mobile_number'=>$request->input('mobile_number'),
                'image'=>$url
            ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
