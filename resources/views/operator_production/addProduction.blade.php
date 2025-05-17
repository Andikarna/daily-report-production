<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Operator Produksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h1 class="h4">Laporan Produksi</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('create_report') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="division" class="form-label">Divisi</label>
                        <select class="form-select" id="division" name="division" required>
                            <option selected disabled>Pilih Divisi</option>
                            @foreach ($division as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="leader" class="form-label">Leader</label>
                        <select class="form-select" id="leader" name="leader" required>
                            <option selected disabled>Pilih Leader</option>
                            @foreach ($leader as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="date_production" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date_production" name="date_production" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <select class="form-select" id="name" name="name" required>
                            <option selected disabled>Pilih Operator</option>
                            @foreach ($operator as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="shift" class="form-label">Shift</label>
                        <select class="form-select" id="shift" name="shift" required>
                            <option selected disabled>Pilih Shift</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="Non Shift">Non Shift</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-primary" id="add-ip">Tambah I.P</button>
                    </div>

                    <div id="produksi_container">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success" id="save-report">Simpan Laporan</button>
                    </div>
                
            </div>
        </div>

        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('assets/images/success.jpg') }}" style="width: 300px; height: 300px;" alt="Success" class="mb-3">
                        <p class="mb-0">Data berhasil disimpan!</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        </form>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

{{-- <script>
    document.getElementById('add-ip').addEventListener('click', function() {
        const container = document.getElementById('produksi_container');

        const newStage = `
    <div class="ip-member">
        <div class="mb-3 mt-3">
            <label for="type_production" class="form-label">I.P</label>
            <input type="text" class="form-control" id="type_production" name="type_production"
                            required>
        </div>

        <div class="text-start">
            <button type="button" class="btn btn-primary add-lot">Tambah Lot</button>
        </div>

        <div class="lot-container">
        </div>

        <div class="col-12 mt-3">
            <button type="button"
            class="btn btn-danger remove-ip">Hapus I.P</button>
        </div>
    </div>`;
        container.insertAdjacentHTML('beforeend', newStage);
    });

    // Event delegation untuk tombol Hapus I.P
    document.getElementById('produksi_container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-ip')) {
            e.target.closest('.ip-member').remove();
        }
    });

    // Event delegation untuk tombol Tambah Lot
    document.getElementById('produksi_container').addEventListener('click', function(e) {
        if (e.target.classList.contains('add-lot')) {
            const container = e.target.closest('.ip-member').querySelector('.lot-container');

            const newStage = `
       <div class="lot-member">
            <div class="col-md-12 mt-3 mb-3">
                <label for="no_lot" class="form-label">No. Lot</label>
                <input type="text" class="form-control" id="no_lot" name="no_lot" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="ok" class="form-label">OK</label>
                    <input type="number" class="form-control" id="ok" name="ok" required>
                </div>

                <div class="col-md-2">
                    <label for="ng" class="form-label">NG</label>
                    <input type="number" class="form-control" id="ng" name="ng" required>
                </div>

                <div class="col-md-4">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control" id="total" name="total" required>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Keterangan</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>   

            <div class="text-end col-12 mt-3">
                <button type="button"
                class="btn btn-danger remove-lot">Hapus Lot</button>
            </div>
        </div>`;
            container.insertAdjacentHTML('beforeend', newStage);
        }
    });

    // Event delegation untuk tombol Hapus Lot
    document.getElementById('produksi_container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-lot')) {
            e.target.closest('.lot-member').remove();
        }
    });
</script> --}}

<script>
    let ipCount = 1;
    let lot = 1;
    const noIpData = @json($noIp);

    console.log(noIpData);

    document.getElementById('add-ip').addEventListener('click', function() {
        const container = document.getElementById('produksi_container');
        ipCount++;


        const options = noIpData.map(data => `<option value="${data}">${data}</option>`).join('');

        const newStage = `
    <div class="mt-3 ip-member">
        <input hidden type="text" class="form-control" id="countIp[]" name="countIp[]" value="${lot}">
        
        <div class="mb-3">
            <label for="ip" class="form-label">I.P</label>
            <select class="form-select" id="ip[]" name="ip[]" required>
                <option selected disabled>Pilih IP</option>
                ${options}
            </select>
        </div>

        <div class="text-start">
            <button type="button" class="btn btn-primary add-lot">Tambah Lot</button>
        </div>

        <div class="lot-container">
        </div>

        <div class="col-12 mt-3">
            <button type="button" class="btn btn-danger remove-ip">Hapus</button>
        </div>
    </div>`;


        container.insertAdjacentHTML('beforeend', newStage);

    });

    // Event delegation untuk tombol Hapus I.P
    document.getElementById('produksi_container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-ip')) {
            e.target.closest('.ip-member').remove();
        }

        ipCount--;
    });

    // Event delegation untuk tombol Tambah Lot
    document.getElementById('produksi_container').addEventListener('click', function(e) {
        if (e.target.classList.contains('add-lot')) {
            const ipMember = e.target.closest('.ip-member');
            const container = e.target.closest('.ip-member').querySelector('.lot-container');
            const lotCount = container.children.length + 1; // Hitung jumlah lot

            const newStage = `
       <div class="mt-3 lot-member card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>No. Lot <span class="lot-number">${lotCount}</span></span>
                <div>
                    <button type="button" class="btn btn-sm btn-secondary toggle-content">Minimize</button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12 mb-3">
                    <label for="no_lot" class="form-label">No. Lot</label>
                    <input type="text" class="form-control" id="no_lot[]" name="no_lot[]" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="ok" class="form-label">OK</label>
                        <input type="number" class="form-control" id="ok[]" name="ok[]" oninput="calculateTotal(this)" required>
                    </div>

                    <div class="col-md-2">
                        <label for="ng" class="form-label">NG</label>
                        <input type="number" class="form-control" id="ng[]" name="ng[]" oninput="calculateTotal(this)" required>
                    </div>

                    <div class="col-md-3">
                        <label for="time" class="form-label">Time (Menit)</label>
                        <input type="text" class="form-control" id="time[]" name="time[]" required>
                    </div>

                    <div class="col-md-4">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total[]" name="total[]" readonly>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="description" name="description[]" rows="4" required></textarea>
                </div>   

                <div class="text-end col-12 mt-3">
                    <button type="button" class="btn btn-danger remove-lot">Hapus</button>
                </div>
            </div>
        </div>`;
            container.insertAdjacentHTML('beforeend', newStage);

            ipMember.querySelector('input[name="countIp[]"]').value = lotCount;
        }
    });

    // Event delegation untuk tombol Hapus Lot
    document.getElementById('produksi_container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-lot')) {
            e.target.closest('.lot-member').remove();
        }
    });

    // Event delegation untuk tombol Minimize/Expand Lot
    document.getElementById('produksi_container').addEventListener('click', function(e) {
        if (e.target.classList.contains('toggle-content')) {
            const cardBody = e.target.closest('.lot-member').querySelector('.card-body');
            if (cardBody.style.display === 'none') {
                cardBody.style.display = 'block';
                e.target.textContent = 'Minimize';
            } else {
                cardBody.style.display = 'none';
                e.target.textContent = 'Expand';
            }
        }
    });

    // Event delegation untuk tombol Increment Number
    document.getElementById('produksi_container').addEventListener('click', function(e) {
        if (e.target.classList.contains('increment-number')) {
            const lotNumber = e.target.closest('.lot-member').querySelector('.lot-number');
            lotNumber.textContent = parseInt(lotNumber.textContent) + 1;

            const lotCount = container.children.length; // Hitung ulang jumlah lot
            ipMember.querySelector('input[name="countIp[]"]').value = lotCount;
        }
    });
</script>

<script>
    function calculateTotal(element) {
        // Dapatkan elemen parent (baris yang sama)
        const row = element.closest('.row');

        // Ambil nilai OK dan NG
        const okInput = row.querySelector('input[name="ok[]"]');
        const ngInput = row.querySelector('input[name="ng[]"]');
        const totalInput = row.querySelector('input[name="total[]"]');

        const okValue = parseInt(okInput.value) || 0; // Default ke 0 jika kosong
        const ngValue = parseInt(ngInput.value) || 0;

        // Hitung total dan masukkan ke kolom Total
        totalInput.value = okValue + ngValue;
    }
</script>

<script>

    document.getElementById('save-report').addEventListener('click', function (event) {
    event.preventDefault(); // Mencegah pengiriman form default

    // Ambil elemen form
    const form = document.querySelector('form');
    const formData = new FormData(form);

    // Kirim data menggunakan Fetch API
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tampilkan modal jika berhasil
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
                window.location.reload(); // Reload halaman
            });

            // Reset form jika perlu
            form.reset();
        } else {
            alert('Terjadi kesalahan: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data!');
    });
});
</script>



</html>
