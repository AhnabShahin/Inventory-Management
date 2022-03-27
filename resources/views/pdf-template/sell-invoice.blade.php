<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        .company-details {
            text-align: right;
        }
        .company-details > h1,
        .company-details >  p {
            margin-top: 0;
            margin-bottom: 0px;
        }

        .full-width {
            width: 100%;
        }
    </style>
    <div class="company-details">
        <h1>Invoice</h1>
        <p>455 Foggy Heights, AZ 85004, US</p>
        <p>(123) 456-789</p>
        <p>company@example.com</p>
    </div>

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
    <table border="0" cellspacing="0" cellpadding="0" class="full-width">
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

</html>