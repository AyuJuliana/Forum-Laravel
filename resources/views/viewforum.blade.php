@extends('layout.master')

@section('content')
<div class="main">
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-headline">
            <div class="panel-heading">
              <h3 class="panel-title">{{ $forum->judul }}</h3>
              <p class="panel-subtitle">{{ $forum->created_at->diffForHumans() }}</p>
            </div>

            <div class="panel-body">
              <p>{{ $forum->konten }}</p>
            </div>
            
            <div class="panel-footer">
              <div class="btn-group">
                <button class="btn btn-default"><i class="lnr lnr-thumbs-up"></i> Suka</button>
                <button class="btn btn-default" id="btn-komentar-utama"><i class="lnr lnr-bubble"></i> Komen</button>
              </div>
              <form action="{{ route('postkomentar', ['forum' => $forum->id]) }}" style="margin-top:10px;" id="form-komentar-utama" method="POST">
                @csrf
                <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                <input type="hidden" name="parent" value="0">
                <textarea name="konten" class="form-control" id="textarea-komentar-utama" rows="4"></textarea>
                <input type="submit" class="btn btn-primary" value="Kirim">
              </form>

              <h3>Komentar</h3>
              
              <ul class="list-unstyled activity-list">
                @foreach($forum->komentar()->where('parent', 0)->orderby('created_at', 'desc')->get() as $komentar)
                <li class="d-flex align-items-start">
                  <img src="{{ asset('profile.jpeg') }}" alt="Avatar" class="img-circle avatar">
                  <div class="content ml-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <div>
                        <p><a href="#">{{ $komentar->user->pengguna->nama ?? 'Anonymous' }}</a></p>
                      </div>
                      <span class="timestamp">{{ $komentar->created_at->diffForHumans() }}</span>
                    </div>
                    <p>{{ $komentar->konten_komen }}</p>
                  </div>
                  <form action="{{ route('postkomentar', ['forum' => $forum->id]) }}" method="POST" style="padding-left:0.5cm;">
                    @csrf
                    <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                    <input type="hidden" name="parent" value="{{ $komentar->id }}">
                    <input type="text" name="konten" class="form-control">
                    <input type="submit" class="btn btn-primary btn-xs" value="Kirim">
                  </form>
                  <br>
                  @foreach($komentar->childs()->orderBy('created_at', 'desc')->get() as $child)
                  <p><a href="#">{{ $child->user->pengguna->nama ?? 'Anonymous' }}</a>
                    {{ $child->konten_komen }}<span class="timestamp">{{ $child->created_at->diffForHumans() }}</span>
                   </p>
                  @endforeach
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  $(document).ready(function(){
    $('#btn-komentar-utama').click(function() {
      $('#form-komentar-utama').toggle();
    });
  });
</script>
@endsection

.activity-list {
  list-style-type: none;
  padding: 0;
}
.activity-list li {
  display: flex;
  align-items: flex-start; /* Mengatur agar komentar berada di atas form komentar */
  margin-bottom: 15px;
  padding-bottom: 10px;
  border-bottom: 1px solid #e0e0e0;
}
.activity-list img.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 15px;
}
.activity-list .content {
  flex-grow: 1;
}
.activity-list .content p {
  margin: 0;
}
.activity-list .date {
  color: #888;
  font-size: 12px;
}
</style>