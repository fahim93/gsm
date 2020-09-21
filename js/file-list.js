  function setFileList(data, FOLDER_URL, FILE_DETAILS_URL, BASE_URL, DEFAULT_THUMB_SRC) {
      if (data.length > 0) {
          let content_grid = '';
          let content_list = '';
          for (let i = 0; i < data.length; i++) {
              let file = data[i];
              let id = file.id;
              let folder = file.folder;
              let title = file.title;
              let is_paid = file.is_paid;
              let is_featured = file.is__featured;
              let price = file.price;
              let price_unit = file.price_unit;
              let thumbnail = file.thumbnail;
              let file_size = file.file_size;
              let file_size_unit = file.file_size_unit;
              let created_at = file.created_at;
              let d = new Date(created_at);
              let displaying_date = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
              let thumbnail_src = (thumbnail !== null) ? BASE_URL + thumbnail : BASE_URL + DEFAULT_THUMB_SRC;
              let price_element = (is_paid === 'Yes') ? '<div class="ribbon green"><span>' + price + ' ' + price_unit + '</span></div>' : '';
              let price_element_list_content = (is_paid === 'Yes') ? '<span class="label label-warning">Paid</span><span class="label label-success">' + price + ' ' + price_unit + '</span>' : '<span class="label label-success">Free</span>';
              let featured_element = (is_featured === 'Yes') ? '<span class="label label-info">Featured</span>' : '';
              let button_element = (is_paid === 'Yes') ? '<a class="btn btn-secondary content-btn" href="' + FILE_DETAILS_URL + id + '"><i class="fa fa-money fw-r5"></i>Buy</a>' : '<a class="btn btn-secondary content-btn" href="' + FILE_DETAILS_URL + id + '"><i class="fa fa-download fw-r5"></i>Download</a>';
              let folder_element;
              if (folder != null) {
                  folder_element = '<span class="file-folder text-bold"><a href="' + FOLDER_URL + file.folder + '" target="_blank">' + file.folder_title + '</a></span>';
              } else {
                  folder_element = '<span class="file-folder text-bold"><a href="' + BASE_URL + '" target="_blank">Root Folder</a></span>';
              }
              content_grid +=
                  '<div class="col-md-3 col-sm-4 col-xs-12 no-margin">' +
                  '<div class="file-grid-item">' +
                  '<div class="content-top">' +
                  '<div class="image">' +
                  '<a href="' + FILE_DETAILS_URL + id + '">' +
                  price_element +
                  '<img src="' + thumbnail_src + '" class="img-responsive">' +
                  '</a>' +
                  '</div>' +
                  '<div class="body">' +
                  '<div class="title">' +
                  '<a href="' + FILE_DETAILS_URL + id + '">' + title + '</a>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '<div class="content-bottom">' +
                  '<div class="content-controls">' +
                  '<span class="file-date">' + displaying_date + '</span>' +
                  '<span class="seprator text-muted">&ensp;|&ensp;</span><spanclass="file-date">' + file_size + ' ' + file_size_unit + '</span>' +
                  '</div>' +
                  button_element +
                  '</div>' +
                  '</div>' +
                  '</div>';

              content_list +=
                  '<div class="file-list-item">' +
                  '<div class="image">' +
                  '<a href="' + FILE_DETAILS_URL + id + '">' +
                  '<img src="' + thumbnail_src + '" class="img-responsive">' +
                  '</a>' +
                  '</div>' +
                  '<div class="body">' +
                  '<div class="title">' +
                  '<a href="' + FILE_DETAILS_URL + id + '">' + title + '</a>' +
                  '</div>' +
                  '<div class="file-labels">' +
                  featured_element +
                  price_element_list_content +
                  '</div>' +
                  '<div class="content-controls">' +
                  folder_element +
                  '<span class="seprator text-muted">&ensp;|&ensp;</span>' +
                  '<span class="file-date">Date: ' + displaying_date + '</span>' +
                  '<span class="seprator text-muted">&ensp;|&ensp;</span><span class="file-date">Size: ' + file_size + ' ' + file_size_unit + '</span>' +
                  '</div>' +
                  '</div>' +
                  '<div class="content-buttons">' +
                  button_element +
                  '</div>' +
                  '</div>';
          }
          $('#file_container_grid').html(content_grid);
          $('#file_container_list').html(content_list);
      } else {
          $('#file_section').addClass('hidden');
      }

  }