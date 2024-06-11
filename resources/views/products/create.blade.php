<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .c3 {
            vertical-align: top;
            width: 100%;
            height: 180px;
        }

        .image-preview {
            width: 100px;
            height: 100px;
            margin: 10px;
            overflow: hidden;
            position: relative;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
        }

        .delete-button {
            position: absolute;
            right: 0;
            background-color: #2e1a1a;
            color: white;
            border: none;
            width: 20px;
            height: 20px;
            font-size: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Products</a>
        </div>
    </nav>
    <!-- Insert form  -->
    <div class="container">
        <div class="row justify-content-center">
            <div id="drop-container" class="col-sm-8">
                <div class="card mt-5 p-3">
                    <form action="/products/store" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="mb-2">Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" />
                        </div>
                        @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name')}}</span>
                        @endif
                        <div class="form-group mb-3">
                            <label class="mb-2">Description</label>
                            <textarea name="description" rows="3" class="form-control">{{old('description')}}</textarea>
                        </div>
                        @if($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description')}}</span>
                        @endif
                        <div class="form-group mb-3">
                            <label class="mb-2">Image</label>
                            <input type="file" id="file-input" name="image" class="form-control" />
                            @if($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image')}}</span>
                            @endif
                            <div class="c3">
                               <h3>Image Preview</h3>
                                <div id="image-preview"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark">INSERT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dropContainer = document.getElementById('drop-container');
        const imagePreview = document.getElementById('image-preview');

        dropContainer.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropContainer.style.borderColor = '#2196F3';
        });

        dropContainer.addEventListener('dragleave', () => {
            dropContainer.style.borderColor = '#ccc';
        });

        dropContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            dropContainer.style.borderColor = '#ccc';

            for (const file of e.dataTransfer.files) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'c3';

                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.alt = 'Image Preview';

                        const deleteButton = document.createElement('button');
                        deleteButton.className = 'delete-button';
                        deleteButton.innerHTML = '&#10006;';
                        deleteButton.addEventListener('click', () => {
                            imgContainer.remove();

                        });

                        imgContainer.appendChild(imgElement);
                        imgContainer.appendChild(deleteButton);
                        imagePreview.appendChild(imgContainer);
                    };

                    reader.readAsDataURL(file);
                }
            }
        });

        document.getElementById('file-input').addEventListener('change', () => {
            // Clear the previous images
            while (imagePreview.firstChild) {
                imagePreview.removeChild(imagePreview.firstChild);
            }

            for (const file of document.getElementById('file-input').files) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'image-preview';

                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.alt = 'Image Preview';

                        const deleteButton = document.createElement('button');
                        deleteButton.className = 'delete-button';
                        deleteButton.innerHTML = '&#10006;';
                        deleteButton.addEventListener('click', () => {
                            imgContainer.remove();
                            document.getElementById('file-input').value = '';
                        });

                        imgContainer.appendChild(imgElement);
                        imgContainer.appendChild(deleteButton);
                        imagePreview.appendChild(imgContainer);
                    };

                    reader.readAsDataURL(file);
                }
            }
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>