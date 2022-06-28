{{--<?php
ddd($answers);
?>--}}


<p>ようこそ、{{ Auth::user()->name }}さん</p>
<h2>your name :{{ Auth::user()->name }}さん</h2>
{{--<p>your class :</p>--}}
<p>my question</p>
@foreach ($questions as $question)
     <a href="{{ route('question.show', $question->id) }}">
    <p>＊{{$question->question}}</p>
    </a>
@endforeach 
<p>my answer</p>
@foreach ($answers as $answer)
{{--<?php
ddd($answer);
?>--}}
    <a href="{{ route('question.show', $answer->question_id) }}">
    <p>＊{{$answer->body}}</p>
    </a>
@endforeach 
<p>お気に入りの質問</p>
@foreach ($favorites as $favorite)
{{--<?php
ddd($favorite);
?>--}}
    <a href="{{ route('question.show', $favorite->id) }}">
    <p>＊{{$favorite->question}}</p>
    </a>
@endforeach 