@extends('backend.layouts.master')
@section('main')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Edit News & Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit News & Blog</h5>

                        <!-- Vertical Form -->
                        <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="name" class="form-label">News Title</label>
                                <input type="text" class="form-control" id="name" name="title"
                                    value="{{ $news->title }}" oninput="generateSlug()" placeholder="Category Name">
                            </div>

                            <div class="col-12 mt-2">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug"name="slug"
                                    value="{{ $news->slug }}" placeholder="Slug">
                            </div>

                            <div class="col-12 mt-2">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author"
                                    value="{{ $news->author }}" placeholder="Author Name" readonly>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="ckeditor" cols="30" placeholder="Description Here...." rows="10" name="description">{!! $news->description  !!}</textarea>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="slug" class="form-label">Category</label>
                                <select id="inputState" class="form-select" name="category" value="{{ old('category') }}">
                                    <option value="" selected="">Choose...</option>
                                    @if ($categories->count() > 0)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id === $news->category? 'selected' : ''  }}>{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="slug" class="form-label">Image</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>

                        </form><!-- Vertical Form -->


                        <div class="all-images mt-5">
                            <div class="mt-3 position-relative pb-3" style="margin-top:30px;">
                                <label>Current Images:</label>
                                <div class="row">
                                    @if (!empty($news->image) && !is_null($news->image))
                                        <img src="{{ Storage::url($news->image->url . '/' . $news->image->saved_name) }}"
                                            style="height: 150px;width: 150px; border:1px solid #D9D9D9" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection

@section('customjs')
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
