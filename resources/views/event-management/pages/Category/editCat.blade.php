@extends('event-management.layout.app')

@section('page-content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Category</h6>

                    {{-- Success Message --}}
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Category Form -->
                    <form action="{{ route('updateCat', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" required onkeyup="updateSlug()" value="{{ old('category_name', $category->category_name) }}">
                        </div>
                       
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection