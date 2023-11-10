@extends('app')
@section('content')
<div class="container w-25 border p-4 my-4">
    <div class='row mx-auto'>
        <form action="{{ route('categories.update',['category'=>$category->id]) }}" method="POST">
            @method('PUT')
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
              <input type="text" class="form-control" id="category" name="category"
               placeholder="Category of the task" value="{{ $task->category->category }}">
            </div>
            <div class="mb-3">
              <label for="color" class="form-label">color</label>
              <input type="color" class="form-control" id="color" name="color" placeholder="Color of the task">
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
          </form>
          <div>
            @if ($category->tasks->count()>0)
            <div class="row py-1">
                <div class="col-md-9 d-flex align-items-center">
                    <a  href="{{ route('tasks-edit',[$task->id])}}">{{ $task->title }}
                    </a>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <form action="{{ route('task-destroy',[$task->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>

                <hr>
            </div>
                @else
                No tasks
            @endif
          </div>
    </div>
</div>

@endsection
