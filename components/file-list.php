  <div class="downloads-files pad-t-50 wow fadeInUp" id="file_section">
      <div class="container">
          <div class="downloads-files-grid-holder">
              <div class="col-md-12 col-sm-12 col-xs-12 no-margin">
                  <div class="control-bar inline-width">
                      <div class="col-md-8 col-sm-8 col-xs-12">
                          <div class="inline pad-b-30">
                              <div class="le-select width-200">
                                  <select class="sort-by-select" name="order_by" id="order_by">
                                      <option value="title" selected>Title</option>
                                      <option value="price">Price</option>
                                      <option value="created_at">Date</option>
                                      <option value="downloads">Downloads</option>
                                      <option value="visits">Visits</option>
                                      <option value="is_featured">Featured</option>
                                  </select>
                              </div>
                              <div class="le-select">
                                  <select class="sort-type-select hasCustomSelect" name="sort" id="sort"
                                      data-placeholder="Sort Type">
                                      <option value="DESC">Descending</option>
                                      <option value="ASC" selected>Ascending</option>

                                  </select>
                              </div>
                              <button type="submit" id="btn-sort"
                                  class="btn-inline btn btn-sm btn-primary">Sort</button>
                          </div>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-12 pull-right">
                          <div class="grid-list-buttons pull-right">
                              <ul class="pull-right">
                                  <li class="grid-list-button-item">
                                      <button id="grid_view" class="btn btn-primary"><i class="fa fa-th-large"></i>
                                          Grid</button>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 pull-right">
                          <div class="grid-list-buttons pull-right">
                              <ul>
                                  <li class="grid-list-button-item">
                                      <button id="list_view" class="btn"><i class="fa fa-th-list"></i>
                                          List</button>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="file_container_grid" class=""></div>
              <div id="file_container_list" class="hidden"></div>
          </div>
      </div>
  </div>