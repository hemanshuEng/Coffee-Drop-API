<!-- create new shop and time table -->

<section id="newshop">
    <div class="text-center display-4 mb-2">Enter New Shop</div>

    <!-- form-->
    <form id="newshop-form" method="post" class="needs-validation mb-5 ">
        @csrf
        <div class="form-group row">
            <label for="postcode-1" class="col-sm-2 col-form-label">Enter Shop Postcode</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="postcode-1" placeholder="Enter post Code" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-open-0" placeholder="Opening Time">
                <small class="form-text text-muted">Sunday opening time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-close-0" placeholder="Opening Time">
                <small class="form-text text-muted">Sunday closing time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-open-1" placeholder="Opening Time">
                <small class="form-text text-muted">Monday opening time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-close-1" placeholder="Opening Time">
                <small class="form-text text-muted"> Monday closing time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-open-2" placeholder="Opening Time">
                <small class="form-text text-muted">Tuesday opening time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-close-2" placeholder="Opening Time">
                <small class="form-text text-muted"> Tuesday closing time</small>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-open-3" placeholder="Opening Time">
                <small class="form-text text-muted"> Wednesday opening time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-close-3" placeholder="Opening Time">
                <small class="form-text text-muted">Wednesday closing time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-open-4" placeholder="Opening Time">
                <small class="form-text text-muted">Thursday opening time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-close-4" placeholder="Opening Time">
                <small class="form-text text-muted">Thursday closing time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-open-5" placeholder="Opening Time">
                <small class="form-text text-muted">Friday opening time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-close-5" placeholder="Opening Time">
                <small class="form-text text-muted">Friday closing time</small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-open-6" placeholder="Opening Time">
                <small class="form-text text-muted">Saturday opening time</small>
            </div>
            <div class="col-sm-2">
                <input type="time" class="form-control" id="day-close-6" placeholder="Opening Time">
                <small class="form-text text-muted">Saturday closing time</small>
            </div>
        </div>
        <div class="form-group row">

        </div>
        <button type="submit" class="btn btn-dark ">Enter New shop</button>
    </form>
    <!-- alert-->
    <div class="alert alert-success alert-dismissible fade" id="newshop-alert" role="alert">
        <h6 class="text-center " id='newshop-msg'></h6>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</section>
