<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>SAP Material Data</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background-color: #eee; }
        .error { color: red; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>

    <h1>SAP Material Data</h1>

    @if(isset($error))
        <div class="error">{{ $error }}</div>
    @elseif(empty($materialsData) || !isset($materialsData['d']['results']))
        <p>No material data found.</p>
    @else
        <table>
            <thead>
                <tr>
                     <th>#</th>

                    <th>Matnr (Material Number)</th>
                    <th>Maktx (Description)</th>
                    <th>Maktg (Technical Description)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materialsData['d']['results'] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item['Matnr'] }}</td>
                        <td>{{ $item['Maktx'] }}</td>
                        <td>{{ $item['Maktg'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>



<!DOCTYPE html>
<html>
<head>
    <title>Browser Selection</title>
</head>
<body>
    <form>
        <label for="browser">Choose a browser:</label>
        <input list="browsers" name="browser" id="browser">

        <datalist id="browsers">
            <option value="Chrome">
            <option value="Firefox">
            <option value="Safari">
            <option value="Edge">
            <option value="Opera">
        </datalist>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
