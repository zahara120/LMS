@extends('layout.template')
@section('title','Registration Detail')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Registration Detail</h3>
    </div>

    <div class="box-body">

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Title Training :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="approval_id" placeholder="titleTraining" style="width: 100%;" disabled>
                <option>{{$regist->training->approval->titleTraining}}</option>
            </select>
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Nama Trainee :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$regist->user->name}}" disabled>
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">NIP :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$regist->user->nip}}" disabled>
            </div>
        </div>

        

       
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Mandatory Training :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$regist->training->mandatory}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Method Training :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$regist->training->mandatoryTraining}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Description :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$regist->training->catatan}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Publish :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$regist->training->publish}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Start Date :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$regist->training->start_date}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">End Date :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$regist->training->end_date}}" disabled>
            </div>
        </div>
        <form action="/regist/{{$regist->id}}" method="post">
        @csrf
        @method('PUT')
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Decision :</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label><input type="radio" name="status" id="approve" onclick="javascript:statusCheck();" value="1"> Approve</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                        <label><input type="radio" name="status" id="reject" onclick="javascript:statusCheck();" value="2"> Reject</label>
                    </div>
                </div>
            </div>
            <div id="ifreject" style="display:none">
                <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Alasan :</label>
                <div class="col-sm-8">
                    <input type="text" name="reason" placeholder="Reason">
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <a href="{{url()->previous()}}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
    function statusCheck() {
        if (document.getElementById('reject').checked) {
            document.getElementById('ifreject').style.display = 'block';
        }
        else document.getElementById('ifreject').style.display = 'none';
    
    }
</script>

@endsection