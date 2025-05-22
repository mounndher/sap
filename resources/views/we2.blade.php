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



                    <th>MeinsMeins </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materialsData['d']['results'] as $item)
                    <tr>


                        <td>{{ $item['Meins'] }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>


