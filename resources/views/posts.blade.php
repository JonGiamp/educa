<strong>Forum</strong>
<br><br>
<strong>Sujets</strong>
<br>
<a href="">Nouveau sujet</a>
<ul>
    @foreach ($posts as $post)
    <li><a href="{{url('/index.php', ['id'=>$post->id])}}">{{$post->title}}</a> - le {{$post->date}} par {{$post->author}}</li>
    @endforeach
</ul>