<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        //$users = User::getAllOrderByUpdated_at();
        //ddd($users);
        //$questions = Question::getAllOrderByUpdated_at();
        //$answers = Answer::answers_getAllOrderByUpdated_at();
        
         //ddd($answers);
    //       $questions = User::query()
    //   ->find(Auth::user()->id)
    //   ->userQuestions()
    //   ->orderBy('created_at', 'desc')
    //   ->get();
       //ddd($questions);
      $answers = User::query()
      ->find(Auth::user()->id)
      ->userAnswers()
      ->orderBy('created_at', 'desc')
      ->get();
       //ddd( $answers);
      $questions = User::query()
       ->find(Auth::user()->id)
       ->userQuestions()
       ->orderBy('created_at', 'desc')
       ->get();
      // ddd($questions);
      $favorites = User::query()
       ->find(Auth::user()->id)
       ->questions()
       ->orderBy('created_at', 'desc')
       ->get();
    // ddd($favorites);  
     
        return view('user.index',compact('questions','answers','favorites'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('user.create');
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
}
