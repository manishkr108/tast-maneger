<!-- index.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Task Manager</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .create-task-btn {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }

        .table td {
            border-bottom: 1px solid #ddd;
        }

        .actions {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .actions a,
        .actions button {
            display: inline-block;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .actions a.edit {
            background-color: #2196F3;
            color: #fff;
        }

        .actions button.delete {
            background-color: #F44336;
            color: #fff;
        }

        .actions a.edit:hover,
        .actions button.delete:hover {
            background-color: #0D47A1;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }

        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .custom-pagination .pagination {
            margin: 0;
        }

        .custom-pagination .page-item {
            margin: 0 5px;
            list-style-type: none;
        }

        .custom-pagination .page-link {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #333;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-pagination .page-link:hover {
            background-color: #ddd;
        }

        .custom-pagination .page-item.disabled .page-link {
            opacity: 0.6;
            pointer-events: none;
        }

        .custom-pagination .page-item.active .page-link {
            background-color: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }

        /* Hide SVG arrow images */
        .custom-pagination .page-link svg {
            display: none;
        }

        .w-5 {
            display: none;
        }


        .alert-success {
            background-color: #4CAF50;
            color: #fff;
        }

        .alert-danger {
            background-color: #F44336;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
        @endif

        <h1 class="heading">Task Manager</h1>

        <div class="create-task-btn">
            <button class="btn btn-primary"><a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a></button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Priority</th>
                    <th>Project</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->project->name }}</td>
                    <td class="actions">
                        <div class="actions">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="edit">Edit</a>
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="custom-pagination">
            {{ $tasks->links() }}
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>