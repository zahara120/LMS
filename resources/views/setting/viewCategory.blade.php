@extends('layout.template')
@section('title','Detail Category')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Detail Category</h3>
    </div>

    <div class="box-body">

        <label for="inputName" class="col-sm-2 control-label">Category id: </label>
        <div class="col-sm-10">
        </div>
        {{ $category->id }}
        </div>
        </div>
                  
        <label for="inputName" class="col-sm-2 control-label">Name Category : </label>
        <div class="col-sm-10">
        </div>
        {{ $category->nameCategory }}
        </div>
        </div>

    </div>
</div>
@endsection