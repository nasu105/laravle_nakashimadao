<!-- resources/views/answer/show.blade.php -->

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
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Question</p>
              <p class="py-2 px-3 text-grey-darkest" id="question">
                {{$question->question}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Description</p>
              <p class="py-2 px-3 text-grey-darkest" id="description">
                {{$question->description}}
              </p>
            </div>
            <form class="mb-6" action="{{ route('answer.store') }}" method="POST">
            @csrf
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="body">回答</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="body" id="body">
              <input type="hidden" name="question_id" value={{$question->id}}>
            </div>
            <button type="submit" class="px-2 py-1 text-indigo-500 border border-indigo-500 font-semibold rounded-lg hover:bg-indigo-100">
              Create
            </button>
          </form>
            <a href="{{ route('question.index') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Back
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

