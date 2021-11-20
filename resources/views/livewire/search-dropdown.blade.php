 <div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
<input 
     wire:model.debounce.500ms="search" type="text" class="bg-gray-800 text-sm rounded-full w-64 px-4 py-1 
     pl-8 focus:outline-none focus:shadow-outline" 
     placeholder="Search (press '/' to focus)"
     x-ref="search"
     @keydown.window="
            if (event.keyCode == 191 ) {
                event.preventDefault();
                $refs.search.focus();
            }
     "
     @focus="isOpen = true"
     @keydown.escape.window="isOpen = false"
     @keydown="isOpen = true"
     @keydown.shift.tab="isOpen = false"
>
     <div class="absolute top-0">
         <svg class="fill-current w-4 text-gray-500 mt-2 ml-3" style="color:gray;" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 30 30" style=" fill:#000000;">
             <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"></path>
         </svg>
     </div>


     <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

     @if(strlen($search) >= 2)
     <div
      class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4" 
      x-show.transition.opacity="isOpen"
      >
        @if ($searchResults->count()  > 0)
        <ul>
             @foreach($searchResults as $result)
             <li class="border-b border-gray-700 w-64 ">
                 <a
                  href="{{route('movies.show', $result['id'])}}" 
                 class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                    @if($loop->last)
                    @keydown.tab="isOpen = false"
                    @endif
                 >
                @if ($result['poster_path'])
                 <img src="https://image.tmdb.org/t/p/w92{{$result['poster_path']}}" alt="poster"
                class="w-8">
                @else
                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                @endif
                <span class="ml-4"> {{$result['title']}}</span>
                </a>
                </li>
             @endforeach
            </ul>
            @else
            <div class="px-3 py-3">No results for"{{$search}}"</div>
        @endif
     </div>
     @endif
 </div>