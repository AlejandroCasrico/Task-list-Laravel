
@extends('app')
@section('content')
    <div class="container w-25 border p-4 mt-5" style="background: white">
        <form action="{{ route('tasks') }}" method="POST">
            @csrf
            @if (session('success'))
                <h5 class="alert alert-success" id="success">{{ session('success') }}</h5>
                <script>
                    setTimeout(function () {
                        document.querySelector('#success').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            @error('title')
            <h5 class="alert alert-danger">{{ $message }}</h5>
            @enderror
            <div class="mb-3">
                @php
                    $title = 'Task Name ';
                @endphp
              <label for="title" class="form-label">{{ $title }}</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Name of the task">
            </div>
                <label for="category_id" class="form-label">Task Category</label>
                <select name="category_id" class="form-select" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
                </select>
                <br>
            <button type="submit" class="btn btn-primary">Create Task</button>
          </form>
          <div>
            @foreach ( $tasks as $task )
                <div class="row py-1">

                          <li class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('tasks-edit',['id'=>$task->id])}}">{{ $task->title }}</a>
                    </li>


                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('tasks-destroy',['id'=>$task->id]) }}" method="POST">
                           @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm m-3" type="submit">Delete</button>
                        </form>

                    </div>
                    <hr>
                </div>
            @endforeach
          </div>
    </div>
@endsection
