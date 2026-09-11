<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cotización {{ $quotation->folio }}</title>
    <style>
        @page { margin: 0; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #2c2c2c;
            background: #ffffff;
        }

        /* ============================================
           BANNER SUPERIOR
           ============================================ */
        .banner {
            background: #faf6ee;
            padding: 22px 25px 18px;
            text-align: center;
        }
        .banner-title {
            font-family: 'DejaVu Serif', serif;
            font-size: 34px;
            font-weight: bold;
            color: #b8956a;
            letter-spacing: 3px;
            margin-bottom: 16px;
        }
        .banner-images {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .banner-images .cell {
            vertical-align: middle;
            text-align: center;
            padding: 0 6px;
        }
        .banner-images .circle {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            border: 5px solid #ffffff;
        }
        .banner-images .circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .banner-images .rect {
            width: 500px;
            height: 210px;
            border-radius: 8px;
            overflow: hidden;
            margin: 0 auto;
            border: 5px solid #ffffff;
        }
        .banner-images .rect img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* ============================================
           INFO BAR (3 renglones)
           ============================================ */
        .info-bar {
            background: #ffffff;
            padding: 14px 25px;
            border-top: 1px solid #e8e2d5;
            border-bottom: 1px solid #e8e2d5;
        }
        .info-bar .row {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        .info-bar .row + .row {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #e8e2d5;
        }
        .info-bar .row .cell {
            display: table-cell;
            vertical-align: middle;
        }
        .info-bar .row .cell.left { width: 50%; text-align: left; }
        .info-bar .row .cell.right { width: 50%; text-align: right; }
        .info-bar .row .cell.center { text-align: center; }

        .info-bar .label {
            font-size: 9px;
            color: #b8956a;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        .info-bar .value {
            font-family: 'DejaVu Serif', serif;
            font-size: 15px;
            font-weight: bold;
            color: #2c2c2c;
        }
        .info-bar .detail {
            font-size: 11px;
            color: #777;
            letter-spacing: 0.3px;
        }

        /* ============================================
           TÍTULO
           ============================================ */
        .title-bar {
            text-align: center;
            padding: 28px 25px 22px;
        }
        .title-bar h1 {
            font-family: 'DejaVu Serif', serif;
            font-size: 30px;
            font-weight: bold;
            color: #b8956a;
            letter-spacing: 18px;
        }

        /* ============================================
           CONTENIDO
           ============================================ */
        .content { padding: 0 25px 22px; }

        .section-header {
            background: #7a6a4f;
            color: #ffffff;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 4px;
            padding: 11px 16px;
            margin-top: 20px;
        }
        .section-header:first-child { margin-top: 0; }

        /* ============================================
           TABLA DE ITEMS
           ============================================ */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        .items-table thead th {
            background: #f5f0e4;
            color: #7a6a4f;
            font-size: 12.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 12px 16px;
            border-bottom: 1px solid #e5dcc8;
            text-align: left;
        }
        .items-table thead th.center { text-align: center; }
        .items-table thead th.right { text-align: right; }
        .items-table tbody td {
            padding: 15px 16px;
            border-bottom: 1px solid #f0ece2;
            font-size: 14px;
            color: #2c2c2c;
            vertical-align: top;
        }
        .items-table tbody td.center { text-align: center; }
        .items-table tbody td.right { text-align: right; }

        /* ============================================
           BOTTOM SECTION: Notas (izq) + Totales (der)
           ============================================ */
        .bottom-section {
            display: table;
            width: 100%;
            table-layout: fixed;
            margin-top: 26px;
        }
        .bottom-section .notes-col {
            display: table-cell;
            width: 55%;
            vertical-align: top;
            padding-right: 30px;
        }
        .bottom-section .totals-col {
            display: table-cell;
            width: 45%;
            vertical-align: bottom;
        }

        /* Notas */
        .notes {
            border-top: 1px solid #f0ece2;
            padding-top: 14px;
            font-size: 11px;
            color: #777;
            line-height: 1.8;
        }
        .notes p { margin-bottom: 3px; }

        /* Totales */
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 10px 18px;
            font-size: 13px;
        }
        .totals-table .label {
            text-align: right;
            color: #777;
            letter-spacing: 0.5px;
        }
        .totals-table .value {
            text-align: right;
            font-weight: bold;
            color: #2c2c2c;
        }
        .totals-table .grand-total {
            background: #7a6a4f;
            color: #ffffff;
            font-size: 19px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }
        .totals-table .grand-total .label {
            color: #ffffff;
            letter-spacing: 1.5px;
        }
        .totals-table .grand-total .value { color: #ffffff; }

        /* ============================================
           FOOTER BAR
           ============================================ */
        .footer-bar {
            margin-top: 28px;
            background: #7a6a4f;
            color: #ffffff;
            padding: 16px 25px;
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        .footer-bar .cell {
            display: table-cell;
            vertical-align: middle;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        .footer-bar .cell.center { text-align: center; }
        .footer-bar .cell.right { text-align: right; }
        .footer-bar strong { font-size: 14px; letter-spacing: 0.8px; }
    </style>
</head>
<body>

    {{-- ===== BANNER ===== --}}
    <div class="banner">
        <div class="banner-title">"EVENTOS ESPECIALES LERMA"</div>
        <table class="banner-images">
            <tr>
                <td class="cell" style="width: 22%;">
                    <div class="circle"><img src="{{ $img1 }}" alt=""></div>
                </td>
                <td class="cell" style="width: 56%;">
                    <div class="rect"><img src="{{ $img2 }}" alt=""></div>
                </td>
                <td class="cell" style="width: 22%;">
                    <div class="circle"><img src="{{ $img3 }}" alt=""></div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ===== INFO BAR ===== --}}
    <div class="info-bar">

        {{-- Renglón 1: Cotización para / Elaboró --}}
        <div class="row">
            <div class="cell left">
                <div class="label">Cotización para:</div>
                <div class="value">{{ $quotation->client_name }}</div>
            </div>
            <div class="cell right">
                <div class="label">Elaboró:</div>
                <div class="value">Eventos Especiales Lerma</div>
            </div>
        </div>

        {{-- Renglón 2: Folio / Fecha --}}
        <div class="row">
            <div class="cell left">
                <div class="label">Folio:</div>
                <div class="value">{{ $quotation->folio }}</div>
            </div>
            <div class="cell right">
                <div class="label">Fecha:</div>
                <div class="value">{{ $quotation->quotation_date->format('d/m/Y') }}</div>
            </div>
        </div>

        {{-- Renglón 3: Contacto centrado --}}
        <div class="row">
            <div class="cell center">
                <div class="detail">
                    Tel. 728-284-9074 &nbsp;·&nbsp; Cel. 729-373-88-30 &nbsp;·&nbsp; eventosespecialeslerma.com
                </div>
            </div>
        </div>

    </div>

    {{-- ===== TÍTULO ===== --}}
    <div class="title-bar">
        <h1>COTIZACIÓN</h1>
    </div>

    {{-- ===== CONTENIDO ===== --}}
    <div class="content">
        @php
            $grupos = [];
            foreach ($quotation->items as $item) {
                $seccion = strtoupper($item['seccion'] ?? 'SERVICIOS');
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

        {{-- ===== NOTAS (izq) + TOTALES (der) ===== --}}
        <div class="bottom-section">

            {{-- Notas a la izquierda --}}
            <div class="notes-col">
                <div class="notes">
                    <p>• La presente cotización tiene una vigencia de 30 días naturales a partir de la fecha de emisión.</p>
                    <p>• Los precios indicados en esta cotización no incluyen IVA.</p>
                    <p>• Para confirmar la reserva, se requiere un anticipo del 50% del total.</p>
                    <p>• El 50% restante deberá liquidarse previo al día del evento.</p>
                    <p>• El montaje y la logística se coordinarán una semana previa al evento.</p>
                </div>
            </div>

            {{-- Totales a la derecha --}}
            <div class="totals-col">
                <table class="totals-table">
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
    </div>

    {{-- ===== FOOTER BAR ===== --}}
    <div class="footer-bar">
        <div class="cell"><strong>729-373-88-30</strong></div>
        <div class="cell center">Av. Circunvalación No. 15, Col. Agricola Analco, Lerma, Méx.</div>
        <div class="cell right">www.eventosespecialeslerma.com</div>
    </div>

</body>
</html>