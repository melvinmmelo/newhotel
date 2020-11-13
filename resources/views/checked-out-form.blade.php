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
    #cssName{
        font-weight: bold;
        text-decoration: underline;
    }
</style>
<body>
    <div class="dont-print">
        <a href="#" onclick="window.print()">Print</a>
    </div>
    <page size="legal">
        <table width="100%">
            <tr>
                <td><img src="{{ asset('images/checkedoutheader.png') }}" alt="header" width="100%"></td>
            </tr>

            <tr>
                <td align="center"><h2>Guest Folio</strong></td>
            </tr>

            <tr>
                <td align="center">
                    <table width="100%">
                        <tr>
                            <td width="70%">
                                <div id="cssName">{{ $reservation->account->account_name }}</div>
                                <div>{{ $reservation->account->address_street . ", " . $reservation->account->country . ", " . $reservation->account->country }}</div>

                                <br>
                                @if($reservation->company)
                                    {{ $reservation->company->name }}
                                @endif

                                @if($reservation->travelAgency)
                                    {{ $reservation->travelAgency->name }}
                                @endif


                            </td>
                            <td width="30%">
                                <div>Room No.: <strong>{{ $reservation->room_no }}</strong></div>
                                <div>Room Category: <strong>{{ $reservation->room_category_code }}</strong></div>
                                <div>Rate Type: <strong>{{ $reservation->rack_rate_code }}</strong></div>
                                <hr>
                                <div>Folio ID: <strong>{{ $reservation->confirmation_id }}</strong></div>
                                <div>Total Guests: <strong>{{ ($reservation->adult_no + $reservation->child_no) }}</strong></div>
                                <hr>
                                <div>Arrival: <strong>{{ $reservation->actual_arrival_date }}</strong></div>
                                <div>Departure: <strong>{{ $reservation->actual_departure_date }}</strong></div>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


        </table>

        <table class="tbStyle1">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>CODE</th>
                    <th>DESCRIPTION</th>
                    <th>REF #.</th>
                    <th>TRANSACTION AMOUNT</th>
                </tr>
            </thead>

            <tbody>
                @foreach($reservation->transactions as $gT)
                <tr>
                    <td align="center">{{ $gT->created_at  }}</td>
                    <td align="center">{{ $gT->transaction->code  }}</td>
                    <td>{{ $gT->transaction->memo }}</td>
                    <td align="center">{{ $gT->id  }}</td>
                    <td align="center">{{ $gT->amount  }}</td>
                    @php
                        if($gT->transaction->accounting_side == 'DEBIT'){
                            $debits[] = $gT->amount;
                        }else{
                            $credits[] = $gT->amount;
                        }
                    @endphp
                </tr>
                @endforeach

                @php
                    $totalDebit = array_sum($debits);
                    $totalCredit = array_sum($credits);
                @endphp
                <tr>
                    <td></td>
                    <td></td>
                    <td class="textItalic">Service Charge</td>
                    <td></td>
                    <td align="center">{{ ($sc = $totalDebit * .1) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="textItalic">VAT</td>
                    <td></td>
                    <td align="center">{{ $vat = ($totalDebit * .12) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="textItalic">Local Tax</td>
                    <td></td>
                    <td align="center">{{ $lt = ($totalDebit * .0075) }}</td>
                </tr>
                @php
                    $gross = number_format(($totalDebit + $sc + $vat + $lt),2,".","");
                    $net = $gross - $totalCredit;
                @endphp

                <tr>
                    <td></td>
                    <td></td>
                    <td class="textItalic">Gross</td>
                    <td></td>
                    <td class="cssAmount">{{ $gross }}</td>
                </tr>

                <tr>
                    <td colspan="5"> <strong> *** nothing follows *** </strong> <hr></td>
                </tr>



                <tr>
                    <td></td>
                    <td></td>
                    <td class="textItalic">Net</td>
                    <td></td>
                    <td class="cssAmount">{{ $net }}</td>
                </tr>
            </tbody>
        </table>

        <table class="fixedBot">
            <tr>
                <td align="center">{{ $reservation->user->name }}</td>
                <td></td>
                <td align="center">{{ $reservation->account->account_name }}</td>
            </tr>
            <tr>
                <td width="30%" class="tdStyle1">Prepared by</td>
                <td width="20%"></td>
                <td width="30%" class="tdStyle1">Signature of Guest</td>
            </tr>
        </table>
    </page>
</body>
</html>
