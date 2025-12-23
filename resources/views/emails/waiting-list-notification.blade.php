<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobil Tersedia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 20px -30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .celebration {
            text-align: center;
            font-size: 48px;
            margin: 20px 0;
        }
        .car-card {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px solid #3b82f6;
        }
        .car-name {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
        }
        .car-details {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #6b7280;
        }
        .detail-value {
            color: #1f2937;
            font-weight: 500;
        }
        .price-highlight {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
            border: 2px solid #10b981;
        }
        .price-label {
            font-size: 14px;
            color: #16a34a;
            font-weight: 600;
        }
        .price-value {
            font-size: 32px;
            font-weight: bold;
            color: #15803d;
            margin-top: 5px;
        }
        .steps {
            background-color: #fef3c7;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #f59e0b;
        }
        .step-title {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .step-item {
            padding: 10px 0;
            display: flex;
            align-items: flex-start;
        }
        .step-number {
            background-color: #f59e0b;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .step-text {
            color: #78350f;
            font-weight: 500;
        }
        .cta-button {
            display: block;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            text-align: center;
            padding: 15px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
            font-size: 16px;
        }
        .cta-button:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
        .urgency {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
            border: 2px solid #ef4444;
        }
        .urgency-text {
            color: #dc2626;
            font-weight: bold;
            font-size: 18px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .customer-name {
            color: #1e40af;
            font-weight: bold;
        }
    </style>
</head>
<strong>English</strong>
<body>
    <div class="container">
        <div class="header">
            <h1>🚗 GREAT NEWS! 🎉</h1>
        </div>

        <div class="celebration">
            🎊 🥳 🎉
        </div>

        <p>Hello <span class="customer-name">{{ $waitingList->user->name }}</span>,</p>
        
        <p style="font-size: 16px; line-height: 1.8;">
            The car you’ve been waiting for is now <strong style="color: #10b981;">AVAILABLE</strong>! 
            We’re happy to inform you that your dream vehicle is ready to be rented.
        </p>

        <!-- Car Details -->
        <div class="car-card">
            <div class="car-name">
                {{ $waitingList->mobil->merek }} {{ $waitingList->mobil->model }}
            </div>
            <div class="car-details">
                <div class="detail-row">
                    <span class="detail-label">🚙 Type</span>
                    <span class="detail-value">{{ $waitingList->mobil->jenis }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🔢 License Plate</span>
                    <span class="detail-value">{{ $waitingList->mobil->nomor_plat }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📅 Year</span>
                    <span class="detail-value">{{ $waitingList->mobil->tahun }}</span>
                </div>
            </div>
        </div>

        <!-- Price -->
        <div class="price-highlight">
            <div class="price-label">Rental Price</div>
            <div class="price-value">{{ $waitingList->mobil->harga_format }}<span style="font-size: 18px;">/day</span></div>
        </div>

        <!-- Next Steps -->
        <div class="steps">
            <div class="step-title">🎯 NEXT STEPS:</div>
            
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-text">Log in to your account through our website</div>
            </div>
            
            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-text">Select the car {{ $waitingList->mobil->merek }} {{ $waitingList->mobil->model }}</div>
            </div>
            
            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-text">Fill in the booking form completely</div>
            </div>
            
            <div class="step-item">
                <div class="step-number">4</div>
                <div class="step-text">Complete the payment according to the instructions</div>
            </div>
        </div>

        <!-- CTA Button -->
        <a href="http://project-magang.test/login" class="cta-button">
            🔐 LOGIN & BOOK NOW
        </a>

        <!-- Urgency Message -->
        <div class="urgency">
            <div class="urgency-text">⚡ Hurry before it’s gone!</div>
            <p style="margin: 5px 0 0 0; color: #991b1b; font-size: 14px;">
                This car is in high demand. Please place your booking soon to secure availability.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank you for waiting! 🙏</strong></p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                This email was sent automatically from the Car Rental system.<br>
                Please do not reply to this email. For further information, please contact our customer service.
            </p>
        </div>
    </div>
</body>
<br><br><strong>Bahasa Indonesia</strong>
<body>
    <div class="container">
        <div class="header">
            <h1>🚗 KABAR GEMBIRA! 🎉</h1>
        </div>

        <div class="celebration">
            🎊 🥳 🎉
        </div>

        <p>Halo <span class="customer-name">{{ $waitingList->user->name }}</span>,</p>
        
        <p style="font-size: 16px; line-height: 1.8;">
            Mobil yang Anda tunggu sekarang <strong style="color: #10b981;">SUDAH TERSEDIA</strong>! 
            Kami dengan senang hati menginformasikan bahwa kendaraan impian Anda sudah siap untuk disewa.
        </p>

        <!-- Detail Mobil -->
        <div class="car-card">
            <div class="car-name">
                {{ $waitingList->mobil->merek }} {{ $waitingList->mobil->model }}
            </div>
            <div class="car-details">
                <div class="detail-row">
                    <span class="detail-label">🚙 Tipe</span>
                    <span class="detail-value">{{ $waitingList->mobil->jenis }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">🔢 Plat Nomor</span>
                    <span class="detail-value">{{ $waitingList->mobil->nomor_plat }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📅 Tahun</span>
                    <span class="detail-value">{{ $waitingList->mobil->tahun }}</span>
                </div>
            </div>
        </div>

        <!-- Harga -->
        <div class="price-highlight">
            <div class="price-label">Harga Sewa</div>
            <div class="price-value">{{ $waitingList->mobil->harga_format }}<span style="font-size: 18px;">/hari</span></div>
        </div>

        <!-- Langkah Selanjutnya -->
        <div class="steps">
            <div class="step-title">🎯 LANGKAH SELANJUTNYA:</div>
            
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-text">Login ke akun Anda melalui website kami</div>
            </div>
            
            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-text">Pilih mobil {{ $waitingList->mobil->merek }} {{ $waitingList->mobil->model }}</div>
            </div>
            
            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-text">Isi form pemesanan dengan lengkap</div>
            </div>
            
            <div class="step-item">
                <div class="step-number">4</div>
                <div class="step-text">Lakukan pembayaran sesuai instruksi</div>
            </div>
        </div>

        <!-- CTA Button -->
        <a href="http://project-magang.test/login" class="cta-button">
            🔐 LOGIN & PESAN SEKARANG
        </a>

        <!-- Urgency Message -->
        <div class="urgency">
            <div class="urgency-text">⚡ Buruan sebelum kehabisan!</div>
            <p style="margin: 5px 0 0 0; color: #991b1b; font-size: 14px;">
                Mobil ini sangat diminati. Segera lakukan pemesanan untuk memastikan ketersediaan.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima kasih telah menunggu! 🙏</strong></p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                Email ini dikirim secara otomatis dari sistem Rental Mobil.<br>
                Mohon tidak membalas email ini. Untuk informasi lebih lanjut, silakan hubungi customer service kami.
            </p>
        </div>
    </div>
</body>
</html>