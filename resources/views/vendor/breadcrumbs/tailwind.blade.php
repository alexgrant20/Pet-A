@unless ($breadcrumbs->isEmpty())
    <nav class="container">
        <ol class="rounded flex flex-wrap text-sm text-gray-400 font-bold">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}" class="text-primary hover:underline focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li>
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="text-gray-500 px-2 font-bold">
                        &gt;
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
