@extends('layouts.app_dashboard')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Barang</h1>
                <p class="text-gray-600">Create, edit, and manage village news articles</p>
            </div>
            <a href="{{ url('products/create') }}"
                class="bg-primary text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                Tambah Barang
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <!-- Section Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Barang</h2>
                <div class="flex gap-3">
                    <!-- Search -->
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchInput" placeholder="Cari..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- Status Filter -->
                    <select id="statusFilter"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="">All Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div>
            <table id="productTable" class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data will be populated by DataTables -->
                </tbody>
            </table>
        </div>

        <!-- Empty State (initially hidden) -->
        <div id="emptyState" class="text-center py-12 hidden">
            <div class="mb-4">
                <!-- Illustration placeholder -->
                <div class="mx-auto w-48 h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Masih Kosong Nih!</h3>
            <p class="text-gray-500 mb-6">Belum ada data produk di sini</p>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                Tambah Barang Baru
            </button>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        let editingId = null;
        let table;
        // Initialize DataTable
        $(document).ready(function() {
            table = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/products',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    data: function(d) {
                        // Add custom filters
                        d.status_filter = $('#statusFilter').val();
                        d.custom_search = $('#searchInput').val();
                        return d;
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTables AJAX Error:', xhr.responseText);
                        alert('Error loading data. Please check console for details.');
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                        className: "w-2/6",
                        render: function(data, type, row) {
                            return `<div class="font-medium text-gray-900 px-4 py-2">${data}</div>`;
                        }
                    },
                    {
                        data: 'author_name',
                        name: 'author_name',
                        className: "w-1/6",
                        render: function(data, type, row) {
                            return `<div class="font-medium text-gray-900 px-4 py-2">${data}</div>`;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: "w-1/6",
                        orderable: true,
                        render: function(data) {
                            return data;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: "w-1/6",
                        render: function(data) {
                            const statusConfig = {
                                'published': {
                                    class: 'bg-green-100 text-green-800',
                                    text: 'Published'
                                },
                                'draft': {
                                    class: 'bg-yellow-100 text-yellow-800',
                                    text: 'Draft'
                                },
                                'archived': {
                                    class: 'bg-gray-100 text-gray-800',
                                    text: 'Archived'
                                }
                            };
                            const config = statusConfig[data] || statusConfig['draft'];
                            return `<span class="px-2 py-1 text-xs font-medium rounded-full ${config.class}">${config.text}</span>`;
                        }
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        className: "w-1/6",
                        orderable: false,
                        searchable: false,
                    }
                ],
                dom: 't<"flex justify-between items-center mt-4 px-6 pb-4"<"flex items-center gap-2"li><"flex items-center gap-2"p>>',
                language: {
                    emptyTable: `
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <img src="/assets/img/empty_data.png" alt="Empty" class="w-60 h-40 mb-6" />
                        <h3 class="text-lg font-semibold text-gray-700">Masih Kosong Nih!</h3>
                        <p class="text-sm text-gray-500 mt-2">Belum ada data produk di sini.<br>
                        Klik tombol di bawah untuk mulai menambahkan produk pertamamu.</p>
                    </div>`,
                    zeroRecords: `
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <img src="/assets/img/empty_data.png" alt="Empty" class="w-60 h-40 mb-6" />
                        <h3 class="text-lg font-semibold text-gray-700">Masih Kosong Nih!</h3>
                        <p class="text-sm text-gray-500 mt-2">Belum ada data produk di sini.<br>
                        Klik tombol di bawah untuk mulai menambahkan produk pertamamu.</p>
                    </div>`,
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                    infoFiltered: "(difilter dari _MAX_ total entri)",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    search: "Cari:",
                    loadingRecords: `<div class="px-4 py-2 text-gray-600 text-sm text-center">Memuat...</div>`,
                },
                pageLength: 10,
                responsive: true,
                createdRow: function(row, data, dataIndex) {
                    $('td', row).addClass('px-4 py-2'); // Tambahkan padding Tailwind
                    $(row).addClass('hover:bg-gray-50 transition-colors');
                },
                drawCallback: function() {
                    // Custom pagination styling
                    $('.dataTables_paginate .paginate_button').addClass(
                        'px-3 py-2 mx-1 border rounded-lg hover:bg-gray-50 transition-colors');
                    $('.dataTables_paginate .paginate_button.current').addClass(
                        'bg-blue-600 text-white border-blue-600 hover:bg-blue-700');
                }
            });

            // Custom search
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Status filter
            $('#statusFilter').on('change', function() {
                const value = this.value;
                if (value) {
                    table.column(3).search(value).draw();
                } else {
                    table.column(3).search('').draw();
                }
            });
        });

        $(document).on('click', '.btn-delete', function() {
            const productId = $(this).data('id');

            Swal.fire({
                title: 'Hapus Konten?',
                text: 'Apakah Anda yakin ingin menghapus barang ini? Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'border border-red-500 text-red-500 hover:bg-red-100 px-6 py-2 rounded-md w-full order-2',
                    cancelButton: 'bg-red-500 text-white hover:bg-red-600 px-6 py-2 rounded-md w-full order-1 mt-2',
                    actions: 'flex flex-col-reverse gap-2 mt-4 items-stretch'
                },
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: () => {
                    Swal.showLoading(); // Munculkan spinner
                    let _url = "{{ url('products/delete/') }}/" + productId;
                    return fetch(_url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}' // untuk Blade, atau ganti manual jika pakai JS murni
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Gagal menghapus');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Sukses, tampilkan pesan atau reload tabel
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Barang berhasil dihapus.',
                                timer: 2000,
                                showConfirmButton: false,
                            });

                            // Refresh data tabel jika pakai DataTables
                            $('#productTable').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            Swal.showValidationMessage(error.message);
                        });
                }
            });

        });
    </script>
@endpush
