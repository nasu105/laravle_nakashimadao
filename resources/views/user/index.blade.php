{{--<?php
ddd($answers);
?>--}}

<x-app-layout>
  
  <x-slot name="header">
  </x-slot>
 
  
<div class="py-12 bg-cyan-100">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-5/6 lg:w-10/12 bg-cyan-100">
        <div class="sm:rounded-lg ">
            <h1 class="text-xl font-bold">ようこそ、{{ Auth::user()->name }}さん</h1>
            <div class="mt-6 bg-white border-b border-gray-200 flex flex-row bg-cyan-100"> 
                
                
                <div class="text-2xl mx-4 mt-8 basis-1/4" style="width: 30%;">
                    <p class="">your name:</p>
                    <p>{{ Auth::user()->name }}さん</p>
                    {{--<p>your class :</p>--}}
                </div> 
                
                <!---->
                <table class="text-center w-full border-collapse ">
                <div class="ml-5">
                    <div class="mb-4">
                        
                    <thead>    
                        <tr >
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light"> {{ Auth::user()->name }}さんの質問一覧 </th>
                        
                        {{--<p class="text-2xl">{{ Auth::user()->name }}さんの質問一覧</p>--}}
                        
                        </tr>
                    </thead>    
                    
                    <tbody>    
                        <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light">
                            
                        
                        @foreach ($questions as $question)
                            <a href="{{ route('question.show', $question->id) }}">
                            <p>＊{{$question->question}}</p>
                            </a>
                        @endforeach 
                    </div>
                        
                        </td>
                        </tr>
                    </tbody>    
                        
                    <thead>
                        <tr class="hover:bg-grey-lighter">
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">{{ Auth::user()->name }}さんの回答一覧</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">
                             @foreach ($answers as $answer)
                            
                            <a href="{{ route('question.show', $answer->question_id) }}">
                            <p>{{$answer->body}}</p>
                            </a>
                            @endforeach 
                        
                            </td>
                            </tr>
                        </tbody>
                    
                        
                        <thead>
                            <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">{{ Auth::user()->name }}さんのお気に入りの質問</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr class="py-4 px-6 border-b border-grey-light">
                            <td class="py-4 px-6 border-b border-grey-light">
                            @foreach ($favorites as $favorite)
                            <a href="{{ route('question.show', $favorite->id) }}">
                            <p>＊{{$favorite->question}}</p>
                            </a>
                            @endforeach 
                            </td>
                            </tr>
                        
                        </tbody>
                        </table>
                        <!---->
                        
                        
            {{--<div class="ml-5 basis-3/4">
                <div class="mb-4">    
                    <p class="text-2xl">{{ Auth::user()->name }}さんの質問一覧</p>
                    @foreach ($questions as $question)
                        <a href="{{ route('question.show', $question->id) }}">
                        <p>＊{{$question->question}}</p>
                        </a>
                    @endforeach 
                        
                    <div class="mb-4">    
                         <p class="text-2xl">{{ Auth::user()->name }}さんの回答一覧</p>
                        @foreach ($answers as $answer)
                        
                            <a href="{{ route('question.show', $answer->question_id) }}">
                            <p>＊{{$answer->body}}</p>
                            </a>
                        @endforeach 
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-2xl">{{ Auth::user()->name }}さんのお気に入りの質問</p>
                        @foreach ($favorites as $favorite)
                        
                            <a href="{{ route('question.show', $favorite->id) }}">
                            <p>＊{{$favorite->question}}</p>
                            </a>
                        @endforeach 
                    </div>  --}}  
                </div>    
            </div>
        </div>
    </div>    
</div>

</x-app-layout>