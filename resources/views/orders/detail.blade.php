<div class="row">
  <h3 class="col">{{ $order->cust_code }}</h3>

  @error('quantity')
  {{ $message }}
  @enderror
  <div class="col">
    <button type="button" class="btn-close float-end fw-bold my-text-white bg-danger lh-lg"
      data-bs-dismiss="modal"></button>
  </div>
</div>

<div class="row mb-3">
  <div class="col-lg-8">
    <div class="row">
      <div class="col-md-3 p-1">
        <label for="shop_order" class="d-block">Shop order</label>
        <input type="text" name="shop_order" id="shop_order"
          class="form-control @error('shop_order') is-invalid @enderror"
          value="{{ old('shop_order', $order->shop_order) }}">
        @error('shop_order')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-md-3 p-1">
        <label for="quantity" class="d-block">Quantity</label>
        <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
          value="{{ old('quantity', $order->quantity) }}">
        @error('quantity')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col md-3 p-1">
        <label for="job_type" class="d-block">Tipe pekerjaan</label>
        <input type="text" name="job_type" class="form-control @error('job_type') is-invalid @enderror"
          value="{{ old('job_type', $order->job_type) }}">
        @error('job_type')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col md-3 p-1">
        <label for="po_number" class="d-block">Nomor PO</label>
        <input type="text" name="po_number" class="form-control @error('po_number') is-invalid @enderror"
          value="{{ old('po_number', $order->po_number) }}">
        @error('po_number')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 p-1">
        <small>Tanggal order</small>
        <h6>{{ date('d F Y', strtotime($order->created_at)) }}</h6>
      </div>

      <div class="col-md-3 p-1">
        <label for="due_date" class="d-block">Target kirim</label>
        <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror"
          value="{{ old('due_date', $order->due_date) }}">
        @error('due_date')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-md-3 p-1">
        <label for="dwg_number" class="d-block">Nomor drawing</label>
        <input type="text" name="dwg_number" class="form-control @error('dwg_number') is-invalid @enderror"
          value="{{ old('dwg_number', $order->dwg_number) }}">
        @error('dwg_number')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-md-3 p-1">
        <label for="tool_code" class="d-block">Kode tool</label>
        <input type="text" name="tool_code" class="form-control @error('tool_code') is-invalid @enderror"
          value="{{ old('tool_code', $order->tool_code) }}">
        @error('tool_code')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>

    <div class="col-12 py-2">
      <label for="description" class="d-block">Deskripsi</label>
      <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
        value="{{ old('description', $order->description) }}">
      @error('description')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="col-12">
      <label for="note" class="d-block">Catatan</label>
      <textarea name="note" style="height: 100px"
        class="form-control @error('note') is-invalid @enderror">{{ old('note', $order->note) }}</textarea>
      @error('note')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="row">
      <div class="col-md-3 p-1">
        <small>Terakhir diperbarui oleh</small>
        <h6>{{ $order->updated_by }}</h6>
      </div>
      <div class="col-md-3 p-1">
        <small>Terakhir diperbarui</small>
        <h6>{{ date('d F Y', strtotime($order->updated_at)) }}</h6>
      </div>
    
      <div class="col-md-3 p-1">
        <small>Dibuat oleh</small>
        <h6></h6>
      </div>
    </div>

  </div>

  <div class="col-lg-4 bg-success">
    <h1>flow proses</h1>
  </div>  
</div>

<div class="ratio ratio-16x9">
  <iframe src="/pdf/data.pdf" title="pdf" allowfullscreen></iframe>
</div>