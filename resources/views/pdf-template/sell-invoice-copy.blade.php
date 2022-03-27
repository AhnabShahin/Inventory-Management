<!--Author      : @arboshiki-->
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<style>
    #invoice {
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
        border-bottom: 1px solid #3989c6
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
        color: #3989c6
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
        border-left: 6px solid #3989c6
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

    .invoice table td,
    .invoice table th {
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
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
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
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
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
            font-size: 11px !important;
            overflow: hidden !important
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
<div class="container">
    <div id="invoice">
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <div>

                    <head>
                        <div class="row">
                            <div class="col">
                            </div>
                            <div class="col company-details">
                                <h2 style="color:#3989c6;">
                                    Fair LifeStyle
                                </h2>
                                <div>455 Foggy Heights, AZ 85004, US</div>
                                <div>(123) 456-789</div>
                                <div>company@example.com</div>
                            </div>
                        </div>
                    </head>
                </div>
                <body>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">INVOICE TO:</div>
                            <h2 class="to">{{$sell_details->customer->first_name." ".$sell_details->customer->middle_name." ".$sell_details->customer->last_name}}</h2>
                            <div class="address">{{$sell_details->delivery_address}}</div>
                            <div class="email"><a href="mailto:john@example.com">{{$sell_details->customer->email}}</a></div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">{{$sell_details->sell_id}}</h1>
                            <div class="date">
                                @php
                                date_default_timezone_set("Asia/Dhaka");
                                echo date("F j, Y, g:i A")
                                @endphp
                            </div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">ITEMS</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sell_details->orders as $index=>$order)
                            <tr>
                                <td class="no">{{$index+1}}</td>
                                <td class="text-left">
                                    <h3>
                                        {{$order->product->title}}
                                    </h3>
                                    <p><span>Color : </span>{{$order->color}} <span>Size : </span>{{$order->size}}</p>
                                </td>
                                <td class="unit">{{$order->quantity}}</td>
                                <td class="qty">{{$order->unit_selling_price}}</td>
                                <td class="total">{{$order->total_selling_price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">SUBTOTAL</td>
                                <td>{{$sell_details->sell_price_before_discount}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Discount</td>
                                <td>{{$sell_details->discount}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">GRAND TOTAL</td>
                                <td>{{$sell_details->sell_price_after_discount}}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="thanks">Thank you!</div>
                </body>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
</div>

</html>