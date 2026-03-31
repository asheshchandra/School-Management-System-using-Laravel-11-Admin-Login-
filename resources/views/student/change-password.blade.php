@extends('admin.layout')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Change Password</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
          @if (Session::has('success'))
          <div class="alert alert-success">
            {{ Session::get('success') }}
          </div>
          @endif

          @if (Session::has('error'))
          <div class="alert alert-danger">
            {{ Session::get('error') }}
          </div>
          @endif

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Password</h3>
            </div>

            <form action="{{ route('student.updatePassword') }}" method="post">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Old Password</label>
                    <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter Old Password">
                    @error('old_password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">New Password</label>
                    <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter New Password">
                    @error('new_password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Confirm Password">
                    @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Change Password</button>
              </div>
            </form>
          </div>
</div>
</section>
</div>
@endsection

@section('customJs')
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
  $(function() {
    bsCustomFileInput.init();
  });
</script>
@endsection