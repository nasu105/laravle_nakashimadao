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
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="p-6">
            <div class="flex-col justfy-center mb-6">
              <div class="flex-col mb-4 text-center">
                <p class="uppercase font-bold text-lg text-grey-darkest">タイトル-question-</p>
                <p class="py-2 px-3 text-grey-darkest" id="question">
                  {{$question->question}}
                </p>
              </div>
              <div class="flex flex-col mb-6 text-center">
                <p class="uppercase font-bold text-lg text-grey-darkest">本文-description-</p>
                <p class="py-2 px-3 text-grey-darkest" id="description">
                  {{$question->description}}
                </p>
              </div>
                <div>
                  @foreach($answers as $answer)
                    @if ($answer->question_id == $question->id)
                    <div class="w-full">
                      
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
                          <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">削除ボタン</button>
                        </form>
                        
                        <!--ベストアンサーがnullだった場合ボタン表示-->
                        @if ($bestanswer == null)
                        <!--ベストアンサーボタン-->
                        <form action="{{ route('selectbest',$answer->id) }}" method="POST" class="text-center mb-4">
                          @csrf
                          <input type="hidden" name="bestanswer" value="1">
                          <input type="hidden" name="question_id" value={{$question->id}}>
                          <button type="submit" class="w-5/12 py-3 mt-6 mb-2 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                            ベストアンサー
                          </button>
                        </form>
                        @elseif ($answer->bestanswer == "1") 
                        <form action="{{ route('delete_bestanswer', $answer->id) }}" method="POST">
                          @csrf
                          <input type="hidden" name="bestanswer" value="0">
                          <input type="hidden" name="question_id" value={{$question->id}}>
                          <button type="submit">
                            ベストアンサー解除
                          </button>
                        </form>
                        @endif
                      
                    
                    </div>
                  @endif
                @endforeach
                </div>
                <div>
                  <form class="mb-6" action="{{ route('answer.store') }}" method="POST">
                   @csrf
                    <div class="flex flex-col mb-4">
                      <label class="text-center mb-2 uppercase font-bold text-lg text-grey-darkest" for="body">回答-answer-</label>
                      <input class="border py-2 px-3 text-grey-darkest" type="text" name="body" id="body">
                      <input type="hidden" name="question_id" value={{$question->id}}>
                    </div>
                    <div class="flex justify-between">
                      <div>
                         @if ($question->user_id === Auth::user()->id)
                        <button type="submit" class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded-lg hover:bg-indigo-100 transition">
                          回答を投稿する-create-
                        </button>
                        @endif
                      </div>  
                  </form>
                      <div>
                        <a href="{{ route('question.index') }}" class="px-2 py-1 text-lime-500 border border-lime-500 font-semibold rounded-lg hover:bg-lime-100 transition block">
                          戻る-back-
                        </a>
                      </div>  
                    </div>
                </div>
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

