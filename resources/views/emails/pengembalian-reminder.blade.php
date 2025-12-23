<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder Pengembalian Mobil</title>
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
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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
        .urgent-banner {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-left: 4px solid #ef4444;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .urgent-text {
            color: #dc2626;
            font-weight: bold;
            font-size: 20px;
            margin: 0;
        }
        .urgent-subtext {
            color: #991b1b;
            font-size: 14px;
            margin: 5px 0 0 0;
        }
        .info-box {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border: 2px solid #3b82f6;
        }
        .car-name {
            font-size: 22px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
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
        .section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8fafc;
            border-left: 4px solid #f59e0b;
            border-radius: 5px;
        }
        .section-title {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .checklist {
            background-color: #fef3c7;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .checklist-item {
            padding: 8px 0;
            display: flex;
            align-items: flex-start;
        }
        .checklist-icon {
            color: #d97706;
            margin-right: 10px;
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
        .time-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
            border: 2px solid #f59e0b;
        }
        .time-label {
            color: #92400e;
            font-size: 14px;
            font-weight: 600;
        }
        .time-value {
            color: #78350f;
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
</head>
<strong>English </strong>
<body>
    <div class="container">
        <div class="header">
            <h1>⏰ VEHICLE RETURN REMINDER</h1>
        </div>

        <div class="urgent-banner">
            <p class="urgent-text">🚨 TODAY IS THE DEADLINE! 🚨</p>
            <p class="urgent-subtext">Please return the vehicle before 10:00 PM (WITA)</p>
        </div>

        <p>Dear <span style="color: #1e40af; font-weight: bold;">{{ $pemesanan->nama_lengkap }}</span>,</p>
        
        <p style="font-size: 16px; line-height: 1.8;">
            Your car rental period will <strong style="color: #dc2626;">END TODAY</strong>. 
            Please return the vehicle immediately in accordance with the applicable terms.
        </p>

        <!-- Car Details -->
        <div class="info-box">
            <div class="car-name">
                {{ $pemesanan->mobil->merek }} {{ $pemesanan->mobil->model }}
            </div>
            <div class="detail-row">
                <span class="detail-label">📋 Booking Code</span>
                <span class="detail-value"><strong>#{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</strong></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">🔢 License Plate</span>
                <span class="detail-value">{{ $pemesanan->mobil->nomor_plat }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">📅 Rental Period</span>
                <span class="detail-value">{{ $pemesanan->tanggal_mulai->format('d M') }} - {{ $pemesanan->tanggal_selesai->format('d M Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">⏱️ Duration</span>
                <span class="detail-value">{{ $pemesanan->durasi }} Days</span>
            </div>
        </div>

        <!-- Return Deadline -->
        <div class="time-box">
            <div class="time-label">RETURN DEADLINE</div>
            <div class="time-value">TODAY</div>
            <div style="color: #92400e; font-size: 16px; font-weight: 600;">
                {{ $pemesanan->tanggal_selesai->format('d F Y') }}
            </div>
            <div style="color: #78350f; margin-top: 10px;">
                Before <strong>10:00 PM (WITA)</strong>
            </div>
        </div>

        <!-- Return Location -->
        <div class="section">
            <div class="section-title">📍 RETURN LOCATION</div>
            <p style="margin: 0; line-height: 1.8;">
                <strong>Car Rental Address</strong><br>
                Jl. Raya Rental Mobil No. 123<br>
                Jimbaran, Bali, Indonesia<br>
                <strong>Phone:</strong> {{ $pemesanan->no_telepon }}
            </p>
        </div>

        <!-- Return Checklist -->
        <div class="checklist">
            <div style="font-weight: bold; color: #92400e; margin-bottom: 15px; font-size: 16px;">
                ✅ CHECKLIST BEFORE RETURN:
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">🧹</div>
                <div>Ensure the car interior is clean and tidy</div>
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">⛽</div>
                <div>Fuel must be <strong>full tank</strong> (same as at pickup)</div>
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">📄</div>
                <div>Bring booking documents and original ID</div>
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">🔑</div>
                <div>Return all car keys and accessories</div>
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">🚗</div>
                <div>Check the vehicle body condition (no new damage)</div>
            </div>
        </div>

        <!-- Notes (if any) -->
        @if($pemesanan->catatan)
        <div class="section">
            <div class="section-title">📝 ADDITIONAL NOTES</div>
            <p style="margin: 0; color: #4b5563;">{{ $pemesanan->catatan }}</p>
        </div>
        @endif

        <!-- Penalty Information -->
        <div style="background-color: #fef2f2; border: 2px solid #fca5a5; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; color: #991b1b; font-size: 14px;">
                <strong>⚠️ IMPORTANT:</strong> Late returns will be charged a penalty of <strong>10% of the daily rental price</strong> for each day of delay.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank you for using our service! 🙏</strong></p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                This email was sent automatically as a vehicle return reminder.<br>
                If you have any questions, please contact us immediately.
            </p>
        </div>
    </div>
</body>
<br><br> <strong>Bahasa Indonesia</strong>
<body>
    <div class="container">
        <div class="header">
            <h1>⏰ REMINDER PENGEMBALIAN MOBIL</h1>
        </div>

        <div class="urgent-banner">
            <p class="urgent-text">🚨 HARI INI ADALAH HARI TERAKHIR! 🚨</p>
            <p class="urgent-subtext">Mohon kembalikan mobil sebelum jam 22:00 WITA</p>
        </div>

        <p>Yth. <span style="color: #1e40af; font-weight: bold;">{{ $pemesanan->nama_lengkap }}</span>,</p>
        
        <p style="font-size: 16px; line-height: 1.8;">
            Masa sewa mobil Anda akan berakhir <strong style="color: #dc2626;">HARI INI</strong>. 
            Mohon segera kembalikan kendaraan sesuai ketentuan yang berlaku.
        </p>

        <!-- Detail Mobil -->
        <div class="info-box">
            <div class="car-name">
                {{ $pemesanan->mobil->merek }} {{ $pemesanan->mobil->model }}
            </div>
            <div class="detail-row">
                <span class="detail-label">📋 Kode Pemesanan</span>
                <span class="detail-value"><strong>#{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}</strong></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">🔢 Plat Nomor</span>
                <span class="detail-value">{{ $pemesanan->mobil->nomor_plat }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">📅 Periode Sewa</span>
                <span class="detail-value">{{ $pemesanan->tanggal_mulai->format('d M') }} - {{ $pemesanan->tanggal_selesai->format('d M Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">⏱️ Durasi</span>
                <span class="detail-value">{{ $pemesanan->durasi }} Hari</span>
            </div>
        </div>

        <!-- Waktu Pengembalian -->
        <div class="time-box">
            <div class="time-label">DEADLINE PENGEMBALIAN</div>
            <div class="time-value">HARI INI</div>
            <div style="color: #92400e; font-size: 16px; font-weight: 600;">
                {{ $pemesanan->tanggal_selesai->format('d F Y') }}
            </div>
            <div style="color: #78350f; margin-top: 10px;">
                Sebelum jam <strong>22:00 WITA</strong>
            </div>
        </div>

        <!-- Lokasi Pengembalian -->
        <div class="section">
            <div class="section-title">📍 LOKASI PENGEMBALIAN</div>
            <p style="margin: 0; line-height: 1.8;">
                <strong>Alamat Rental Mobil</strong><br>
                Jl. Raya Rental Mobil No. 123<br>
                Jimbaran, Bali, Indonesia<br>
                <strong>Telepon:</strong> {{ $pemesanan->no_telepon }}
            </p>
        </div>

        <!-- Checklist Pengembalian -->
        <div class="checklist">
            <div style="font-weight: bold; color: #92400e; margin-bottom: 15px; font-size: 16px;">
                ✅ CHECKLIST SEBELUM PENGEMBALIAN:
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">🧹</div>
                <div>Pastikan interior mobil dalam kondisi bersih dan rapi</div>
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">⛽</div>
                <div>BBM harus <strong>full tank</strong> (sama seperti saat pengambilan)</div>
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">📄</div>
                <div>Bawa dokumen pemesanan dan KTP asli</div>
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">🔑</div>
                <div>Kembalikan semua kunci dan perlengkapan mobil</div>
            </div>
            
            <div class="checklist-item">
                <div class="checklist-icon">🚗</div>
                <div>Periksa kondisi body mobil (tidak ada kerusakan baru)</div>
            </div>
        </div>

        <!-- Catatan (jika ada) -->
        @if($pemesanan->catatan)
        <div class="section">
            <div class="section-title">📝 CATATAN TAMBAHAN</div>
            <p style="margin: 0; color: #4b5563;">{{ $pemesanan->catatan }}</p>
        </div>
        @endif

        <!-- Informasi Denda (Opsional) -->
        <div style="background-color: #fef2f2; border: 2px solid #fca5a5; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; color: #991b1b; font-size: 14px;">
                <strong>⚠️ PERHATIAN:</strong> Keterlambatan pengembalian akan dikenakan denda sebesar <strong>10% dari harga sewa per hari</strong> untuk setiap keterlambatan.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima kasih telah menggunakan layanan kami! 🙏</strong></p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                Email ini dikirim secara otomatis sebagai reminder pengembalian mobil.<br>
                Jika ada pertanyaan, hubungi kami segera.
            </p>
        </div>
    </div>
</body>
</html>