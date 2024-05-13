@extends('backend.layouts.master')
@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Edit Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Category</h5>

                        <!-- Vertical Form -->
                        <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}" placeholder="Name" readonly>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" placeholder="Email" readonly>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="email" class="form-label">Role</label>
                                <select id="" class="form-select" name="role">
                                    <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
                                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="NewsManager" {{ $user->role == 'NewsManager' ? 'selected' : '' }}>
                                        NewsManager</option>
                                    <option value="BlogManager" {{ $user->role == 'BlogManager' ? 'selected' : '' }}>
                                        BlogManager</option>
                                </select>
                            </div>



                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>

                        </form><!-- Vertical Form -->




                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('customjs')
@endsection
