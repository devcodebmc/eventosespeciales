<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotización {{ $quotation->folio }}</title>
    <style>
        @page { margin: 0; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
            background: #fff;
        }

        /* ============================================
           BANNER SUPERIOR CON IMÁGENES (tu diseño)
           ============================================ */
        .banner {
            background: #fdf8f0;
            padding: 18px 25px 12px;
            text-align: center;
            position: relative;
        }
        .banner-title {
            font-size: 22px;
            font-weight: bold;
            color: #b8860b;
            letter-spacing: 1.5px;
            margin-bottom: 14px;
            font-family: 'Times New Roman', serif;
        }
        .banner-images {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }
        .banner-img-circle {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        }
        .banner-img-circle img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .banner-img-rect {
            width: 230px;
            height: 100px;
            border-radius: 6px;
            overflow: hidden;
            border: 2px solid #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        }
        .banner-img-rect img { width: 100%; height: 100%; object-fit: cover; display: block; }

        /* ============================================
           BARRA DE INFO (cliente + emisor)
           ============================================ */
        .info-bar {
            background: #fff;
            padding: 12px 25px 14px;
            border-top: 1px solid #f0e6d2;
            border-bottom: 1px solid #f0e6d2;
        }
        .info-bar table { width: 100%; border-collapse: collapse; }
        .info-bar td { vertical-align: top; font-size: 10px; color: #333; padding: 0; }
        .info-bar .right { text-align: right; }
        .info-label {
            font-size: 8px;
            color: #b8860b;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .info-name {
            font-size: 11px;
            font-weight: bold;
            color: #333;
            margin-bottom: 2px;
        }
        .info-detail { font-size: 9px; color: #666; line-height: 1.5; }

        /* ============================================
           TÍTULO CENTRAL
           ============================================ */
        .title-bar {
            text-align: center;
            padding: 18px 25px 12px;
        }
        .title-bar h1 {
            font-size: 17px;
            font-weight: bold;
            color: #b8860b;
            letter-spacing: 10px;
            font-family: 'Times New Roman', serif;
        }

        /* ============================================
           SECCIONES Y TABLA
           ============================================ */
        .content { padding: 0 25px 20px; }
        .section-header {
            background: #faf8f3;
            color: #8b6914;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 8px 12px;
            border-left: 3px solid #b8860b;
            margin-bottom: 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .items-table thead th {
            background: #faf8f3;
            color: #8b6914;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 8px 12px;
            border-bottom: 1px solid #e5dcc8;
            text-align: left;
        }
        .items-table thead th.center { text-align: center; }
        .items-table thead th.right { text-align: right; }
        .items-table tbody td {
            padding: 9px 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 10px;
            vertical-align: top;
            color: #333;
        }
        .items-table tbody tr:nth-child(even) td { background: #fcfcfa; }
        .items-table tbody td.center { text-align: center; }
        .items-table tbody td.right { text-align: right; font-weight: 500; }

        /* ============================================
           TOTALES
           ============================================ */
        .totals-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 12px;
        }
        .totals {
            width: 260px;
            border-collapse: collapse;
        }
        .totals td {
            padding: 7px 14px;
            font-size: 10px;
        }
        .totals .label { text-align: right; color: #666; }
        .totals .value { text-align: right; font-weight: bold; color: #333; }
        .totals .grand-total {
            background: #faf8f3;
            color: #8b6914;
            font-size: 13px;
            font-weight: bold;
            border-top: 2px solid #b8860b;
            border-bottom: 2px solid #b8860b;
            padding: 10px 14px;
        }

        /* ============================================
           PIE
           ============================================ */
        .footer {
            margin-top: 20px;
            padding: 12px 25px;
            background: #faf8f3;
            border-top: 1px solid #f0e6d2;
            text-align: center;
            font-size: 8px;
            color: #999;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    {{-- ===== BANNER CON IMÁGENES ===== --}}
    <div class="banner">
        <div class="banner-title">"EVENTOS ESPECIALES LERMA"</div>
        <div class="banner-images">
            <div class="banner-img-circle">
                <img src="{{ $img1 }}" alt="">
            </div>
            <div class="banner-img-rect">
                <img src="{{ $img2 }}" alt="">
            </div>
            <div class="banner-img-circle">
                <img src="{{ $img3 }}" alt="">
            </div>
        </div>
    </div>

    {{-- ===== INFO BAR ===== --}}
    <div class="info-bar">
        <table>
            <tr>
                <td style="width: 50%;">
                    <div class="info-label">Cotización para:</div>
                    <div class="info-name">{{ $quotation->client_name }}</div>
                </td>
                <td class="right" style="width: 50%;">
                    <div class="info-label">Elaboró:</div>
                    <div class="info-name">Eventos Especiales Lerma</div>
                    <div class="info-detail">
                        Tel. 728-284-9074<br>
                        Cel. 729-373 88-30<br>
                        eventosespecialeslerma.com
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 8px;">
                    <div class="info-label">Fecha:</div>
                    <div class="info-name">{{ $quotation->quotation_date->format('d/m/Y') }}</div>
                </td>
                <td class="right" style="padding-top: 8px;">
                    <div class="info-label">Folio:</div>
                    <div class="info-name">{{ $quotation->folio }}</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ===== TÍTULO ===== --}}
    <div class="title-bar">
        <h1>C O T I Z A C I Ó N</h1>
    </div>

    {{-- ===== CONTENIDO ===== --}}
    <div class="content">
        @php
            $grupos = [];
            foreach ($quotation->items as $item) {
                $seccion = $item['seccion'] ?? 'SERVICIOS';
                $grupos[$seccion][] = $item;
            }
        @endphp

        @foreach($grupos as $seccion => $items)
            <div class="section-header">{{ $seccion }}</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 55%;">Descripción</th>
                        <th style="width: 10%;" class="center">Cant.</th>
                        <th style="width: 17%;" class="right">P. Unitario</th>
                        <th style="width: 18%;" class="right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item['descripcion'] }}</td>
                            <td class="center">{{ $item['cantidad'] }}</td>
                            <td class="right">${{ number_format($item['precio_unitario'], 2) }}</td>
                            <td class="right">${{ number_format($item['total'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        {{-- Totales --}}
        <div class="totals-container">
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
        </div>
    </div>

    {{-- ===== PIE ===== --}}
    <div class="footer">
        Gracias por su preferencia · Eventos Especiales Lerma · {{ now()->year }}
    </div>

</body>
</html>