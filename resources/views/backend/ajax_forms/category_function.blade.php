<div class="form-group">
    <label class="pay">Category Function <small>(monster)</small> </label>
    <select name="category_function_id" class="list-dt form-control" id="category_function_id" onchange="getCategoryRole(this.value);">
        <option value="0">-Select Category Function-</option>
        @if(count($monsterIndustryCategoryMapping))
        @foreach($monsterIndustryCategoryMapping as $category_function)
        <option value="{{ $category_function->category_function_id }}">
            {{ isset($category_function->category_function_name)?$category_function->category_function_name:'' }}
        </option>
        @endforeach
        @endif
    </select>
</div>