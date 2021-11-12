@extends('layout.template')
@section('title','Approval Detail')

@section('content')
<!-- <h2>
    category ID :
    {{$approval->category_id}}
<br>
    subcategory ID :
    {{$approval->subcategory_id}}
<br>
    Title Training :
    {{$approval->titleTraining}}
<br>
    Status :
    {{$approval->status}}
<br>
    Quota :
    {{$approval->quota}}
<br>
    Objective Training :
    {{$approval->objectiveTraining}}
<br>
    Background Training :
    {{$approval->backgroundTraining}}
<br>
    Description :
    {{$approval->description}}
</h2>


 -->

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Approval Detail</h3>
    </div>

    <div class="box-body">

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Title Training :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="approval_id" placeholder="titleTraining" style="width: 100%;" disabled>
                <option>{{$approval->titleTraining}}</option>
            </select>
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Status :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="lesson_id" placeholder="LessonTraining" style="width: 100%;" disabled>
                <option value="">{{$approval->status}}</option>
            </select>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Quota :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="lesson_id" placeholder="LessonTraining" style="width: 100%;" disabled>
                <option value="">{{$approval->quota}}</option>
            </select>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Objective Training :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="lesson_id" placeholder="LessonTraining" style="width: 100%;" disabled>
                <option value="">{{$approval->objectiveTraining}}</option>
            </select>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Background Training :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="lesson_id" placeholder="LessonTraining" style="width: 100%;" disabled>
                <option value="">{{$approval->backgroundTraining}}</option>
            </select>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Description :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="lesson_id" placeholder="LessonTraining" style="width: 100%;" disabled>
                <option value="">{{$approval->description}}}</option>
            </select>
            </div>
        </div>

    </div>
    store button ke status
    <a type="button" class="btn btn-success">Terima</a>
    <a type="button" class="btn btn-danger">Tolak</a>
    <input type="text" name="alasan" placeholder="Alasan"> bikin table lagi
</div>
@endsection
