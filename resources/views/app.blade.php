<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crud Basic</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>
<body>
<div class="container-fluid">
    <div class="row">
{{--        sidebar--}}
        <div class="col-3">
            <nav id="sidebar">
                <div class="p-4 pt-5">
                    <ul class="list-unstyled components mb-5">
                        <li>
                            <a href="/contacts/create" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Contact Creation</a>

                        </li>
                        <li>
                            <a href="/contacts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Contacts List</a>

                        </li>

                    </ul>

                </div>
            </nav>

        </div>

{{--        main content--}}
        <div class="col-9">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
