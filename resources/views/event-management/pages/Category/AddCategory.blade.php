@extends('admin.layout.app')

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
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" required onkeyup="updateSlug()">
                        </div>
                        <div class="mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                          <div class="mb-3">
                            <label class="form-label">SEO Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="title" onkeyup="updateSlug()">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">SEO Meta Description</label>
                            <input type="text" class="form-control" name="meta_description">
                        </div>

                        <div class="mb-3">
                            <label>canonical</label>
                            <input type="url" name="canonicals" id="canonicals" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Schema</label>
                            <input type="text" name="blog_schema" id="blog_schema" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function slugify(text) {
        return text
            .toString()
            .trim() // Trim leading and trailing whitespace first
            .replace(/^['"]+|['"]+$/g, "") // Trim quotes
            .replace(/,/g, '-') // Replace commas with hyphens
            .toLowerCase()
            .replace(/&/g, "and")
            .replace(/\s+/g, "-") // Replace spaces with hyphens
            .replace(/--+/g, "-") // Remove multiple hyphens
            .replace(/^-+/, "") // Remove leading hyphens
            .replace(/-+$/, ""); // Remove trailing hyphens
    }

    function updateSlug() {
        let categoryName = document.getElementById("category_name").value;
        let slugField = document.getElementById("slug");

        // If user hasn't manually changed the slug, auto-update it
        if (!slugField.dataset.edited) {
            slugField.value = slugify(categoryName);
        }
    }

    document.getElementById("slug").addEventListener("input", function() {
        // Mark slug field as manually edited when the user types in it
        this.dataset.edited = true;
    });
</script>
@endsection