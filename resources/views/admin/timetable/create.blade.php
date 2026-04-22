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
                                    <select name="class_id" id="class_id" class="form-control">
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
                                        <select name="subject_id" id="subject_id" class="form-control">
                                            <option value="">Select Subject</option>
                                            <!-- @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                            @endforeach -->
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
                                            <th>Room no</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($days as $day)
                                        <tr>
                                            <td>{{ $day->name }}</td>
                                            <input type="hidden" name="timetable[{{ $loop->index }}][day_id]" value="{{ $day->id }}">
                                            <td><input type="time" name="timetable[{{ $loop->index }}][start_time]"></td>
                                            <td><input type="time" name="timetable[{{ $loop->index }}][end_time]"></td>
                                            <td><input type="number" name="timetable[{{ $loop->index }}][room_no]" placeholder="Enter room no."></td>
                                        </tr>
                                        @endforeach
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
<script>
    $('#class_id').change(function(){
        const class_id = $(this).val();
        $.ajax({
            url:"{{ route('findSubject') }}",
            type:"get",
            data:{class_id},
            dataType:'json',
            success:function(response){
               $('#subject_id').find('option').not(':first').remove();
               $.each(response['subject'], (key, item)=>{
                $('#subject_id').append(`<option value="${item.subject_id}">${item.subject.name}</option>`)
               })
            }
        })
    })
</script>
@endsection