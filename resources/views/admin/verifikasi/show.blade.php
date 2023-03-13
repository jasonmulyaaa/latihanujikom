@extends('layout.master')
@section('content')

{{-- @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

        <div class="content-wrapper bg-white">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Verifikasi</h4>
                  <p class="card-description">
                    Isi Form Verifikasi
                  </p>
                  <div class="row">
                    <div class="col-md-4">
                      <address>
                        <h4 class="fw-bold">Foto</h4>
                        <br>
                        <img src="{{ asset('storage/' . $verifikasi->foto) }}" alt="course" onerror="this.onerror=null; this.src='../../assets/images/faces/icon.png'" style="width: 240px; height: 240px; object-fit: cover;">
                        <br>
                        <br>
                        <h5>
                          <b>
                          {!! $nama->nama !!} ({!! $verifikasi->nik !!})
                          </b>
                        </h5>
                        <br>
                        <h5>
                          <b>
                          Tanggal: {!! $verifikasi->tgl_pengaduan !!}
                          </b>
                        </h5>
                      </address>
                    </div>
                    <div class="col-md-8">
                      <address>
                        <br>
                        <h5 class="fw-bold">
                          Isi Laporan
                        </h5>
                        <p class="mb-2">
                          {!! $verifikasi->isi_laporan !!}
                        </p>
                        @php
                        $tanggapan = Tanggapan::where('id_pengaduan', $verifikasi->id_pengaduan)->first();
                    @endphp
                        <h5 class="fw-bold">
                          Isi Tanggapan
                        </h5>
                        @if ($tanggapan)
                        <p class="mb-2">
                          {!! $tanggapan->tanggapan !!}
                        </p>
                        @else
                        <p class="mb-2">
                          (Tanggapan Belum Ditanggapi oleh Petugas)
                        </p>
                        @endif
                      </address>
                    </div>
                  </div>
                </div>
                  <div class="card-body">
                    <h4 class="card-title">Status</h4>
                    <form action="{{ route('verifikasi.update', $verifikasi->id_pengaduan) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')

                              <div class="card-body">
                                <form class="forms-sample">
                                  <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                      <option value="0">0</option>
                                      <option value="proses">Proses</option>
                                      <option value="selesai">Selesai</option>
                                    </select>
                                  </div>
                                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </form>
                              </div>
                            {{-- </div>
                          </div> --}}
              </form>
                  </div>
                </div>
              </div>
            </div>
</form>

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