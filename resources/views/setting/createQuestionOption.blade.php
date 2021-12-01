@extends('layout.template')
@section('title','Create Question Option')

@section('content')

<div class="box">
    <div class="box-header">

        <h3 class="box-title">Create Question Option</h3>
    </div>

            <div class="box-body form-horizontal" id="template">

            {{-- <button value="{{$test->test_id}}" class="button-add-more-question">Add more questions</button> --}}
            <?php $i = 1; ?>
            @foreach ($survey->questionnaire as $item)
            <div class="box-footer">
            <div class="form-group row mt-2" >
                <label class="col-sm-2 control-label">Question {{ $i }}:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="addmore[][question]" value="{{ $item->question }}" placeholder="Pertanyaan" disabled>
                </div>

                

            </div>

            @if($item->typeAnswer == 'multiplechoice')
            <form role="form"  action="/questionoption/{{ $survey->id }}/survey" method="POST">
            @csrf
            <input type="hidden" name="questionnaire_id" value="{{  $item->id  }}">
            
            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Answer Option :</label>
                <div class="col-lg-4">
                <input type="text" class="form-control" name="option_text" value="{{ old('option_text') }}" placeholder="Pilihan Pertanyaan">
                </div>
                
                <div class="col-lg-2">
                <button type="submit" class="btn btn-primary" style="float:right">Add option</button>
                </div>
            </div>

            </form> 
            @endif


            @foreach ($item->answer as $answers)
                {{-- tampilan answer dari subquestion --}}
                <div class="form-group row mt-2" >
                    <label class="col-sm-2 control-label">Answer:</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $answers->option_text }}" placeholder="Pertanyaan" disabled>
                    </div>

                    <div class="col-lg-1 ">
                        <form action="/questionoption/{{$answers->id}}" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                        @csrf
                        @method('DELETE')
                        <button href="#" class="btn btn-xs btn-danger" style="float:right"><i class="fa fa-trash"></i>Delete</button>
                        </form>
                    </div>

                    <div class="col-lg-1">
                        <a href="{{url('/questionoption/'.$answers->id.'/edit')}}" class="btn btn-xs btn-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </div>
                
                </div>
            @endforeach
            

            </div>
            <?php $i++; ?>   
            @endforeach

            {{-- <button type="submit" class="btn btn-success">Done</button> --}}
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">


function typeAnswerCheck() {
        if (document.getElementById('multiplechoice').checked) {
            document.getElementById('ifmultiplechoice').style.display = 'block';
        }
        else {
            document.getElementById('ifmultiplechoice').style.display = 'none';
        }
    }

</script> 

@endsection

