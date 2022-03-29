<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Helpers\{Utility,Reply};
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user                       = new User();
        $user->first_name           = $request->first_name;
        $user->last_name            = $request->last_name;
        $user->email                = $request->email;
        $user->password             = Hash::make('123456');
        $user->profile_photo_path   = Utility::fileUpload($request->image,'uploads/');
        $user->dob                  = $request->dob;
        $user->age                  = $request->age;
        $user->home_phone           = $request->home_phone;
        $user->mobile_phone         = $request->mobile_phone;
        $user->street_address       = $request->street_address;
        $user->city                 = $request->city;
        $user->state                = $request->state;
        $user->zip_code             = $request->zip_code;
        $user->current_time         = date('H:i A');
        
        // $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDeoGwJDBE4ic-btiuWCfLk37ehqk2LxPs&address=' . urlencode($userExist->street_address) . '&sensor=false&components=country:US';
        // $geocode = file_get_contents($url);
        // $results = json_decode($geocode, true);
        // dd($results);

        if($user->save()){
            return Reply::redirect(route('users.index'), __('User created successfully!'));
        }
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
        $data['userData'] = User::whereId($id)->first();
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserRequest $request, $id)
    {
        $userExist                       = User::findOrFail($id);
        $userExist->first_name           = $request->first_name;
        $userExist->last_name            = $request->last_name;
        $userExist->email                = $request->email;
        $userExist->dob                  = $request->dob;
        $userExist->age                  = $request->age;
        $userExist->home_phone           = $request->home_phone;
        $userExist->mobile_phone         = $request->mobile_phone;
        $userExist->street_address       = $request->street_address;
        $userExist->city                 = $request->city;
        $userExist->state                = $request->state;
        $userExist->zip_code             = $request->zip_code;
        $userExist->current_time         = date('H:i A');
        $userExist->profile_photo_path   = $request->hasFile('image') ? (Utility::fileUpload($request->image, 'uploads/', null, $userExist->profile_photo_path)) : $userExist->profile_photo_path;

        if($userExist->save()){
            return Reply::redirect(route('users.index'), __('User updated successfully!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user       = User::findOrFail($id);
        $userImage  = $user->profile_photo_path;
        if($user->delete()){
            File::delete(public_path($userImage));
            return Reply::dataOnly('Selected users deleted successfully!');
        }
    }

    public function deleteMultipleUserData(Request $request){
        $userIds = explode(",",$request->user_ids);
        if(User::destroy($userIds)){
            return Reply::dataOnly('Users deleted successfully!');
        }
    }
}
