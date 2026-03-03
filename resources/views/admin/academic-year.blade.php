@extends('admin.layout')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Academic Year</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Academic Year</li>
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

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Academic Year</h3>
            </div>

            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror

            <form action="{{ route('academic-year.store') }}" method="post">
              @csrf <div class="card-body">
                <div class="form-group">
                  <label for="name">Academic Year</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Enter Academic Year" required>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
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