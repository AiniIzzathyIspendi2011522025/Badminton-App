{{ Form::open(array('method'=>'PATCH','url' => route('customer.profil.update', $customer->id), 'files' =>true)) }}
<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-sm-6">
                <label>First Name</label>
                <input name="first_name" value="{{$customer->first_name}}" type="text" class="form-control"
                    id="e_first_name" placeholder="" required>
                @error('last_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div><!-- End .col-sm-6 -->

            <div class="col-sm-6">
                <label>Last Name</label>
                <input name="last_name" value="{{$customer->last_name}}" type="text" class="form-control"
                    id="e_last_name" placeholder="" required>
                @error('last_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div><!-- End .col-sm-6 -->
        </div><!-- End .row -->
        <label>Alamat</label>
        <input name="address" value="{{$customer->address}}" type="text" class="form-control" id="e_address"
            placeholder="" required>
        @error('address')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror

        <div class="row">
            <div class="col-sm-6">
                <label>No Handphone</label>
                <input name="handphone" value="{{$customer->handphone}}" type="text" class="form-control"
                    id="e_handphone" placeholder="" required>
                @error('handphone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div><!-- End .col-sm-6 -->

            <div class="col-sm-6">
                <label for="avatar">Ubah Avatar :</label>
                <input type="file" id="e_avatar" name="avatar" accept="image/*">
                @error('avatar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div><!-- End .col-sm-6 -->
        </div><!-- End .row -->
        <button type="submit" class="btn btn-outline-primary-2">
            <span>SIMPAN PERUBAHAN</span>
            <i class="icon-long-arrow-right"></i>
        </button>


    </div><!-- End .col-lg-6 -->
    <div class="col-lg-4">
    </div><!-- End .col-lg-6 -->
</div><!-- End .row -->
{!! Form::close() !!}