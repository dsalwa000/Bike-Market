<!DOCTYPE html>
<html>
<head>
    <title>OFERTA</title>

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

        .bike {
            width: 90%;
            margin: 70px auto 0 auto;
        }

        .bike__logo {
            width: 400px;
        }

        .bike__image {
            margin-top: 24px;
            width: 250px;
            height: 250px;
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
        $bikeList = [];

        $bikeParameters = [
            'image' => 'none',
            'name' => $thisBike->name,
            'price' => $thisBike->price,
            'year' => $thisBike->year,
            'Localisation' => 'none',
            'Producent' => 'none',
            'Purpose' => 'none',
            'Condition' => 'none'
        ];

        foreach ($images as $image) {
            if ($image->bike == $thisBike->id) {
                $bikeParameters['image'] = $image->image;
                break;
            }
        }

        foreach ($localisation as $e) {
            if ($e->id == $thisBike->localisation) {
                $bikeParameters['localisation'] = $e->value;
                break;
            }
        }

        foreach ($producent as $e) {
            if ($e->id == $thisBike->producent) {
                $bikeParameters['producent'] = $e->value;
                break;
            }
        }

        foreach ($purpose as $e) {
            if ($e->id == $thisBike->purposes) {
                $bikeParameters['purpose'] = $e->value;
                break;
            }
        }

        foreach ($condition as $e) {
            if ($e->id == $thisBike->conditions) {
                $bikeParameters['condition'] = $e->value;
                break;
            }
        }

        $bikeList[] = $bikeParameters;

    @endphp

    @foreach($bikeList as $bike)
        <div class="bike">
            <img class="bike__logo" src="http://udamian.webd.pro/images/logo.png">
            <h1>{{ $bike['name'] }}</h1><br><br>
            <img class="bike__image" src="http://udamian.webd.pro/images/{{ $bike['image'] }}">
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
        <div class="bike__page-break"></div>
    @endforeach

</body>
</html>
