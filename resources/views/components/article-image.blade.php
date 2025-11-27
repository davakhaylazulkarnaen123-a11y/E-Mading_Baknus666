@props(['artikel', 'size' => 'medium', 'class' => '', 'alt' => ''])

@php
    $imageUrl = $artikel->getImageUrl($size);
    $altText = $alt ?: $artikel->judul;
    $defaultClass = 'object-cover rounded-lg';
    $finalClass = $class ? $class : $defaultClass;
@endphp

@if($imageUrl)
    <picture>
        @if($artikel->foto_webp && $size !== 'original')
            <source srcset="{{ $artikel->getWebpUrl() }}" type="image/webp">
        @endif
        <img src="{{ $imageUrl }}" 
             alt="{{ $altText }}" 
             class="{{ $finalClass }}"
             loading="lazy"
             onerror="this.src='{{ asset('images/default-article.jpg') }}'; this.onerror=null;">
    </picture>
@else
    <div class="{{ $finalClass }} bg-gray-200 flex items-center justify-center">
        <div class="text-center text-gray-400">
            <i class="fas fa-image text-4xl mb-2"></i>
            <p class="text-sm">No Image</p>
        </div>
    </div>
@endif