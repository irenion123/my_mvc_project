<div
    id="author-view-{{ $author->author_id }}"
    class="col-sm-6 col-md-4 col-lg-3 col-12 d-flex flex-column justify-content-between author-view mb-5">
    <div class="author-image bg-white mb-3" style="background: url('{{ asset($author['photo']) }}'); background-size: contain; background-position: center;"></div>
    <span class="author-name text-center">{{ $author['fullname'] }}</span>
</div>


