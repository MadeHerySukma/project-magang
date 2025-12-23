<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan</title>
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
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
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
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            margin: 10px 0;
        }
        .status-confirmed { background-color: #10b981; color: white; }
        .status-paid { background-color: #3b82f6; color: white; }
        .status-active { background-color: #8b5cf6; color: white; }
        .status-pending { background-color: #f59e0b; color: white; }
        .status-completed { background-color: #6b7280; color: white; }
        .status-cancelled { background-color: #ef4444; color: white; }
        .section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8fafc;
            border-left: 4px solid #3b82f6;
            border-radius: 5px;
        }
        .section-title {
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
            font-size: 16px;
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
        .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #10b981;
            text-align: center;
            padding: 15px;
            background-color: #f0fdf4;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .car-info {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .car-name {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        .note {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px;
            border-radius: 5px;
            margin: 15px 0;
        }
    </style>
</head>
<strong>English</strong>
<body>
    <div class="container">
        <div class="header">
            <h1>🚗 CAR RENTAL BOOKING CONFIRMATION</h1>
        </div>

        <p>Dear <strong>{{ $pemesanan->nama_lengkap }}</strong>,</p>
        <p>Below are the details of your booking:</p>

        @php
        $statusLabelsEn = [
                'pending'   => '<span class="status-badge status-pending">⏳ Pending Payment</span>',
                'paid'      => '<span class="status-badge status-paid">💳 Awaiting Confirmation</span>',
                'confirmed' => '<span class="status-badge status-confirmed">✓ Confirmed</span>',
                'active'    => '<span class="status-badge status-active">🚗 In Progress</span>',
                'completed' => '<span class="status-badge status-completed">✓ Completed</span>',
                'cancelled' => '<span class="status-badge status-cancelled">✗ Cancelled</span>',
            ];
        @endphp


        <!-- Booking Code & Status -->
        <!-- Booking Code & Status -->
        <div style="text-align: center; margin: 20px 0;">
            <div style="font-size: 18px; color: #6b7280;">Booking Code</div>
            <div style="font-size: 32px; font-weight: bold; color: #1e40af;">
                #{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}
            </div>
            <div style="margin-top: 10px;">
                {!! $statusLabelsEn[$pemesanan->status] ?? '-' !!}
            </div>
        </div>


        @if($pemesanan->status === 'confirmed')
        <div class="note">
            <strong>✅ Status: Confirmed!</strong><br>
            Your payment has been confirmed. Please pick up the car according to the scheduled time.
        </div>
        @endif

        <!-- Car Details -->
        <div class="section">
            <div class="section-title">🚗 CAR DETAILS</div>
            <div class="car-info">
                <div class="car-name">{{ $pemesanan->mobil->merek }} {{ $pemesanan->mobil->model }}</div>
                <div style="color: #6b7280;">
                    <strong>License Plate:</strong> {{ $pemesanan->mobil->plat_nomor }} | 
                    <strong>Type:</strong> {{ $pemesanan->mobil->tipe }}
                </div>
            </div>
            <div class="detail-row">
                <span class="detail-label">Rental Period</span>
                <span class="detail-value">{{ $pemesanan->tanggal_mulai->format('d M') }} - {{ $pemesanan->tanggal_selesai->format('d M Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Duration</span>
                <span class="detail-value">{{ $pemesanan->durasi }} Days</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Price per Day</span>
                <span class="detail-value">{{ $pemesanan->harga_per_hari_format }}</span>
            </div>
        </div>

        <!-- Total Price -->
        <div class="total-price">
            Total Cost: {{ $pemesanan->total_harga_format }}
        </div>

        <!-- Renter Information -->
        <div class="section">
            <div class="section-title">📞 RENTER INFORMATION</div>
            <div class="detail-row">
                <span class="detail-label">Full Name</span>
                <span class="detail-value">{{ $pemesanan->nama_lengkap }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">ID Number</span>
                <span class="detail-value">{{ $pemesanan->nik }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Phone Number</span>
                <span class="detail-value">{{ $pemesanan->no_telepon }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Address</span>
                <span class="detail-value">{{ $pemesanan->alamat }}</span>
            </div>
        </div>

        <!-- Payment -->
        @if($pemesanan->metode_pembayaran)
        <div class="section">
            <div class="section-title">💳 PAYMENT</div>
            <div class="detail-row">
                <span class="detail-label">Method</span>
                <span class="detail-value">{{ strtoupper($pemesanan->metode_pembayaran) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    @if(in_array($pemesanan->status, ['paid', 'confirmed', 'active', 'completed']))
                        <span style="color: #10b981;">✅ Paid</span>
                    @else
                        <span style="color: #f59e0b;">⏳ Pending Payment</span>
                    @endif
                </span>
            </div>
        </div>
        @endif

        <!-- Notes -->
        @if($pemesanan->catatan)
        <div class="section">
            <div class="section-title">📝 NOTES</div>
            <p style="margin: 0; color: #4b5563;">{{ $pemesanan->catatan }}</p>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank you for using our service! 🙏</strong></p>
            <p style="margin-top: 10px; font-size: 12px;">
                This email was sent automatically. Please do not reply to this email.<br>
                If you have any questions, please contact us at 081234567890
            </p>
        </div>
    </div>
</body>
<br><br> <strong>Bahasa Indonesia</strong>
<body>
    <div class="container">
        <div class="header">
            <h1>🚗 KONFIRMASI PEMESANAN RENTAL MOBIL</h1>
        </div>

        <p>Yth. <strong>{{ $pemesanan->nama_lengkap }}</strong>,</p>
        <p>Berikut adalah detail pemesanan Anda:</p>

        <!-- Kode & Status -->
        <div style="text-align: center; margin: 20px 0;">
            <div style="font-size: 18px; color: #6b7280;">Kode Pemesanan</div>
            <div style="font-size: 32px; font-weight: bold; color: #1e40af;">
                #{{ str_pad($pemesanan->id, 6, '0', STR_PAD_LEFT) }}
            </div>
            <div style="margin-top: 10px;">
                @php
                    $statusClass = 'status-' . $pemesanan->status;
                @endphp
                <span class="status-badge {{ $statusClass }}">
                    {{ $pemesanan->status_text }}
                </span>
            </div>
        </div>

        @if($pemesanan->status === 'confirmed')
        <div class="note">
            <strong>✅ Status: Dikonfirmasi!</strong><br>
            Pembayaran Anda telah dikonfirmasi. Silakan ambil mobil sesuai jadwal yang telah ditentukan.
        </div>
        @endif

        <!-- Detail Mobil -->
        <div class="section">
            <div class="section-title">🚗 DETAIL MOBIL</div>
            <div class="car-info">
                <div class="car-name">{{ $pemesanan->mobil->merek }} {{ $pemesanan->mobil->model }}</div>
                <div style="color: #6b7280;">
                    <strong>Plat Nomor:</strong> {{ $pemesanan->mobil->plat_nomor }} | 
                    <strong>Tipe:</strong> {{ $pemesanan->mobil->tipe }}
                </div>
            </div>
            <div class="detail-row">
                <span class="detail-label">Periode Sewa</span>
                <span class="detail-value">{{ $pemesanan->tanggal_mulai->format('d M') }} - {{ $pemesanan->tanggal_selesai->format('d M Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Durasi</span>
                <span class="detail-value">{{ $pemesanan->durasi }} Hari</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Harga per Hari</span>
                <span class="detail-value">{{ $pemesanan->harga_per_hari_format }}</span>
            </div>
        </div>

        <!-- Total Harga -->
        <div class="total-price">
            Total Biaya: {{ $pemesanan->total_harga_format }}
        </div>

        <!-- Informasi Penyewa -->
        <div class="section">
            <div class="section-title">📞 INFORMASI PENYEWA</div>
            <div class="detail-row">
                <span class="detail-label">Nama Lengkap</span>
                <span class="detail-value">{{ $pemesanan->nama_lengkap }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">NIK</span>
                <span class="detail-value">{{ $pemesanan->nik }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">No. Telepon</span>
                <span class="detail-value">{{ $pemesanan->no_telepon }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Alamat</span>
                <span class="detail-value">{{ $pemesanan->alamat }}</span>
            </div>
        </div>

        <!-- Pembayaran -->
        @if($pemesanan->metode_pembayaran)
        <div class="section">
            <div class="section-title">💳 PEMBAYARAN</div>
            <div class="detail-row">
                <span class="detail-label">Metode</span>
                <span class="detail-value">{{ strtoupper($pemesanan->metode_pembayaran) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    @if(in_array($pemesanan->status, ['paid', 'confirmed', 'active', 'completed']))
                        <span style="color: #10b981;">✅ Sudah Dibayar</span>
                    @else
                        <span style="color: #f59e0b;">⏳ Menunggu Pembayaran</span>
                    @endif
                </span>
            </div>
        </div>
        @endif

        <!-- Catatan -->
        @if($pemesanan->catatan)
        <div class="section">
            <div class="section-title">📝 CATATAN</div>
            <p style="margin: 0; color: #4b5563;">{{ $pemesanan->catatan }}</p>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima kasih telah menggunakan layanan kami! 🙏</strong></p>
            <p style="margin-top: 10px; font-size: 12px;">
                Email ini dikirim secara otomatis, mohon tidak membalas email ini.<br>
                Jika ada pertanyaan, hubungi kami di 081234567890
            </p>
        </div>
    </div>
</body>

</html>