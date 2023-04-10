<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Interview</title>
</head>

<body>
    <h2 style="text-align: cnenter; margin-bottom: 20px">Data Interview</h2>
    <table style="width: 100%">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Last Education</th>
            <th>Education Name</th>
            <th>Status</th>
            <th>Schedule</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($interviews as $interview)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $interview['name'] }}</td>
                <td>{{ $interview['email'] }}</td>
                <td>{{ $interview['age'] }}</td>
                <td>{{ $interview['phone'] }}</td>
                <td>{{ $interview['lased'] }}</td>
                <td>{{ $interview['education'] }}</td>
                <td>  
                    @if ($interview['response'])
                        {{ $interview['response']['status'] }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if ($interview['response'])
                        {{ $interview['response']['schedule'] }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
