
<x-_layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Content Row -->

    <div
    class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white"
    style="background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(95, 95, 95, 0.4)), url('{{ asset('assets/img/jumbotron.jpg') }}');background-size: cover;"
    >
        <h1 class="mb-3 h2"><b>APLIKASI KENDALI PERBEKALAN KESEHATAN PUSKESMAS</b></h1>

        <h2 class="h4">
        <b>UPTD Puskesmas Babakan Tarogong</b>
        </h2>
    </div>
    
    
    <div class="row">
        <!-- Card Total Obat Persediaan Rutin -->
        <div class="col col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Obat Persediaan Rutin
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalPersediaanRutin }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pills fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Obat Persediaan Program -->
        <div class="col col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Obat Persediaan Program
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalPersediaanProgram  }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-capsules fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-_layout>