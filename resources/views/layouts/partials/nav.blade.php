<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Ecommerce</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Product <span class="sr-only"></span></a>
            </li> --}}
            @if (Auth::user()->level == 'admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  <a class="dropdown-item" href="#" onclick="formProduct()">Create Product</a>
                  <a class="dropdown-item" href="{{ route('product') }}">Data Product</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Costumer</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  <a class="dropdown-item" href="#" onclick="formCostumer()">Create Costumer</a>
                  <a class="dropdown-item" href="{{ route('costumer') }}">Data Costumer</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Order</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  {{-- <a class="dropdown-item" href="#" onclick="formOrder()">Create Order</a> --}}
                  <a class="dropdown-item" href="{{ route('order') }}">Data Order</a>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cproduct') }}">Product <span class="sr-only"></span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Order</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  <a class="dropdown-item" href="#" onclick="formOrder()">Create Order</a>
                  {{-- <a class="dropdown-item" href="{{ route('order') }}">Data Order</a> --}}
                </div>
            </li>
            @endif
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li> --}}
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a class="btn btn-danger my-2 my-sm-0" type="button" href="{{ route('logout') }}">Logout</a>
        </form>
    </div>
</nav>
<br>
