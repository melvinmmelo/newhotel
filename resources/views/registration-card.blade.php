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
        border-top: 1px solid black;
        border-bottom: 1px solid black;
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
                <td colspan="2" align="center"><img src="{{ asset('images/ublogo2.jpg') }}" width="60%"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table id="subTb">
                        <tr>
                            <td width="70%"></td>
                            <td width="30%"><span style="color:red;">{{ $reservation->confirmation_id }}</span></td>
                        </tr>
                        <tr>
                            <td>NAME <br> {{ $reservation->account->title . " " . $reservation->account->account_name }}</td>
                            <td>ROOM NUMBER <br> {{ $reservation->room_no }}</td>
                        </tr>

                        <tr>
                            <td>Company / Travel Agency @if($reservation->company) {{ $reservation->company->name }} @endif @if($reservation->travelAgent) {{ $reservation->travelAgent->account_name }} @endif</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>NATIONALITY <br> {{ $reservation->account->citizenship }}</td>
                            <td>ARRIVAL DATE/TIME <br> {{ $reservation->arrival_date }}</td>
                        </tr>

                        <tr>
                            <td>ADDRESS <br> {{ $reservation->account->street . ", " . $reservation->account->address_city  }}</td>
                            <td>DEPARTURE DATE/TIME <br> {{ $reservation->arrival_date }}</td>
                        </tr>

                        <tr>
                            <td>EMAIL ADDRESS <br> {{ $reservation->account->email }}</td>
                            <td>ROOM CATEGORY <br> {{ $reservation->room_category_code }}</td>
                        </tr>

                        <tr>
                            <td>TELEPHONE <br> {{ $reservation->account->telephone }}</td>
                            <td>ROOM RATE <br> {{ $reservation->rack_rate_code }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>NUMBER IN PARTY <br> {{ $reservation->adult_no }} Adult(s) | {{ $reservation->child_no }} Child</td>
                        </tr>

                        <tr>
                            <td><pre>PAYMENT WILL BE MADE EASY
<input type="checkbox" name="" id="" @if($reservation->payment_mode == 'Cash') checked @endif> CASH                                     <input type="checkbox" name="" id="" @if($reservation->payment_mode == 'Cheque') checked @endif> CHEQUE
<input type="checkbox" name="" id="" @if($reservation->payment_mode == 'Credit Card') checked @endif> CREDIT CARD                              <input type="checkbox" name="" id="" @if($reservation->payment_mode == 'Debit') checked @endif> DEBIT</pre></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><pre>CARD USED : {{ $reservation->cc_type }}
CARD NUMBER :  {{ substr($reservation->cc_no,-4) }}   </pre></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="2"><pre>
<strong><i>NOTICE TO GUEST : This property is privately owned and management reserves the right to refuse service
    to anyone and will not be responsible in injury to guest or for any loss of money, jewelry or
    valuables of any kind.
SAFE DEPOSIT BOX RULES & REGULATIONS
    1. The use of safety deposit box is restricted to the time of your stay with us.
    2. No duplicate key is kept by the hotel, therefore, in case of lost key, a new key
        will be ordered and there will be a charged of US$ 100.00
    3. In the event that the key is not returned to us on your departure, the contents
        of the box will be removed in the presence of the Resort Manager.</i></strong></pre><br><br>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Checked In : {{ $reservation->user->name }}
                            </td>
                            <td>GUEST SIGNATURE : {{ $reservation->account->account_name }}</td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>

    </page>
</body>
</html>
