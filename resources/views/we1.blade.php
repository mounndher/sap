<!DOCTYPE html>
<html>
<head>
    <title>Materials List</title>
</head>
<body>

    <h2>Search Materials</h2>

    <form method="GET" action="{{ route('show.materials') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search material..." />
        <button type="submit">Search</button>
    </form>

    @if(isset($error))
    <p style="color: red;">{{ $error }}</p>
    @elseif(count($materialsData) > 0)
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Mandt</th>
                <th>Matnr (Material Number)</th>
                <th>Maktx (Description)</th>
                <th>Maktg (Technical Description)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materialsData['d']['results'] as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
        
                <td>{{ $item['Matnr'] ?? '' }}</td>
                <td>{{ $item['Maktx'] ?? '' }}</td>
                <td>{{ $item['Maktg'] ?? '' }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
    @else
    <p>No materials found.</p>
    @endif

</body>
</html>
