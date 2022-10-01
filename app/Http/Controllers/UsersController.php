<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $validated = Validator::make($request->all(), $rules);
        if($validated->fails()) {
            return $this->response->createErrorResponse($validated->errors()->first());
        }
        try{
            $user = User::where('email', $request->email)->first();
            if(isset($user))
            {
                if(Hash::check($request->password, $user->password))
                {
                    $token = $user->createAuthToken('web');
                    $refresh = $user->createRefreshToken('web');
                    $response = [
                        'user' => $user,
                        'token' => $token,
                        'refresh' => $refresh
                    ];
                    return $this->response->createResponse('Logged In!', $response);
                }
            }
            return $this->response->createErrorResponse('Invalid Credentials');
        }
        catch(Exception $e){
            $errMsg = $e->getMessage();
            return $this->response->createErrorResponse($errMsg);
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];

        $validated = Validator::make($request->all(), $rules);

        if($validated->fails()) {
            return $this->response->createErrorResponse($validated->errors()->first());
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'user',
                'password' => bcrypt($request->password)
            ]);

            if(!isset($user)) {
                return $this->response->createErrorResponse('Operation Failed');
            }

            return $this->response->createResponse('Registration Successful!!', $user);
        }
        catch(Exception $e) {
            $errMsg = $e->getMessage();
            return $this->response->createErrorResponse($errMsg);
        }
    }

    public function logout(Request $request) {
        try{
            $deleted = $request->user()->currentAccessToken()->delete();
            if(!$deleted) {
                return $this->response->createErrorResponse('Logout unsuccessful');
            }
            return $this->response->createResponse('Logout successful', null);
        }
        catch(Exception $e){
            return $this->response->createErrorResponse('Logout unsuccessful');
        }
    }
}
