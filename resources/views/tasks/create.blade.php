<!-- create.blade.php -->
<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        /* height: 100vh; */
    }

    .form-wrapper {
        width: 400px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
    }

    .form-wrapper h1 {
        text-align: center;
    }

    .form-wrapper label {
        display: block;
        margin-bottom: 10px;
    }

    .form-wrapper input[type="text"],
    .form-wrapper input[type="number"],
    .form-wrapper select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    .form-wrapper button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    .back-button {
        background-color: #fac;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        float: right;
    }
</style>

<div class="container">
    <div class="form-wrapper">
        <a href="{{ route('tasks.index') }}" class="back-button">Back</a>
        <h1>Create Task</h1>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div>
                <label for="name">Task Name</label>
                <input type="text" name="name" id="name">
                @error('name')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="priority">Priority</label>
                <input type="number" name="priority" id="priority">
                @error('priority')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="project_id">Project</label>
                <select name="project_id" id="project_id">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                @error('project_id')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</div>