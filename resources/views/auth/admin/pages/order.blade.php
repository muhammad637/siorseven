<form action="{{route('store.order')}}" method='POST'></form>
@csrf
<label for="barang_id">Nama Barang</label>
<select name="barang_id" id="">
  @foreach ($barangs as $barang)
  <option value="{{$barang->id}}">{{$barang->jenis}}-{{$barang->merk}}-{{$barang->tipe}}</option> 
  @endforeach
  
</select>
<label for="cars">Pesan Kerusakan</label>
  <input type="text" name="pesan_kerusakan" class="form-control form-control-lg"  aria-label="Pesan Kerusakan">
  @error('pesan_kerusakan') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror

  <label for="cars">Nama Teknisi</label>

<select name="cars" id="cars">
  @foreach ($users as $user)
  <option value="{{$user->id}}">{{$user->nama}}</option>
  @endforeach
  
</select>
<button type="submit">Kirim</button>
</form>