@extends('app')
@section('content')
    <div class="container w-25 border p-4 my-4" style="background-color:white">
        <div class='row mx-auto'>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                @if (session('success'))
                    <h5 class="alert alert-success" id="success">{{ session('success') }}</h5>
                    <script>
                        setTimeout(function () {
                            document.querySelector('#success').style.display = 'none';
                        }, 3000);
                    </script>
                @endif
                @error('category')
                <h5 class="alert alert-danger">{{ $message }}</h5>
                @enderror
                <div class="mb-3">
                    @php
                        $title = 'Task Project';
                    @endphp
                  <label for="category" class="form-label">Category</label>
                  <input type="text" class="form-control" id="category" name="category" placeholder="Category of the task">
                </div>
                <div class="mb-3">
                  <label for="color" class="form-label">color</label>
                  <input type="color" class="form-control" id="color" name="color" placeholder="Color of the task">
                </div>
                <button type="submit" class="btn btn-primary">Create Category</button>
              </form>
              <div>
                @foreach ( $categories as $category )
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a class="d-flex align-items-center gap-2" href="{{ route('categories.show',[$category->id])}}">
                            <hr>
                        <span class="color-container" style="background-color: {{ $category->color }}">{{ $category->category }}</span>
                        </a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                         <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $category->cate4gory }}">
                        Delete
                      </button>
                    </div>

                    <hr>
                </div>
                <!-- Modal -->
                    <div class="modal fade" id="modal-{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                           When u delete a category<strong>{{ $category->category }}</strong> Tasks will be deleted
                            Are u sure you want to delete it?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="POST" action="{{ route('categories.destroy',['category'=>$category->id])  }}">
                                @method('DELETE')
                                @csrf
                              <button type="submit" class="btn btn-danger">Delete</button>

                            </form>

                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
              </div>
        </div>
    </div>
@endsection
