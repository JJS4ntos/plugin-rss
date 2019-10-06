@extends('index')
@section('content')

        <div id="dashboard-widgets" class="metabox-holder">
          <div id="postbox-container-1" class="postbox-container">
            <div id="normal-sortables" class="meta-box-sortables ui-sortable">
              <div id="metabox" class="postbox">
                <button type="button" class="handlediv" aria-expanded="true">
                  <span class="screen-reader-text">Metabox collapse</span>
                  <span class="toggle-indicator" aria-hidden="true"></span>
                </button>
                <h2 class="hndle ui-sortable-handle"><span>WP-Admin reference Metabox</span></h2>
                <div class="inside">
                  <div class="main">
                    <p><strong>Dummy metabox</strong></p>
                    <p>
                      It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                      The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,
                      content here', making it look like readable English.
                    </p>
                    <p>
                      Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for
                      'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, by accident.
                    </p>
                    <p><a class="button button-primary">Don't click me!</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
@endsection
