@extends('layout.master')
@section('content')
<!-- partial -->

<div class="content-wrapper bg-white">
          <div class="row">
            
            
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tanggapan Table</h4>
                  <div class="table-responsive">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><table class="table table-striped">
                        <div class="col-md-4">
                          <form action="{{ url()->current() }}" autocomplete="off" method="get">
                              <div class="input-group ">
                                  <input type="text" class="form-control" placeholder="Search" name="search">
                                  <button class=" btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                              </div>
                          </form>
                         </div>
                        <thead>
                          <tr>
                            <th>
                                Judul Pengaduan
                            </th>
                            <th>
                            Tanggapan
                            </th>
                            <th>
                            Tanggal Tanggapan
                            </th>
                            <th>
                              Action
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($tanggapans as $tanggapan)
                          <tr>
                            <td>
                              {!! $tanggapan->tanggapan !!}
                            </td>
                            <td>
                                {{ $tanggapan->tgl_tanggapan}}
                              </td>
                            <td>
                            <form action="{{ route('tanggapan.destroy', $tanggapan->id_petugas) }}" method="POST">
  
                            <a class="btn rounded-pill btn-warning" href="{{ route('tanggapan.edit', $tanggapan->id_petugas)}}">Edit</a>
                            @csrf
                            @method('DELETE')
  
                            <button type="submit" class="btn rounded-pill btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
                          </form>
                            </td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                      {{-- {!! $tanggapans->links() !!} --}}
                      <br>

                    </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">@if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form action="{{ route('tanggapan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Form Tanggapan</h4>
                                  <p class="card-description">
                                    Isi Form Tanggapan
                                  </p>
                                  <form class="forms-sample">
                                        {{-- <div class="form-group">
                                      <label for="exampleInputName1">Tanggapan</label>
                                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Nama Petugas" name="nama_petugas" value="{{ old('nama_petugas') }}">
                                    </div> --}}
                                    <div class="form-group">
                                      <label for="content1">Isi Tanggapan</label>
                                      <br>
                                      <textarea id="content1" name="tanggapan" rows="5" style="width: 100%;">{{ old('tanggapan') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                </form>
              </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                
                  
           
            

          
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Halaman ini bersifat rahasia dan hanya boleh diakses oleh pihak yang berwajib</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2023. Sweet Things</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


@endsection