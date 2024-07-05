@extends('layout.master')

@section('content')
<div class="main">
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Forum</h3>
              <div class="right">
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">Add New Post</a>
              </div>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled activity-list">
                @foreach($forum as $frm)
                <li class="d-flex align-items-center">
                  <img src="{{ asset('profile.jpeg') }}" alt="Avatar" class="avatar">
                  <div class="content">
                    <p>
                      <a href="/forum/{{ $frm->id }}/view">
                        {{ $frm->user->pengguna->nama ?? 'Anonymous' }} : {{ $frm->judul }}
                      </a>
                    </p>
                    <span class="date">{{ $frm->created_at->diffForHumans() }}</span>
                  </div>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Forum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('forum.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
            <label for="judul">Judul</label>
            <input name="judul" type="text" class="form-control" id="judul" aria-describedby="judulHelp">
            @if ($errors->has('judul'))
            <span class="help-block">{{ $errors->first('judul') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="konten">Konten</label>
            <textarea name="konten" class="form-control" id="konten" rows="3">{{ old('konten') }}</textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

<style>
  .activity-list {
    list-style-type: none;
    padding: 0;
  }
  .activity-list li {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 10px;
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
