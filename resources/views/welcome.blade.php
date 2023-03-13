@extends('layout.user')
@section('content')
        <!-- start hero-section -->
        <section class="hero-section-s3">
            <div class="container">
                <div class="row">
                    <div class="col col-md-6 col-sm-8">
                        <div class="content">
                            <h2>Layanan Aspirasi dan Pengaduan Online Rakyat</h2>
                            <p>Pengelolaan pengaduan pelayanan publik di setiap organisasi penyelenggara di Indonesia belum terkelola secara efektif dan terintegrasi. Masing-masing organisasi penyelenggara mengelola pengaduan secara parsial dan tidak terkoordinir dengan baik.</p>
                            {{-- <div class="btns">
                                <a href="#"><img src="{{ asset('') }}assets/user/images/app-store.jpg" alt></a>
                                <a href="#"><img src="{{ asset('') }}assets/user/images/play-store.jpg" alt></a>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="phone">
                    <img src="{{ asset('2.png') }}" alt>
                </div>
            </div>
        </section>
        <!-- end hero-section -->


        <!-- start contact-section-s2 -->
        <section class="contact-section-s2 section-padding" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="section-title-s3">
                            <span>Form Pengaduan</span>
                            <h2>Berikan Laporan dan Aspirasi anda.</h2>
                        </div>
                    </div>
                </div>  
                <div class="row contact-form-info">
                    <div class="col col-md-12">
                        <div class="contact-form">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success mt-2">
                              <p>{{ $message }}</p>
                            </div>
                          @endif
                            <form class="contact-validation-active" action="{{ route('welcome.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="file" name="foto" class="form-control" placeholder="Foto..">
                                    <br>
                                    <textarea class="form-control" id="message" name="isi_laporan" placeholder="Laporan.."></textarea>
                                    <input type="hidden" name="status" value="0">
                                <div class="submit">
                                    <button type="submit">Submit</button>
                                    <div id="loader">
                                        <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                                    </div>
                                </div>
                                <div class="error-handling-messages">
                                    <div id="success">Thank you</div>
                                    <div id="error"> Error occurred while sending email. Please try again later. </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>            
            </div> <!-- end container -->
        </section>
        <!-- end contact-section-s2 -->
@endsection

