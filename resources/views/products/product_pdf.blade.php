<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; }
        img {
            width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
</head>
<body>

<h2>Product Details</h2>

{{-- Image --}}
@if(file_exists($image))
    <img src="{{ $image }}" alt="Product Image">
@endif

<table>
    <tr>
        <th>Name</th>
        <td>{{ $product->name }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $product->description }}</td>
    </tr>
    <tr>
        <th>Price</th>
        <td>{{ $product->price }}</td>
    </tr>
</table>

</body>
</html>
