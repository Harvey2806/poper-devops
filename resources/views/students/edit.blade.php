<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $student->name }}" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $student->email }}" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>