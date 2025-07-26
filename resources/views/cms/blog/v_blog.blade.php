@extends('layouts.app_dashboard')

@section('content')
    <!-- Header -->
    <div class="mb-4 md:mb-6 px-2 md:px-0">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-1">Kelola Blog</h1>
                <p class="text-xs md:text-sm text-gray-600">Buat, edit, dan kelola artikel berita desa</p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ url('dashboard/blogs/create') }}"
                    class="w-full md:w-auto bg-primary text-white px-3 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors hover:bg-primary/90 text-sm font-medium">
                    <span>Tambah Blog</span>
                    <i class="fas fa-plus text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mx-2 md:mx-0">
        <!-- Section Header -->
        <div class="p-3 md:p-4 border-b border-gray-200">
            <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0">
                <h2 class="text-lg font-semibold text-gray-900">Daftar Artikel</h2>
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                    <!-- Search -->
                    <div class="relative">
                        <i class="fas fa-search absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" id="searchInput" placeholder="Cari artikel..."
                            class="w-full sm:w-auto pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                    </div>
                    <!-- Status Filter -->
                    <select id="statusFilter"
                        class="w-full sm:w-auto px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none bg-white">
                        <option value="">Semua Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Container with horizontal scroll -->
        <div class="overflow-x-auto">
            <table id="blogTable" class="w-full table-auto min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 md:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Judul
                        </th>
                        <th class="hidden sm:table-cell px-3 md:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Penulis
                        </th>
                        <th class="hidden md:table-cell px-3 md:px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Tanggal
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
                    <!-- Data will be populated by DataTables -->
                </tbody>
            </table>
        </div>

        <!-- Empty State (initially hidden) -->
        <div id="emptyState" class="text-center py-12 hidden">
            <div class="mb-4 flex justify-center">
                <img src="/assets/img/empty_data.png" alt="Empty" class="w-32 h-24 opacity-60" />
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Artikel</h3>
            <p class="text-sm text-gray-500 mb-6">Mulai menulis artikel pertama Anda untuk berbagi cerita dengan warga desa.</p>
            <a href="{{ url('dashboard/blogs/create') }}" 
               class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg transition-colors text-sm font-medium">
                <i class="fas fa-plus text-xs"></i>
                <span>Tulis Artikel Pertama</span>
            </a>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        let editingId = null;
        let table;
        // Initialize DataTable
        $(document).ready(function() {
            table = $('#blogTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/dashboard/blogs',
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
                            return `<div class="font-medium text-gray-900 text-sm">${data}</div>`;
                        }
                    },
                    {
                        data: 'author_name',
                        name: 'author_name',
                        className: "w-1/6",
                        render: function(data, type, row) {
                            return `<div class="font-medium text-gray-900 text-sm">${data}</div>`;
                        }
                    },
                    {
                        data: 'date',
                        name: 'date',
                        className: "w-1/6",
                        orderable: true,
                        render: function(data) {
                            return `<span class="text-sm text-gray-600">${data}</span>`;
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
                dom: 't<"flex justify-between items-center mt-3 px-3 md:px-4 pb-3"<"flex items-center gap-2"li><"flex items-center gap-2"p>>',
                language: {
                    emptyTable: `
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <img src="/assets/img/empty_data.png" alt="Empty" class="w-40 h-28 mb-4" />
                        <h3 class="text-base font-semibold text-gray-700">Masih Kosong Nih!</h3>
                        <p class="text-sm text-gray-500 mt-2">Belum ada data blog di sini.<br>
                        Klik tombol di atas untuk mulai menambahkan blog pertamamu.</p>
                    </div>`,
                    zeroRecords: `
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <img src="/assets/img/empty_data.png" alt="Empty" class="w-40 h-28 mb-4" />
                        <h3 class="text-base font-semibold text-gray-700">Masih Kosong Nih!</h3>
                        <p class="text-sm text-gray-500 mt-2">Belum ada data blog di sini.<br>
                        Klik tombol di atas untuk mulai menambahkan blog pertamamu.</p>
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
                    $('td', row).addClass('px-3 md:px-4 py-2 text-sm'); // Tambahkan padding Tailwind yang lebih kecil
                    $(row).addClass('hover:bg-gray-50 transition-colors');
                },
                drawCallback: function() {
                    // Custom pagination styling dengan ukuran lebih kecil
                    $('.dataTables_paginate .paginate_button').addClass(
                        'px-2 py-1 mx-0.5 border rounded text-sm hover:bg-gray-50 transition-colors');
                    $('.dataTables_paginate .paginate_button.current').addClass(
                        'bg-primary text-white border-primary hover:bg-primary');
                    
                    // Style info dan length menu
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
            const blogId = $(this).data('id');

            Swal.fire({
                title: 'Hapus Konten?',
                text: 'Apakah Anda yakin ingin menghapus blog ini? Tindakan ini tidak dapat dibatalkan.',
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
                    let _url = "{{ url('dashboard/blogs/delete/') }}/" + blogId;
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
                                text: 'Blog berhasil dihapus.',
                                timer: 2000,
                                showConfirmButton: false,
                            });

                            // Refresh data tabel jika pakai DataTables
                            $('#blogTable').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            Swal.showValidationMessage(error.message);
                        });
                }
            });

        });
    </script>
@endpush
