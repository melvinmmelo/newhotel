<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Printed</title>

<link rel="stylesheet" href="{{ asset('css/printedForm.css') }}">
</head>
<style>
    #subTb {
        width: 100%;
        border-collapse: collapse;
    }

    #subTb td {
        border: 1px solid black;
    }
    .mainTitle {
        font-family:'Times New Roman', Times, serif;
        font-size: 24px;
        font-weight: bold;
        color: coral;
    }
</style>
<body>
    <page size="legal">
    <img src="{{ asset('images/cthm.jpg') }}" width="100%">
    <table width="100%">
        <tr>
            <td width="5%"></td>
            <td width="10%"></td>
            <td width="15%"></td>
            <td width="10%"></td>
            <td width="15%"></td>
            <td width="5%"></td>
        </tr>

        <tr>
            <td colspan="6" align="center"><span class="mainTitle">Reservation Confirmation</span></td>
        </tr>


        {{-- main tr --}}
        <tr>
            <td>&nbsp;</td>
            <td colspan="4"> {{-- main tr --}}
                {{-- table in td --}}
                <table border="1" id="subTb">
                    <tr>
                        <td>To</td>
                        <td>{{ $reservation->account->account_name }}</td>
                        <td>From</td>
                        <td>{{ $reservation->account->account_name }}</td>
                    </tr>

                    <tr>
                        <td>Company</td>
                        <td></td>
                        <td>Hotel</td>
                        <td>UB Hotel</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>{{ $reservation->account->email }}</td>
                        <td>Tel</td>
                        <td>{{ $reservation->account->telephone }}</td>
                    </tr>

                    <tr>
                        <td>Tel</td>
                        <td>{{ $reservation->account->telephone }}</td>
                        <td>Fax</td>
                        <td>{{ $reservation->account->fax }}</td>
                    </tr>

                    <tr>
                        <td>Fax</td>
                        <td>{{ $reservation->account->fax }}</td>
                        <td>Email</td>
                        <td>{{ $reservation->account->email }}</td>
                    </tr>

                    <tr>
                        <td>Date</td>
                        <td>{{ $reservation->created_at->format('jS \of F Y h:i A') }}</td>
                        <td>Pages</td>
                        <td>1</td>
                    </tr>


                </table> {{-- end table in td --}}
            </td> {{-- end main td --}}
            <td>&nbsp;</td>
        </tr> {{-- end main tr --}}

        <tr>
            <td></td>
            <td colspan="5">Thank you for choosing UB Hotel. We are pleased to confirm your reservation with the following details:</td>
        </tr>

    </table>




    </page>
</body>
</html>
