<div class="active tab-pane" id="settings">
    {{ Form::open(array('method'=>'PATCH','url' => route('owner.profil.update', $owner->id), 'files' =>true)) }}
    <div class="form-group row">
        <div class="col-sm-6">
            <label>First Name</label>
            <input name="first_name" value="{{$owner->first_name}}" type="text" class="form-control" id="e_first_name"
                placeholder="" required>
            @error('last_name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div><!-- End .col-sm-6 -->
        <div class="col-sm-6">
            <label>Last Name</label>
            <input name="last_name" value="{{$owner->last_name}}" type="text" class="form-control" id="e_last_name"
                placeholder="" required>
            @error('last_name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div><!-- End .col-sm-6 -->
    </div>
    <label>Alamat</label>
    <input name="address" value="{{$owner->address}}" type="text" class="form-control" id="e_address" placeholder=""
        required>
    @error('address')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
    <br>
    <label>No Handphone</label>
    <input name="handphone" value="{{$owner->handphone}}" type="text" class="form-control" id="e_handphone"
        placeholder="" required>
    @error('handphone')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
    <br>
    <div class="form-group row">
        <div class="col-sm-6">
            <label>Ubah Avatar</label><br>
            <input value="{{$owner->avatar}}" type="file" id="e_avatar" name="avatar" accept="image/*">
            @error('avatar')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div><!-- End .col-sm-6 -->
        <div class="col-sm-6">
            <label>Ubah KTP</label><br>
            <input value="{{$owner->ktp}}" type="file" id="e_ktp" name="ktp">
            @error('ktp')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div><!-- End .col-sm-6 -->
    </div>
    <br>

    <br>
    <button type="submit" class="btn btn-danger">Edit Profil</button>
    {!! Form::close() !!}
</div>