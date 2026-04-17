@extends('admin.layout')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Timetable</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Timetable</li>
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
                            <h3 class="card-title">Add Timetable</h3>
                        </div>
                        <form action="{{ route('timetable.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Class Name</label>
                                    <select name="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <select name="subject_id" class="form-control">
                                            <option value="">Select Subject</option>
                                            @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        @error('subject_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Start time</th>
                                            <th>End time</th>
                                            <th>Room number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @foreach ($days as $day)
                                        <tr>
                                            <td>{{ $day->name }}</td>
                                            <input type="hidden" name="timetable[{{ $i }}][day_id]" value="{{ $day->id }}">
                                            <td><input type="time" name="timetable[{{ $i }}][start_time]"></td>
                                            <td><input type="time" name="timetable[{{ $i }}][end_time]"></td>
                                            <td><input type="number" name="timetable[{{ $i }}][room_number]" placeholder="Enter room number"></td>
                                        </tr>
                                        @endforeach
                                        @php
                                        $i++;
                                        @endphp
                                    </tbody>
                                </table>
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