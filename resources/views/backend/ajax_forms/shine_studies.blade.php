        <div class="form-group">
            <label class="pay">Education Stream <small>(shine)</small></label>
            <select name="shine_study_id" class="list-dt form-control js-example-basic-single" id="shine_study_id">
                <option value="0">-Select Education Stream-</option>
                @if(count($shine_studies))
                @foreach($shine_studies as $shine_study)
                <option value="{{ $shine_study->study_id }}">
                    {{ isset($shine_study->study_desc)?$shine_study->study_desc:'' }}
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