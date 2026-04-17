@extends('admin.layout')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assign Teacher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Assign Teacher</li>
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
                            <h3 class="card-title">Update Assign Teacher</h3>
                        </div>
                        <form action="{{ route('assign-teacher.update', $assign_teacher->id) }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Class Name</label>
                                    <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ $assign_teacher->class_id == $class->id ? 'selected' : '' }} {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Subject Name</label>
                                    <select name="subject_id" class="form-control @error('subject_id') is-invalid @enderror">
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $assign_teacher->subject_id == $subject->id ? 'selected' : '' }} {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Teacher Name</label>
                                    <select name="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror">
                                        <option value="">Select Teacher</option>
                                        @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ $assign_teacher->teacher_id == $teacher->id ? 'selected' : '' }} {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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