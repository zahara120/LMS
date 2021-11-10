@extends('layout.template')
@section('title','Test')

@section('content')

  <section id="section-banner">
       <h1>Editing answers</h1>
    </section>

    <div class="exam-info">
        <p>
        Exam name:<span class="exam-atr">{{{$exam->exam_name}}}</span> Questions :<span class="exam-atr">{{{$exam->questions_count}}}</span>
        Exam time :<span class="exam-atr">{{{$exam->exam_time}}} minutes</span> Created at :<span class="exam-atr"> {{{$exam->created_at}}}</span>
        </p>
    </div>

    <section class="section-form">

    {{Form::open(array('action' => 'updateAnswers'))}}
        @foreach($questions as $question)
            <div class="single-question clearfix">
            {{ Form::hidden('teacher_id', $question->user_id) }}
                  <div class="question-name">
                       <h3>{{{$question->question_name}}}</h3>
                  </div>
                  @foreach($answers as $answer)
                      @if($question->question_id==$answer->question_id)
                            <div class="true-or-false clearfix">
                            @if($answer->correct_answer=="true")
                                 <div class="true-answer">
                                     <input type="text" name="answer_name[]" value="{{{$answer->answer_name}}}">
                                     <input type="checkbox" checked="checked" name="correct_answer[]" value="{{{$answer->answer_id}}}">
                                 </div>
                            @elseif ($answer->correct_answer=="false")
                                 <div class="false-answer">
                                      <input type="text" name="answer_name[]" value="{{{$answer->answer_name}}}">
                                      <input type="checkbox" name="correct_answer[]" value="{{{$answer->answer_id}}}">
                                 </div>
                            @endif
                            <a value="{{$answer->answer_id}}" class="button-remove">Remove</a>
                            <input type="hidden" name="answer_id[]" value="{{{$answer->answer_id}}}">
                       </div>

                      @endif
                  @endforeach
                  <a value="{{$question->question_id}}" class="button-add-new-answer">Add more answers</a>
            </div>
        @endforeach

        {{Form::submit('Save All Answer',array('class'=>'button-save-all'))}}
    {{ Form::close() }}

    </section>

    <script>
    $('.button-remove').click(function(){
//        var thisDiv=$(this);
        $.ajax({
             method: "DELETE",
             url: '{{ url('/answer/delete') }}' + '/' + $(this).attr('value'),
             success: function() {
                location.reload()
            //thisDiv.parent().css("display","none");
             }
        });
    });
    $('.button-add-new-answer').click(function(){
        $.ajax({
            method: "POST",
            url: '{{ url('/answer/add') }}' + '/' + $(this).attr('value'),
            success: function(){
                location.reload()
            }
        });
    });

</script>
@stop