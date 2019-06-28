<section class="cashback">
        <div class="text-center display-4 mb-2">Cashback</div>

        <form id="cashback-form" method="post" class="needs-validation mb-5 ">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="ristretto">Ristretto</label>
                    <input type="number" class="form-control" id="ristretto" placeholder="Enter Quantity" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="espresso">Espresso</label>
                    <input type="number" class="form-control" id="espresso" placeholder="Enter Quantity" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="lungo">Lungo</label>
                    <input type="number" class="form-control" id="lungo" placeholder="Enter Quantity" required>
                </div>
            </div>
            <button type="submit" class="btn btn-dark float-right">Create New Shop</button>
        </form>
        <!--alert response message-->
        <div class="alert alert-success alert-dismissible fade" id="cashback-alert" role="alert">
            <h4 class="text-center " id='cashback-amount'></h4>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    </section>
