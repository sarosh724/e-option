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
                        <span class="required">Base Price</span>
                    </label>
                    <input type="number" step="any" class="form-control" id="price" name="price" value="{{@$coin->price}}">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="fv-row">
                <div class="field">
                    <label for="min_value" class="form-label">
                        <span class="required">Minimum Price</span>
                    </label>
                    <input type="number" step="any" class="form-control" id="min_value" name="min_value" value="{{@$coin->min_value}}">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="fv-row">
                <div class="field">
                    <label for="max_value" class="form-label">
                        <span class="required">Maximum Price</span>
                    </label>
                    <input type="number" step="any" class="form-control" id="max_value" name="max_value" value="{{@$coin->max_value}}">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="fv-row">
                <div class="field">
                    <label for="profit_percentage" class="form-label">
                        <span class="required">Profit Percentage</span>
                    </label>
                    <input type="number" step="any" class="form-control" id="profit_percentage" name="profit_percentage" value="{{@$coin->profit_percentage}}">
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
                    required: true,
                    min: 1
                },
                min_value: {
                    required: true,
                    min: 1
                },
                max_value: {
                    required: true,
                    min: 1
                },
                profit_percentage: {
                    required: true,
                    min: 1
                },
                name: {
                    required: true
                },
            },
            messages: {
                price: {
                    required: 'Base Price is required',
                    min: "Value must be greater then 0"
                },
                min_value: {
                    required: 'Minimum Price is required',
                    min: "Value must be greater then 0"
                },
                max_value: {
                    required: 'Maximum Price is required',
                    min: "Value must be greater then 0"
                },
                profit_percentage: {
                    required: 'Profit Percentage is required',
                    min: "Value must be greater then 0"
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
