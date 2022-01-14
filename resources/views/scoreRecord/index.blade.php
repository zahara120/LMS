@extends('layout.template')
@section('title','Score Record')

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Score Record</h3>
        <div class="pull-right">
            
            {{-- search --}}

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal">
                create
            </button>
            <a href="/exportCategoryTraining" type="button" class="btn btn-success btn-flat">
                Export
            </a>
            <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#upload">
                Import
            </button>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>User Name</th>
                    <th>Title Training</th>
                    <th>Score Pre-Test</th>
                    <th>Score Post-Test</th>
                    <th class="text-center">Action</th>
                </tr> 
            </thead>
            <tbody>
            <?php $number = 0;?>
                @foreach ($test as $tests)
                @foreach($tests->test_result as $result)
                <tr>
                <?php $number++ ?>
                    <td class="text-center">{{ $number }}</td>
                    <td>{{$result->user->name}}</td>
                    <td>{{$result->training->approval->titleTraining}}</td>
                    <td>{{$result->pretestScore}}</td>
                    <td>{{$result->posttestScore}}</td>
                    
                    <td class="text-center" width="200px">
                        <a href="#" class="btn btn-xs btn-info" >
                            <i class="fa fa-eye"></i> View
                        </a>
                        <a href="#" class="btn btn-xs btn-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </a>

                        <form action="#" class="inline" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                            @method('delete')
                            @csrf         
                            <button type="submit" class="btn btn-xs btn-danger" >
                                <i class="fa fa-trash"></i> Delete
                            </button> 
                        </form>
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody> 
        </table>
    </div> 
</div>

@endsection