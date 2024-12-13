<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Humans</title>
    <style>
        <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #1C1C1E;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007BFF;
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #eaf5ff;
        }

        button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            opacity: 0.9;
        }

        button[type="submit"] {
            background-color: #dc3545;
            color: #fff;
        }

        button[type="submit"]:hover {
            background-color: #c82333;
        }

        button:not([type="submit"]) {
            background-color: #007BFF;
            color: #fff;
        }

        button:not([type="submit"]):hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <h1>List of Humans</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($humans as $human)
                <tr>
                    <td>{{ $human->id }}</td>
                    <td>{{ $human->name }}</td>
                    <td>{{ $human->email }}</td>
                    <td>{{ $human->age }}</td>
                    <td>
                        <button>Edit</button>
                        <button type="submit">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No humans found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>