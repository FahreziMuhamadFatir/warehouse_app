<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE - Edit User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e5e5e5;
            overflow: hidden; /* menghindari double scroll */
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left-panel {
            width: 40%;
            background-color: #6d6b7c;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-panel img {
            width: 95%;
            height: 95%;
            object-fit: cover;
        }

        .right-panel {
            flex: 1;
            background-color: #f0f0f3;
            overflow-y: auto;
            padding: 60px;
        }

        .form-container {
            background-color: #f0f0f3;
            border-radius: 25px;
            max-width: 600px;
            margin: auto;
            padding: 40px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #1f1f50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .error {
            background-color: #ffdddd;
            color: red;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .success {
            background-color: #ddffdd;
            color: green;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        a.back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #1f1f50;
            text-decoration: none;
            font-weight: bold;
        }

        img.preview {
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Panel Kiri (Statis) -->
        <div class="left-panel">
            <img src="{{ asset('uploads/foto.jpg') }}" alt="Illustration">
        </div>

        <!-- Panel Kanan (Scroll jika konten panjang) -->
        <div class="right-panel">
            <div class="form-container">
                <h1>Edit User</h1>

                @if ($errors->any())
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label>Nama:</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

                    <label>Fullname:</label>
                    <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>

                    <label>Email:</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

                    <label>Usertype:</label>
                    <select name="usertype" required>
                        <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staff" {{ $user->usertype == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="manager" {{ $user->usertype == 'manager' ? 'selected' : '' }}>Manager</option>
                    </select>

                    <label>Foto:</label>
                    @if ($user->photo)
                        <img src="{{ asset('uploads/user/' . $user->photo) }}" width="100" class="preview"><br>
                    @endif
                    <input type="file" name="photo">

                    <button type="submit">Update</button>
                </form>

                <a href="{{ route('users.index') }}" class="back-link">← Kembali ke Data User</a>
            </div>
        </div>
    </div>
</body>
</html>
