@extends('layout.template')
@section('title','ADD CATEGORY')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add Category</h3>
    </div>

    <form role="form" action="/subcategorytraining" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">

        <div class="form-group">
            <label for="subcategoryTraining">Name Category :</label>
            <input type="text" name="subcategoryTraining" class="form-control" id="subcategoryTraining" placeholder="Nama Subcategory Training">
        </div>   
        </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>

    </form>
</div>

@endsection