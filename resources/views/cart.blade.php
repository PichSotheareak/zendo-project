@extends('layout.RootLayout')
@section('content')
    <center>
        <div class="container my-5">
            <h3>Your Shopping Cart</h3>
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Product 1 -->
                    <tr>
                        <td class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/60" alt="Product 1" class="me-3" />
                            <div>
                                <p class="mb-0">Classic Sneakers</p>
                                <small class="text-muted">Comfortable everyday shoes</small>
                            </div>
                        </td>
                        <td>$50.00</td>
                        <td>
                            <input type="number" class="form-control" style="width: 70px;" value="2" min="1" />
                        </td>
                        <td>$100.00</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </td>
                    </tr>

                    <!-- Product 2 -->
                    <tr>
                        <td class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/60" alt="Product 2" class="me-3" />
                            <div>
                                <p class="mb-0">Leather Wallet</p>
                                <small class="text-muted">Genuine leather, brown color</small>
                            </div>
                        </td>
                        <td>$35.00</td>
                        <td>
                            <input type="number" class="form-control" style="width: 70px;" value="1" min="1" />
                        </td>
                        <td>$35.00</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total:</td>
                        <td colspan="1" class="fw-bold">$135.00</td>
                    </tr>
                </tfoot>
            </table>

            <button class="btn btn-primary float-end">Proceed to Checkout</button>
        </div>

    </center>
@endsection
