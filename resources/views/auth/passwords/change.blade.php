@if (Auth::user()->thisCustomer())
{{ Form::open(array('method'=>'POST', 'url' => route('customer.auth.changePassword.store'))) }}<div class="row">
    <div class="col-lg-8">
        <label>New Password</label>
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror required"
            required> <span class="form-text m-b-none"></span>
        @error('password')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
        <label>Confirm Password</label>
        <input name="password_confirmation" type="password"
            class="form-control @error('password') is-invalid @enderror required" required>
        <span class="form-text m-b-none"></span>
        @error('password')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
        <button type="submit" class="btn btn-outline-primary-2">
            <span>UBAH PASSWORD</span>
            <i class="icon-long-arrow-right"></i>
        </button>
    </div><!-- End .col-lg-6 -->
    <div class="col-lg-4">
    </div><!-- End .col-lg-6 -->
</div>
{!! Form::close() !!}

@elseif (Auth::user()->thisOwner())
{{ Form::open(array('method'=>'POST', 'url' => route('owner.auth.changePassword.store'))) }}<div class="row">
    <div class="col-lg-8">
        <div class="form-group row">
            <div class="col-sm-6">
                <label>New Password</label>
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror required"
                    required> <span class="form-text m-b-none"></span>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div><!-- End .col-sm-6 -->
            <div class="col-sm-6">
                <label>Confirm Password</label>
                <input name="password_confirmation" type="password"
                    class="form-control @error('password') is-invalid @enderror required" required>
                <span class="form-text m-b-none"></span>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div><!-- End .col-sm-6 -->
        </div>
        <button type="submit" class="btn btn-danger">Ubah Password</button>
    </div><!-- End .col-lg-6 -->
    <div class="col-lg-4">
    </div><!-- End .col-lg-6 -->
</div>
{!! Form::close() !!}
@endif
