@extends('layout.template')
@section('title','Create Answer')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Create Answer</h3>
    </div>

        <form role="form"  action="/answer" method="POST">

            @csrf
            <div class="box-body">

            {{-- <button value="{{$test->test_id}}" class="button-add-more-question">Add more questions</button> --}}

            @foreach ($question as $item)
            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Question:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="addmore[][question]" value="{{ $item->question }}" placeholder="Pertanyaan">
                </div>

                <div class="col-lg-2 ">
                    <a href="#" class="btn btn-primary addoption" style="float:right">Add option</a>
                </div>

            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Answer Option :</label>
                <div class="col-lg-4">
                <input type="text" class="form-control" name="addmore[][option_text]" value="{{ old('option_text') }}" placeholder="Pilihan Pertanyaan">
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                      <label><input type="checkbox" name="addmore[][correct]">Answer</label>
                    </div>
                </div>
                
                <div class="col-lg-2">
                <a href="#" class="btn btn-primary addoption" style="float:right">Add option</a>
                </div>
            </div>

            <div class="option"></div>
            @endforeach

            {{-- <input type="text" name="addmore[0][question]" placeholder="Question" class="form-control" /> --}}

            {{-- @foreach($question as $item)
            <button value="{{$item->question}}" class="button-remove">Remove</button>
                <input type="text" placeholder="Question name" name="question_name[]" value="{{{$question->question_name}}}">
                <input type="hidden" name="question_id[]" value="{{{$question->question_id}}}">
            @endforeach --}}

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
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
//           $(this).parent().parent().append('<div class="box-body" ><div class="form-group row mt-2"><label class="col-sm-2 control-label">Answer Option :</label><div class="col-lg-4"><input type="text" class="form-control" name="addmore[][option_text]" placeholder="Pilihan Pertanyaan"></div><div class="col-lg-2"><div class="checkbox"><label><input type="checkbox"  name="addmore[][correct]">Answer</label></div></div><div class="col-lg-2"><a href="#" class="remove btn btn-danger addoption" style="float:right">Delete</a></div></div></div>');
//       });

$('.remove').live('click',function(){ 
          $(this).parent().parent().remove();
      });


</script> 

@endsection
