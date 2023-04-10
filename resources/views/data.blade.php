<!doctype html>
<html lang="en">

<head>
    <title>Interview Kerja</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('landing') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Download Data
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('export-pdf') }}">Cetak PDF</a>
                    <a class="dropdown-item" href="{{ route('export.excel') }}">Cetak Excel</a>
                </div>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                @csrf
                <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search By Name"
                    aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a href="{{ route('data') }}"><button class="btn btn-outline-dark my-2 my-sm-0"
                    type="submit">Refresh</button></a>

        </div>
    </nav>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Your Email</th>
                                    <th>Age</th>
                                    <th>Phone Number</th>
                                    <th>Last Education</th>
                                    <th>Education Name</th>
                                    <th>CV</th>
                                    <th>Status</th>
                                    <th>Schedule</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($interviews as $interview)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $interview['name'] }}</td>
                                        <td>{{ $interview['email'] }}</td>
                                        <td>{{ $interview['age'] }}</td>
                                        @php
                                            //
                                            $telp = substr_replace($interview['phone'], '62', 0, 1);
                                            
                                        @endphp

                                        @php
                                            if ($interview['response']) {
                                                if ($interview['response']['status'] == 'diterima') {
                                                    $pesanWA = 'Hallo' . $interview->name . '! Interview anda  ' . $interview->response['status'] . ' silahkan untuk mengunjungi perusahaan kami untuk melakukan interview di tanggal :' . $interview['response']['schedule'];
                                                } 
                                                elseif ($interview['response']['status'] == 'ditolak') {
                                                $pesanWA = 'Hallo' . $interview->name . '! Interview anda  ' . $interview->response['status'] . 'Silahkan untuk mengisi sesuatu dengan persyaratan yg berlaku!';
                                                }
                                            }
                                            else {
                                                $pesanWA = 'Belum ada data response!';
                                            }
                                        @endphp
                                        <td><a href="https://wa.me/{{ $telp }}?text={{ $pesanWA }} "
                                                target="_blank">{{ $telp }}</a></td>
                                        <td>{{ $interview['lased'] }}</td>
                                        <td>{{ $interview['education'] }}</td>
                                        <td>
                                            <a href="../assets/image/{{ $interview->img }}" target="_blank">Lihat
                                                CV</a>
                                        </td>
                                        <td>
                                            @if ($interview->response)
                                                {{ $interview->response['status'] }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($interview->response)
                                            {{ $interview->response['status'] == 'diterima' ? \Carbon\Carbon::parse($interview->response['schedule'])->format('j F Y') : '-' }}
                                        @else
                                            -
                                        @endif
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>
