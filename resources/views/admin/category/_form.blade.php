<div class="form-group">
  <label for="parent" class="col-md-3 control-label">
    Parent
  </label>
  <div class="col-md-8">
      <select  class="form-control" name="parent_id" id="parent_id" >
          <option value="0">Родитель</option>
          {!! $options  !!}
      </select>
  </div>
</div>

<div class="form-group">
  <label for="title" class="col-md-3 control-label">
    Slug
  </label>
  <div class="col-md-8">
    <input type="text" class="form-control" name="slug"
           id="title" value="{{ $slug }}">
  </div>
</div>

<div class="form-group">
  <label for="title" class="col-md-3 control-label">
    Title
  </label>
  <div class="col-md-8">
    <input type="text" class="form-control" name="title"
           id="title" value="{{ $title }}">
  </div>
</div>


<div class="form-group">
  <label for="meta_description" class="col-md-3 control-label">
    Description
  </label>
  <div class="col-md-8">
    <textarea class="form-control" id="meta_description"
              name="description" rows="3">{{
      $description
    }}</textarea>
  </div>
</div>
