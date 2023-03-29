 <form>
                @csrf
        <input type="hidden" name="id"/>
        <a type="button"@foreach($post->likes as $like) @if($like) data-status='1'@endif  @endforeach id="like" data-status='0' data-class="{{ get_class($post) }}" data-id="{{ $post->id }}"><i class="fa-solid fa-heart"></i></a>
 </form>

<script>

</script>
