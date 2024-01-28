@foreach ($comments as $comment)

    <h1>{{ $comment->id }}</h1>
    <br>
    <p>{{ $comment->content }}</p>
    <br>
    <hr>

@endforeach
