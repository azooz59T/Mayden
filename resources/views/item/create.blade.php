<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js"></script>
    <title></title>
  <body>
    <section class="vh-100" style="background-color: #eee;">
      <div class="container py-5 h-100" style="background-image:url({{url('images/background.jpg')}})">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-lg-9 col-xl-7">
            <div class="card rounded-3">
              <div class="card-body p-4">

                <h4 class="text-center my-3 pb-3 text-lg">Shoping List</h4>
                <form action="{{ route('item.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" aria-describedby="ItemName" placeholder="Enter Item Name">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control" placeholder="Item Description">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Quantity</label>
                    <input name="quantity" type="number" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Price</label>
                    <input name="price" type="number" class="form-control">
                  </div>
                  <div class="form-check">
                    <input name="ticked" type="checkbox" class="form-check-input">
                    <label>Ticked</label>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="priceLimitmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header justify-center">
            <h5 class="modal-title text-red-700" id="exampleModalLabel">Limit Reached</h5>
          </div>
          <div class="modal-body">
            <p class="text-red-400">The price of this Item exceeds the budget limit for this shopping list</p>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script type="module">
    $('form').submit(function(event) {
      event.preventDefault(); // Prevent the default form submission

      $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
            if (response.message === 'You have reached the price limit.') {
                $('#priceLimitmodal').modal('show'); // Show the modal
            } else {
                // Handle other responses (e.g., item added successfully)
                window.location.href = "{{ route('item.index') }}";
            }
        },
        error: function(error) {
            console.error(error);
        }
        });
      });
    </script>
</html>
