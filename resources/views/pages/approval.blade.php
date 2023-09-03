<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Not approved Yet</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/approval.css') }}">
</head>

<body>
        <div class="container">
            <div class="">
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">Account Needs approval</h1>
                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                Your Account is still Not approved
                            </h3>

                            <p>Once your account is approved you Can access the Dashboard</p>

                            <a href="{{ route('welcome') }}" class="link_404">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
