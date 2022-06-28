<!-- resources/views/question/index.blade.php -->
<!--トップジーズアカデミー-->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-blue-600 leading-tight">
      {{ __('質問一覧') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <!--サイト内検索-->
          <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="">サイト内検索</label>
          <input class="form-control w-80 border text-grey-darkest px-3 py-1.5 text-base text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300" placeholder="サイト内検索" type="text" name="" id="">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">question</th>
              </tr> 
            </thead>
            <tbody>
                @foreach ($questions as $question)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light">
                    <!-- 詳細&回答画面へのリンク -->
                    <a href="{{ route('question.show', $question->id) }}">
                    <div class="flex flex-row">
                      <div class="flex-col">
                        <!--まだ機能つけてない部分　なすさんお願いします〜-->
                        <div class="justify-items-start">
                          <p class="text-grey-dark">{{ "うけつけちゅう" }}</p>
                        </div>  
                        <!--回答数を表示-->
                        <div class="">
                          <p class="text-grey-dark">{{$question->answers->count()}}</p>
                          <p class="text-grey-dark">{{ "回答" }}</p>
                        </div>  
                      </div>
                      <div>
                        <div class="py-4">
                          <h3 class="text-center font-bold text-lg text-grey-dark">{{$question->question}}</h3>
                        </div>
                  <div class="flex justify-end"> 
                    <!--created_at 持ってきてください　なすさんお願いします-->
                    <div class="px-2"> 
                     <p>投稿時間:{{\Carbon\Carbon::parse($question->created_at)->format("Y年m月d日")}}</p>
                    </div>
                    <div class="px-1">
                      <p class="text-right text-grey-dark">{{ $question->user->name }}</p>
                    </div>
                      <div class="flex">
                        <!-- favorite 状態で条件分岐 -->
                        @if($question->users()->where('user_id', Auth::id())->exists())
                        <!-- unfavorite ボタン -->
                          <form action="{{ route('unfavorites',$question) }}" method="POST" class="text-left">
                            @csrf
                            <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline">
                              <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                              </svg>
                            </button>
                          </form>
                          @else
                          <!-- favorite ボタン -->
                          <form action="{{ route('favorites',$question) }}" method="POST" class="text-left">
                            @csrf
                            <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline">
                              <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                              </svg>
                            </button>
                          </form>
                          @endif
                        <!--条件分岐でログインしているユーザーが投稿したquestionのみ編集ボタンと削除ボタンが表示される-->
                          @if ($question->user_id === Auth::user()->id)
                          <!-- 更新ボタン -->
                          <form action="{{ route('question.edit',$question->id) }}" method="GET" class="text-left">
                            @csrf
                            <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                              <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                              </svg>
                            </button>
                          </form>
                        <!-- 削除ボタン -->
                        <form action="{{ route('question.destroy',$question->id) }}" method="POST" class="text-left">
                          @method('delete')
                          @csrf
                          <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                            <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                          </button>
                        </form>
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

