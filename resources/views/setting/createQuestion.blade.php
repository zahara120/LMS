@extends('layout.template')
@section('title','Create Question')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Create Question</h3>
    </div>

        <form role="form"  action="/question" method="POST">

            @csrf
            <div class="box-body">

            {{-- <button value="{{$test->test_id}}" class="button-add-more-question">Add more questions</button> --}}

            <div class="box-body">

                <div class="form-group row mt-2">
                    <label class="col-sm-2 control-label">Name test :</label>
                    <div class="col-sm-8">
                    <select class="form-control select2" name="test_id" placeholder="titleTraining" style="width: 100%;">
                        @foreach($test as $item)
                        <option value="{{ $item->id }}">{{ $item->nameTest }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Question :</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="addmore[][question]" placeholder="Pertanyaan">
                </div>

                <div class="col-lg-2">
                    <a href="#" class="btn btn-primary addquestion" style="float:right">Add Question</a>
                    {{-- <button id="add" name="add" class="btn btn-primary addquestion" style="float:right">Add Question</button> --}}
                </div>
            </div>

            <div class="question"></div>

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

$('.addquestion').on('click',function(){ 
          addquestion();
        //   var html = $(".clone").html();
        //   $(".img_div").after(html);
      });
      function addquestion(){
          var question= '<div><div class="form-group row mt-2"><label class="col-sm-2 col-form-label">Question :</label><div class="col-sm-8"><input type="text" class="form-control" name="addmore[][question]" placeholder="Pertanyaan"></div><div class="col-lg-2"><a href="#" class="remove btn btn-danger addquestion" style="float:right">Delete</a></div></div>';
          $('.question').append(question);
      };
      $('.remove').live('click',function(){ 
          $(this).parent().parent().remove();
      });

//             $('.button-remove').click(function(e){
//                 e.preventDefault();
// //                var thisDiv=$(this);
//                 $.ajax({
//                      method: 'DELETE',
//                      url: '{{ url('question/delete') }}' + '/' + $(this).attr('value'),
//                      success: function() {
// //                   thisDiv.parent().css("display","none");
//                         location.reload();
//                     }
//                 });
//             });
//             $('.button-add-more-question').click(function(){
//                 $.ajax({
//                      method: "POST",
//                      url: '{{ url('question/add') }}' + '/' + $(this).attr('value'),
//                      success: function(){
//                          location.reload();
//                      }
//                 });
//             });

</script> 

{{-- <script type="text/javascript">

    var i = 0;

    $("#add").click(function(){

        ++i;

        $("#addquestion").append('<label class="col-sm-2 control-label">Question :</label><div class="col-sm-8"><input type="text" class="form-control" name="addmore[][question]" placeholder="Pertanyaan"></div><div class="col-lg-2"><button class="remove-tr" style="float:right">Delete</a></div>');

    });

    $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();

    });  

</script> --}}

@endsection