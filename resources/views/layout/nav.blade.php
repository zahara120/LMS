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
            @if($training->pretest->end_date <= now())
            <p style="color:red;"> time is up, next time try to be on time </p>
            @elseif($pretest_result != null)
            @else
            <p>
                Exam Time: <span id="timerPretest">{{$training->pretest->duration}}</span>
                <br>
                Name Test : {{ $training->pretest->nameTest }}.
            </p>
            <div class="icon-bar" >
                <button id="btn1" class="btn btn-sm btn-success" onclick="countdownPretest();">Start Exam<span class="js-timeout"></span>  </button>
            </div>
            @endif

            @if ($pretest_result != null )
            <div class="alert bg-gray color-palette alert-dismissible">Your test score: {{ $pretest_result->score }}</div>
            @else
            <br>
            <form action="/test/{{$training->id}}/training" method="post">
            @csrf
            <input type="hidden" name="test_id" value="{{ $training->pretest->id }}"> 
            <?php $i = 1; ?>
            <div id="questionHide" style="display:none">
            @foreach($training->pretest->question as $item)
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
            </div>
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
                @if($training->posttest->end_date <= now())
                <p style="color:red;"> time is up, next time try to be on time </p>
                @elseif($posttest_result != null)
                @else
                <p>
                    Exam Time:    &nbsp; <span id="timer">{{$training->posttest->duration}}</span>
                    <br>
                    Name Test : {{ $training->posttest->nameTest }}.
                </p>
                <div class="icon-bar" >
                    <button id="btn2" class="btn btn-sm btn-success" onclick="countdownPosttest()">Start Exam<span class="js-timeout"></span></button>
                </div>
                @endif

                @if ($posttest_result != null )
                <div class="alert bg-gray color-palette alert-dismissible">Your test score: {{ $posttest_result->score }}</div>
                @else
                <br>
                <form action="/test/{{$training->id}}/training" method="post">
                @csrf
                <input type="hidden" name="test_id" value="{{ $training->posttest->id }}"> 
                <?php $i = 1; ?>
                <div id="questionHide2" style="display:none">
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
                </div>
                @endif
                {{-- <input type="submit" value=" Submit results " /> --}}
            </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
    <script type="text/javascript">
        function countdownPretest() {
            var end_date = '<?php echo $training->pretest->end_date ?>';
            const tanggalTujuan = new Date(end_date).getTime();
            document.getElementById('questionHide').style.display='block';
            document.getElementById("btn1").disabled = true;
            document.getElementById("btn1").style.backgroundColor = "red";
            
            const countdown = setInterval(function() {
                var start_date = '<?php echo $training->pretest->start_date ?>';
                // const sekarang = new Date(start_date).getTime();
                const sekarang = new Date().getTime();
                const selisih = tanggalTujuan - sekarang;
    
                const hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
                const jam = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                const menit = Math.floor(selisih % (1000 * 60 * 60) / (1000 * 60));
                const detik = Math.floor(selisih % (1000 * 60) / 1000);
    
                const timerPretest = document.getElementById('timerPretest');
                timerPretest.innerHTML = hari + ' day ' + jam + ' hours ' + menit + ' minutes ' 
                + detik + ' seconds';
    
                if(selisih <= 0){
                    clearInterval(countdown);
                    timerPretest.innerHTML = 'time out!';
                    document.getElementById("btn1").disabled = true;
                    document.getElementById('questionHide').style.display='none';
                }
            }, 1000);
        }

        function countdownPosttest() {
            var end_date = '<?php echo $training->posttest->end_date ?>';
            const tanggalTujuan = new Date(end_date).getTime();
            document.getElementById('questionHide2').style.display='block';
            document.getElementById("btn2").disabled = true;
            document.getElementById("btn2").style.backgroundColor = "red";

            const countdown = setInterval(function() {
                var start_date = '<?php echo $training->posttest->start_date ?>';
                // const sekarang = new Date(start_date).getTime();
                const sekarang = new Date().getTime();
                const selisih = tanggalTujuan - sekarang;
    
                const hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
                const jam = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                const menit = Math.floor(selisih % (1000 * 60 * 60) / (1000 * 60));
                const detik = Math.floor(selisih % (1000 * 60) / 1000);
    
                const timer = document.getElementById('timer');
                timer.innerHTML = hari + ' day ' + jam + ' hours ' + menit + ' minutes ' 
                + detik + ' seconds';
    
                if(selisih <= 0){
                    clearInterval(countdown);
                    timer.innerHTML = 'time out!';
                    document.getElementById("btn2").disabled = true;
                    document.getElementById('questionHide2').style.display='none';
                }
            }, 1000);
        }
    </script>
@endsection