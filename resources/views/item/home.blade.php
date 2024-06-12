<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <title></title>
  <body>
    <section class="vh-100" style="background-color: #eee;">
      <div class="container py-5 h-100" style="background-image:url({{url('images/background.jpg')}})">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-lg-9 col-xl-7">
            <div class="card rounded-3">
              <div class="card-body p-4">

                <h4 class="text-center my-3 pb-3 text-lg">Shoping List</h4>
                <div class="flex justify-center">
                  <button type="button" class="btn btn-primary btn-lg btn-block w-60" onclick="window.location='{{ route('item.create') }}'">Add Item</button>
                </div>
                <form class="flex" action="{{ route('item.pricelimit' , 'price_goes_here') }}" method="GET">
                  @csrf
                  <div class="form-row">
                    <div class="form-group">
                      <label for="inputZip">Add Pirce limit</label>
                      <input name="price_limit" type="text" class="form-control" id="priceLimit">
                    </div>
                  </div>
                  <button type="submit" onclick="submitPriceLimitForm()" class="btn btn-primary mt-3 ml-4">Add</button>
                </form>
                <table class="table mb-4">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Checked</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Price</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ $item->name }}</th>
                        <td>{{ $item->description }}</td>
                        <td>
                          @if ($item->ticked)
                              <img src="{{ asset('images/checked.png') }}" alt="Checked">
                          @else
                              No
                          @endif
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                          <form class="contents" action="{{ route('item.destroy', $item->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger">Delete</button>
                          </form>
                          @if (!$item->ticked)
                          <form class="contents" action="{{ route('tick', $item->id) }}" method="GET">
                              @csrf
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success ms-1">Tick</button>
                          </form>
                          @endif
                        </td>
                    </tr>
                     @endforeach
                  </tbody>
                </table>
                <div class="text-center">
                  <h2>Total Price: </h2>
                  <h3>{{$totalPrice}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
  <script>
    function submitPriceLimitForm() {
        var priceLimit = document.getElementById('priceLimit').value;
        var url = "{{ route('item.pricelimit', ':priceLimit') }}".replace(':priceLimit', priceLimit);
        document.forms[0].action = url;
        document.forms[0].submit();
    }
  </script>
</html>
