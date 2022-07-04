<!-- resources/views/question/show.blade.php -->
<?php

use Carbon\Carbon;

?>
<link href="style.css" rel="stylesheet" type="text/css">
<x-app-layout>
  @section('title')
  @include('layouts.navigation')
  @endsection
  <x-slot name="header">
    <h2 class="text-orange-500 font-semibold text-xl leading-tight">
      {{ __('詳細画面-show question detail-') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="bg-white border-b border-gray-200">
          <div class="p-6 ">
            <div class="flex-col justfy-center mb-6">
              <div class="flex-col mb-4 text-center">
                <p class="uppercase font-bold text-xl text-grey-darkest">タイトル-question-</p>
                <p class="text-xl py-2 px-3 text-grey-darkest" id="question">
                  {{$question->question}}
                </p>
              </div>
              <div class="flex flex-col mb-6 ">
                <p class="uppercase font-bold text-xl text-center text-grey-darkest">本文-description-</p>
                <p class="text-xl text-center py-2 px-3 text-grey-darkest" id="description" style="white-space: pre-wrap;">
                
                  {{$question->description}}
                  
                </p>
              </div>
                <div class="">
                  @foreach($answers as $answer)
                    @if ($answer->question_id == $question->id)
                    <div class="w-full mb-4 mt-4">
                      
                      @if ($answer->bestanswer == 1)
                        <!--ベストアンサーである場合表示-->
                      <div class="flex justify-between">  
                        <div class="flex">  
                          <svg class="h-8 w-8 text-yellow-400"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" />
                          </svg>
                          <p class="text-xl underline decoration-double">best!!</p>
                        </div>
                      </div>
                      @endif
                      <!--</div>-->
                      <div class="ml-4">
                        <!--回答者名を表示-->
                        <p class="">回答者:{{$answer->user->name}}</p>
                        <!--回答を表示-->
                        <p id="bodys">
                          回答内容:{{$answer->body}}
                        </p>
                        <!--回答時間を表示-->
                        <p>投稿時間:{{\Carbon\Carbon::parse($answer->created_at)->format("Y年m月d日")}}</p>
                        <div class="flex">  
                          <!--更新ボタン-->
                          <form action="{{ route('answer.edit',$answer->id) }}" method="GET">
                            @csrf
                            @if ($answer->user_id === Auth::user()->id)
                            <button type="submit">
                              <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                              </svg>
                            </button>
                            @endif
                          </form>
                          <!--削除ボタン-->
                          <form action="{{ route('answer.destroy', $answer->id) }}" method="POST">
                            @method('delete')
                            @csrf
                             @if ($answer->user_id === Auth::user()->id)
                            <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white px-2 focus:outline-none focus:shadow-outline">
                              <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                            </button>
                             @endif
                          </form>
                        </div>
                      </div>  
                      
                        <!--ベストアンサーがnullだった場合ボタン表示-->
                        @if ($bestanswer == null)
                        <!--ベストアンサーボタン-->
                        <form action="{{ route('selectbest',$answer->id) }}" method="POST" class="text-center mb-4">
                          @csrf
                          <input type="hidden" name="bestanswer" value="1">
                          <input type="hidden" name="flag_bestanswer" value="1">
                          <input type="hidden" name="question_id" value={{$question->id}}>
                           @if ($question->user_id === Auth::user()->id)
                          <button type="submit" class="w-5/12 py-3 mt-6 mb-2 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                            ベストアンサー
                          </button>
                          @endif
                        </form>
                        @elseif ($answer->bestanswer == "1") 
                        <form action="{{ route('delete_bestanswer', $answer->id) }}" method="POST">
                          @csrf
                          <input type="hidden" name="bestanswer" value="0">
                          <input type="hidden" name="flag_bestanswer" value="0">
                          <input type="hidden" name="question_id" value={{$question->id}}>
                           @if ($question->user_id === Auth::user()->id)
                          
                          <div class="flex">
                            <svg class="h-8 w-8 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />  <line x1="12" y1="9" x2="12" y2="13" />  <line x1="12" y1="17" x2="12.01" y2="17" /></svg>
                            <button type="submit"class="px-2 py-1 text-red-500 border-red-500 font-semibold rounded-lg hover:bg-red-100">
                              ベストアンサー解除
                            </button>
                            
                          </div>
                          @endif
                        </form>
                        @endif
                    </div>
                    @endif
                  @endforeach
                </div>
                
                <!--回答欄-->
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
                        <button type="submit" class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded-lg hover:bg-indigo-100 transition">
                          回答を投稿する-create-
                        </button>
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

