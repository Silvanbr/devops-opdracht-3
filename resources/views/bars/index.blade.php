<x-main>
    <div class="container">
        <div class="columns mt-6 mb-6">
            <div class="column">
                <h1 class="title is-2">All the news articles</h1>
            </div>
            <div class="column">
                <a href="{{ route('bars.create') }}" class="button is-primary is-pulled-right">
                    Add Bar
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">log out</button>
                </form>
            </div>
        </div>
        @foreach($bars as $bar)
          @if($bar->grault > 3.1415927)
             <article class="media" style=background-color:green>
          @else
             <article class="media">
          @endif
                <div class="media-content">
                    <div class="content">
                        <p>
                            <a href="{{ route('bars.show', $bar) }}">
                                <strong>{{ $bar->name }}</strong>
                            </a>
                            <small>{{ $bar->grault}}</small>
                            <br>
                            {{ $bar->id }}
                            <small>{{ $bar->waldo}}</small>
                            <small>ordan: {{$bar->getOrdan()}}</small>
                        </p>
                    </div>
                </div>
            </article>
        @endforeach
        {{$bars->links()}}

    </div>
</x-main>
