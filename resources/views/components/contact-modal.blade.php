{{-- 
    COMPONENT: Contact Modal (FINAL FIXED VERSION)
    
    File Location: resources/views/components/contact-modal.blade.php
    
    PERBAIKAN: URL untuk pengembalian sekarang pakai '/send-whatsapp' bukan '/whatsapp'
--}}

<!-- Modal Overlay -->
<div id="contactModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <!-- Background Overlay -->
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeContactModal()"></div>
    
    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all animate-slideIn">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-t-2xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Pilih Nomor Kontak</h3>
                            <p class="text-green-100 text-sm">Hubungi via WhatsApp</p>
                        </div>
                    </div>
                    <button onclick="closeContactModal()" class="text-white hover:text-green-200 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Body -->
            <div class="p-6">
                <!-- Info Pemesanan -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center space-x-2 mb-2">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-bold text-blue-900" id="modalCustomerName">-</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-xs text-blue-700">Kode: <strong id="modalBookingCode">-</strong></span>
                    </div>
                </div>

                <!-- Pilihan Nomor -->
                <div class="space-y-3">
                    <!-- Nomor Utama -->
                    <a id="linkPrimary" href="#" target="_blank" class="block">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-xl p-4 transition-all transform hover:scale-105 shadow-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white text-xs font-semibold mb-0.5">📱 Nomor Utama</p>
                                        <p class="text-white text-lg font-bold" id="displayPrimary">-</p>
                                        <p class="text-green-100 text-xs">Nomor terdaftar di data user</p>
                                    </div>
                                </div>
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Nomor Alternatif -->
                    <a id="linkAlternative" href="#" target="_blank" class="block">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-xl p-4 transition-all transform hover:scale-105 shadow-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white text-xs font-semibold mb-0.5">📞 Nomor Alternatif</p>
                                        <p class="text-white text-lg font-bold" id="displayAlternative">-</p>
                                        <p class="text-blue-100 text-xs">Nomor kontak lainnya</p>
                                    </div>
                                </div>
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Info -->
                <div class="mt-4 bg-yellow-50 border border-yellow-300 rounded-lg p-3">
                    <div class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-xs text-yellow-800">
                            Klik salah satu nomor untuk membuka WhatsApp. Pesan akan otomatis terisi dengan detail pemesanan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 rounded-b-2xl p-4 flex justify-end">
                <button onclick="closeContactModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700 font-semibold text-sm transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
/**
 * Function: Show Contact Modal
 * 
 * ✅ FIXED: URL route untuk pengembalian sekarang benar
 * 
 * @param {number} pemesananId - ID pemesanan
 * @param {string} noPrimary - Nomor telepon utama
 * @param {string} noAlternatif - Nomor telepon alternatif
 * @param {string} namaPelanggan - Nama pelanggan
 * @param {string} kodePemesanan - Kode pemesanan (format: #000001)
 * @param {string} type - Tipe notifikasi: 'konfirmasi' atau 'reminder'
 */
function showContactModal(pemesananId, noPrimary, noAlternatif, namaPelanggan, kodePemesanan, type = 'konfirmasi') {
    // Set info pelanggan di modal
    document.getElementById('modalCustomerName').textContent = namaPelanggan;
    document.getElementById('modalBookingCode').textContent = kodePemesanan;
    document.getElementById('displayPrimary').textContent = noPrimary;
    
    // ✅ PERBAIKAN FINAL: URL SESUAI ROUTE
    let urlPrimary = '';
    if (type === 'konfirmasi') {
        // Route pemesanan: admin.pemesanan.whatsapp → /admin/pemesanan/{id}/whatsapp
        urlPrimary = `/admin/pemesanan/${pemesananId}/whatsapp`;
    } else if (type === 'reminder') {
        // Route pengembalian: admin.pengembalian.send-whatsapp → /admin/pengembalian/{id}/send-whatsapp
        urlPrimary = `/admin/pengembalian/${pemesananId}/send-whatsapp`;
    }
    document.getElementById('linkPrimary').href = urlPrimary;
    
    // Setup nomor alternatif jika ada
    const linkAlternative = document.getElementById('linkAlternative');
    if (noAlternatif) {
        document.getElementById('displayAlternative').textContent = noAlternatif;
        
        let urlAlternative = '';
        if (type === 'konfirmasi') {
            // Nomor alternatif untuk pemesanan
            urlAlternative = `/admin/pemesanan/${pemesananId}/whatsapp?phone=${encodeURIComponent(noAlternatif)}`;
        } else if (type === 'reminder') {
            // Nomor alternatif untuk pengembalian
            urlAlternative = `/admin/pengembalian/${pemesananId}/send-whatsapp?phone=${encodeURIComponent(noAlternatif)}`;
        }
        linkAlternative.href = urlAlternative;
        linkAlternative.classList.remove('hidden');
    } else {
        linkAlternative.classList.add('hidden');
    }
    
    // Show modal
    document.getElementById('contactModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeContactModal() {
    document.getElementById('contactModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeContactModal();
    }
});
</script>

<style>
@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animate-slideIn {
    animation: slideIn 0.3s ease-out;
}
</style>