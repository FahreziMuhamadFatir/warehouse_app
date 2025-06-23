<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WAREHOUSE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e5e5e5;
            height: 100vh;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left-panel {
            flex: 1;
            background-color: #6d6b7c;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            overflow: hidden; /* agar tidak melebihi batas */
        }


        .left-panel img {
            width: 95%;
            height: 95%;
            object-fit: cover;
        }

        .right-panel {
            flex: 2;
            background-color: #f0f0f3;
            padding: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background-color: #f0f0f3;
            border-radius: 25px;
            width: 100%;
            max-width: 600px;
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
    </style>
</head>
<body>

<div class="container">
    <!-- Left Image Panel -->
    <div class="left-panel">
        <img src="{{ asset('uploads/foto.jpg') }}" alt="Illustration">
    </div>

    <!-- Right Form Panel -->
    <div class="right-panel">
        <div class="form-container">
            <h1>Add User</h1>

            @if($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>Username (name):</label>
                <input type="text" name="name" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Full Name:</label>
                <input type="text" name="fullname">

                <label>User Type:</label>
                <select name="usertype" required>
                    <option value="">-- Pilih --</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="manager">Manager</option>
                </select>

                <label>Photo:</label>
                <input type="file" name="photo" accept="image/*">

                <button type="submit">Simpan</button>
            </form>

            <a href="/" class="back-link">← Kembali</a>
        </div>
    </div>
</div>

</body>
</html>
