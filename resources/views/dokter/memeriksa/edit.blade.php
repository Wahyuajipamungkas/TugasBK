<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Memeriksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Periksa Pasien') }}
                            </h2>

                        </header>

                        <form class="mt-6" id="formPeriksa" action="{{route('dokter.memeriksa.update', $janjiPeriksa->id)}}" method="POST">
                            @csrf

                            <div class="mb-3 form-group">
                                <label for="Edit_namaInput">Nama Pasien</label>
                                <input type="text" class="rounded form-control" id="Edit_namaInput"  value="{{$janjiPeriksa->pasien->nama}}" readonly>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="tgl_periksa">Tanggal Periksa</label>
                                <input type="datetime-local" class="rounded form-control" name="tgl_periksa" id="edit_tgl_periksa" value="{{$janjiPeriksa->periksa->tgl_periksa}}" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="catatan">Catatan</label>
                        <textarea class="rounded form-control" id="edit_catatan" name="catatan" rows="3" placeholder="Catatan Pemeriksaan">{{$janjiPeriksa->periksa->catatan}}</textarea>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="edit_obat">Pilih Obat</label>
                                <select class="rounded form-control" name="obats[]" id="edit_obat" multiple onchange="hargaBiayaPeriksa()">
                                    @foreach ($obats as $obat)
                                    <option value="{{$obat->id}}" data-harga="{{$obat->harga}}" {{in_array($obat->id, $janjiPeriksa->periksa->detailPeriksa->pluck('id_obat')->toArray()) ? 'selected' : ''}}>
                                        {{$obat->nama_obat}} - {{$obat->kemasan}} (Rp {{$obat->harga}})</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">TEkan CTRL (Windows) atau Command (Mac) Untuk memilih lebih dari satu</small>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="biaya_periksa">Biaya Pemeriksaan(Rp)</label>
                                <input type="text" class="rounded form-control" id="edit_biaya_periksa" name="biaya_periksa" value="{{$janjiPeriksa->periksa->biaya_periksa}}" readonly>
                            </div>
                            <a type="button" href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                       <script>
                            function hargaBiayaPeriksa() {
                                const biayaperiksa = 100000;
                                let totalBiaya = biayaperiksa;
                                const select = document.getElementById('edit_obat');
                                const selectedOptions = Array.from(select.selectedOptions);

                                selectedOptions.forEach(option => {
                                    const harga = parseInt(option.getAttribute('data-harga')) || 0;
                                    totalBiaya += harga;
                                });

                                document.getElementById('edit_biaya_periksa').value = totalBiaya;
                            }
                        </script>

                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
