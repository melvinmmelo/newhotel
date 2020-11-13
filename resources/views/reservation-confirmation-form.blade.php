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
    <div class="dont-print">
        <a href="#" onclick="window.print()">Print</a>
    </div>
    <page size="legal">


    <table width="100%">
        <tr>
            <td width="70%"><img src="{{ asset('images/cthm.jpg') }}" width="100%"></td>
            <td><img src="{{ asset('images/conf-header-img.png') }}" width="100%"></td>
        </tr>
    </table>

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
                        <td>{{ $reservation->account->title . " " . $reservation->account->account_name }}</td>
                        <td>From</td>
                        <td>{{ $reservation->user->name }}</td>
                    </tr>

                    <tr>
                        <td>Company</td>
                        <td>@if($reservation->company) {{ $reservation->company->name }} @endif</td>
                        <td>Hotel</td>
                        <td>UB Hotel</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>{{ $reservation->account->email }}</td>
                        <td>Tel</td>
                        <td>+971 4 211 8111</td>
                    </tr>

                    <tr>
                        <td>Tel</td>
                        <td>{{ $reservation->account->telephone }}</td>
                        <td>Fax</td>
                        <td>+971 4 211 8112</td>
                    </tr>

                    <tr>
                        <td>Fax</td>
                        <td>{{ $reservation->account->fax }}</td>
                        <td>Email</td>
                        <td>reservations.ubhotel@ub.edu.ph</td>
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
            <td colspan="6" align="center"><span class="mainTitle"></span></td>
        </tr>


        {{-- main tr --}}
        <tr>
            <td>&nbsp;</td>
            <td colspan="4"> {{-- main tr --}}
                {{-- table in td --}}
                <table border="1" id="subTb">
                    <tr>
                        <td>Guest Name</td>
                        <td>{{ $reservation->account->title . " " . $reservation->account->account_name }}</td>
                        <td>Confirmation No</td>
                        <td>( {{ $reservation->confirmation_id }} )</td>
                    </tr>

                    <tr>
                        <td>Arrival Date</td>
                        <td>{{ $reservation->arrival_date }}</td>
                        <td>Adults/Child</td>
                        <td>{{ $reservation->adult_no . " / " .  $reservation->child_no }}</td>
                    </tr>

                    <tr>
                        <td>Departure Date</td>
                        <td>{{ $reservation->departure_date }}</td>
                        <td>Payment Method</td>
                        <td>{{ $reservation->payment_mode }}</td>
                    </tr>

                    <tr>
                        <td>No. of Nights</td>
                        <td>{{ $reservation->nights }}</td>
                        <td>Average Daily Rate</td>
                        <td>{{ $reservation->total_amount }}</td>
                    </tr>

                    <tr>
                        <td>Room Category</td>
                        <td>{{ $reservation->room_category_code }}</td>
                        <td></td>
                        <td></td>
                    </tr>


                </table> {{-- end table in td --}}
            </td> {{-- end main td --}}
            <td>&nbsp;</td>
        </tr> {{-- end main tr --}}

        <tr>
            <td></td>
            <td colspan="5">Thank you for choosing UB Hotel. We are pleased to confirm your reservation with the following details:</td>
        </tr>

        <tr>
            <td></td>
            <td colspan="4"><br><strong>Hotel check-in time begins from 14:00 and check-out time is 12 noon. We kindly request you to reconfirm your check-out date and time at the reception upon check in for accurate booking.</strong>

                <br><br><strong>Late Check-out Policy:</strong> Additional 50% charge of room rate will apply up to 18:00 Hrs. and one full night charges will apply after 18:00 Hrs.
                <br><br>
                <strong>RESERVATION AMENDMENTS</strong><br>

                All Changes to your reservation are subject to availability at the time of change and may result in a possible rate change.
                <br><br>
                <strong>Special Request:</strong> All special requests are subject to availability upon check-in.
                <br><br>
                <strong>Deposit upon arrival:</strong> Deposit in Cash or Credit Card is required upon check-in for room and incidental charges.
                <br><br>
                <strong>CANCELLATION & NO-SHOW POLICY</strong>
                <br>
                All non-guaranteed reservations will be released 48 hours prior to the date of arrival. Guaranteed reservations will be held until midnight on the day of arrival and in case of non-arrival; otherwise this will result in one-night accommodation charge as a late cancellation fee. All guaranteed reservations must be cancelled 48 hours prior to the day of arrival; otherwise this will result in one-night accommodation charge as a late cancellation fee. If this is non-guaranteed reservation, kindly fill the below section with your credit card details and return this form by email to reservations.ubhotel@ub.edu.ph.
                <br><br>
                We, at UB Hotel, look forward to welcome you and your esteemed guests.

                <br><br>
                Best regards,<br>

                <strong>Reservations Department</strong></td>
            <td></td>


            </td>
        </tr>

    </table>

    </page>
</body>
</html>
