@extends('layout.template')
@section('title','Create Questionnaire')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Create Questionnaire</h3>
    </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form"  action="/questionnaire/{{ $survey->id }}/survey" method="POST">
            @csrf
            {{-- <input type="hidden" name="question_id" value="{{  $item->id  }}"> --}}

            <div class="box-body">

            <div class="box-body">

            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Questionnaire : </label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="question" placeholder="Pertanyaan">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Type Answer :</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label><input type="radio" name="typeAnswer" id="essay" value="essay"> Essay</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                      <label><input type="radio" name="typeAnswer" id="multiplechoice" value="multiplechoice"> Multiple Choice</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary" style="float:right">Add Question</button>
                </div>
            </div>
        </form>
        
        <?php $i = 1; ?>
        @foreach ($survey->questionnaire as $item)
        <div class="box-footer">
            <div class="form-group row mt-2" >
                <label class="col-sm-2 control-label">Question {{ $i }}:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="addmore[][question]" value="{{ $item->question }}" placeholder="Pertanyaan" disabled>
                </div>

                <div class="col-lg-1">
                    {{-- <a data-toggle="modal" data-target="#modal-edit" class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i> Edit
                    </a> --}}
                    <a href="{{url('/questionnaire/'.$item->id.'/edit')}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                </div>

                <div class="col-lg-1">
                    <form action="/questionnaire/{{$item->id}}" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                        @csrf
                        @method('DELETE')
                        <button href="#" class="btn btn-xs btn-danger" style="float:right"><i class="fa fa-trash"></i>Delete</button>
                    </form>
                </div>
            </div>
    
            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Type Answer :</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="typeAnswer" value="{{ $item->typeAnswer }}" placeholder="Type Answer" disabled>
                </div>
            </div>
            
        </div>
        <?php $i++; ?>
        @endforeach


    </div> 
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
          var question= '<div><div class="form-group row mt-2"><label class="col-sm-2 col-form-label">Question :</label><div class="col-sm-8"><input type="text" class="form-control" name="question[]" placeholder="Pertanyaan"></div><div class="col-lg-2"><a href="#" class="remove btn btn-danger addquestion" style="float:right">Delete</a></div></div>';
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

<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Question</h4>
        </div>
        <div class="modal-body">
            <form action="/room" method="post">
            @csrf
            <div class="form-group">
                <label for="nameRoom">Question :</label>
                <input type="text" name="nameRoom" class="form-control" id="nameRoom" placeholder="Nama Room Training">
                @if ($errors->has('nameRoom'))
                <span class="help-block">
                <strong>{{ $errors->first('nameRoom') }}</strong>
                    </span>
                @endif
            </div>   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
        </div>
      </div>
    </div>
  </div> 
