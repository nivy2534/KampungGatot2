@extends('layouts.app_dashboard')

@section('content')
    <!-- Header -->
    <div class="mb-4 md:mb-6 px-2 md:px-0">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-1">Kelola Katalog</h1>
                <p class="text-xs md:text-sm text-gray-600">Buat, edit, dan kelola katalog produk & event desa</p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ url('dashboard/catalogs/create') }}"
                    class="w-full md:w-auto bg-primary text-white px-3 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors hover:bg-primary/90 text-sm font-medium">
                    <span>Tambah Katalog</span>
                    <i class="fas fa-plus text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mx-2 md:mx-0">
        <!-- Section Header -->
        <div class="p-3 md:p-4 border-b border-gray-200">
            <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0">
                <h2 class="text-lg font-semibold text-gray-900">Daftar Produk</h2>
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                    <!-- Search -->
                    <div class="relative">
                        <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" id="searchInput" placeholder="Cari produk..."
                            class="w-full sm:w-auto pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                    </div>
                    <!-- Status Filter -->
                    <select id="statusFilter"
                        class="w-full sm:w-auto px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none bg-white">
                        <option value="">Semua Status</option>
                        <option value="ready">Ready</option>
                        <option value="habis">Habis</option>
                        <option value="preorder">Pre-Order</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="productTable" class="w-full table-auto min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Produk
                        </th>
                        <th class="hidden md:table-cell px-3 md:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Harga
                        </th>
                        <th class="hidden sm:table-cell px-3 md:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Penjual
                        </th>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-3 md:px-4 py-3 text-sm">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-lg object-cover border border-gray-200" 
                                             src="{{ $product->image_url ? asset($product->image_url) : '/assets/img/belanja.png' }}" 
                                             alt="{{ $product->name }}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Str::limit($product->description, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-3 md:px-4 py-3 text-sm">
                                <span class="text-sm font-medium text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </td>
                            <td class="hidden sm:table-cell px-3 md:px-4 py-3 text-sm">
                                <span class="text-sm text-gray-700">{{ $product->seller_name }}</span>
                            </td>
                            <td class="px-3 md:px-4 py-3 text-sm">
                                @php
                                    $typeConfig = [
                                        'produk' => ['class' => 'bg-green-100 text-green-800', 'text' => 'Produk'],
                                        'event' => ['class' => 'bg-blue-100 text-blue-800', 'text' => 'Event'],
                                    ];
                                    $config = $typeConfig[$product->type] ?? $typeConfig['produk'];
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $config['class'] }}">
                                    {{ $config['text'] }}
                                </span>
                            </td>
                            <td class="px-3 md:px-4 py-3 text-sm">
                                <div class="flex gap-1">
                                    <a href="{{ route('catalogs.edit', $product->id) }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium px-2 py-1 rounded transition-colors">
                                        Edit
                                    </a>
                                    <button type="button" class="btn-delete bg-red-600 hover:bg-red-700 text-white text-xs font-medium px-2 py-1 rounded transition-colors"
                                            data-id="{{ $product->id }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <img src="/assets/img/empty_data.png" alt="Empty" class="w-32 h-24 opacity-60 mb-4" />
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Produk</h3>
                                    <p class="text-sm text-gray-500 mb-6">Mulai menambahkan produk pertama Anda untuk dipajang di website desa.</p>
                                    <a href="{{ url('dashboard/products/create') }}" 
                                       class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg transition-colors text-sm font-medium">
                                        <i class="fas fa-plus text-xs"></i>
                                        <span>Tambah Produk Pertama</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('addon-script')
    <!-- DataTables CSS dan JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let editingId = null;
        let table;

        // Initialize DataTable
        $(document).ready(function() {
            table = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/dashboard/catalogs',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    data: function(d) {
                        d.status_filter = $('#statusFilter').val();
                        d.custom_search = $('#searchInput').val();
                        return d;
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTables AJAX Error:', xhr.responseText);
                        alert('Error loading data. Please check console for details.');
                    }
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                        className: "w-2/6",
                        render: function(data, type, row) {
                            const imageUrl = row.image_url ? row.image_url : '/assets/img/belanja.png';
                            const description = row.description ? row.description.substring(0, 50) + '...' : '';
                            return `
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-lg object-cover border border-gray-200" 
                                             src="${imageUrl}" alt="${data}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">${data}</p>
                                        <p class="text-xs text-gray-500 truncate">${description}</p>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'price',
                        name: 'price',
                        className: "hidden md:table-cell w-1/6",
                        render: function(data, type, row) {
                            return `<span class="text-sm font-medium text-gray-900">Rp ${new Intl.NumberFormat('id-ID').format(data)}</span>`;
                        }
                    },
                    {
                        data: 'seller_name',
                        name: 'seller_name',
                        className: "hidden sm:table-cell w-1/6",
                        render: function(data, type, row) {
                            return `<span class="text-sm text-gray-700">${data}</span>`;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: "w-1/6",
                        render: function(data, type, row) {
                            const statusConfig = {
                                'ready': {
                                    class: 'bg-green-100 text-green-800',
                                    text: 'Ready'
                                },
                                'habis': {
                                    class: 'bg-red-100 text-red-800',
                                    text: 'Habis'
                                },
                                'preorder': {
                                    class: 'bg-blue-100 text-blue-800',
                                    text: 'Pre-Order'
                                }
                            };
                            const config = statusConfig[data] || statusConfig['ready'];
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
                dom: 't<"flex justify-between items-center mt-3 px-3 md:px-4 pb-3"<"flex items-center gap-2"li><"flex items-center gap-2"p>>',
                language: {
                    emptyTable: `
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <img src="/assets/img/empty_data.png" alt="Empty" class="w-32 h-24 opacity-60 mb-4" />
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Produk</h3>
                        <p class="text-sm text-gray-500 mb-6">Mulai menambahkan produk pertama Anda untuk dipajang di website desa.</p>
                    </div>`,
                    zeroRecords: `
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <img src="/assets/img/empty_data.png" alt="Empty" class="w-32 h-24 opacity-60 mb-4" />
                        <h3 class="text-base font-semibold text-gray-700">Tidak ditemukan</h3>
                        <p class="text-sm text-gray-500 mt-2">Coba ubah kata kunci pencarian Anda.</p>
                    </div>`,
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                    infoFiltered: "(difilter dari _MAX_ total entri)",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    search: "Cari:",
                    loadingRecords: `<div class="px-3 py-2 text-gray-600 text-sm text-center">Memuat...</div>`,
                },
                pageLength: 10,
                responsive: true,
                createdRow: function(row, data, dataIndex) {
                    $('td', row).addClass('px-3 md:px-4 py-3 text-sm');
                    $(row).addClass('hover:bg-gray-50 transition-colors');
                },
                drawCallback: function() {
                    $('.dataTables_paginate .paginate_button').addClass(
                        'px-2 py-1 mx-0.5 border rounded text-sm hover:bg-gray-50 transition-colors');
                    $('.dataTables_paginate .paginate_button.current').addClass(
                        'bg-primary text-white border-primary hover:bg-primary');
                    
                    $('.dataTables_info').addClass('text-xs text-gray-600');
                    $('.dataTables_length select').addClass('text-sm border border-gray-300 rounded px-2 py-1');
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
                title: 'Hapus Produk?',
                text: 'Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.',
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
                    Swal.showLoading();
                    let _url = "{{ url('dashboard/catalogs/delete/') }}/" + productId;

                    return fetch(_url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }
                        return response.json();
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Produk telah dihapus.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'bg-primary text-white hover:bg-primary/90 px-6 py-2 rounded-md'
                        }
                    });
                    table.ajax.reload();
                }
            });
        });
    </script>
@endpush
