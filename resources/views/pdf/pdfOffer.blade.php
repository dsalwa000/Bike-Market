<!DOCTYPE html>
<html>
<head>
    <title>WHOLE OFFER</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!--font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #fff5e5; 
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 0.75rem;
        }

        .containerPage {
            width: 90%;
            margin: 70px auto 0 auto;
        }

        .picturePurpose {
            width: 160px;
            height: 160px;
        }

        .logoTop {
            width: 300px;
        }

        .singleBikePicture {
            margin-top: 25px;
            width: 250px;
            height: 250px;
        }

        .page-break{
            page-break-after: always;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}

        .link{
            text-decoration: none;
            color: black;
        }

    </style>
</head>

<body>
@php
    $bikeTable = [];
    $bikeCounter = 0;
@endphp

@foreach($purpose as $p)
    @if ($p->value == 'All')
        @continue
    @endif

    @foreach($bikes as $bike)
        @if ($p->id == $bike->purposes)
            @php
                foreach ($images as $image) {
                    if ($image->bike == $bike->id) {
                        $bikeTable[] = [$bike, $image];
                        $bikeCounter++;
                        break;
                    }
                }
            @endphp
        @endif
    @endforeach
    @php
        if ($bikeCounter == 0){
            break;
        }
    @endphp

    <div class="containerPage">
        <img class="logoTop" src='http://udamian.webd.pro/images/logo.png'>

        <h3>BIKE PURPOSE: {{ $p->value }}</h3>
        <table>
            <tr>
                <td>Picture</td>
                <td>Bike name</td>
                <td>Link</td>
            </tr>
            @foreach($bikeTable as $bike)
                <tr>
                    <td><img class="picturePurpose" src="http://udamian.webd.pro/images/{{ $bike[1]->image }}"></td>
                    <td>{{ $bike[0]->name }}</td>
                    <td><a href="https://udamian.webd.pro/showBike/{{ $bike[0]->id }}">https://udamian.webd.pro/showBike/{{ $bike[0]->id }}</a></td>
                </tr>
            @endforeach
        </table>

        @php
            $bikecounter = 0;
            $bikeTable = [];
        @endphp
    </div>

    <div class="page-break"></div>
@endforeach

@php
    $bikeList = [];

    foreach ($bikes as $bike) {
        $bikeParameters = [
            'image' => 'none',
            'name' => $bike->name,
            'price' => $bike->price,
            'year' => $bike->year,
            'Localisation' => 'none',
            'Producent' => 'none',
            'Purpose' => 'none',
            'Condition' => 'none'
        ];

        foreach ($images as $image) {
            if ($image->bike == $bike->id) {
                $bikeParameters['image'] = $image->image;
                break;
            }
        }

        foreach ($localisation as $e) {
            if ($e->id == $bike->localisation) {
                $bikeParameters['localisation'] = $e->value;
                break;
            }
        }

        foreach ($producent as $e) {
            if ($e->id == $bike->producent) {
                $bikeParameters['producent'] = $e->value;
                break;
            }
        }

        foreach ($purpose as $e) {
            if ($e->id == $bike->purposes) {
                $bikeParameters['purpose'] = $e->value;
                break;
            }
        }

        foreach ($condition as $e) {
            if ($e->id == $bike->conditions) {
                $bikeParameters['condition'] = $e->value;
                break;
            }
        }

        $bikeList[] = $bikeParameters;
    }

@endphp

{{-- @foreach($bikeList as $bike)
    <div class="containerPage">
        <img class="logoTop" src="http://udamian.webd.pro/images/logo.png">
        <h1>{{ $bike['name'] }}</h1><br><br>
        <img class="singleBikePicture" src="http://udamian.webd.pro/images/{{ $bike['image'] }}">
        <table>
            @foreach($bike as $key => $value)
                @if ($key == 'image')
                    @continue
                @endif

                @if ($value != 'none')
                    <tr>
                        <td>{{ ucfirst($key) }}</td> 
                        <td>{{ $value }}</td> 
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    <div class="page-break"></div>
@endforeach --}}


</body>
</html>
