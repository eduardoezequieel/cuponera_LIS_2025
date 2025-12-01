<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas por Empresa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #3B82F6;
        }
        
        .header h1 {
            font-size: 24px;
            color: #1E293B;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 12px;
            color: #64748B;
        }
        
        .date-range {
            background-color: #F1F5F9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .summary-cards {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }
        
        .summary-card {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            text-align: center;
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
        }
        
        .summary-card:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        
        .summary-card:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        
        .summary-card h3 {
            font-size: 11px;
            color: #64748B;
            margin-bottom: 5px;
            font-weight: normal;
            text-transform: uppercase;
        }
        
        .summary-card p {
            font-size: 22px;
            font-weight: bold;
            color: #1E293B;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        thead {
            background-color: #3B82F6;
            color: white;
        }
        
        th {
            padding: 10px 8px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        th:last-child,
        td:last-child {
            text-align: right;
        }
        
        tbody tr {
            border-bottom: 1px solid #E2E8F0;
        }
        
        tbody tr:nth-child(even) {
            background-color: #F8FAFC;
        }
        
        td {
            padding: 10px 8px;
            font-size: 11px;
        }
        
        .company-name {
            font-weight: 600;
            color: #1E293B;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .percentage-container {
            display: inline-block;
            width: 80px;
            height: 10px;
            background-color: #E2E8F0;
            border-radius: 5px;
            position: relative;
            vertical-align: middle;
            margin-right: 5px;
        }
        
        .percentage-bar {
            height: 100%;
            background: linear-gradient(90deg, #3B82F6, #8B5CF6);
            border-radius: 5px;
        }
        
        .percentage-text {
            font-size: 10px;
            color: #64748B;
        }
        
        tfoot {
            background-color: #F1F5F9;
            font-weight: bold;
        }
        
        tfoot td {
            padding: 12px 8px;
            color: #1E293B;
            border-top: 2px solid #3B82F6;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #94A3B8;
            border-top: 1px solid #E2E8F0;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Ventas por Empresa</h1>
        <p>Análisis detallado del desempeño de ventas</p>
    </div>

    @if($startDate || $endDate)
    <div class="date-range">
        <strong>Período:</strong>
        @if($startDate && $endDate)
            {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
        @elseif($startDate)
            Desde {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
        @elseif($endDate)
            Hasta {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
        @endif
    </div>
    @endif

    <div class="summary-cards">
        <div class="summary-card">
            <h3>Total Empresas</h3>
            <p>{{ $salesByCompany->count() }}</p>
        </div>
        <div class="summary-card">
            <h3>Total Ventas</h3>
            <p>{{ number_format($totalSalesAll) }}</p>
        </div>
        <div class="summary-card">
            <h3>Ingresos Totales</h3>
            <p>${{ number_format($totalRevenueAll, 2) }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 30%;">Empresa</th>
                <th style="width: 15%;" class="text-center">Cupones Creados</th>
                <th style="width: 12%;" class="text-center">Ventas</th>
                <th style="width: 15%;" class="text-right">Ingresos</th>
                <th style="width: 23%;" class="text-right">% del Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salesByCompany as $index => $data)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="company-name">{{ $data['company']->fullname }}</td>
                <td class="text-center">{{ $data['total_coupons'] }}</td>
                <td class="text-center">{{ number_format($data['total_sales']) }}</td>
                <td class="text-right">${{ number_format($data['total_revenue'], 2) }}</td>
                <td class="text-right">
                    @php
                        $percentage = $totalSalesAll > 0 ? ($data['total_sales'] / $totalSalesAll) * 100 : 0;
                    @endphp
                    <div class="percentage-container">
                        <div class="percentage-bar" style="width: {{ $percentage }}%;"></div>
                    </div>
                    <span class="percentage-text">{{ number_format($percentage, 1) }}%</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px; color: #94A3B8;">
                    No hay datos disponibles para el período seleccionado.
                </td>
            </tr>
            @endforelse
        </tbody>
        @if($salesByCompany->count() > 0)
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">TOTAL</td>
                <td class="text-center">{{ number_format($totalSalesAll) }}</td>
                <td class="text-right">${{ number_format($totalRevenueAll, 2) }}</td>
                <td class="text-right">100%</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        <p>Generado el {{ now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY [a las] HH:mm') }}</p>
        <p>Sistema de Gestión de Cupones</p>
    </div>
</body>
</html>
