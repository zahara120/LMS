@extends('layout.template')
@section('title','Create Answer')

@section('content')

<div class="box">
    <div class="box-header">

        <h3 class="box-title">Create Answer</h3>
    </div>

            <div class="box-body" id="template">

            {{-- <button value="{{$test->test_id}}" class="button-add-more-question">Add more questions</button> --}}
            <?php $i = 1; ?>
            @foreach ($test->question as $item)
            <div class="box-footer">
            <div class="form-group row mt-2" >
                <label class="col-sm-2 control-label">Question {{ $i }}:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="addmore[][question]" value="{{ $item->question }}" placeholder="Pertanyaan" disabled>
                </div>

            </div>

            <form role="form"  action="/answer/{{ $test->id }}/test" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{  $item->id  }}">
                <div class="form-group row mt-2">
                    <label class="col-sm-2 control-label">Answer Option :</label>
                    <div class="col-lg-4">
                    <input type="text" class="form-control" name="option_text" value="{{ old('option_text') }}" placeholder="Pilihan Pertanyaan">
                    </div>
    
                    <div class="col-lg-2">
                        <div class="checkbox">
                          <label><input name="correct" type="checkbox" value=1>Answer</label>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary" style="float:right">Add option</button>
                    </div>
                </div>
            </form>


            @foreach ($item->question_option as $answers)
                {{-- tampilan answer dari subquestion --}}
                <div class="form-group row mt-2" >
                    <label class="col-sm-2 control-label">Answer:</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $answers->option_text }}" placeholder="Pertanyaan" disabled>
                    </div>

                    @if($answers->correct == 1)
                    <div class="col-lg-2">
                        <div class="checkbox">
                          <label><input name="correct" type="checkbox" checked>Answer</label>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-2">
                        <div class="checkbox">
                          <label><input name="correct" type="checkbox" disabled>Answer</label>
                        </div>
                    </div>
                    @endif
    
                    <div class="col-lg-1 ">
                        <form action="/answer/{{$answers->id}}" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                        @csrf
                        @method('DELETE')
                        <button href="#" class="btn btn-xs btn-danger" style="float:right"><i class="fa fa-trash"></i>Delete</button>
                        </form>
                    </div>

                    <div class="col-lg-1">
                        {{-- <a data-toggle="modal" data-target="#modal-edit" class="btn btn-xs btn-info">
                            <i class="fa fa-pencil"></i> Edit
                        </a> --}}
                        <a href="{{url('/answer/'.$answers->id.'/edit')}}" class="btn btn-xs btn-primary">
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

// $('.addoption').on('click',function(){ 
//     addoption();
//         //   var html = $(".clone").html();
//         //   $(".img_div").after(html);
//       });
//       function addoption(){
//           var option= '<div><div class="form-group row mt-2"><label class="col-sm-2 control-label">Answer Option :</label><div class="col-lg-4"><input type="text" class="form-control" name="addmore[][option_text]" placeholder="Pilihan Pertanyaan"></div><div class="col-lg-2"><div class="checkbox"><label><input type="checkbox">Answer</label></div></div><div class="col-lg-2"><a href="#" class="remove btn btn-danger addoption" style="float:right">Delete</a></div> </div></div>';
//           $('.option').append(option);
//       };

$('.addoption').live('click',function(){ 
          $(this).parent().parent().append('<div class="box"><div class="box-body"><div class="form-group row mt-2"><label class="col-sm-2 control-label">Answer Option :</label><div class="col-lg-4"><input type="text" class="form-control" name="addmore[][option_text]" value="{{ old('option_text') }}" placeholder="Pilihan Pertanyaan"></div><div class="col-lg-2"><div class="checkbox"><label><input type="checkbox" name="addmore[][correct]">Answer</label></div></div><div class="col-lg-2"><a href="#" class="btn btn-primary addoption" style="float:right">Add option</a></div></div></div></div>');
      });

// $('.addoption').click(function(){ 
//           $(this).parent('div').parent('div').append('<div class="box-body" ><div class="form-group row mt-2"><label class="col-sm-2 control-label">Answer Option :</label><div class="col-lg-4"><input type="text" class="form-control" name="addmore[][option_text]" placeholder="Pilihan Pertanyaan"></div><div class="col-lg-2"><div class="checkbox"><label><input type="checkbox"  name="addmore[][correct]">Answer</label></div></div><div class="col-lg-2"><a href="#" class="remove btn btn-danger addoption" style="float:right">Delete</a></div></div></div>');
//       });

$('.addoption').click(function(){ 
          $('#template').parent().parent().append('<div class="box-body" ><div class="form-group row mt-2"><label class="col-sm-2 control-label">Answer Option :</label><div class="col-lg-4"><input type="text" class="form-control" name="addmore[][option_text]" placeholder="Pilihan Pertanyaan"></div><div class="col-lg-2"><div class="checkbox"><label><input type="checkbox"  name="addmore[][correct]">Answer</label></div></div><div class="col-lg-2"><a href="#" class="remove btn btn-danger addoption" style="float:right">Delete</a></div></div></div>');
      });

    

$('.remove').live('click',function(){ 
          $(this).parent().parent().remove();
      });


</script> 

@endsection

