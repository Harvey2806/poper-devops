<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
</head>
<body>
    <h1>Students</h1>
    <a href="{{ route('students.create') }}">Add New Student</a>
    <ul>
        @foreach($students as $student)
            <li>{{ $student->name }} - {{ $student->email }}
                <a href="{{ route('students.edit', $student) }}">Edit</a>
                <form action="{{ route('students.destroy', $student) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>