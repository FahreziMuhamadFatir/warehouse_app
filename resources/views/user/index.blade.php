<!DOCTYPE html>
<html>
<head>
    <title>WAREHOUSE</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f3f9;
            margin: 0;
            padding: 40px;
        }

        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
            color: #444;
        }

        thead {
            background-color: #f9fbfd;
            border-bottom: 1px solid #ddd;
        }

        th {
            color: #666;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tbody tr:nth-child(even) {
            background-color: #f5f8fc;
        }

        img {
            border-radius: 50%;
            object-fit: cover;
        }

        /* Hapus warna default tombol */
        button {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
        }

        /* Tombol Edit */
        .btn-edit {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }

        /* Tombol Hapus */
        .btn-delete {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c62828;
        }

        p {
            color: green;
            font-weight: 600;
        }

        td:last-child {
            display: flex;
            gap: 8px;
            align-items: center;
        }
    </style>
</head>
<body>
    <h1>Form Add User</h1>
    <a href="{{ route('users.create') }}">Add User</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Usertype</th>
                <th>Foto</th>
                <th>Dibuat Pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->usertype }}</td>
                    <td>
                        @if ($user->photo && file_exists(public_path('uploads/user/' . $user->photo)))
                            <img src="{{ asset('uploads/user/' . $user->photo) }}" width="50" height="50" alt="Foto">
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <form action="{{ route('users.edit', $user->id) }}" method="GET" style="display:inline;">
                            <button type="submit" class="btn-edit">Edit</button>
                        </form>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Data pengguna belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
