<!doctype html>
<html lang="en">

<head>
    <title>Interview Kerja</title>
    <meta charset="utf-8">
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
            </ul>
            <form class="form-inline my-2 my-lg-0">
                @csrf
                <select name="search" class="form-control mr-sm-2" type="text" placeholder="Search by name"
                    aria-label="Search" id="">
                    <option selected hidden disabled>Search By Status</option>
                    <option value="ditolak">ditolak</option>
                    <option value="diterima">diterima</option>
                    <!-- <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search by name" aria-label="Search"> -->
                </select>
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a href="{{ route('data.petugas') }}"><button class="btn btn-outline-dark my-2 my-sm-0"
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
                        @if (Session::get('responseSuccess'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('responseSuccess') }}
                            </div>
                        @endif
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
                                    $search = '';
                                    if (@$_GET['search']) {
                                        $search = $_GET['search'];
                                    }
                                @endphp

                                @foreach ($interviews as $interview)
                                    @if ($search !== '')
                                        @if ($interview->response)
                                            @if ($interview->response['status'] == $search)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $interview['name'] }}</td>
                                                    <td>{{ $interview['email'] }}</td>
                                                    <td>{{ $interview['age'] }}</td>
                                                    <td>{{ $interview['phone'] }}</td>
                                                    <td>{{ $interview['lased'] }}</td>
                                                    <td>{{ $interview['education'] }}</td>
                                                    <td>
                                                        <a href="../assets/image/{{ $interview->img }}"
                                                            target="_blank">Lihat CV</a>
                                                    </td>
                                                    <td>
                                                        @if ($interview->response)
                                                            {{ $interview->response['status'] }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($interview->response['status'] == 'diterima')
                                                            {{ \Carbon\Carbon::parse($interview->response['schedule'])->format('j F Y') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <a href="{{ route('response.edit', $interview->id) }}"><button
                                                                type="button" class="btn btn-success btn-sm">Send
                                                                Respon</button></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @else
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $interview['name'] }}</td>
                                            <td>{{ $interview['email'] }}</td>
                                            <td>{{ $interview['age'] }}</td> 
                                            <td>{{ $interview['phone'] }}</td> 
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

                                                <a href="{{ route('response.edit', $interview->id) }}"><button
                                                        type="button" class="btn btn-success btn-sm">Send
                                                        Respon</button></a>
                                            </td>
                                        </tr>
                                    @endif
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
