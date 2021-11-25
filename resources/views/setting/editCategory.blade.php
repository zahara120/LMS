@extends('layout.template')
@section('title','Edit Category')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Category</h3>
    </div>

    <form class="form-horizontal" role="form" action="{{ url('categorytraining/'.$category->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="box-body">

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Name Category Training :</label>
            <div class="col-sm-8">
                <input type="text" name="nameCategory" value="{{ $category->nameCategory }}" class="form-control" id="nameCategory" placeholder="Nama Category Training">
            </div>
        </div>
    </div>

        <div class="modal-footer">
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        {{-- <form class="form-horizontal">
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Category name :</label>

              <div class="col-sm-10">
                <input class="form-control select2" type="text" value="{{ $category->nameCategory }}" disabled>
              </div> --}}    
        </form>

        {{-- <div class="form-group">
            <label for="categoryTraining">Name Category :</label>
            <input type="text" name="categoryTraining" value="$category->nameCategory" class="form-control" id="categoryTraining" placeholder="Nama Category Training">
        </div>   
        </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>

    </form> --}}
</div>

@endsection