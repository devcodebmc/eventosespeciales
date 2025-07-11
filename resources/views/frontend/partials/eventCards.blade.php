@php
    $cards = [
        [
            'url' => '/blog/tying-the-knot',
            'image_url' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'date' => 'Julio 20, 2023',
            'category' => 'Wedding',
            'title' => 'Tying the Knot: A Journey of Love and Togetherness',
            'description' => 'Discover the beautiful journey of our love story...',
        ],
        [
            'url' => '/blog/from-yes-to-i-do',
            'image_url' => 'https://images.unsplash.com/photo-1523438885200-e635ba2c371e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'date' => 'Julio 20, 2023',
            'category' => 'Flower',
            'title' => 'From "Yes" to "I Do": Our Whirlwind Wedding Story',
            'description' => 'The romantic tale of our quick engagement...',
        ],
        [
            'url' => '/blog/love-journey',
            'image_url' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'date' => 'Julio 20, 2023',
            'category' => 'Wedding',
            'title' => 'Tying the Knot: A Journey of Love and Togetherness',
            'description' => 'Discover the beautiful journey of our love story...',
        ],
        [
            'url' => '/blog/whirlwind-story',
            'image_url' => 'https://images.unsplash.com/photo-1523438885200-e635ba2c371e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'date' => 'Julio 20, 2023',
            'category' => 'Flower',
            'title' => 'From "Yes" to "I Do": Our Whirlwind Wedding Story',
            'description' => 'The romantic tale of our quick engagement...',
        ],
        [
            'url' => '/blog/love-togetherness',
            'image_url' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'date' => 'Julio 20, 2023',
            'category' => 'Wedding',
            'title' => 'Tying the Knot: A Journey of Love and Togetherness',
            'description' => 'Discover the beautiful journey of our love story...',
        ]
    ];
@endphp

<section aria-labelledby="featured-posts-heading" class="py-8 px-1 max-w-full mx-auto">
    <h2 id="featured-posts-heading" class="sr-only">Publicaciones destacadas</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-1">
        @foreach($cards as $card)
            <article class="relative aspect-[4/5] group">
                <a href="{{ $card['url'] }}" class="absolute inset-0 z-10" aria-label="Leer más sobre {{ $card['title'] }}"></a>
                
                <!-- Imagen en hover -->
                <div class="absolute inset-0 bg-cover bg-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                     style="background-image: url('{{ $card['image_url'] }}')" aria-hidden="true">
                </div>

                <!-- Contenido -->
                <div class="absolute inset-0 bg-[#263238] flex flex-col justify-end p-4 transition-all duration-300 group-hover:bg-black/60">
                    <span class="text-xs text-white/80 mb-1">
                        <time datetime="{{ date('Y-m-d', strtotime($card['date'])) }}">{{ $card['date'] }}</time> • {{ $card['category'] }}
                    </span>
                    <h3 class="text-lg font-medium text-white mb-2 leading-tight">
                        {{ $card['title'] }}
                    </h3>
                    <div class="w-8 h-0.5 bg-rose-400 mb-3" aria-hidden="true"></div>
                    <p class="text-xs text-white/90 hidden group-hover:block">
                        {{ $card['description'] }}
                    </p>
                </div>
            </article>
        @endforeach
    </div>
</section>