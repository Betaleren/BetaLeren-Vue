<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $users =  User::orderBy('id', 'ASC')->get();
        return $users;
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $response = User::query()->where('id', $id)->get();
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function course($id) {
        $data = array();
        $count = 0;
        $joined_courses = DB::table('user_courses')->where('user_id', $id)->get();

        foreach($joined_courses as $courses) {
                $data[$count]['id'] = $courses->course_id;

                $course_data = DB::table('courses')->where('id', $courses->course_id)->get();
                foreach($course_data as $course) {
                    $data[$count]['title'] = $course->title;
                    $data[$count]['holder_id'] = $course->holder_id;
                    $data[$count]['category_id'] = $course->category_id;
                    $data[$count]['episodes'] = $course->episodes;
                    $data[$count]['description'] = $course->description;
                    $data[$count]['thumbnail'] = $course->thumbnail;
                    $data[$count]['date'] = $course->date;
                }
                $count++;
        }
        return response()->json($data);
    }

    public function time($id) {
        $user = DB::table('users')->where( 'id', $id)->get();
        $response = explode(' ', $user[0]->joined);
        return $response[0];
    }
}
