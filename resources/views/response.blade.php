<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">
    <title>Interview Kerja</title>
</head>

<body>

    <form action="{{ route('response.update', $interviewId) }}" method="POST"
        style="width: 500px; margin: 50px auto; display: block;">
        @csrf
        @method('PATCH')
        <div class="input-card">
            <label for="status">Status :</label>
            @if ($interview)
                <select name="status" id="status">
                    <option selected hidden disabled>Pilih Status:</option>
                    <option value="ditolak" {{ $interview['status'] == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                    <option value="diterima" {{ $interview['status'] == 'diterima' ? 'selected' : '' }}> diterima
                    </option>
                </select>
            @else
                <select name="status" id="status">
                    <option selected hidden disabled>Pilih Status:</option>
                    <option value="ditolak">ditolak</option>
                    <option value="diterima">diterima</option>
                </select>
            @endif
        </div>
        <div class="input-card">
            <label for="schedule">Schedule :</label>
            <input type="date" name="schedule" value="" id="schedule">
        </div>
        <button class="back-btn" type="submit">Send</button>
    </form>
</body>

</html>
