<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="card-body">
            <a href="#" class="btn btn-primary mb-3">Students</a>
            <br>
            <a href="#" class="btn btn-primary active mb-3">Student groups</a>
            <br>
            <a href="{{ route('students.create') }}" class="btn btn-primary">New Student</a>
            <br>
            <a href="#" class="btn btn-primary mb-3">Edit</a>
        </div>

        @section('content')
            <div class="container">
                <h2>Student List</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Email</th>
                        <th>Place of birth</th>
                        <th>Date of birth</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->sex === 0 ? 'Male' : 'Female' }}</td>
                            <td>{{ $student->email_address }}</td>
                            <td>{{ $student->place_of_birth }}</td>
                            <td>{{ $student->date_of_birth }}</td>
                            <td>
                                <a href="{{ route('students.show',$student->id) }}" class="btn btn-primary">Edit Student</a>
                                <form action="{{ route('students.delete', $student->id) }}" method="post">
                                    @csrf
                                    {{method_field('DELETE')}}

                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                {{ $students->links() }}
            </div>

    </body>
</html>
