<figure>
  <picture>
    <source media="(min-width: 1600px)" data-srcset="/assets/media/{{ $image }}-xl.webp" type="image/webp">
    <source media="(min-width: 1600px)" data-srcset="/assets/media/{{ $image }}-xl.jpg">
    <source media="(min-width: 1200px)" data-srcset="/assets/media/{{ $image }}-lg.webp" type="image/webp">
    <source media="(min-width: 1200px)" data-srcset="/assets/media/{{ $image }}-lg.jpg">
    <source media="(min-width: 900px)" data-srcset="/assets/media/{{ $image }}-md.webp" type="image/webp">
    <source media="(min-width: 900px)" data-srcset="/assets/media/{{ $image }}-md.jpg">
    <img src="/assets/media/{{ $image }}.jpg" 
      alt="{{ $caption }}" 
      title="{{ $caption }}" 
      height="{{ $height }}" 
      width="{{ $width }}">
  </picture>
</figure>
