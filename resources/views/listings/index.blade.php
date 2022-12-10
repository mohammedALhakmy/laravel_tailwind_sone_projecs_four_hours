<x-layout>

@include('partials._hero')
@include('partials._search')
    <div
        class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
    >
@unless(count($Listings    )  == 0)
   @foreach ($Listings as $Listing)
       <!-- Item 1 -->
{{--    Lisiting-card   --}}
       <x-listing_card :listing="$Listing"/>

    @endforeach
    @else <p>No Listhgs Found</p>
    @endunless
    </div>
    <div class="mt-4 p-4 mr-auto">
        {{ $Listings->links() }}
    </div>
</x-layout>
