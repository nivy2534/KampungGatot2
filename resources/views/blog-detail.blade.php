@extends('layouts.app')

@section('content')
  {{-- Header --}}
  @include('components.header')

  {{-- Main Content --}}
  <article class="py-8 px-4 sm:px-6 lg:px-8 bg-white min-h-screen">
    <div class="max-w-4xl mx-auto">
      
      {{-- Breadcrumb --}}
      <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('blog') }}" class="hover:text-[#1B3A6D] transition-colors">Blog</a>
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
        <span class="text-gray-700">{{ $blog->name }}</span>
      </nav>

      {{-- Article Header --}}
      <header class="mb-8">
        <div class="flex items-center gap-3 mb-4">
          <span class="px-3 py-1 bg-[#1B3A6D]/10 text-[#1B3A6D] text-xs font-medium rounded-full">
            {{ ucfirst(str_replace('_', ' ', $blog->tag)) }}
          </span>
          <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
            {{ ucfirst($blog->status) }}
          </span>
        </div>
        
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
          {{ $blog->name }}
        </h1>
        
        <div class="flex items-center gap-4 text-sm text-gray-600 mb-6">
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            <span>{{ $blog->author_name }}</span>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
            </svg>
            <span>{{ $blog->created_at->format('d F Y') }}</span>
          </div>
        </div>

        {{-- Featured Image --}}
        @if($blog->image_url)
        <div class="mb-8">
          <img 
            src="{{ asset($blog->image_url) }}" 
            alt="{{ $blog->name }}"
            class="w-full h-64 lg:h-96 object-cover rounded-lg shadow-sm"
          >
        </div>
        @endif
      </header>

      {{-- Article Content --}}
      <div class="prose prose-lg max-w-none">
        <div class="text-lg text-gray-600 mb-6 font-medium leading-relaxed">
          {{ $blog->excerpt }}
        </div>
        
        <div class="text-gray-700 leading-relaxed">
          {!! nl2br(e($blog->description)) !!}
        </div>
      </div>

      {{-- Share Buttons --}}
      <div class="mt-8 pt-8 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan Artikel</h3>
        <div class="flex gap-3">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
             target="_blank"
             class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
            </svg>
            Facebook
          </a>
          
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->name) }}" 
             target="_blank"
             class="flex items-center gap-2 px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors text-sm">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
            </svg>
            Twitter
          </a>
          
          <a href="https://wa.me/?text={{ urlencode($blog->name . ' ' . request()->fullUrl()) }}" 
             target="_blank"
             class="flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
            </svg>
            WhatsApp
          </a>
        </div>
      </div>
    </div>
  </article>

  {{-- Related Articles --}}
  @if($relatedBlogs->count() > 0)
  <section class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-2xl font-bold text-gray-900 mb-8">Artikel Terkait</h2>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($relatedBlogs as $relatedBlog)
        <article class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
          <a href="{{ route('blog.show', $relatedBlog->slug) }}" class="block">
            @if($relatedBlog->image_url)
            <div class="aspect-w-16 aspect-h-9">
              <img 
                src="{{ asset($relatedBlog->image_url) }}" 
                alt="{{ $relatedBlog->name }}"
                class="w-full h-48 object-cover"
              >
            </div>
            @endif
            
            <div class="p-6">
              <div class="flex items-center gap-2 mb-3">
                <span class="px-2 py-1 bg-[#1B3A6D]/10 text-[#1B3A6D] text-xs font-medium rounded">
                  {{ ucfirst(str_replace('_', ' ', $relatedBlog->tag)) }}
                </span>
              </div>
              
              <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-[#1B3A6D] transition-colors">
                {{ $relatedBlog->name }}
              </h3>
              
              <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                {{ $relatedBlog->excerpt }}
              </p>
              
              <div class="flex items-center justify-between text-xs text-gray-500">
                <span>{{ $relatedBlog->author_name }}</span>
                <span>{{ $relatedBlog->created_at->format('d M Y') }}</span>
              </div>
            </div>
          </a>
        </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- Footer --}}
  @include('components.footer')
@endsection

@push('styles')
<style>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
@endpush
