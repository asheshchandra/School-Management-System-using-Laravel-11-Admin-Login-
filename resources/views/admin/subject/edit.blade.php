@extends('admin.layout')


@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subject</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Subject</li>
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
              <h3 class="card-title">Edit Subject</h3>
            </div>

            <form action="{{ route('subject.update') }}" method="post">
              @csrf 
              <div class="card-body">
                <input type="hidden" name="id" value="{{ $subject->id }}">
                <div class="form-group">
                  <label for="name">Subject Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Enter subject name" value="{{ old('name', $subject->name) }}" required>
                </div>
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <div class="form-group">
                  <label for="type">Type</label>
                  <select name="type" id="type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="theory" {{ old('type', $subject->type) == 'theory' ? 'selected' : '' }}>Theory</option>
                    <option value="practical" {{ old('type', $subject->type) == 'practical' ? 'selected' : '' }}>Practical</option>
                  </select>
                </div>
                @error('type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Subject</button>
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