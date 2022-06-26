<!-- resources/views/quesion/create.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-pink-600 leading-tight">
      {{ __('質問する-Create New Question-') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <form class="mb-6" action="{{ route('question.store') }}" method="POST">
            @csrf
            <div class="flex flex-col mb-6">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="question">タイトル-question-</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="question" id="question" placeholder="プログラミングに関しての質問は何ですか？">
            </div>
            <div class="flex flex-col mb-4">
              
              <!---->
              <div>
                <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="description">本文-description-</label>
                <p>誰かがあなたの質問に答えられるように、なるべく詳しく、たくさんの情報を含めて書いてください</p>
              </div>  
              <div class="mt-4">
                <textarea class="border w-full py-2 px-3 text-grey-darkest" type="text" name="description" id="description" placeholder="詳しく書いてください" ></textarea>
              </div>
            </div>
            <!--<button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">-->
            <!--  Create-->
            <!--</button>-->
            <div class="flex justify-center">
              <div>
                <button type="submit" class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded-lg hover:bg-indigo-100">
                  投稿する-create question-
                </button>
              </div>  
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

