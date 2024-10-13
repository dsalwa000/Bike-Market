<!DOCTYPE html>
<html>
<head>
    <title>Bike {{ $bike[0]->name }} Request</title>
    <style>
        html {
            font-family: "Inter", sans-serif;
        }

        .clean-link {
            color: black;
        }
        
        :root {
            --mail-distance: 12px;
            --max-width: 700px;
        }

        #mail {
            box-sizing: border-box;
            background-color: #fff5e5;
            padding: 15px;
        }

        .mail__link {
            width: 70%;
            margin: 0 0 var(--mail-distance) 0;
        }

        .mail__logo {
            max-width: 700px;
        }

        .mail__thank-you {
            text-align: center;
            margin: 0 0 var(--mail-distance) 0;
            font-size: 18px;
            font-weight: bold;
        }

        .mail__information {
            text-align: center;
            margin: 0 0 var(--mail-distance) 0;
            font-size: 24px;
            font-weight: bold;
        }

        .mail__table {
            min-width: 700px;
            max-width: 700px;
            margin-bottom: var(--mail-distance);
        }

        .mail__table th, .mail__table td{
            text-align: center;
            border: 1px black solid;
        }
    </style>
</head>

<body>
    <section id="mail">

        <table align="center">
            <td>
                <a class="mail__link" href="https://udamian.webd.pro/">
                    <img class="mail__logo center" src="https://udamian.webd.pro/images/logo.png">
                </a>
            </td>
        </table>

        @if($confirmationMail)
            <p class="mail__thank-you">Thank you for sending the form! This is a confirmation mail so don't response to that. Below you will find a content of your message.</p>

            <p class="mail__information">Your form's information: </p>
        @else
            <p class="mail__information">Client's information: </p>
        @endif

        <table align="center" class="mail__table">
            <tr>
                <th>The bike from the request</th>
                <td><a class="clean-link" href="https://udamian.webd.pro/showBike/{{ $bike[0]->id }}">{{ $bike[0]->name }} [LINK]</a></td>
            </tr>
            <tr>
                <th>Name and surname</th>
                <td>{{ $data['nameSurname'] }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $data['email'] }}</td>
            </tr>
            <tr>
                <th>Phone number</th>
                <td>{{ $data['phone'] }}</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>{{ $data['message'] }}</td>
            </tr>
        </table>
    </section>
</body>
</html>
