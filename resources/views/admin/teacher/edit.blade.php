@extends('admin.layout')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Teacher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Teacher</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Teacher</h3>
                        </div>

                        <form action="{{ route('teacher.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $teacher->id }}">
                            <div class="card-body">
                                <div class="row" style="margin-top: 20px;">
                                    <div class="form-group col-md-4">
                                        <label>Teacher Name</label>
                                        <input type="text" name="teacher_name" class="form-control" placeholder="Enter Teacher Name" value="{{ $teacher->name }}">
                                        @error('teacher_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Teacher's Father Name</label>
                                        <input type="text" name="father_name" class="form-control" placeholder="Enter Father Name" value="{{ $teacher->father_name }}">
                                        @error('father_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Teacher's Mother Name</label>
                                        <input type="text" name="mother_name" class="form-control" placeholder="Enter Mother Name" value="{{ $teacher->mother_name }}">
                                        @error('mother_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" value="{{ $teacher->dob }}">
                                        @error('dob')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Phone Number</label>
                                        <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ $teacher->phone }}">
                                        @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ $teacher->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $teacher->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ $teacher->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ $teacher->email }}">
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Password (Leave blank to keep current)</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Teacher</button>
                                <a href="{{ route('teacher.read') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
