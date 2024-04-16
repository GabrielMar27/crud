<table class="table">
    <tbody>


    @forelse ($posts as $post)

        <tr >
            <td style="display: flex;justify-content: center">
                <img src="{{asset('/storage/media/'.$post->imageFolder.'/'.$post->image)}}" class="card-img-top" alt="{{$post->image}}" style="height: 200px;width: auto ;max-width: 500px">
            </td>
            <td  >
                <div style="display: flex;justify-content: space-between;align-items:center;flex-direction: column">
                    <a  class="link-primary btn" href="{{ route('posts.show', $post->id) }}"
                        style="
                                                  display:inline-block;
                                                  white-space: nowrap;
                                                  overflow: hidden;
                                                  text-overflow: ellipsis;
                                                  max-width: 20ch;
                                                  font-size: 40px"


                    >
                        {{ $post->title }}
                    </a>
                    <div style="
                                                  display:inline-block;
                                                  white-space: nowrap;
                                                  overflow: hidden;
                                                  text-overflow: ellipsis;
                                                  max-width:  35ch;
                                                  font-size: 20px;"

                    >
                        {{ $post->description }}
                    </div>

                    {{ @explode(' ',$post->created_at)[0]}}
                    @if((Auth::user()->admin===1&&Auth::user()->id===$post->wroteBy)||Auth::user()->admin===2)

                        <div>
                            <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this post?');"><i class="bi bi-trash"></i> Delete</button>
                            </form>

                        </div>
                    @endIf
                </div>



            </td>

        </tr>
    @empty
        <td colspan="6">
             <span class="text-danger">
             <strong>No Post Found!</strong>
            </span>
        </td>

    @endforelse
    </tbody>
</table>
