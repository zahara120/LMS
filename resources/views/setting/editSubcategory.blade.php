@extends('layout.template')
@section('title','Edit Subcategory')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Subcategory</h3>
    </div>

        <form  class="form-horizontal" role="form" action="{{ url('subcategorytraining/'.$subcategory->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="box-body">
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Name Subcategory Training :</label>
            <div class="col-sm-8">
                <input class="form-control select2" name="nameSubcategory" type="text" value="{{ $subcategory->nameSubcategory}}" >
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Name Category Training :</label>
            <div class="col-sm-8">
                <select class="form-control select2" name="nameCategory"  value="{{ $subcategory->category->nameCategory }}" style="width: 100%;" >
                    @foreach($category as $item)
                        <option value="{{ $item->id }}">{{ $item->nameCategory }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Description :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{ $subcategory->description }}" >
            </div>
        </div>

    </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>

</div>
@endsection