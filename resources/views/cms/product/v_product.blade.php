@extends('layouts.app_dashboard')

@section('content')
    <!-- Header -->
    <div class="mb-4 md:mb-6 px-2 md:px-0">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-1">Kelola Barang</h1>
                <p class="text-xs md:text-sm text-gray-600">Create, edit, and manage village products</p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ url('dashboard/products/create') }}"
                    class="w-full md:w-auto bg-primary text-white px-3 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors hover:bg-primary/90 text-sm">
                    <span>Tambah Barang</span>
                    <i class="fas fa-plus text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mx-2 md:mx-0">
        <!-- Section Header -->
        <div class="p-3 md:p-4 border-b border-gray-200">
            <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0">
                <h2 class="text-lg font-semibold text-gray-900">Barang</h2>
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                    <!-- Search -->
                    <div class="relative">
                        <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" id="searchInput" placeholder="Cari..."
                            class="w-full sm:w-auto pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <!-- Status Filter -->
                    <select id="statusFilter"
                        class="w-full sm:w-auto px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white">
                        <option value="">All Status</option>
                        <option value="ready">Ready</option>
                        <option value="sold">Sold</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table id="productTable" class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product Name
                        </th>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Creator
                        </th>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date Created
                        </th>
                        <th class="px-3 md:px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-3 md:px-4 py-3">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                         class="w-10 h-10 rounded-lg object-cover">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">{{ $product->name }}</h3>
                                        <p class="text-xs text-gray-500">{{ Str::limit($product->description, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 md:px-4 py-3 text-sm text-gray-900">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-3 md:px-4 py-3 text-sm text-gray-900">
                                {{ $product->seller_name ?? 'N/A' }}
                            </td>
                            <td class="px-3 md:px-4 py-3">
                                @if($product->status == 'ready')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Ready
                                    </span>
                                @elseif($product->status == 'habis')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Habis
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 md:px-4 py-3 text-sm text-gray-500">
                                {{ $product->created_at->format('d M Y') }}
                            </td>
                            <td class="px-3 md:px-4 py-3 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ url('dashboard/products/edit', $product->id) }}"
                                       class="bg-blue-700 hover:bg-blue-800 text-white text-xs font-medium px-2 py-1 rounded transition-colors">
                                        Edit
                                    </a>
                                    <button type="button" class="btn-delete bg-red-600 hover:bg-red-700 text-white text-xs font-medium px-2 py-1 rounded transition-colors"
                                            data-id="{{ $product->id }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
                    url: '/dashboard/products',
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
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                        className: "w-2/6",
                        render: function(data, type, row) {
                            let imageUrl = row.image_path ? `{{ asset('storage/') }}/${row.image_path}` : '/assets/img/default-product.jpg';
                            return `
                                <div class="flex items-center space-x-3">
                                    <img src="${imageUrl}" alt="${data}" class="w-10 h-10 rounded-lg object-cover">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">${data}</h3>
                                        <p class="text-xs text-gray-500">${row.description ? row.description.substring(0, 50) + '...' : ''}</p>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'price',
                        name: 'price',
                        className: "w-1/6",
                        render: function(data, type, row) {
                            return `<div class="text-sm text-gray-900">Rp${new Intl.NumberFormat('id-ID').format(data)}</div>`;
                        }
                    },
                    {
                        data: 'seller_name',
                        name: 'seller_name',
                        className: "w-1/6",
                        render: function(data, type, row) {
                            return `<div class="text-sm text-gray-900">${data || 'N/A'}</div>`;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: "w-1/6",
                        render: function(data) {
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
                                    class: 'bg-yellow-100 text-yellow-800',
                                    text: 'Pre-Order'
                                }
                            };
                            const config = statusConfig[data] || statusConfig['ready'];
                            return `<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${config.class}">${config.text}</span>`;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: "w-1/6",
                        orderable: true,
                        render: function(data) {
                            const date = new Date(data);
                            const day = date.getDate();
                            const monthNames = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                            const month = monthNames[date.getMonth()];
                            const year = date.getFullYear();

                            const hours = String(date.getHours()).padStart(2, '0');
                            const minutes = String(date.getMinutes()).padStart(2, '0');

                            return `<div class="text-sm text-gray-500">${hours}:${minutes} ${day} ${month} ${year}</div>`;
                        }
                    },
                    {
                        data: 'id',
                        name: 'actions',
                        className: "w-1/6 text-center",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="${window.location.origin}/dashboard/products/edit/${data}"
                                       class="inline-flex items-center justify-center text-gray-900 hover:text-blue-700 text-lg p-1 focus:outline-none" title="Edit">
                                         <i class="fas fa-edit"></i>
                                     </a>
                                    <button type="button" class="btn-delete inline-flex items-center justify-center text-red-600 hover:text-red-800 text-lg p-1 focus:outline-none" data-id="${data}" title="Hapus">
                                         <i class="fas fa-trash-alt"></i>
                                     </button>
                                </div>
                            `;
                        }
                    }
                ],
                dom: 't<"flex flex-col sm:flex-row justify-between items-center mt-4 px-3 md:px-4 pb-4 space-y-3 sm:space-y-0"<"flex items-center gap-2"li><"flex items-center gap-2"p>>',
                language: {
                  emptyTable: `
                  <div class="flex flex-col items-center justify-center py-8 text-center">
                      <img src="/assets/img/empty_data.png" alt="Empty" class="w-40 h-28 mb-4" />
                      <h3 class="text-base font-semibold text-gray-700">Masih Kosong Nih!</h3>
                      <p class="text-sm text-gray-500 mt-2">Belum ada data produk di sini.<br>
                      Klik tombol di bawah untuk mulai menambahkan produk pertamamu.</p>
                  </div>`,
                  zeroRecords: `
                  <div class="flex flex-col items-center justify-center py-8 text-center">
                      <img src="/assets/img/empty_data.png" alt="Empty" class="w-40 h-28 mb-4" />
                      <h3 class="text-base font-semibold text-gray-700">Masih Kosong Nih!</h3>
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
                    $('td', row).addClass('px-3 md:px-4 py-2 text-sm'); // Tambahkan padding Tailwind yang lebih kecil
                    $(row).addClass('hover:bg-gray-50 transition-colors');
                },
                drawCallback: function() {
                    // Custom pagination styling
                    $('.dataTables_info').addClass('text-xs text-gray-600');
                    $('.dataTables_length select').addClass('text-sm');
                    $('.dataTables_paginate .paginate_button').addClass(
                        'px-3 py-2 mx-1 border rounded-lg hover:bg-gray-50 transition-colors text-sm');
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
                    let _url = "{{ url('dashboard/products/delete/') }}/" + productId;
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
