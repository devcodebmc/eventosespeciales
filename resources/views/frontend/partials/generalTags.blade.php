<section class="max-w-4xl mx-auto px-4 py-6">
  <h3 class="text-4xl font-script text-[#2A4044] mb-4 text-center">Etiquetas</h3>
  <div class="flex flex-wrap justify-center gap-2 mt-4">
    @foreach ($tags as $tag)
      <a href="#" class="no-underline">
        <span class="bg-[#fbeee6] text-[#2A4044] px-3 py-1 rounded-md text-sm sm:text-base hover:bg-[#e0f7fa] transition duration-300">
          #{{ $tag }}
        </span>
      </a>
    @endforeach
  </div>
</section>