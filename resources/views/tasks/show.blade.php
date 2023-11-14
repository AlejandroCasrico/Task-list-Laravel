
@extends('app')
@section('content')
    <div class="container w-25 border p-4 mt-5" style="background: white">
        <form action="{{ route('tasks-update', ['id' => $task->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @if (session('success'))
                <h5 class="bg-warning" id="warning-alert">{{ session('success') }}</h5>
                <script>
                    setTimeout(() => {
                        document.querySelector('bg-warning').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            @error('title')
            <h5 class="alert alert-danger">{{ $message }}</h5>
            @enderror
            <div class="mb-3">
              <label for="title" class="form-label">Task Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Name of the task" value="{{ $task->title }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>

    </div>
@endsection
