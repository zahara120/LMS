@extends('layout.template')
@section('title','Create Question')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Create Question</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

        {{-- <form role="form"  action="/question/{{ $test->id }}/test" method="POST">
            @csrf
            <div class="box-body">

            <div class="box-body">

            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Question : </label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="question[]" placeholder="Pertanyaan">
                </div>

                <div class="col-lg-2">
                    <a href="#" class="btn btn-primary addquestion" style="float:right">Add Question</a>
                </div>
            </div>

            <div class="question"></div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form> --}}

        <form role="form"  action="/question/{{ $test->id }}/test" method="POST">
            @csrf
            {{-- <input type="hidden" name="question_id" value="{{  $item->id  }}"> --}}

            <div class="box-body">

            <div class="box-body">

            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Question : </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="question[]" placeholder="Pertanyaan">
                </div>

                <div class="col-lg-2">
                <button type="submit" class="btn btn-primary" style="float:right">Add Question</button>
                </div>
            </div>
        </form>
        
        <?php $i = 1; ?>
        @foreach ($test->question as $item)
            <div class="form-group row mt-2" >
                <label class="col-sm-2 control-label">Question {{ $i }}:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="addmore[][question]" value="{{ $item->question }}" placeholder="Pertanyaan" disabled>
                </div>

                <div class="col-lg-1">
                    {{-- <a data-toggle="modal" data-target="#modal-edit" class="btn btn-xs btn-info">
                        <i class="fa fa-pencil"></i> Edit
                    </a> --}}
                    <a href="{{url('/question/'.$item->id.'/edit')}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                </div>

                <div class="col-lg-1">
                    <form action="/question/{{$item->id}}" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                        @csrf
                        @method('DELETE')
                        <button href="#" class="btn btn-xs btn-danger" style="float:right"><i class="fa fa-trash"></i>Delete</button>
                    </form>
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
            <div class="form-group {{$errors->has('nameRoom') ? ' has-error' : ' '}}">
                <label for="nameRoom">Question :</label>
                <input type="text" name="nameRoom" value="{{ old('nameRoom') }}" class="form-control" id="nameRoom" placeholder="Nama Room Training">
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
