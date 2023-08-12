<form action='{{url("/admin/coins/store")}}' method="post" class="form" id="coin_form" name="coin_form">
    @csrf
    <div class="row">
        <input type="hidden" id="coin_id" name="id" value="{{ @$coin->id }}">
        <div class="col-lg-12">
            <div class="fv-row">
                <div class="field">
                    <label for="coin_name" class="form-label">
                        <span class="required">Name</span>
                    </label>
                    <input type="text" class="form-control" id="coin_name" name="name" value="{{@$coin -> name}}">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="fv-row">
                <div class="field">
                    <label for="price" class="form-label">
                        <span class="required">Price</span>
                    </label>
                    <input type="number" step="any" class="form-control" id="price" name="price" value="{{@$coin->price}}">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="field">
                <button type="submit" class="btn btn-sm btn-primary ">Save</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#coin_form").validate({
            rules: {
                price: {
                    required: true
                },
                name: {
                    required: true
                },
            },
            messages: {
                price: {
                    required: 'Price is required'
                },
                name: {
                    required: "Enter coin name"
                },
            },
            submitHandler: function(form) {
                    return true;
            }
        });
    });
</script>
