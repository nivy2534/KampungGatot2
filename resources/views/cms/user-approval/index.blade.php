@extends('layouts.app_dashboard')

@section('content')
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-check text-[#1B3A6D] text-sm"></i>
            </div>
            <div>
                <h1 class="text-xl font-semibold text-gray-900">Persetujuan Pengguna</h1>
                <p class="text-sm text-gray-500">Kelola permintaan registrasi pengguna baru</p>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                <i class="fas fa-clock mr-1"></i>
                {{ count($users) }} Menunggu
            </span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-clock text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-orange-900">Pending</p>
                    <p class="text-lg font-bold text-orange-900">{{ count($users) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-check text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-green-900">Disetujui</p>
                    <p class="text-lg font-bold text-green-900" id="approvedCount">0</p>
                </div>
            </div>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-times text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-red-900">Ditolak</p>
                    <p class="text-lg font-bold text-red-900" id="rejectedCount">0</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    @if(count($users) > 0)
        <!-- Table Section -->
        <div class="overflow-hidden">
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-list text-gray-400"></i>
                    <h3 class="text-sm font-semibold text-gray-900">Daftar Permintaan Registrasi</h3>
                </div>
                <div class="text-xs text-gray-500">
                    Total {{ count($users) }} permintaan
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengguna
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Daftar
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="usersTableBody">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors" id="user-row-{{ $user['id'] }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-[#1B3A6D]/10 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-[#1B3A6D] text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user['name'] }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $user['id'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user['email'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($user['created_at'])->format('d M Y H:i') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($user['created_at'])->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    Menunggu
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button type="button"
                                            class="approve-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors"
                                            data-user-id="{{ $user['id'] }}"
                                            data-user-name="{{ $user['name'] }}">
                                        <i class="fas fa-check mr-1"></i>
                                        Setujui
                                    </button>
                                    <button type="button"
                                            class="reject-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                            data-user-id="{{ $user['id'] }}"
                                            data-user-name="{{ $user['name'] }}">
                                        <i class="fas fa-times mr-1"></i>
                                        Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-check text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Permintaan</h3>
            <p class="text-gray-500 mb-4">Saat ini tidak ada permintaan registrasi yang menunggu persetujuan.</p>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 max-w-md mx-auto">
                <div class="flex items-start space-x-2">
                    <div class="w-4 h-4 bg-blue-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                        <i class="fas fa-info text-white text-xs"></i>
                    </div>
                    <div class="text-xs text-blue-700">
                        <p class="font-medium mb-1">Informasi:</p>
                        <p>Permintaan registrasi baru akan muncul di sini dan membutuhkan persetujuan Anda sebelum pengguna dapat mengakses sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <i class="fas fa-times text-red-600"></i>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="rejectModalTitle">
                        Tolak Permintaan Registrasi
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" id="rejectModalContent">
                            Apakah Anda yakin ingin menolak permintaan registrasi dari <span id="rejectUserName" class="font-medium"></span>?
                        </p>
                        <div class="mt-4">
                            <label for="rejectionReason" class="block text-sm font-medium text-gray-700 mb-2">
                                Alasan Penolakan (Opsional)
                            </label>
                            <textarea id="rejectionReason"
                                      rows="3"
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                      placeholder="Masukkan alasan penolakan..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button"
                        id="confirmRejectBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    <i class="fas fa-times mr-2"></i>
                    Tolak
                </button>
                <button type="button"
                        id="cancelRejectBtn"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B3A6D] sm:mt-0 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    let currentUserId = null;

    // Approve user
    $(document).on('click', '.approve-btn', function() {
        const userId = $(this).data('user-id');
        const userName = $(this).data('user-name');

        Swal.fire({
            title: 'Setujui Permintaan',
            text: `Apakah Anda yakin ingin menyetujui permintaan registrasi dari ${userName}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg mr-2 font-medium',
                cancelButton: 'bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-medium'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                approveUser(userId, userName);
            }
        });
    });

    // Reject user - show modal
    $(document).on('click', '.reject-btn', function() {
        currentUserId = $(this).data('user-id');
        const userName = $(this).data('user-name');

        $('#rejectUserName').text(userName);
        $('#rejectionReason').val('');
        $('#rejectModal').removeClass('hidden');
    });

    // Cancel reject modal
    $('#cancelRejectBtn').click(function() {
        $('#rejectModal').addClass('hidden');
        currentUserId = null;
    });

    // Confirm reject
    $('#confirmRejectBtn').click(function() {
        if (currentUserId) {
            const reason = $('#rejectionReason').val().trim();
            rejectUser(currentUserId, reason);
        }
    });

    // Close modal when clicking outside
    $('#rejectModal').click(function(e) {
        if (e.target === this) {
            $('#rejectModal').addClass('hidden');
            currentUserId = null;
        }
    });

    function approveUser(userId, userName) {
        // Show loading state
        const button = $(`.approve-btn[data-user-id="${userId}"]`);
        const originalText = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Memproses...');

        $.ajax({
            url: `/dashboard/user-approval/${userId}/approve`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    // Remove row with animation
                    $(`#user-row-${userId}`).fadeOut(300, function() {
                        $(this).remove();
                        updateStats();
                        checkEmptyState();
                    });

                    // Show success message
                    Swal.fire({
                        title: 'Berhasil!',
                        text: `Permintaan registrasi dari ${userName} telah disetujui.`,
                        icon: 'success',
                        timer: 3000,
                        customClass: {
                            confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                        },
                        buttonsStyling: false
                    });
                } else {
                    throw new Error(response.message || 'Terjadi kesalahan');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                button.prop('disabled', false).html(originalText);

                let errorMessage = 'Terjadi kesalahan saat menyetujui permintaan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    title: 'Gagal!',
                    text: errorMessage,
                    icon: 'error',
                    customClass: {
                        confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                    },
                    buttonsStyling: false
                });
            }
        });
    }

    function rejectUser(userId, reason) {
        const userName = $('#rejectUserName').text();

        // Show loading state
        $('#confirmRejectBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...');

        $.ajax({
            url: `/dashboard/user-approval/${userId}/reject`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                reason: reason
            }),
            success: function(response) {
                if (response.success) {
                    // Hide modal
                    $('#rejectModal').addClass('hidden');

                    // Remove row with animation
                    $(`#user-row-${userId}`).fadeOut(300, function() {
                        $(this).remove();
                        updateStats();
                        checkEmptyState();
                    });

                    // Show success message
                    Swal.fire({
                        title: 'Berhasil!',
                        text: `Permintaan registrasi dari ${userName} telah ditolak.`,
                        icon: 'success',
                        timer: 3000,
                        customClass: {
                            confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                        },
                        buttonsStyling: false
                    });
                } else {
                    throw new Error(response.message || 'Terjadi kesalahan');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                $('#confirmRejectBtn').prop('disabled', false).html('<i class="fas fa-times mr-2"></i>Tolak');

                let errorMessage = 'Terjadi kesalahan saat menolak permintaan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    title: 'Gagal!',
                    text: errorMessage,
                    icon: 'error',
                    customClass: {
                        confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                    },
                    buttonsStyling: false
                });
            },
            complete: function() {
                currentUserId = null;
                $('#confirmRejectBtn').prop('disabled', false).html('<i class="fas fa-times mr-2"></i>Tolak');
            }
        });
    }

    function updateStats() {
        const pendingCount = $('#usersTableBody tr').length;
        $('.bg-orange-50 .text-lg').text(pendingCount);
        $('.inline-flex.bg-orange-100 .text-xs').text(`${pendingCount} Menunggu`);
    }

    function checkEmptyState() {
        if ($('#usersTableBody tr').length === 0) {
            // Reload page to show empty state
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    }

    // Auto refresh every 30 seconds
    setInterval(function() {
        // Only refresh if there are pending users
        if ($('#usersTableBody tr').length > 0) {
            window.location.reload();
        }
    }, 30000);
});
</script>
@endpush
