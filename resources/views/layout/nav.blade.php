@extends('layout.template')
@section('title','Training')

@section('content')
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#pretest" data-toggle="tab">PreTest</a></li>
        <li><a href="#modul" data-toggle="tab">Modul</a></li>
        <li><a href="#posttest" data-toggle="tab">PostTest</a></li>
        <li><a href="#" data-toggle="tab">Evaluasi</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="pretest">
            <div class="panel-body">
            <p>
                Exam Time:    &nbsp; <span class="js-timeout" >{{$training->pretest->duration}}</span>
            </p>
            <p>
                Name Test : {{ $training->pretest->nameTest }}.
            </p>
            @if ($pretest_result != null )
            <div class="alert bg-gray color-palette alert-dismissible">Your test score: {{ $pretest_result->score }}</div>
            @else
            <form action="/test/{{$training->pretest->id}}/training" method="post">
            @csrf
            <?php $i = 1; ?>
            @foreach($training->pretest->question as $item)
                {{-- @if ($i > 1) <hr /> @endif --}}
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <div class="form-group">
                            <strong>Question {{ $i }}.<br />{!! nl2br($item->question) !!}</strong>

                            <input type="hidden"name="questions[{{ $i }}]"value="{{ $item->id }}">
                            @foreach($item->question_option as $question)
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
            {{-- <input type="submit" value=" Submit results " /> --}}
        </div>
        </div>

        <!-- /.tab-pane -->
        <div class="tab-pane" id="modul">
            modul
            <iframe height="400"  width="600" src="/videos/{{$training->lesson->file}}"></iframe>
        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="posttest">
            <div class="panel-body">
                <p>
                    Exam Time:    &nbsp; <span class="js-timeout" >{{$training->posttest->duration}}</span>
                </p>
                {{-- <div class="icon-bar" >
                    <button class="btn btn-lg">Exam Time CountDown : <span class="js-timeout"></span>  </button>
                </div> --}}
                <p>
                    Name Test : {{ $training->posttest->nameTest }}.
                </p>
                @if ($posttest_result != null )
                <div class="alert bg-gray color-palette alert-dismissible">Your test score: {{ $posttest_result->score }}</div>
                @else
                <form action="/test/{{$training->posttest->id}}/training" method="post">
                @csrf
                <?php $i = 1; ?>
                @foreach($training->posttest->question as $item)
                    {{-- @if ($i > 1) <hr /> @endif --}}
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="form-group">
                                <strong>Question {{ $i }}.<br />{!! nl2br($item->question) !!}</strong>
        
                                <input type="hidden"name="questions[{{ $i }}]"value="{{ $item->id }}">
                                @foreach($item->question_option as $question)
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
                {{-- <input type="submit" value=" Submit results " /> --}}
            </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  

@endsection