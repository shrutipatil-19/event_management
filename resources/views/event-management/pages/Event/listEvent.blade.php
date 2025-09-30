@extends('event-management.layout.app')

@section('page-content')
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Event Table</li>
        </ol>
        <div>
            <a href="{{ route('createEvent') }}" class="btn btn-success">Add Event</a>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Event Table</h6>
                    <form method="GET" action="{{ route('listEvent') }}" class="mb-3">
                        <select name="filter" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Filter by Status --</option>
                            <option value="published" {{ request('filter') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="waiting" {{ request('filter') == 'waiting' ? 'selected' : '' }}>Draft / Waiting</option>
                            <option value="archived" {{ request('filter') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </form>


                    <!-- <p class="text-secondary mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>events Title</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ $event->user->name }}</td>
                                    <td>{{ $event->category->category_name }}</td>
                                    <td>

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection