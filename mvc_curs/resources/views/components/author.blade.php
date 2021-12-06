<div
    id="author-view-{{ $author->author_id }}"
    class="col-lg-4 col-sm-6 col-6 d-flex flex-column justify-content-between author-view mb-5"
    onclick="window.location.assign('{{ route('single_author', ['author' => $author]) }}', false)"
>
    <div class="author-image bg-white mb-3" style="background: url('{{ asset($author['photo']) }}'); background-size: contain; background-position: center;"></div>
    <span class="author-name text-center">{{ $author['fullname'] }}</span>
</div>


