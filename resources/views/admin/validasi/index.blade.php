@extends('layout.master')
@section('content')
<!-- partial -->
<?php
use App\Models\Tanggapan;
?>

<div class="content-wrapper bg-white">
          <div class="row">
            
            
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Validasi Table</h4>
                  <div class="table-responsive">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                      </li>
                      {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Add</button>
                      </li> --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><table class="table table-striped">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success mt-2">
                          <p>{{ $message }}</p>
                        </div>
                      @endif
                        <div class="col-md-4">
                          <form action="{{ url()->current() }}" autocomplete="off" method="get">
                              <div class="input-group ">
                                  <input type="text" class="form-control" placeholder="Search" name="search">
                                  <button class=" btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                              </div>
                          </form>
                         </div>
                         <a class="btn btn-secondary me-2" href="{{ route('pdf') }}">PDF</a>
                        <thead>
                          <tr>
                            <th>
                              Foto
                            </th>
                            <th>
                              NIK
                            </th>
                            <th>
                              Tanggal Pengaduan
                            </th>
                            <th>
                                Status
                              </th>
                              <th>
                                Action
                              </th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($validasis as $validasi)
                          <tr>
                            <td>
                            <div style="width: 100px;">
                              <img src="{{ asset('storage/' . $validasi->foto) }}" alt="No Image" class="img-fluid mt-3">
                          </div>
                            </td>
                            <td>
                              {{ $validasi->nik}}
                          </td>
                            <td>
                              {{ $validasi->tgl_pengaduan}}
                          </td>
                            <td>
                                <div @if($validasi->status == 'selesai') class="badge badge-opacity-success" @elseif($validasi->status == 'proses') class="badge badge-opacity-warning" @endif>{{ $validasi->status}}</div>
                            </td>
                            <td>
                            {{-- <form action="{{ route('validasi.destroy', $validasi->id_pengaduan) }}" method="POST"> --}}

                              <form action="{{ route('validasi.update', $validasi->id_pengaduan) }}" method="POST">
                                @csrf
                                @method('PUT')
                            <a class="btn rounded-pill btn-info" href="{{ route('validasi.show', $validasi->id_pengaduan)}}">Detail</a>
                          @php
                            $tanggapan = Tanggapan::where('id_pengaduan', $validasi->id_pengaduan)->first();
                        @endphp
                            @if ($validasi->status == 'selesai' && empty($tanggapan))
                            <a class="btn rounded-pill btn-warning" href="{{ route('validasi.edit', $validasi->id_pengaduan)}}">Tanggapan</a>

                            @elseif($validasi->status == 'proses')
                            <button type="submit" class="btn rounded-pill btn-success">Selesai</button>
                            @endif

                            </form>

                            </form>
                            {{-- @csrf
                            @method('DELETE')
  
                            <button type="submit" class="btn rounded-pill btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button> --}}
                          </form>
                            </td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                      {{-- {!! $validasis->links() !!} --}}
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
                <form action="{{ route('validasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Form Validasi</h4>
                                  <p class="card-description">
                                    Isi Form Validasi
                                  </p>
                                  <form class="forms-sample">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Gambar</strong>
                                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control" @error('gambar') is-invalid @enderror name="gambar" id="image" onchange="previewImage()">
                                                    @error('gambar')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                      <label for="exampleInputName1">Judul</label>
                                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Judul" name="judul" value="{{ old('judul') }}">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputName1">Deskripsi</label>
                                      <textarea class="form-control" id="content" name="deskripsi">{{ old('deskripsi') }}</textarea>
                                      <script>
                                          CKEDITOR.replace('content');
                                      </script>
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