<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cotización {{ $quotation->folio }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'dejavusans', sans-serif;
            font-size: 12px;
            font-weight: normal;
            color: #2c2c2c;
            background: #ffffff;
        }
        table, td, th, p, div, span { font-weight: normal; }
        strong, b { font-weight: bold; }

        /* ============================================
           BANNER (ancho completo, sin márgenes)
           ============================================ */
        .banner {
            background: #faf6ee;
            padding: 16px 0 14px;
            text-align: center;
            width: 100%;
        }
        .banner-title {
            font-family: 'dejavuserif', serif;
            font-size: 24px;
            font-weight: normal;
            color: #b8956a;
            letter-spacing: 2px;
            margin-bottom: 10px;
            line-height: 1;
        }
        .banner-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 15px 0;   /* ← aumenta este valor */
            border: 0;
        }
        .banner-table td {
            vertical-align: middle;
            text-align: center;
            padding: 0 15px;    /* ← espacio lateral entre imágenes */
            border: 0;
            line-height: 0;
            font-size: 0;
            background: #faf6ee;
        }
        .banner-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            display: block;
        }
        .banner-circle img {
            width: 100%;
            height: 100%;
            display: block;
            border-radius: 50%;  
        }
        .banner-rect {
            width: 100%;  
            max-width: 440px;
            height: 160px;
            border-radius: 10px;
            overflow: hidden;
            margin: 0 auto;
            display: block;
            padding: 3px;
        }
        .banner-rect img {
            width: 100%;
            height: 100%;
            display: block;
        }

        /* ============================================
           CONTENEDOR DEL CONTENIDO (con padding lateral)
           ============================================ */
        .container {
            padding: 0 20px;
        }

        /* ============================================
           INFO BAR
           ============================================ */
        .info-bar {
            background: #ffffff;
            padding: 10px 0 8px;
            border-top: 1px solid #e8e2d5;
            border-bottom: 1px solid #e8e2d5;
        }
        .info-table { width: 100%; border-collapse: collapse; border: 0; }
        .info-table td {
            vertical-align: middle;
            padding: 3px 0;
            border: 0;
            font-weight: normal;
            line-height: 1.3;
        }
        .info-table tr.divider td {
            border-top: 1px dashed #e8e2d5;
            padding: 0;
            height: 5px;
        }
        .info-left { width: 50%; text-align: left; }
        .info-right { width: 50%; text-align: right; }
        .info-center { text-align: center; }

        .info-label {
            font-size: 8.5px;
            color: #b8956a;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: normal;
            margin-bottom: 1px;
            line-height: 1.2;
        }
        .info-value {
            font-family: 'dejavuserif', serif;
            font-size: 14px;
            font-weight: normal;
            color: #2c2c2c;
            line-height: 1.2;
        }
        .info-detail {
            font-size: 10px;
            color: #888;
            letter-spacing: 0.2px;
            font-weight: normal;
            line-height: 1.3;
        }

        /* ============================================
           TÍTULO
           ============================================ */
        .title-bar {
            text-align: center;
            padding: 10px 0 8px;
            line-height: 1;
        }
        .title-bar h1 {
            font-family: 'dejavuserif', serif;
            font-size: 16px;
            font-weight: normal;
            color: #b8956a;
            letter-spacing: 8px;
            line-height: 1;
            margin: 0;
        }

        /* ============================================
           CONTENIDO
           ============================================ */
        .content { padding: 0 0 12px 0; }

        .section-header {
            background: #7a6a4f;
            color: #ffffff;
            font-size: 10.5px;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 5px 10px;
            margin-top: 8px;
            line-height: 1.2;
            page-break-after: avoid;
        }
        .section-header-first { margin-top: 0; }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            border: 0;
            margin-bottom: 4px;
        }
        .items-table thead { display: table-header-group; }
        .items-table thead th {
            background: #f5f0e4;
            color: #7a6a4f;
            font-size: 10px;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 6px 10px;
            border: 0;
            border-bottom: 1px solid #e5dcc8;
            text-align: left;
            white-space: nowrap;
            line-height: 1.2;
        }
        .items-table thead th.center { text-align: center; }
        .items-table thead th.right { text-align: right; }
        .items-table tbody td {
            padding: 8px 10px;
            border: 0;
            border-bottom: 1px solid #f0ece2;
            font-size: 11.5px;
            font-weight: normal;
            color: #2c2c2c;
            vertical-align: top;
            line-height: 1.3;
        }
        .items-table tbody td.center { text-align: center; }
        .items-table tbody td.right { text-align: right; }

        /* ============================================
           BOTTOM (Notas + Totales)
           ============================================ */
        .bottom-table {
            width: 100%;
            border-collapse: collapse;
            border: 0;
            margin-top: 16px;
        }
        .bottom-table td {
            vertical-align: bottom;
            padding: 0;
            border: 0;
        }
        .bottom-notes-col {
            width: 55%;
            padding-right: 25px !important;
            vertical-align: top !important;
        }
        .bottom-totals-col {
            width: 45%;
            vertical-align: bottom;
        }

        .notes {
            border-top: 1px solid #f0ece2;
            padding-top: 10px;
            font-size: 10px;
            color: #888;
            line-height: 1.6;
            font-weight: normal;
        }
        .notes p { margin-bottom: 2px; font-weight: normal; }

        .totals-table { width: 100%; border-collapse: collapse; border: 0; }
        .totals-table td {
            padding: 7px 14px;
            font-size: 11.5px;
            font-weight: normal;
            border: 0;
            line-height: 1.2;
        }
        .totals-table .label { text-align: right; color: #888; letter-spacing: 0.3px; }
        .totals-table .value { text-align: right; font-weight: normal; color: #2c2c2c; }
        .totals-table .grand-total {
            background: #7a6a4f;
            color: #ffffff;
            font-size: 16px;
            font-weight: normal;
            letter-spacing: 1px;
        }
        .totals-table .grand-total .label { color: #ffffff; letter-spacing: 1px; }
        .totals-table .grand-total .value { color: #ffffff; }
    </style>
</head>
<body>

    {{-- ===== BANNER (ancho completo) ===== --}}
    <div class="banner">
        <div class="banner-title">"EVENTOS ESPECIALES LERMA"</div>
        <table class="banner-table">
            <tr>
                <td style="width: 20%;">
                    <div class="banner-circle"><img src="{{ $img1 }}" alt=""></div>
                </td>
                <td style="width: 60%;">
                    <div class="banner-rect"><img src="{{ $img2 }}" alt=""></div>
                </td>
                <td style="width: 20%;">
                    <div class="banner-circle"><img src="{{ $img3 }}" alt=""></div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ===== RESTO DEL CONTENIDO (con padding lateral) ===== --}}
    <div class="container">

        {{-- ===== INFO BAR ===== --}}
        <div class="info-bar">
            <table class="info-table">
                <tr>
                    <td class="info-left">
                        <div class="info-label">Cotización para:</div>
                        <div class="info-value">{{ $quotation->client_name }}</div>
                    </td>
                    <td class="info-right">
                        <div class="info-label">Elaboró:</div>
                        <div class="info-value">Eventos Especiales Lerma</div>
                    </td>
                </tr>
                <tr class="divider"><td colspan="2"></td></tr>
                <tr>
                    <td class="info-left">
                        <div class="info-label">Folio:</div>
                        <div class="info-value">{{ $quotation->folio }}</div>
                    </td>
                    <td class="info-right">
                        <div class="info-label">Fecha:</div>
                        <div class="info-value">{{ $quotation->quotation_date->format('d/m/Y') }}</div>
                    </td>
                </tr>
                <tr class="divider"><td colspan="2"></td></tr>
                <tr>
                    <td colspan="2" class="info-center">
                        <div class="info-detail">
                            Tel. 728-284-9074 &nbsp;·&nbsp; Cel. 729-373-88-30 &nbsp;·&nbsp; eventosespecialeslerma.com
                        </div>
                    </td>
                </tr>
            </table>
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
                $first = true;
            @endphp

            @foreach($grupos as $seccion => $items)
                <div class="section-header {{ $first ? 'section-header-first' : '' }}">{{ $seccion }}</div>
                @php $first = false; @endphp
                <table class="items-table">
                    <thead>
                        <tr>
                            <th style="width: 50%;">Descripción</th>
                            <th style="width: 8%;" class="center">Cant.</th>
                            <th style="width: 20%;" class="right">P. Unitario</th>
                            <th style="width: 22%;" class="right">Total</th>
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

            {{-- Notas + Totales --}}
            <table class="bottom-table">
                <tr>
                    <td class="bottom-notes-col">
                        <div class="notes">
                            <p>• La presente cotización tiene una vigencia de 30 días naturales a partir de la fecha de emisión.</p>
                            <p>• Los precios indicados en esta cotización no incluyen IVA.</p>
                            <p>• Para confirmar la reserva, se requiere un anticipo del 50% del total.</p>
                            <p>• El 50% restante deberá liquidarse previo al día del evento.</p>
                            <p>• El montaje y la logística se coordinarán una semana previa al evento.</p>
                        </div>
                    </td>
                    <td class="bottom-totals-col">
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
                    </td>
                </tr>
            </table>
        </div>

    </div>

</body>
</html>