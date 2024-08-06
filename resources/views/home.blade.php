<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="/create">Tambah Data</a>
    <a href="/logout">Log Out</a>
    <form action="/search" method="post">
        @csrf
        <input type="search" name="cari" id="">
        <input type="submit" value="Cari">
    </form>
    <table border="1">
        <tr>
            <th>NO</th>
            <th>Name</th>
            <th>Is Publish</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
        @foreach ($categori as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->is_publish == 1 ? 'Publish':'Not Publish' }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                    <a href="/edit/{{ $item->id }}">edit</a>
                    <a href="/delete/{{ $item->id }}">delete</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>