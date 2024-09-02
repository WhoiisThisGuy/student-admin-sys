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
    <h1>Edit student</h1>
    <div class="col-md-6">
    <form method="POST" action="{{route("students.update",$student->id)}}">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group">
            <label for="name">Student name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{$student->name}}">
        </div>
        <div class="form-group">
                <input type="radio" id="male" name="sex" value="0">
                <label for="male">male</label><br>
                <input type="radio" id="female" name="sex" value="1">
                <label for="female">female</label><br>
        </div>
        <div class="form-group">
            <label for="place_of_birth">Place of birth</label>
            <input type="text" class="form-control" name="place_of_birth">
        </div>
        <div class="form-group">
            <label for="date_of_birth">Date of birth</label>
            <input type="date" class="form-control" name="date_of_birth">
        </div>
        <div class="form-group">
            <label for="email_address">Email</label>
            <input type="email" class="form-control" name="email_address">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    </body>
</html>
