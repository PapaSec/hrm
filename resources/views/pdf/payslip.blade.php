<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payslip</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompdf/2.0.3/dompdf_config.inc.js"></script>
    <style>
        @page {
            margin: 20mm;
            size: A4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }

        .payslip-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            border: 2px solid #2c5aa0;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2c5aa0 0%, #1e3f73 100%);
            color: white;
            padding: 25px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .company-logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .company-name {
            font-size: 16px;
            margin-bottom: 5px;
            position: relative;
            z-index: 1;
        }

        .payslip-title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 15px;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .info-section {
            padding: 25px;
            background: #f8f9fa;
        }

        .employee-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .employee-details,
        .pay-period {
            flex: 1;
        }

        .pay-period {
            text-align: right;
        }

        .info-label {
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 3px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 14px;
            margin-bottom: 12px;
            color: #333;
        }

        .pay-details {
            background: white;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            background: #2c5aa0;
            color: white;
            padding: 12px 20px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pay-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pay-table th {
            background: #e9ecef;
            padding: 12px 20px;
            text-align: left;
            font-weight: bold;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pay-table td {
            padding: 12px 20px;
            border-bottom: 1px solid #e9ecef;
            font-size: 13px;
        }

        .pay-table tr:hover {
            background: #f8f9fa;
        }

        .amount {
            text-align: right;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }

        .total-row {
            background: #e8f4fd;
            font-weight: bold;
            border-top: 2px solid #2c5aa0;
        }

        .total-row td {
            padding: 15px 20px;
            font-size: 14px;
            color: #2c5aa0;
        }

        .net-pay-section {
            background: linear-gradient(135deg, #28a745 0%, #20692b 100%);
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
            border-radius: 6px;
            position: relative;
            overflow: hidden;
        }

        .net-pay-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(45deg,
                    transparent,
                    transparent 10px,
                    rgba(255, 255, 255, 0.1) 10px,
                    rgba(255, 255, 255, 0.1) 20px);
            animation: shine 3s linear infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) translateY(-100%);
            }

            100% {
                transform: translateX(100%) translateY(100%);
            }
        }

        .net-pay-label {
            font-size: 16px;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .net-pay-amount {
            font-size: 32px;
            font-weight: bold;
            position: relative;
            z-index: 1;
            font-family: 'Courier New', monospace;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .footer {
            padding: 20px;
            text-align: center;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            font-size: 11px;
            color: #6c757d;
        }

        .disclaimer {
            font-style: italic;
            margin-bottom: 10px;
        }

        .generated-date {
            font-weight: bold;
            color: #495057;
        }

        @media print {
            .payslip-container {
                border: none;
                box-shadow: none;
            }

            .net-pay-section::before {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="payslip-container">
        <!-- Header Section -->
        <div class="header">
            <div class="company-logo">🏢</div>
            <div class="company-name">ACME CORPORATION LTD</div>
            <div class="payslip-title">EMPLOYEE PAYSLIP</div>
        </div>

        <!-- Employee Information Section -->
        <div class="info-section">
            <div class="employee-info">
                <div class="employee-details">
                    <div class="info-label">Employee Name</div>
                    <div class="info-value">John Smith</div>

                    <div class="info-label">Employee ID</div>
                    <div class="info-value">EMP001234</div>

                    <div class="info-label">Department</div>
                    <div class="info-value">Software Development</div>

                    <div class="info-label">Position</div>
                    <div class="info-value">Senior Developer</div>
                </div>

                <div class="pay-period">
                    <div class="info-label">Pay Period</div>
                    <div class="info-value">June 1 - June 30, 2025</div>

                    <div class="info-label">Pay Date</div>
                    <div class="info-value">June 30, 2025</div>

                    <div class="info-label">Pay Frequency</div>
                    <div class="info-value">Monthly</div>

                    <div class="info-label">Currency</div>
                    <div class="info-value">USD ($)</div>
                </div>
            </div>

            <!-- Earnings Section -->
            <div class="pay-details">
                <div class="section-header">💰 Earnings</div>
                <table class="pay-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Hours/Units</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Basic Salary</td>
                            <td class="amount">160.00</td>
                            <td class="amount">$37.50</td>
                            <td class="amount">$6,000.00</td>
                        </tr>
                        <tr>
                            <td>Overtime</td>
                            <td class="amount">8.00</td>
                            <td class="amount">$56.25</td>
                            <td class="amount">$450.00</td>
                        </tr>
                        <tr>
                            <td>Performance Bonus</td>
                            <td class="amount">-</td>
                            <td class="amount">-</td>
                            <td class="amount">$500.00</td>
                        </tr>
                        <tr>
                            <td>Transport Allowance</td>
                            <td class="amount">-</td>
                            <td class="amount">-</td>
                            <td class="amount">$200.00</td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="3"><strong>Total Earnings</strong></td>
                            <td class="amount"><strong>$7,150.00</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Deductions Section -->
            <div class="pay-details" style="margin-top: 20px;">
                <div class="section-header">📉 Deductions</div>
                <table class="pay-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Rate/Amount</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Federal Income Tax</td>
                            <td>Tax</td>
                            <td class="amount">22%</td>
                            <td class="amount">$1,573.00</td>
                        </tr>
                        <tr>
                            <td>State Income Tax</td>
                            <td>Tax</td>
                            <td class="amount">5%</td>
                            <td class="amount">$357.50</td>
                        </tr>
                        <tr>
                            <td>Social Security</td>
                            <td>Tax</td>
                            <td class="amount">6.2%</td>
                            <td class="amount">$443.30</td>
                        </tr>
                        <tr>
                            <td>Medicare</td>
                            <td>Tax</td>
                            <td class="amount">1.45%</td>
                            <td class="amount">$103.68</td>
                        </tr>
                        <tr>
                            <td>Health Insurance</td>
                            <td>Benefit</td>
                            <td class="amount">-</td>
                            <td class="amount">$250.00</td>
                        </tr>
                        <tr>
                            <td>401(k) Contribution</td>
                            <td>Retirement</td>
                            <td class="amount">6%</td>
                            <td class="amount">$429.00</td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="3"><strong>Total Deductions</strong></td>
                            <td class="amount"><strong>$3,156.48</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Net Pay Section -->
            <div class="net-pay-section">
                <div class="net-pay-label">Net Pay</div>
                <div class="net-pay-amount">$3,993.52</div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <div class="disclaimer">
                This payslip is generated electronically and does not require a signature.
                Please retain this document for your records.
            </div>
            <div class="generated-date">
                Generated on: June 26, 2025 | Document ID: PS-2025-06-001234
            </div>
        </div>
    </div>

    <script>
        // Function to generate PDF using dompdf (when integrated with backend)
        function generatePDF() {
            // This would typically be handled server-side with dompdf
            // For demonstration, we'll show how the HTML structure is ready for dompdf
            console.log('HTML structure ready for dompdf conversion');

            // In a real implementation, you would send this HTML to your PHP backend
            // that has dompdf installed to generate the PDF
            alert('This HTML is optimized for dompdf PDF generation. Send this HTML content to your PHP backend with dompdf to generate the PDF.');
        }

        // Add print functionality
        function printPayslip() {
            window.print();
        }

        // You can call generatePDF() or printPayslip() as needed
        console.log('Payslip loaded and ready for PDF generation or printing');
    </script>
</body>

</html>