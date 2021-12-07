@extends('layout.template')
@section('title','Training')

@section('content')
<div class="box">
    @include('layout.nav')
    {{-- <div class="box-body"> --}}
    <div class="panel-body">
    <p>
        Exam Time:    &nbsp; <span class="js-timeout" >{{$training->pretest->duration}}</span>
    </p>
        {{-- <div class="icon-bar" >
        <button class="btn btn-lg">Exam Time CountDown : <span class="js-timeout"></span>  </button>
        </div> --}}
    <strong>Name Test : {{ $training->pretest->nameTest }}.<br />
    @if ($test_result != null )
    <div class="alert bg-gray color-palette alert-dismissible">Your test score: {{ $test_result->score }}</div>
    @else
    <form action="/test/{{$training->pretest->id}}/training" method="post">
    @csrf
    <?php $i = 1; ?>
        @foreach($questions as $item)
            {{-- @if ($i > 1) <hr /> @endif --}}
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ $i }}.<br />{!! nl2br($item->question) !!}</strong>

                        <input type="hidden"name="questions[{{ $i }}]"value="{{ $item->id }}">
                        @foreach($item->options as $question)
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="answers[{{ $item->id }}]" value="{{ $question->id }}">
                                {{ $question->option_text }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        <?php $i++; ?>
        @endforeach
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit results</button>
        </div>
        </form>
        @endif
    </div>
    </div>
{{-- </div> --}}

<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<script type="text/javascript">
    var interval;
    var form=document.forms.exam;
    function countdown() {
      clearInterval(interval);

      interval = setInterval( function() {
          var timer = $('.js-timeout').html();
          timer = timer.split(':');
          var minutes = timer[0];
          var seconds = timer[1];
          seconds -= 1;
          if (minutes < 0) return;
          else if (seconds < 0 && minutes != 0) {
              minutes -= 1;
              seconds = 59;
          }
          else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

          $('.js-timeout').html(minutes + ':' + seconds);

          if (minutes == 0 && seconds == 0) { clearInterval(interval);  form.submit(); alert("Time Over Please Click Ok Button");}
      }, 1000);
    }
    
    $('.js-timeout').text("{{$training->pretest->duration}}");
    countdown();
</script>


@endsection