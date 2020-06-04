<div class="form-group">
    <label class="pay">Category Roles <small>(monster)</small></label>
    <select name="category_role_id" class="list-dt form-control" id="category_role_id">
        <option value="0">-Select Category Role-</option>
        @if(count($monster_category_role_mappings))
        @foreach($monster_category_role_mappings as $category_role)
        <option value="{{ $category_role->role_id }}">
            {{ isset($category_role->role_name)?$category_role->role_name:'' }}
        </option>
        @endforeach
        @endif
    </select>
</div>