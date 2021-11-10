@extends('layout.template')
@section('title','Test')

@section('content')
    <section id="section-banner">
       <h1>Editing questions</h1>
    </section>

    <div class="exam-info">
        <p>
        Exam name:<span class="exam-atr"></span> Questions :<span class="exam-atr"></span>
        Exam time :<span class="exam-atr"> minutes</span> Created at :<span class="exam-atr"></span>
        </p>
    </div>

    <section id="section-question-form">

    <button value="" class="button-add-more-question">Add more questions</button>

    {{-- {{Form::open(array('action' => 'updateQuestions','method'=>'patch'))}}

        {{ Form::hidden('exam_id', $exam->exam_id) }} --}}

        {{-- @foreach($questions as $question) --}}
            <div class="single-q clearfix">
                <button value="{{ old('question') }}" class="button-remove">Remove</button>
                <input type="text" placeholder="Question name" name="question_name[]" value="">
                <input type="hidden" name="question_id[]" value="">
            </div>
        {{-- @endforeach --}}

        {{-- {{Form::submit('Save Questions',array('class'=>'button-save-question'))}}
     {{ Form::close() }} --}}

    </section>

    <script>
            $('.button-remove').click(function(e){
                e.preventDefault();
//                var thisDiv=$(this);
                $.ajax({
                     method: 'DELETE',
                     url: '{{ url('question/delete') }}' + '/' + $(this).attr('value'),
                     success: function() {
//                   thisDiv.parent().css("display","none");
                        location.reload();
                    }
                });
            });

            $('.button-add-more-question').click(function(){

                $.ajax({
                     method: "POST",
                     url: '{{ url('question/add') }}' + '/' + $(this).attr('value'),
                     success: function(){
                         location.reload();
                     }
                });
            });
    </script>
  @stop