<section id="event" class="py-12 px-6 bg-gray-50">
    <div class="container mx-auto max-w-7xl">
        {{-- Header: Title + Filter --}}
        <div class="mb-8 px-2">
            {{-- Title --}}
            <div class="mb-4">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">
                    Event Kampung Gatot
                </h2>
                <p class="text-base text-gray-600 max-w-xl">
                    Ikuti berbagai kegiatan menarik dan acara yang diselenggarakan di Kampung Gatot
                </p>
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap justify-start gap-2">
                <button
                    class="event-filter-btn px-4 py-2 bg-[#1B3A6D] text-white rounded-full text-sm font-semibold font-['Poppins'] hover:bg-[#0f2a4f] hover:text-white transition-colors"
                    data-filter="all"
                >
                    Semua
                </button>
                <button
                    class="event-filter-btn px-4 py-2 border border-[#1B3A6D] text-[#1B3A6D] rounded-full text-sm font-medium font-['Poppins'] hover:bg-[#1B3A6D] hover:text-white transition-colors"
                    data-filter="current"
                >
                    Saat ini
                </button>
                <button
                    class="event-filter-btn px-4 py-2 border border-[#1B3A6D] text-[#1B3A6D] rounded-full text-sm font-medium font-['Poppins'] hover:bg-[#1B3A6D] hover:text-white transition-colors"
                    data-filter="upcoming"
                >
                    Akan datang
                </button>
                <button
                    class="event-filter-btn px-4 py-2 border border-[#1B3A6D] text-[#1B3A6D] rounded-full text-sm font-medium font-['Poppins'] hover:bg-[#1B3A6D] hover:text-white transition-colors"
                    data-filter="past"
                >
                    Kemarin
                </button>
            </div>
        </div>

        {{-- Event Cards --}}
        <div class="px-2">
            {{-- All Events --}}
            <div id="all-events" class="events-container">
                <div class="flex flex-wrap gap-5">
                    @forelse ($allEvents as $event)
                        @include('components.event-card', ['event' => $event])
                    @empty
                        <div class="w-full text-center py-8">
                            <p class="text-gray-500">Belum ada event tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Current Events --}}
            <div id="current-events" class="events-container hidden">
                <div class="flex flex-wrap gap-5">
                    @forelse ($currentEvents as $event)
                        @include('components.event-card', ['event' => $event])
                    @empty
                        <div class="w-full text-center py-8">
                            <p class="text-gray-500">Tidak ada event pada waktu tersebut.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Upcoming Events --}}
            <div id="upcoming-events" class="events-container hidden">
                <div class="flex flex-wrap gap-5">
                    @forelse ($upcomingEvents as $event)
                        @include('components.event-card', ['event' => $event])
                    @empty
                        <div class="w-full text-center py-8">
                            <p class="text-gray-500">Tidak ada event pada waktu tersebut.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Past Events --}}
            <div id="past-events" class="events-container hidden">
                <div class="flex flex-wrap gap-5">
                    @forelse ($pastEvents as $event)
                        @include('components.event-card', ['event' => $event])
                    @empty
                        <div class="w-full text-center py-8">
                            <p class="text-gray-500">Tidak ada event pada waktu tersebut.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for filtering --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.event-filter-btn');
            const eventContainers = document.querySelectorAll('.events-container');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');

                    // Update button states
                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-[#1B3A6D]', 'text-white');
                        btn.classList.add('border', 'border-[#1B3A6D]', 'text-[#1B3A6D]');
                    });

                    this.classList.remove('border', 'border-[#1B3A6D]', 'text-[#1B3A6D]');
                    this.classList.add('bg-[#1B3A6D]', 'text-white');

                    // Hide all containers
                    eventContainers.forEach(container => {
                        container.classList.add('hidden');
                    });

                    // Show selected container
                    const targetContainer = document.getElementById(filter + '-events');
                    if (targetContainer) {
                        targetContainer.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
</section>
