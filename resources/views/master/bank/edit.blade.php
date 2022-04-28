    <div class="col-md-12">
    <input type="hidden" name="id" value="{{ $bank->id }}" id="id_data" />
        <div class="form-group">
            <label for="bank" 
            @error('bank') class="text-danger" 
            @enderror>NAMA BANK
            @error('bank')
            | {{ $message }}
            @enderror</label>
            <input type="text" class="form-control" value="{{ $bank->nama_bank  }}"
                name="nama_bank" style="height: 28px;">
        </div>
    </div>