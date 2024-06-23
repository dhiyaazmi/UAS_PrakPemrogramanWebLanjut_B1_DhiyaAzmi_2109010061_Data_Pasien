<!-- resources/views/patients/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pasien</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Edit Pasien</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $patient->email) }}">
        <br>
        <label for="phone">No HP:</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}">
        <br>
        <label for="dob">Tanggal Lahir:</label>
        <input type="date" name="dob" id="dob" value="{{ old('dob', $patient->dob) }}">
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>