<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ganancias por Empresa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #10B981;
        }
        
        .header h1 {
            font-size: 22px;
            color: #1E293B;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 11px;
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
            margin-bottom: 20px;
        }
        
        .summary-card {
            display: table-cell;
            width: 25%;
            padding: 12px;
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
            background-color: #ECFDF5;
            border-color: #10B981;
        }
        
        .summary-card h3 {
            font-size: 10px;
            color: #64748B;
            margin-bottom: 5px;
            font-weight: normal;
            text-transform: uppercase;
        }
        
        .summary-card p {
            font-size: 18px;
            font-weight: bold;
            color: #1E293B;
        }
        
        .summary-card:last-child p {
            color: #10B981;
        }
        
        .info-box {
            background-color: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 20px;
        }
        
        .info-box p {
            font-size: 10px;
            color: #166534;
            line-height: 1.4;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        thead {
            background-color: #10B981;
            color: white;
        }
        
        th {
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
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
            padding: 8px 6px;
            font-size: 10px;
        }
        
        .company-name {
            font-weight: 600;
            color: #1E293B;
        }
        
        .company-email {
            color: #64748B;
            font-size: 9px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 600;
        }
        
        .badge-blue {
            background-color: #DBEAFE;
            color: #1E40AF;
        }
        
        .badge-primary {
            background-color: #E0E7FF;
            color: #4F46E5;
        }
        
        .profit {
            color: #10B981;
            font-weight: bold;
        }
        
        .amount {
            font-weight: 600;
        }
        
        tfoot {
            background-color: #F8FAFC;
            border-top: 2px solid #10B981;
        }
        
        tfoot td {
            padding: 10px 6px;
            font-weight: bold;
            font-size: 11px;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #E2E8F0;
            color: #64748B;
            font-size: 9px;
        }
        
        .rank-badge {
            display: inline-block;
            width: 20px;
            height: 20px;
            line-height: 20px;
            border-radius: 50%;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }
        
        .rank-1 { background-color: #FEF3C7; color: #92400E; }
        .rank-2 { background-color: #E5E7EB; color: #374151; }
        .rank-3 { background-color: #FED7AA; color: #9A3412; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Ganancias por Empresa</h1>
        <p>Sistema de Gestión de Cupones</p>
    </div>
    
    <div class="date-range">
        <strong>Período:</strong> 
        {{ \Carbon\Carbon::parse($startDate)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }} 
        - 
        {{ \Carbon\Carbon::parse($endDate)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
    </div>
    
    <div class="summary-cards">
        <div class="summary-card">
            <h3>Empresas Activas</h3>
            <p>{{ $profitsByCompany->count() }}</p>
        </div>
        <div class="summary-card">
            <h3>Total Ventas</h3>
            <p>{{ number_format($totalSalesAll) }}</p>
        </div>
        <div class="summary-card">
            <h3>Total Vendido</h3>
            <p>${{ number_format($totalRevenueAll, 2) }}</p>
        </div>
        <div class="summary-card">
            <h3>Ganancia Plataforma</h3>
            <p>${{ number_format($totalPlatformProfit, 2) }}</p>
        </div>
    </div>
    
    <div class="info-box">
        <p><strong>ℹ️ Información:</strong> Las ganancias se calculan aplicando el porcentaje de comisión asignado a cada empresa sobre el total de ventas. La ganancia de la plataforma representa los ingresos generados por las comisiones en el período seleccionado.</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 4%;">#</th>
                <th style="width: 30%;">Empresa</th>
                <th style="width: 8%;" class="text-center">Ventas</th>
                <th style="width: 13%;" class="text-right">Total Vendido</th>
                <th style="width: 10%;" class="text-center">Comisión</th>
                <th style="width: 15%;" class="text-right">Ganancia Plataforma</th>
                <th style="width: 15%;" class="text-right">Ganancia Empresa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profitsByCompany as $index => $data)
                <tr>
                    <td class="text-center">
                        @if($index < 3)
                            <span class="rank-badge rank-{{ $index + 1 }}">{{ $index + 1 }}</span>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </td>
                    <td>
                        <div class="company-name">{{ $data['company']->company_name }}</div>
                        <div class="company-email">{{ $data['company']->email }}</div>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-blue">{{ number_format($data['total_sales']) }}</span>
                    </td>
                    <td class="text-right amount">${{ number_format($data['total_revenue'], 2) }}</td>
                    <td class="text-center">
                        <span class="badge badge-primary">{{ number_format($data['commission_percentage'], 2) }}%</span>
                    </td>
                    <td class="text-right profit">${{ number_format($data['platform_profit'], 2) }}</td>
                    <td class="text-right amount">${{ number_format($data['company_profit'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right">TOTALES</td>
                <td class="text-center">{{ number_format($totalSalesAll) }}</td>
                <td class="text-right">${{ number_format($totalRevenueAll, 2) }}</td>
                <td class="text-center">—</td>
                <td class="text-right profit">${{ number_format($totalPlatformProfit, 2) }}</td>
                <td class="text-right">${{ number_format($totalCompanyProfit, 2) }}</td>
            </tr>
        </tfoot>
    </table>
    
    @if($profitsByCompany->isEmpty())
        <div style="text-align: center; padding: 40px; color: #64748B;">
            <p>No hay datos para mostrar en el período seleccionado.</p>
        </div>
    @endif
    
    <div class="footer">
        <p>Generado el {{ now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY [a las] h:mm A') }}</p>
        <p>Sistema de Gestión de Cupones - Reporte Confidencial</p>
    </div>
</body>
</html>
