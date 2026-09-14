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
            font-size: 13px;
            color: #2c2c2c;
            background: #ffffff;
        }

        /* ============================================
           BANNER SUPERIOR
           ============================================ */
        .banner {
            background: #faf6ee;
            padding: 24px 25px 20px;
            text-align: center;
        }
        .banner-title {
            font-family: 'DejaVu Serif', serif;
            font-size: 38px;
            font-weight: bold;
            color: #b8956a;
            letter-spacing: 3px;
            margin-bottom: 18px;
        }
        .banner-table {
            width: 100%;
            border-collapse: collapse;
        }
        .banner-table td {
            vertical-align: middle;
            text-align: center;
            padding: 0 6px;
        }
        .banner-circle {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            border: 5px solid #ffffff;
        }
        .banner-circle img {
            width: 100%;
            height: 100%;
            display: block;
        }
        .banner-rect {
            width: 500px;
            height: 210px;
            border-radius: 8px;
            overflow: hidden;
            margin: 0 auto;
            border: 5px solid #ffffff;
        }
        .banner-rect img {
            width: 100%;
            height: 100%;
            display: block;
        }

        /* ============================================
           INFO BAR
           ============================================ */
        .info-bar {
            background: #ffffff;
            padding: 16px 25px;
            border-top: 1px solid #e8e2d5;
            border-bottom: 1px solid #e8e2d5;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            vertical-align: middle;
            padding: 6px 0;
        }
        .info-table tr.divider td {
            border-top: 1px dashed #e8e2d5;
            padding: 0;
            height: 10px;
        }
        .info-left { width: 50%; text-align: left; }
        .info-right { width: 50%; text-align: right; }
        .info-center { text-align: center; }

        .info-label {
            font-size: 10px;
            color: #b8956a;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        .info-value {
            font-family: 'DejaVu Serif', serif;
            font-size: 17px;
            font-weight: bold;
            color: #2c2c2c;
        }
        .info-detail {
            font-size: 12px;
            color: #777;
            letter-spacing: 0.3px;
        }

        /* ============================================
           TÍTULO (moderado)
           ============================================ */
        .title-bar {
            text-align: center;
            padding: 20px 25px 18px;
        }
        .title-bar h1 {
            font-family: 'DejaVu Serif', serif;
            font-size: 22px;
            font-weight: bold;
            color: #b8956a;
            letter-spacing: 12px;
        }

        /* ============================================
           CONTENIDO
           ============================================ */
        .content { padding: 0 25px 24px; }

        .section-header {
            background: #7a6a4f;
            color: #ffffff;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 4px;
            padding: 13px 18px;
            margin-top: 22px;
        }
        .section-header-first { margin-top: 0; }

        /* ============================================
           TABLA DE ITEMS (artículos)
           ============================================ */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .items-table thead th {
            background: #f5f0e4;
            color: #7a6a4f;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 14px 18px;
            border-bottom: 1px solid #e5dcc8;
            text-align: left;
        }
        .items-table thead th.center { text-align: center; }
        .items-table thead th.right { text-align: right; }
        .items-table tbody td {
            padding: 17px 18px;
            border-bottom: 1px solid #f0ece2;
            font-size: 15px;
            color: #2c2c2c;
            vertical-align: top;
        }
        .items-table tbody td.center { text-align: center; }
        .items-table tbody td.right { text-align: right; }

        /* ============================================
           BOTTOM SECTION
           ============================================ */
        .bottom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 28px;
        }
        .bottom-table td {
            vertical-align: bottom;
            padding: 0;
        }
        .bottom-notes-col {
            width: 55%;
            padding-right: 30px !important;
            vertical-align: top !important;
        }
        .bottom-totals-col {
            width: 45%;
            vertical-align: bottom;
        }

        /* Notas */
        .notes {
            border-top: 1px solid #f0ece2;
            padding-top: 16px;
            font-size: 12.5px;
            color: #777;
            line-height: 1.9;
        }
        .notes p { margin-bottom: 4px; }

        /* Totales */
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 12px 18px;
            font-size: 14px;
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
            font-size: 21px;
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
            margin-top: 30px;
            background: #7a6a4f;
            color: #ffffff;
            padding: 18px 25px;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-table td {
            vertical-align: middle;
            font-size: 12px;
            letter-spacing: 0.5px;
            color: #ffffff;
        }
        .footer-left { text-align: left; width: 30%; }
        .footer-center { text-align: center; width: 40%; }
        .footer-right { text-align: right; width: 30%; }
        .footer-table strong { font-size: 15px; letter-spacing: 0.8px; }
    </style>
</head>
<body>

    {{-- ===== BANNER ===== --}}
    <div class="banner">
        <div class="banner-title">"EVENTOS ESPECIALES LERMA"</div>
        <table class="banner-table">
            <tr>
                <td style="width: 22%;">
                    <div class="banner-circle"><img src="{{ $img1 }}" alt=""></div>
                </td>
                <td style="width: 56%;">
                    <div class="banner-rect"><img src="{{ $img2 }}" alt=""></div>
                </td>
                <td style="width: 22%;">
                    <div class="banner-circle"><img src="{{ $img3 }}" alt=""></div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ===== INFO BAR ===== --}}
    <div class="info-bar">
        <table class="info-table">

            {{-- Renglón 1: Cotización para / Elaboró --}}
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

            {{-- Divisor --}}
            <tr class="divider"><td colspan="2"></td></tr>

            {{-- Renglón 2: Folio / Fecha --}}
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

            {{-- Divisor --}}
            <tr class="divider"><td colspan="2"></td></tr>

            {{-- Renglón 3: Contacto centrado --}}
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

    {{-- ===== FOOTER BAR ===== --}}
    <div class="footer-bar">
        <table class="footer-table">
            <tr>
                <td class="footer-left"><strong>729-373-88-30</strong></td>
                <td class="footer-center">Av. Circunvalación No. 15, Col. Agricola Analco, Lerma, Méx.</td>
                <td class="footer-right">www.eventosespecialeslerma.com</td>
            </tr>
        </table>
    </div>

</body>
</html>