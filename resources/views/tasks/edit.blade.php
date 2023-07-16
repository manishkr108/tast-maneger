<!-- create.blade.php -->
<!DOCTYPE html>
<html>

<head>
  <title>Create Task</title>
  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
    }


    h1 {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 30px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background-color: #fff;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-size: 14px;
    }

    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    button[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      width: 100%;
    }

    .error {
      color: #dc3545;
      font-size: 14px;
      margin-top: 5px;
    }

    .success {
      color: #28a745;
      font-size: 14px;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="form-wrapper">
    <h1>Edit Task</h1>
    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
      @csrf
      @method('PUT')
      <div>
        <label for="name">Task Name</label>
        <input type="text" name="name" id="name" value="{{ $task->name }}">
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
      </div>
      <div>
        <label for="priority">Priority</label>
        <input type="number" name="priority" id="priority" value="{{ $task->priority }}">
        @error('priority')
        <div class="error">{{ $message }}</div>
        @enderror
      </div>
      <div>
        <label for="project_id">Project</label>
        <select name="project_id" id="project_id">
          <option value="">Select Project</option>
          @foreach($projects as $project)
          <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
          @endforeach
        </select>
        @error('project_id')
        <div class="error">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit">Save</button>
    </form>
    @if(session('success'))
    <div class="success">{{ session('success') }}</div>
    @endif
  </div>
</body>

</html>