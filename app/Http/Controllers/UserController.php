<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $users =  User::all('id', 'firstname', 'lastname');
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
     * This function gets all coures a user joined and returns the data in json format
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function course($id) {
        $data = array();
        $count = 0;

        // Retrieve the course an user has been joined
        $joined_courses = DB::table('user_courses')->where('user_id', $id)->get();

        // Loop threw all the courses and store the course id foreach of the courses
        foreach($joined_courses as $courses) {

            // Store data
                $data[$count]['id'] = $courses->id;
                $data[$count]['course_id'] = $courses->course_id;

                // Retrieves all the data of the course in the foreach
                $course_data = DB::table('courses')->where('id', $courses->course_id)->get();

                // foreach to store all the data in the array data that been created above
                foreach($course_data as $course) {
                    $data[$count]['title'] = $course->title;
                    $data[$count]['user_id'] = $course->user_id;
                    $data[$count]['category_id'] = $course->category_id;
                    $data[$count]['description'] = $course->description;
                    $data[$count]['thumbnail'] = $course->thumbnail;
                    $data[$count]['date'] = $course->date;
                }
                $count++;
        }

        // return the array data in json format
        return response()->json($data);
    }

    /**
     * this function will execute a query that lets a user leave a course
     *
     * @param Request $request
     * @return string
     */
    public function leaveCourse(Request $request) {

        // request the data from the axios call
        $data = $request->only(['course_id']);

        // this query deletes the selected joined course from a user.
        DB::table('user_courses')->where('id', $data)->delete();

        // return message
        return "Successful deleted";
    }

    /**
     * this function will be deleted
     *
     * @param $id
     * @return mixed
     */
    public function time($id) {
        $user = DB::table('users')->where( 'id', $id)->get();
        $response = explode(' ', $user[0]->created_at);
        return $response[0];
    }
}
