<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2, h4 { text-align: center; margin: 0; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <h2>Sales Report</h2>
    <h4>
        Date Range: 
        {{ \Carbon\Carbon::parse($start_date)->format('M d, Y') }} -
        {{ \Carbon\Carbon::parse($end_date)->format('M d, Y') }}
    </h4>

    <table>
        <thead>
            <tr>
                <th>Item Type</th>
                <th>Item Name</th>
                <th>Quantity Sold</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($data as $row)
                @php $total += $row->subtotal; @endphp
                <tr>
                    <td>{{ $row->type_name }}</td>
                    <td>{{ $row->item_name }}</td>
                    <td>{{ $row->total_quantity }}</td>
                    <td class="right">₱{{ number_format($row->price, 2) }}</td>
                    <td class="right">₱{{ number_format($row->subtotal, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="right"><strong>Grand Total:</strong></td>
                <td class="right"><strong>₱{{ number_format($grandTotal, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
