@extends('layout.template')
@section('title','Approval Record')

@section('content')
@if(session('succes'))
<div class="alert alert-success" role="alert">
    {{session('succes')}}
</div>
@endif

<style>
  .status{
    margin-left: 5px;
  }
</style>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Approval Record</h3>
        <div class="pull-right">
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#provider">
                create
            </button>
            <a href="" type="button" class="btn btn-success btn-flat">
                Export
            </a>
            <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#upload">
                Import
            </button> --}}
            {{-- <a href="/categorytraining/create" class="btn btn-primary btn-flat">
               create
            </a> --}}
        </div> 
    </div>
    <div class="box-body table-responsive">
        <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists())
                <th>NIP</th>
                <th>Nama Pemohon</th>
                @endif
                <th>Tittle Training</th>
                <th>Category Training</th>
                <th>Kuota</th>
                <th>Status</th>
                <th>Waktu Pengajuan</th>
                @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists())
                <th >Action</th>
                @endif
            </tr> 
        </thead>
        <tbody>
            <?php $number = 0;?>
            @foreach ($approval as $item)
            @if(Auth::user()->id == $user_id || Auth::user()->role()->where('nameRole', '=', 'Admin')->exists() 
            || Auth::user()->id == $approver_satu || Auth::user()->id == $approver_dua || Auth::user()->id == $approver_tiga)
            <tr>
                <?php $number++ ?>
                <td class="text-center">{{ $number }}</td>
                @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists())
                  @foreach($approval_detail as $items )
                  <td>{{ $items->user->nip }}</td>
                  <td>{{ $items->user->name }}</td>
                  @endforeach
                @endif
                <td>{{ $item->titleTraining }}</td>
                <td>{{ $item->category->nameCategory }}</td>
                <td>{{ $item->quota }}</td>
                <td>
                    @if ($item->status==0)
                    <label class="label label-warning">Pending</label>
                    @elseif ($item->status==1)
                    <label class="label label-success">Approve</label>
                    @elseif($item->status == 2) 
                    <label class="label label-danger">Reject</label>
                      @if(auth()->user()->role()->where('nameRole', '=', 'User')->exists())
                        <a href="{{route('approval.edit',  $item->id)}}" class="btn btn-xs btn-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                      @endif
                    @endif
                </td>
                <td>{{ $item->created_at }}</td>
                {{-- <td>
                    <label class="label {{ ($item->status == 0) ? 'label-danger' :'label-success' }}">{{ ($item->status==0)?'Pending':'Approve' }}</label>
                </td> --}}
                @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists())
                <td class="text-center">
                    {{-- <form role="form" action="/approval/{id}" method="post">
                    @csrf
                    <div class="form-group col-md-6">
                        <select name="status">
                          <option value="0" @if($item->status==0)selected @endif>Pending</option>
                          <option value="1" @if($item->status==1)selected @endif>Approve</option>
                          <option value="2" @if($item->status==2)selected @endif>Reject</option> 
                        </select>
                    </div>
                    </form> --}}
                    @if($item->status == 0)
                      <a href="/approval/{{$item->id}}" type="button" class="btn btn-warning status">Status</a>
                    @else
                      <a type="button" class="btn btn-warning status" disabled>Status</a>
                    @endif
            
                    <div class="col-md-4">
                    <?php $buttonFlag = 0;?>
                      @foreach($trainings as $training)
                      <!-- kalo ada -->
                        @if($training->approval_id == $item->id)
                        <?php $buttonFlag++ ?>
                        @endif
                      @endforeach

                      @if($buttonFlag < 1 &&  $item->status == 1)
                      <a class="btn btn-info" type ="button" href="{{route('training.create', $item->id)}}"> Detail</a>
                      @else
                      <button class="btn btn-info "  disabled> Detail</button>
                      @endif
                    </div> 
                </td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody> 
    </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$('.dropdown-item').click((event) => {
    updateleave(event.target);
    removedropdown(event.target);
  });
  
  function updateleave(el) {
    let data = {
          status:$(el).data('status')
    };
    $.ajax({
      url: $(el).data('url'),
      type: 'PUT',
      data: {
        _token:CSRF_TOKEN,
        status:data
      },
      dataType: 'JSON',
      success: function(result) {
          if (result.error) {
            alert(result.error);
          } else {
            location.reload();
          }
      },
      error: function(err) {
          alert('something went wrong');
      }
    });
  }
  
  function removedropdown(el) {
    // to remove the dropdown after select 
    const dropdown = el.closest('.dropdown'); //get dropdown
    const selected = $(`<label>${$(el).text()}</label>`); //create selected label    
    selected.appendTo($(dropdown).parent()); //append label to dropdown's parent before...
    dropdown.remove(); //...removing dropdown
  }

</script>
@endsection
