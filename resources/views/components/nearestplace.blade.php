
<!--   nearest place find and display in map and display opening hours and address -->
<section id="nearestplace">
        <div class="text-center display-4 mb-2">Find Nearest Shop</div>
        <div class="row">

            <div class="col-md-6">
                <form id="postcode-form" method="post" class="needs-validation mb-5 ">
                    <div class="form-group ">
                        <label for="postcode">Enter Your Post Code</label>
                        <input type="text" class="form-control" id="postcode" placeholder="Enter PostCode" required>
                    </div>
                    <button type="submit" class="btn btn-dark float-right">Find nearest shop</button>
                </form>
                <div id="address"></div>
            </div>
            <div class="col-md-6">
                <div id="mapid-2"></div>
            </div>
        </div>
</section>
