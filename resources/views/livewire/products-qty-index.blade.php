{{--<div>
    <ul>
        @foreach ($data as $produk)
            <li>{{ $produk->nama }}</li>
        @endforeach
    </ul>
</div>--}}

<div>
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="spg" @error('spg')
                class="text-danger"
            @enderror>SPG @error('spg')
                | {{ $message }}
            @enderror</label>
            <input type="text" id="spg" name="spg" class="form-control">
        </div>

        <div class="form-group">
            <label for="nama" @error('nama')
                class="text-danger"
            @enderror>Nama Pemesan @error('nama')
                | {{$message}}
            @enderror</label>
            <input type="text" id="nama" name="nama" class="form-control">
        </div>

        <div class="form-group">
            <label for="hp" @error('hp')
                class="text-danger"
            @enderror>No. Handphone @error('hp')
                | {{$message}}
            @enderror</label>
            <input type="text" id="hp" name="hp" class="form-control">
        </div>

        <div class="form-group">
            <label for="alamat" @error('alamat')
                class="text-danger"
            @enderror>Alamat Pengiriman @error('alamat')
                | {{$message}}
            @enderror</label>
            <input type="text" id="alamat" name="alamat" class="form-control">    
        </div>

        <div class="card">
            <div class="card-header">
                <label class="product-header">Pesanan</label> 
            </div>

            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                    <tr>
                        <th @error('orderProducts.*.product_id')
                            class="text-danger"
                        @enderror>Produk @error('orderProducts.*.product_id')
                            | {{$message}}
                        @enderror</th>
                        <th @error('orderProducts.*.quantity')
                            class="text-danger"
                        @enderror>Kuantitas @error('orderProducts.*.quantity')
                            | {{$message}}
                        @enderror</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orderProducts as $index => $orderProduct)
                        <tr>
                            <td>
                                <select name="orderProducts[{{$index}}][product_id]"
                                        wire:model="orderProducts.{{$index}}.product_id"
                                        class="form-control">
                                    <option value="">-- pilih produk --</option>
                                    @foreach ($allProducts as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->nama }} (Rp. {{ number_format($product->harga, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number"
                                       name="orderProducts[{{$index}}][quantity]"
                                       class="form-control"
                                       wire:model="orderProducts.{{$index}}.quantity" />
                            </td>
                            <td>
                                <a href="#" wire:click.prevent="removeProduct({{$index}})">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary"
                            wire:click.prevent="addProduct">+ Tambah Produk</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div>
            <input class="btn btn-primary" type="submit" value="Simpan">
        </div>
    </form>
    {{--<script>
            document.addEventListener('livewire:load', () => {
                setInterval(function(){ window.livewire.emit('alive'); }, 1800000);
            });
    </script>--}}
</div>


