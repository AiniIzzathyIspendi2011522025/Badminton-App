@extends('layouts.owner.home')

@section('content')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script>

<section class="section">
        <div class="section-header">
            <h1>Kelola Lapangan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">
                    <strong>Kelola Lapangan</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Pilih Venue</label>
                        {!! Form::select('venue', $venue, null, ['class' => 'form-control selectpicker', 'data-live-search'=>'true', 'required'=>'required', 'id'=>'s_venue']) !!}
                        @error('venue')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                <div class="tab-content tab-bordered" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-header">
                            <h4>List Data Lapangan</h4>
                            <div class="card-header-form">
                                <div class="input-group">                
                                    <div class="input-group-btn">
                                    </div>
                                </div>
                            </div>
                            </div>
                        <div class="table-responsive">
                            <table class="table table-striped dataTables-field" id="table-2">
                            <thead>
                                <tr>
                                <th class="text-center">
                                    <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                @foreach($datas as $data)
                                <tr class = "tr-body">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->price}}</td>
                                    <td><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-folder"></i> View </a>&nbsp; <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                </div>
            </div>
            </div>
        </div>


</section>
{!! Form::open(['method'=>'DELETE','route'=>['owner.field.destroy',0], 'style'=>'display.none','id'=>'deleted_field'])!!}
{!! Form::close() !!}
{!! Form::open(['method'=>'GET','route'=>['owner.field.edit',0], 'style'=>'display.none','id'=>'edit_field'])!!}
{!! Form::close() !!}

@endsection

@section('script')
<script type="text/javascript">
    $('#s_venue').on('change', function (e){
        let id = $('#s_venue').val();
        show_data(id);
    });

    function show_data(id){
        
        $.ajax(
            { url: "{{url('api/field')}}?data=all&&id="+id, 
            dataType: 'json', 
            cache: false, 
            dataSrc: '',

            success: function(data){  
                var name = data.map(function(item) {
                    return item.name;
                }); 
                var price = data.map(function(item) {
                    return item.price;
                }); 

                $(".tr-body").remove();
                for(i=0; i<data.length; i++){
                    let j = i+1;
                    var start = '<tr class="tr-body">';
                    var td1 = '<td class="tr-body">'+j+'</td>'; 
                    var td2 = '<td class="tr-body">'+name[i]+'</td>'; 
                    var td3 = '<td class="tr-body">'+price[i]+'</td>';          
                    var td4 = '<td class="tr-body"><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-folder"></i> View </a>&nbsp; <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit </a></td>';
                    var end = '</tr>';
                    $("#list").append(start, td1, td2, td3, td4, end);     
                }
            }
                
        });
    }

    function confirmdelete(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            );
            $('#deleted_field').attr('action', "{{route('owner.field.index')}}/"+id);
            $('#deleted_field').submit();
        }
        })
    }
    function edit(id){
        $('#edit_field').attr('action', "{{route('owner.field.index')}}/"+id+"/edit");
        $('#edit_field').submit();
    }
    
</script>
@endsection