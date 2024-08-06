<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/create" method="post">
        @csrf
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" id=""></td>
            </tr>
            <tr>
                <td>Is Publish</td>
                <td>
                    <select name="is_publish" id="">
                        <option value="">Status</option>
                        <option value="0">Not Publish</option>
                        <option value="1">Publish</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Create"></td>
            </tr>
        </table>
    </form>
</body>
</html>