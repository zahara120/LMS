@extends('layout.template')
@section('title','Test')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Add Question</h3>
    </div>

    <form role="form" action="/test" method="post">
        @csrf
        <div class="box-body">

            {{-- <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Type Question :</label>
                <div class="col-lg-2">
                <select class="form-control select2" name="typeQuestion" placeholder="Jenis Pertanyaan" style="width: 100%;">
                    <option value="External">Pre Test</option>
                    <option value="Internal">Post Test</option>
                </div>
            </div>  --}}


            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Question :</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="multiInput1[][question]" value="{{ old('question') }}" placeholder="Pertanyaan">
                </div>

                <div class="col-lg-2">
                    <a href="#" class="btn btn-primary addquestion" style="float:right">Add Question</a>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Answer Option :</label>
                <div class="col-lg-4">
                <input type="text" class="form-control" name="multiInput2[][option_text]" value="{{ old('option_text') }}" placeholder="Pilihan Pertanyaan">
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                      <label><input type="checkbox">Answer</label>
                    </div>
                </div>
                
                <div class="col-lg-2">
                <a href="#" class="btn btn-primary addoption" style="float:right">Add option</a>
                </div>
            </div>

            <div class="option"></div>

            <div class="question"></div>

            {{-- <div class="form-group row mt-5">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                <a href="#" class="btn btn-primary addoption " style="float:right">Tambah option</a>
                </div>
            </div> --}}

        {{-- <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-form-label">Question :</label>
                    <input type="text" name="question" class="form-control" placeholder="Pertanyaan">
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 col-form-label">Answer Option :</label>
                    <input type="text" name="option_text" class="form-control" placeholder="Pilihan jawaban">

                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="#" class="btn btn-primary addoption" >Add Option</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>   --}}
    </div>

  <div class="box-footer">
    <button type="button" class="btn btn-default">Cancel</button>
    <button type="submit" class="btn btn-success">Submit</button>
  </div>
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
      $('.addoption').on('click',function(){ 
          addoption();
        //   var html = $(".clone").html();
        //   $(".img_div").after(html);
      });
      function addoption(){
          var option= '<div><div class="form-group row mt-2"><label class="col-sm-2 control-label">Answer Option :</label><div class="col-lg-4"><input type="text" class="form-control" name="option_text" value="{{ old('option_text') }}" placeholder="Pilihan Pertanyaan"></div><div class="col-lg-2"><div class="checkbox"><label><input type="checkbox">Answer</label></div></div><div class="col-lg-2"><a href="#" class="remove btn btn-danger addoption" style="float:right">Delete</a></div> </div></div>';
          $('.option').append(option);
      };
    //   $('.remove').live('click',function(){ 
    //       $(this).parent().parent().remove();
    //   });
      $('.addquestion').on('click',function(){ 
          addquestion();
        //   var html = $(".clone").html();
        //   $(".img_div").after(html);
      });
      function addquestion(){
          var question= '<div><div class="form-group row mt-2"><label class="col-sm-2 col-form-label">Question :</label><div class="col-sm-8"><input type="text" class="form-control" name="question" value="{{ old('question') }}" placeholder="Pertanyaan"></div><div class="col-lg-2"><a href="#" class="remove btn btn-danger addquestion" style="float:right">Delete</a></div></div><div class="form-group row mt-2"><label class="col-sm-2 control-label">Answer Option :</label><div class="col-lg-4"><input type="text" class="form-control" name="multiInput2[][option_text]" value="{{ old('option_text') }}" placeholder="Pilihan Pertanyaan"></div><div class="col-lg-2"><div class="checkbox"><label><input type="checkbox">Answer</label></div></div><div class="col-lg-2"><a href="#" class="btn btn-primary addoption" style="float:right">Add option</a></div></div><div class="option"></div></div>';
          $('.question').append(question);
      };
      $('.remove').live('click',function(){ 
          $(this).parent().parent().remove();
      });

</script>

@endsection

