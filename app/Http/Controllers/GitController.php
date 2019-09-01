<?php

namespace App\Http\Controllers;

use App\Git;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Git[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        //
        return Git::all();
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
     * @return string
     */
    public function store(Request $request)
    {
        $client_id = "716c5f9342b1131e18b2";
        $client_secret = "680b04eaf1e4bca50cb1bf1b9a8b7ee56d9de45d";
        $url = "https://github.com/login/oauth/access_token";

        // client_id, code, client_secret

        $postParams = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'code' => $request->code,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json'));
        $response = curl_exec($ch);

        curl_close($ch);
        try {
            $check = DB::table('users_gits')->where('user_id', Auth::user()->id)->first();
            if (is_null($check)) {
                $accessToken = json_decode($response)->{'access_token'};
                DB::table('users_gits')->insert(['user_id' => Auth::user()->id, 'access_token' => $accessToken]);
                return response()->json(['status' => 'success', 'message' => ['connected' => ['Your Github Account is now connected.']]], 201);
            }
        } catch (\Exception $e){
            return response()->json(['status' => 'error', 'errors'=>  [ 'code_fail' => ['connecting to your Github account failed.']]], 422);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Git  $git
     * @return bool
     */
    public function check($id)
    {
        $response = DB::table('users_gits')->where('user_id',  $id)->count();
        return response()->json($response);
    }

    public function get($id)
    {
        $token = DB::table('users_gits')->where('user_id',  $id)->get();
        return response()->json($token);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Git  $git
     * @return \Illuminate\Http\Response
     */
    public function edit(Git $git)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Git  $git
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Git $git)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Git  $git
     * @return \Illuminate\Http\Response
     */
    public function destroy(Git $git)
    {
        //
    }
}
