    <div class="form-group">
        <label class="pay">City Name<small>(shine)</small></label>
        <select name="shine_cities_id" class="list-dt form-control js-example-basic-single" id="shine_cities_id">
            <option value="0">-Select City Name-</option>
            @if(count($shine_cities))
            @foreach($shine_cities as $shine_city)
            <option value="{{ $shine_city->city_id }}">
                {{ isset($shine_city->city_desc)?$shine_city->city_desc:'' }}
            </option>
            @endforeach
            @endif
        </select>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>