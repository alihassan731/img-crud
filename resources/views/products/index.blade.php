<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".alert").fadeOut(2000);
        });
    </script>

    <!-- Link for Datatable -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Products</a>
        </div>
    </nav>

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <div class="container">
        <div class="container">
            <div style="text-align: right;">
                <a href="products/create" class="btn btn-dark mt-3">new product</a>
            </div>
            <h1>PRODUCT table</h1>
        </div>
        <div class="container">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <img src="products/{{ $product->image}}" class="rounded-circle" width="50px"
                                height="50px" />
                        </td>
                        <td>{{ $product->name}}</td>
                        <td>{{ $product->description}}</td>
                        <td>
                            <a href="products/{{ $product->id }}/edit" class="btn btn-success btn-sm">Edit</a>
                            <form action="products/{{ $product->id }}/delete" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Delete
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">DELETE Model</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure, You want to DELETE.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- <a href="products/{{ $product->id }}/delete" class="btn btn-danger btn-sm">Delete</a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- <div>
                
            </div> -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <Script>
        $('#example').DataTable({
                "ordering": false // Disable DataTables ordering
        });
    </Script>
</body>

</html>