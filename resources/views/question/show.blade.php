<!-- resources/views/question/show.blade.php -->
<?php

use Carbon\Carbon;

?>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Show Question Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="">
        <div class="p-6">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">タイトル-question-</p>
              <p class="py-2 px-3 text-grey-darkest" id="question">
                {{$question->question}}
              </p>
            </div>
            <div class="flex flex-col mb-6">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">本文-description-</p>
              <p class="py-2 px-3 text-grey-darkest" id="description">
                {{$question->description}}
              </p>
            </div>
              @foreach($answers as $answer)
                @if ($answer->question_id == $question->id)
                  <div class="">
                    
                    @if ($answer->bestanswer == 1)
                      <!--ベストアンサーである場合表示-->
                      <p>ベストアンサー</p>
                    @endif
                      <!--回答者名を表示-->
                      <p>回答者:{{$answer->user->name}}</p>
                      <!--回答を表示-->
                      <p id="bodys">
                        回答内容:{{$answer->body}}
                      </p>
                      <!--回答時間を表示-->
                      <p>投稿時間:{{\Carbon\Carbon::parse($answer->created_at)->format("Y年m月d日")}}</p>
                      <!--更新ボタン-->
                      <form action="{{ route('answer.edit',$answer->id) }}" method="GET">
                        @csrf
                        <button type="submit">編集ボタン</button>
                      </form>
                      <!--削除ボタン-->
                      <form action="{{ route('answer.destroy', $answer->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit">削除ボタン</button>
                      </form>
                      
                      <!--エラー内容　Property [bestanswer] does not exist on the Eloquent builder instance.-->
                    @if ($answer->where('question_id' == $answer->question_id)->bestanswer->exists(0)) //ベストアンサーが選ばれている場合表示しない
                      <!--ベストアンサーボタン-->
                      <form action="{{ route('selectbest',$answer->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="bestanswer" value="1">
                        <input type="hidden" name="question_id" value={{$question->id}}>
                        <button type="submit" class="w-5/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                          ベストアンサー
                        </button>
                      </form>
                    @endif
                    </div>
                  </div>
                @endif
              @endforeach
            <form class="mb-6" action="{{ route('answer.store') }}" method="POST">
            @csrf
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="body">回答-answer-</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="body" id="body">
              <input type="hidden" name="question_id" value={{$question->id}}>
            </div>
            <div class="flex">
              <div>
                <button type="submit" class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded-lg hover:bg-indigo-100">
                  回答を投稿する-create-
                </button>
              </div>  
          </form>
              <div>
                <a href="{{ route('question.index') }}" class="px-2 py-1 text-lime-500 border border-lime-500 font-semibold rounded-lg hover:bg-lime-100">
                  戻る-back-
                </a>
              </div>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

