<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge" /><!--<![endif]--><meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <style>
        #invoice{
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #5d69b3
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #5d69b3
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #5d69b3
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #5d69b3;
            font-size: 1.2em
        }

        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #5d69b3
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #5d69b3;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #5d69b3;
            font-size: 1.4em;
            border-top: 1px solid #5d69b3
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>
</head>
<body>
    <div id="invoice">
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <img style="width:200px;height:80px;" src="{{ asset("images/travellers-logo.png") }}" data-holder-rendered="true" />
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                Lisa Momoh
                            </h2>
                            Manager
                            <div>216 Jacobson Avenue</div>
                            <div>(123) 456-789</div>
                            <div class="email">
                                <a href="mailto:john@example.com">travellers@gmail.com</a>
                            </div>
                        </div>

                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">INVOICE TO:</div>
                            <h2 class="to">{{$client->first_name }} {{$client->last_name}}</h2>
                            <div class="email"><a href="mailto:john@example.com">{{$client->email}}</a></div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">Invoice - #{{$booking->id}} </h1>
                            <div class="date">{{$booking->created_at}}</div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Places Table --}}
                        @isset($booking->places)
                            <table>
                                <h2>Places</h2>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($booking->places); $i++)
                                    <tr>
                                        <td class="no">{{ $i+1 }}</td>
                                        <td class="text-left">
                                            <h3>{{$booking->places[$i]->name}}</h3>
                                            {{$booking->places[$i]->description}}
                                        </td>
                                        <td class="total">N{{$booking->places[$i]->price}}</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        @endisset


                        {{-- Festivals Table --}}
                        @isset($booking->festivals)
                            <table >
                                <h2>Festivals</h2>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($booking->festivals); $i++)
                                    <tr>
                                        <td class="no">{{ $i+1 }}</td>
                                        <td class="text-left">
                                            <h3>{{$booking->festivals[$i]->name}}</h3>
                                            {{$booking->festivals[$i]->description}}
                                        </td>
                                        <td class="total">N0</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        @endisset


                        {{-- Activities Table --}}
                        @isset($booking->activities)
                            <table >
                                <h2>Activites</h2>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($booking->activities); $i++)
                                    <tr>
                                        <td class="no">{{ $i+1 }}</td>
                                        <td class="text-left">
                                            <h3>{{$booking->activities[$i]->name}}</h3>
                                            {{$booking->activities[$i]->description}}
                                        </td>
                                        <td class="total">N0</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        @endisset

                        {{-- Table Footer --}}
                        <table>
                            <tfoot>
                                <tr>
                                    <td ></td>
                                    <td >SUBTOTAL</td>
                                    <td>{{
                                        $subtotal
                                    }}
                                    </td>
                                </tr>
                                <tr>
                                    <td ></td>
                                    <td >TAX 25%</td>
                                    <td>{{ $subtotal * 0.25 }}</td>
                                </tr>
                                <tr>
                                    <td ></td>
                                    <td >GRAND TOTAL</td>
                                    <td>{{ ($subtotal * 0.25)+$subtotal}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </main>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
</body>
</html>
