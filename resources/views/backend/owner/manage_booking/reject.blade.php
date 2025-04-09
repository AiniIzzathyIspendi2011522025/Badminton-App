{!! Form::open(['method'=>'PATCH', 'route' => ['owner.booking.reject', 0],'id'=>'reject']) !!}
<div class="col-12" animated fadeInRight" id="reject-booking" style="display:none">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Alasan penolakan booking</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <textarea name="reject_note" class="form-control" cols="200" rows="4" required></textarea>
                    <input type="hidden" name="rent_id" id="rent_id">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button class="btn btn-success" type="submit">Tolak </button>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
{!! Form::close() !!}
