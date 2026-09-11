<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotización {{ $quotation->folio }}</title>
    <style>
        @page { margin: 30px 40px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; }

        /* Encabezado */
        .header { text-align: center; margin-bottom: 24px; }
        .header .brand {
            font-size: 22px;
            font-weight: bold;
            color: #b8860b;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }
        .header .subtitle {
            font-size: 11px;
            color: #888;
            margin-bottom: 16px;
        }
        .header .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .header .info-table td {
            font-size: 10px;
            color: #555;
            padding: 2px 0;
            text-align: left;
            vertical-align: top;
        }
        .header .info-table .right { text-align: right; }

        /* Título */
        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #b8860b;
            letter-spacing: 4px;
            margin: 20px 0;
            padding: 8px 0;
            border-top: 1px solid #e5e5e5;
            border-bottom: 1px solid #e5e5e5;
        }

        /* Tabla de items */
        .items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .items thead th {
            background-color: #f5f0e6;
            color: #8b6914;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 10px;
            border: 1px solid #e5dcc8;
        }
        .items tbody td {
            padding: 8px 10px;
            border: 1px solid #eee;
            font-size: 11px;
        }
        .items tbody tr:nth-child(even) { background-color: #fafafa; }
        .items .center { text-align: center; }
        .items .right { text-align: right; }

        /* Totales */
        .totals {
            width: 260px;
            margin-left: auto;
            border-collapse: collapse;
        }
        .totals td {
            padding: 6px 12px;
            font-size: 11px;
        }
        .totals .label { text-align: right; color: #666; }
        .totals .value { text-align: right; font-weight: bold; }
        .totals .grand-total {
            background-color: #f5f0e6;
            color: #8b6914;
            font-size: 13px;
            font-weight: bold;
            border-top: 2px solid #b8860b;
        }

        /* Pie */
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 9px;
            color: #999;
        }
    </style>
</head>
<body>
    {{-- Encabezado --}}
    <div class="header">
        <div class="brand">"EVENTOS ESPECIALES LERMA"</div>
        <div class="subtitle">Organización Profesional de Eventos</div>
        <table class="info-table">
            <tr>
                <td>
                    <strong>COTIZACIÓN PARA:</strong> {{ $quotation->client_name }}<br>
                    <strong>ELABORÓ:</strong> Eventos Especiales Lerma
                </td>
                <td class="right">
                    Tel. 728-284-9074<br>
                    Cel. 729-373 88-30<br>
                    eventosespecialeslerma.com<br>
                    <strong>Fecha:</strong> {{ $quotation->quotation_date->format('d/m/Y') }}<br>
                    <strong>Folio:</strong> {{ $quotation->folio }}
                </td>
            </tr>
        </table>
    </div>

    {{-- Título --}}
    <div class="title">C O T I Z A C I Ó N</div>

    {{-- Tabla de items --}}
    <table class="items">
        <thead>
            <tr>
                <th style="width: 55%;">Descripción</th>
                <th style="width: 10%;" class="center">Cant.</th>
                <th style="width: 17%;" class="right">P. Unitario</th>
                <th style="width: 18%;" class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotation->items as $item)
                <tr>
                    <td>{{ $item['descripcion'] }}</td>
                    <td class="center">{{ $item['cantidad'] }}</td>
                    <td class="right">${{ number_format($item['precio_unitario'], 2) }}</td>
                    <td class="right">${{ number_format($item['total'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totales --}}
    <table class="totals">
        <tr>
            <td class="label">Subtotal:</td>
            <td class="value">${{ number_format($quotation->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td class="label">IVA (0%):</td>
            <td class="value">${{ number_format($quotation->iva, 2) }}</td>
        </tr>
        <tr class="grand-total">
            <td class="label">TOTAL:</td>
            <td class="value">${{ number_format($quotation->total, 2) }}</td>
        </tr>
    </table>

    <div class="footer">
        Gracias por su preferencia · Eventos Especiales Lerma · {{ now()->year }}
    </div>
</body>
</html>