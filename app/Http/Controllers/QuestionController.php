<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::getAllOrderByUpdated_at();
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // バリデーション
      $validator = Validator::make($request->all(), [
        'question' => 'required | max:191',
        'description' => 'required',
      ]);
      // バリデーション:エラー
      if ($validator->fails()) {
        return redirect()
          ->route('question.create')
          ->withInput()
          ->withErrors($validator);
      }
      // 編集フォームから送信されてきたデータとユーザーIDをマージし、DBにinsertする
      $data = $request->merge(['user_id' => Auth::user()->id])->all();
      // create()は最初から用意されている関数
      // 戻り値は挿入されたレコードの情報
      $result = Question::create($data);
      // ルーティング「todo.index」にリクエスト送信（一覧ページに移動）
    //   ddd($request);
      return redirect()->route('question.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $question_id = $id;
        $answers = Answer::find($question_id);
        // answers_getAllOrderByUpdated_at();
        // ddd($question);
        return view('question.show', compact('question','answers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ddd($id);
        $question = Question::find($id);
        return view('question.edit', compact('question'));
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
      //バリデーション
      $validator = Validator::make($request->all(), [
        'question' => 'required | max:191',
        'description' => 'required',
      ]);
      //バリデーション:エラー
      if ($validator->fails()) {
        return redirect()
          ->route('question.edit', $id)
          ->withInput()
          ->withErrors($validator);
      }
      //データ更新処理
      $result = Question::find($id)->update($request->all());
      return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Question::find($id)->delete();
        return redirect()->route('question.index');
    }
    
    public function mydata()
    {
      // Userモデルに定義したリレーションを使用してデータを取得する.
      $questions = User::query()
       ->find(Auth::user()->id)
       ->userQuestions()
       ->orderBy('created_at', 'desc')
       ->get();
       
      return view('question.index', compact('questions'));
    }
    

}
