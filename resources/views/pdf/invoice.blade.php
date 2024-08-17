<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>      
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .store-name {
            text-transform: uppercase;
            font-size: 2em;
            font-family: Calibri, sans-serif;
        }
    </style>
    <script>
        window.onload = function() {
            function calculateTotalAmount() {
                var table = document.getElementById("invoiceTable");
                var rows = table.getElementsByTagName("tr");
                var totalAmount = 0;
                for (var i = 2; i < rows.length - 4; i++) { // Adjusted range to exclude SGST and CGST rows
                    var cells = rows[i].getElementsByTagName("td");
                    var amountCell = cells[4];
                    if (amountCell) {
                        totalAmount += parseFloat(amountCell.textContent || amountCell.innerText);
                    }
                }
                var totalAmountElement = document.getElementById("totalAmount");
                if (totalAmountElement) {
                    totalAmountElement.textContent = totalAmount.toFixed(2);
                }
            }
            calculateTotalAmount();
        }
    </script>
</head>
<body>
    <table border="1" width="100%" align="center" id="invoiceTable">
        <tr>
            <th colspan="5">
                <div align="right">
                    Contact: +91 9944177142<br>+91 8248885192
                </div>
                <div class="store-name" align="center">
                    Small Shop Store
                </div>
                <div align="center">
                    Deals: We sell all types of stationery items (official, school, sports), gifts, games, etc.<br>
                    Address: Plot No 15, T.A.R Nagar, Bodi Chetty Street, Thirupapuliyur, Cuddalore-607002.
                </div>
                <br><br>
                <table border="0" width="100%">
                    <tr>
                        <td align="left">Bill No: {{ $order->order_number }}</td>
                        <td align="right">Date: {{ $order->order_date }}</td>
                    </tr>
                </table>
                <br><br>
                <div align="left">
                    M/S: {{ $order->customer->email }}
                </div>
                <br><br>
            </th>
        </tr>
        <tr height="60px">
            <th width="10%">S.No</th>
            <th width="40%">Item Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th width="20%">
                <div align="center">
                    <b>Amount</b>
                </div>
                <table border="0" width="100%">
                    <tr>
                        <td align="left">Rs.</td>
                        <td align="right">P</td>
                    </tr>
                </table>
            </th>
        </tr>
        @foreach ($order_items as $row)
        <tr height="5">
            <td>{{ $row->id }}</td>
            <td>{{ $row->product->name }}</td>
            <td>
                <span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span>
                {{ $row->product->price }}
            </td>
            <td>{{ $row->qty }}</td>
            <td>
                <span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span>
                {{ $row->qty * $row->product->price }}
            </td>
        </tr>
        @endforeach
        <tr height="5">
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th colspan="2">Subtotal</th>
            <th id="totalAmount">&nbsp;</th>
        </tr>
        <tr height="5">
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th colspan="2">SGST ({{ $order->sgst_percentage }}%)</th>
            <th>
                <span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span>
                {{ $order->calculaterSGST() }}
            </th>
        </tr>
        <tr height="5">
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th colspan="2">CGST ({{ $order->cgst_percentage }}%)</th>
            <th>
                <span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span>
                {{ $order->calculaterCGST() }}
            </th>
        </tr>
        <tr height="5">
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th colspan="2">Total Amount</th>
            <th>
                <span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span>
                {{ $order->total_amount_with_SGST_CGST() }}
            </th>
        </tr>
        <tr height="60px">
            <th colspan="5" align="right">
                <span style="font-size: 1em;">
                    {{ $order->getTotalAmountInWords() }} only <br>
                    {{ $order->convertTaxAmountInWords() }} only
                </span>
            </th>
        </tr>
        <tr height="60px">
            <th colspan="5" align="right">
                <span style="font-size: 1em;">
                    Small Shop Store<br>
                    Authorized Signature
                </span>
            </th>
        </tr>
        <!-- Example of displaying the UPI QR code -->
        <tr>
            <td colspan="5">
                <img src="data:image/png;base64,{{ base64_encode($upi_qr) }}" alt="UPI QR Code">
            </td>
        </tr>
    </table>
</body>
</html>