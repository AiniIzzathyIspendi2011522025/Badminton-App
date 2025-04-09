{!! Form::open(['method'=>'PATCH', 'route' => ['admin.venue.reject', 0],'id'=>'reject']) !!}
<div class="col-12" animated fadeInRight" id="reject-venue" style="display:none">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Alasan penolakan venue</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <textarea name="reject_note" class="form-control" cols="200" rows="4" required></textarea>
                    <input type="hidden" name="venue_id" id="venue_id">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Kirim alasan tolak</button>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
{!! Form::close() !!}